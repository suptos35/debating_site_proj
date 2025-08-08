<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Post;
use App\Models\Reference;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function reportContent(Request $request)
    {
        $request->validate([
            'reportable_type' => 'required|string',
            'reportable_id' => 'required|integer',
            'reason' => 'required|in:spam,abuse,misinfo,irrelevant,contradiction,other'
        ]);

        $reportableType = $request->reportable_type;
        $reportableId = $request->reportable_id;

        // Check if content exists
        if ($reportableType === 'App\Models\Post') {
            $content = Post::find($reportableId);
        } else {
            $content = Reference::find($reportableId);
        }

        if (!$content) {
            return response()->json([
                'success' => false,
                'message' => 'Content not found.'
            ], 404);
        }

        // Check if user already reported this content
        $existingReport = Report::where([
            'user_id' => Auth::id(),
            'reportable_type' => $reportableType,
            'reportable_id' => $reportableId
        ])->first();

        if ($existingReport) {
            return response()->json([
                'success' => false,
                'message' => 'You have already reported this content.'
            ], 409);
        }

        // Create the report
        $report = Report::create([
            'user_id' => Auth::id(),
            'reportable_type' => $reportableType,
            'reportable_id' => $reportableId,
            'reason' => $request->reason
        ]);

        // Check if this is the first report for this content
        $isFirstReport = Report::where([
            'reportable_type' => $reportableType,
            'reportable_id' => $reportableId,
            'status' => 'pending'
        ])->count() === 1;

        // If it's the first report, create notification for admins
        if ($isFirstReport) {
            $this->notifyAdmins($report);
        }

        return response()->json([
            'success' => true,
            'message' => 'Report submitted successfully. Thank you for helping keep our community safe.'
        ]);
    }

    private function notifyAdmins($report)
    {
        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {
            Notification::create([
                'user_id' => $admin->id,
                'type' => 'content_reported',
                'post_id' => null,
                'triggered_by_user_id' => $report->user_id,
                'notifiable_type' => $report->reportable_type,
                'notifiable_id' => $report->reportable_id,
                'is_read' => false
            ]);
        }
    }

    public function getReportDetails(Request $request)
    {
        $request->validate([
            'type' => 'required|in:post,reference',
            'id' => 'required|integer'
        ]);

        $reportableType = $request->type === 'post' ? 'App\Models\Post' : 'App\Models\Reference';
        $reportableId = $request->id;

        // Get report summary
        $reportSummary = Report::getReportSummary($reportableType, $reportableId);
        $totalReports = Report::getTotalReportsCount($reportableType, $reportableId);

        // Get the content details
        if ($request->type === 'post') {
            $content = Post::with(['user', 'parent', 'categories'])->find($reportableId);
            if (!$content) {
                return response()->json([
                    'success' => false,
                    'message' => 'Post not found.'
                ], 404);
            }

            $contentDetails = [
                'type' => 'post',
                'title' => $content->title ?? 'Untitled',
                'content' => substr($content->content, 0, 200) . '...',
                'author' => $content->user->name,
                'author_email' => $content->user->email,
                'created_at' => $content->created_at->format('M d, Y H:i'),
                'is_argument' => $content->parent_id !== null,
                'parent_post' => $content->parent ? [
                    'id' => $content->parent->id,
                    'title' => $content->parent->title ?? $content->parent->content
                ] : null,
                'categories' => $content->categories->pluck('name')->toArray()
            ];
        } else {
            $content = Reference::with(['post.user'])->find($reportableId);
            if (!$content) {
                return response()->json([
                    'success' => false,
                    'message' => 'Reference not found.'
                ], 404);
            }

            $contentDetails = [
                'type' => 'reference',
                'title' => $content->description ?? 'Reference',
                'url' => $content->url,
                'description' => $content->description,
                'author' => $content->post ? $content->post->user->name : 'Unknown',
                'author_email' => $content->post ? $content->post->user->email : 'Unknown',
                'created_at' => $content->created_at->format('M d, Y H:i'),
                'parent_post' => $content->post ? [
                    'id' => $content->post->id,
                    'title' => $content->post->title ?? $content->post->content
                ] : null
            ];
        }

        return response()->json([
            'success' => true,
            'reportSummary' => $reportSummary,
            'totalReports' => $totalReports,
            'contentDetails' => $contentDetails
        ]);
    }

    public function resolveReport(Request $request)
    {
        $request->validate([
            'type' => 'required|in:post,reference',
            'id' => 'required|integer',
            'action' => 'required|in:resolve,delete_content'
        ]);

        $reportableType = $request->type === 'post' ? 'App\Models\Post' : 'App\Models\Reference';
        $reportableId = $request->id;

        DB::transaction(function () use ($request, $reportableType, $reportableId) {
            if ($request->action === 'delete_content') {
                // Delete the content
                if ($request->type === 'post') {
                    $post = Post::find($reportableId);
                    if ($post) {
                        $post->delete();
                    }
                } else {
                    $reference = Reference::find($reportableId);
                    if ($reference) {
                        $reference->delete();
                    }
                }
            }

            // Mark all reports for this content as resolved
            Report::where([
                'reportable_type' => $reportableType,
                'reportable_id' => $reportableId,
                'status' => 'pending'
            ])->update([
                'status' => 'resolved',
                'reviewed_by' => Auth::id(),
                'reviewed_at' => now()
            ]);

            // Mark related notifications as read
            Notification::where([
                'notifiable_type' => $reportableType,
                'notifiable_id' => $reportableId,
                'type' => 'content_reported'
            ])->update(['is_read' => true]);
        });

        return response()->json([
            'success' => true,
            'message' => $request->action === 'delete_content'
                ? 'Content deleted and reports resolved successfully.'
                : 'Reports resolved successfully.'
        ]);
    }
}
