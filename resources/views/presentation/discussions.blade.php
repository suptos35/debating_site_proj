<x-main_layout :categories="$categories">
    <x-slot name="title">All Discussions</x-slot>

    <!-- Header Section -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center">
                <h1 class="text-4xl font-bold mb-4">All Discussions</h1>
                <p class="text-xl text-blue-100 max-w-2xl mx-auto">
                    Explore all evidence-based discussions from our community
                </p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Stats Section -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-comments text-blue-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-2xl font-bold text-gray-900">{{ number_format($posts->count()) }}</h3>
                        <p class="text-gray-600">Total Discussions</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-users text-green-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-2xl font-bold text-gray-900">{{ number_format($posts->pluck('user_id')->unique()->count()) }}</h3>
                        <p class="text-gray-600">Active Contributors</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-tags text-purple-600 text-xl"></i>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-2xl font-bold text-gray-900">{{ number_format($categories->count()) }}</h3>
                        <p class="text-gray-600">Categories</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Discussions Grid -->
        @if($posts->count() > 0)
            <div class="mb-8">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Recent Discussions</h2>
                    <div class="text-sm text-gray-500">
                        Showing {{ $posts->count() }} discussions
                    </div>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($posts as $post)
                        <x-post_card :post="$post"></x-post_card>
                    @endforeach
                </div>
            </div>
        @else
            <div class="text-center py-16">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-comments text-gray-400 text-3xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-900 mb-2">No Discussions Yet</h3>
                <p class="text-gray-600 mb-6">Be the first to start a discussion in the community!</p>
                @auth
                    <button type="button" data-modal-target="post-modal" data-modal-toggle="post-modal"
                        class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                        Start a Discussion
                    </button>
                @else
                    <a href="{{ route('register') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors inline-block">
                        Join to Start Discussing
                    </a>
                @endauth
            </div>
        @endif
    </main>
</x-main_layout>
