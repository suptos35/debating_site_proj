<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\NotificationService;
use Illuminate\Http\JsonResponse;

class NotificationController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Display a listing of notifications.
     */
    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $notifications = $this->notificationService->getUserNotifications(Auth::id());

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'notifications' => $notifications
            ]);
        }

        return view('notifications.index', compact('notifications'));
    }

    /**
     * Mark a notification as read.
     */
    public function markAsRead($id): JsonResponse
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'You must be logged in'], 401);
        }

        $marked = $this->notificationService->markAsRead($id, Auth::id());

        return response()->json([
            'success' => $marked > 0,
            'message' => $marked > 0 ? 'Notification marked as read' : 'Notification not found'
        ]);
    }

    /**
     * Mark all notifications as read.
     */
    public function markAllAsRead(): JsonResponse
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'You must be logged in'], 401);
        }

        $marked = $this->notificationService->markAllAsRead(Auth::id());

        return response()->json([
            'success' => true,
            'message' => "Marked {$marked} notifications as read",
            'marked_count' => $marked
        ]);
    }

    /**
     * Get unread notifications count.
     */
    public function getUnreadCount(): JsonResponse
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'You must be logged in'], 401);
        }

        $count = $this->notificationService->getUnreadCount(Auth::id());

        return response()->json([
            'success' => true,
            'count' => $count
        ]);
    }

    /**
     * Get recent notifications for dropdown/popup.
     */
    public function getRecent(): JsonResponse
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'You must be logged in'], 401);
        }

        $notifications = Auth::user()->notifications()
            ->with(['post', 'triggeredBy', 'notifiable'])
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        return response()->json([
            'success' => true,
            'notifications' => $notifications
        ]);
    }

    /**
     * Delete a notification.
     */
    public function destroy($id): JsonResponse
    {
        if (!Auth::check()) {
            return response()->json(['error' => 'You must be logged in'], 401);
        }

        $deleted = Auth::user()->notifications()->where('id', $id)->delete();

        return response()->json([
            'success' => $deleted > 0,
            'message' => $deleted > 0 ? 'Notification deleted' : 'Notification not found'
        ]);
    }
}
