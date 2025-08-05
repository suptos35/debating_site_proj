<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poll;
use App\Models\PollOption;
use App\Models\PollVote;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PollController extends Controller
{
    public function index()
    {
        $polls = Poll::with(['user', 'options'])
            ->where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('polls.index', compact('polls'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'options' => 'required|array|min:2|max:10',
            'options.*' => 'required|string|max:255|distinct',
            'multiple_choice' => 'boolean',
            'expires_at' => 'nullable|date|after:now'
        ]);

        DB::transaction(function () use ($request) {
            $poll = Poll::create([
                'title' => $request->title,
                'description' => $request->description,
                'user_id' => Auth::id(),
                'multiple_choice' => $request->boolean('multiple_choice'),
                'expires_at' => $request->expires_at
            ]);

            foreach ($request->options as $optionText) {
                if (!empty(trim($optionText))) {
                    $poll->options()->create([
                        'option_text' => trim($optionText)
                    ]);
                }
            }
        });

        return back()->with('success', 'Poll created successfully!');
    }

    public function vote(Request $request, Poll $poll)
    {
        Log::info('Vote method called', [
            'poll_id' => $poll->id,
            'user_id' => Auth::id(),
            'request_data' => $request->all()
        ]);

        if (!Auth::check()) {
            Log::warning('Vote attempted without authentication');
            return response()->json(['error' => 'You must be logged in to vote'], 401);
        }

        if (!$poll->canVote()) {
            Log::warning('Vote attempted on inactive poll', ['poll_id' => $poll->id]);
            return response()->json(['error' => 'This poll is not accepting votes'], 400);
        }

        $request->validate([
            'option_ids' => 'required|array',
            'option_ids.*' => 'exists:poll_options,id'
        ]);

        $userId = Auth::id();

        // Check if user already voted and it's not multiple choice
        if (!$poll->multiple_choice && $poll->hasUserVoted($userId)) {
            Log::warning('User already voted on single-choice poll', [
                'poll_id' => $poll->id,
                'user_id' => $userId
            ]);
            return response()->json(['error' => 'You have already voted in this poll'], 400);
        }

        DB::transaction(function () use ($poll, $request, $userId) {
            // If not multiple choice, remove any existing votes
            if (!$poll->multiple_choice) {
                $existingVotes = $poll->votes()->where('user_id', $userId)->get();

                foreach ($existingVotes as $vote) {
                    PollOption::where('id', $vote->poll_option_id)->decrement('votes_count');
                    $vote->delete();
                }
            }

            // Add new votes
            foreach ($request->option_ids as $optionId) {
                // Check if this specific option was already voted for (in multiple choice)
                $existingVote = PollVote::where([
                    'poll_id' => $poll->id,
                    'poll_option_id' => $optionId,
                    'user_id' => $userId
                ])->first();

                if (!$existingVote) {
                    PollVote::create([
                        'poll_id' => $poll->id,
                        'poll_option_id' => $optionId,
                        'user_id' => $userId
                    ]);

                    // Increment vote count
                    PollOption::where('id', $optionId)->increment('votes_count');
                }
            }
        });

        Log::info('Vote recorded successfully', [
            'poll_id' => $poll->id,
            'user_id' => $userId,
            'option_ids' => $request->option_ids
        ]);

        // Return updated poll data
        $poll->load('options');
        return response()->json([
            'success' => true,
            'message' => 'Vote recorded successfully!',
            'poll' => $poll
        ]);
    }

    public function destroy(Poll $poll)
    {
        if (Auth::id() !== $poll->user_id) {
            abort(403);
        }

        $poll->delete();
        return back()->with('success', 'Poll deleted successfully!');
    }
}
