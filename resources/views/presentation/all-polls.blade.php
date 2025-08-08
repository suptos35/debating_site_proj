<x-main_layout :categories="$categories">
    <x-slot name="title">All Polls</x-slot>

    <!-- Header Section -->
    <div class="bg-gradient-to-r from-purple-600 to-pink-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center">
                <h1 class="text-4xl font-bold mb-4">Community Polls</h1>
                <p class="text-xl text-purple-100 max-w-2xl mx-auto">
                    Participate in community polls and see what others think about important topics
                </p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Stats Section -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-poll text-purple-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-2xl font-bold text-gray-900">{{ number_format($polls->count()) }}</h3>
                        <p class="text-gray-600">Total Polls</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-vote-yea text-green-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-2xl font-bold text-gray-900">{{ number_format($polls->sum(function($poll) { return $poll->options->sum('votes_count'); })) }}</h3>
                        <p class="text-gray-600">Total Votes</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-users text-blue-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-2xl font-bold text-gray-900">{{ number_format($polls->sum(function($poll) { return $poll->votes()->distinct('user_id')->count('user_id'); })) }}</h3>
                        <p class="text-gray-600">Users Voted</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-user-edit text-orange-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-2xl font-bold text-gray-900">{{ number_format($polls->pluck('user_id')->unique()->count()) }}</h3>
                        <p class="text-gray-600">Poll Creators</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Polls Section -->
        @if($polls->count() > 0)
            <div class="mb-8">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">All Polls</h2>
                    <div class="text-sm text-gray-500">
                        Showing {{ $polls->count() }} polls
                    </div>
                </div>

                <div class="grid lg:grid-cols-2 gap-6">
                    @foreach ($polls as $poll)
                        <x-poll_card :poll="$poll" />
                    @endforeach
                </div>
            </div>
        @else
            <div class="text-center py-16">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-poll text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">No Polls Yet</h3>
                <p class="text-gray-600 mb-6">Be the first to create a poll and get community opinions!</p>
                @auth
                    <button type="button" data-modal-target="poll-modal" data-modal-toggle="poll-modal"
                        class="bg-purple-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-purple-700 transition-colors">
                        Create a Poll
                    </button>
                @else
                    <a href="{{ route('register') }}" class="bg-purple-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-purple-700 transition-colors inline-block">
                        Join to Create Polls
                    </a>
                @endauth
            </div>
        @endif
    </main>
</x-main_layout>
