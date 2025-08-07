<x-main_layout :categories="$categories">
    <!-- Hero Section with Categories from homepage -->
    <div class="gradient-bg">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <!-- Search Field in Top Right -->
            <div class="flex justify-end mb-8">
                <form action="/search" method="GET" class="relative">
                    <input type="text" name="q" placeholder="Search discussions..." class="w-80 px-4 py-2 pr-10 text-sm border border-white/20 bg-white/10 text-white placeholder-white/70 rounded-lg focus:outline-none focus:ring-2 focus:ring-white/50 focus:border-transparent backdrop-blur-sm">
                    <button type="submit" class="absolute inset-y-0 right-0 flex items-center pr-3">
                        <i class="fas fa-search text-white/70 hover:text-white cursor-pointer"></i>
                    </button>
                </form>
            </div>

            <div class="text-center text-white">
                <h1 class="text-4xl font-bold mb-4">Evidence-Based Discussions</h1>
                <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                    Join structured debates where every argument is backed by verified sources and credible references.
                </p>

                <!-- Categories display -->
                {{-- @if($categories->count() > 0)
                    <div class="flex flex-wrap justify-center gap-3 mb-8">
                        @foreach($categories->take(10) as $category)
                            <a href="/categories/{{ $category->id }}"
                               class="px-4 py-2 bg-white/20 backdrop-blur-sm text-white rounded-full text-sm font-medium hover:bg-white/30 transition-all">
                                {{ $category->name }}
                            </a>
                        @endforeach
                        @if($categories->count() > 10)
                            <a href="/categories"
                               class="px-4 py-2 bg-white/10 backdrop-blur-sm text-white/80 rounded-full text-sm font-medium hover:bg-white/20 transition-all">
                                View All...
                            </a>
                        @endif
                    </div>
                @endif --}}

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    @auth
                        <button type="button" data-modal-target="post-modal" data-modal-toggle="post-modal"
                            class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-blue-50 transition-colors">
                            Start a Discussion
                        </button>
                    @else
                        <a href="{{ route('register') }}" class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-blue-50 transition-colors">
                            Join the Discussion
                        </a>
                    @endauth
                    <a href="/categories" class="border-2 border-white text-white px-6 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition-all">
                        Browse Topics
                    </a>
                </div>
            </div>
        </div>
    </div>
    <main class="max-w-6xl mx-auto mt-6 lg:mt-10 px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-3 gap-6">
            <!-- Left and Middle Columns: Posts Section -->
            <div class="lg:col-span-2">
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Latest Discussions</h2>
                    <div class="grid md:grid-cols-2 gap-6">
                        @foreach ($posts->take(4) as $post)
                            <x-post_card :post="$post"></x-post_card>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Right Column: Popular Categories and Writers -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Popular Categories -->
                <div class="glass-effect rounded-xl p-6 border border-white shadow-lg">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">

                        Popular Categories
                    </h3>
                    <div class="space-y-3">
                        @for($i = 0; $i < 4; $i++)
                            <div class="flex items-center justify-between p-3 bg-white rounded-lg border border-gray-100 hover:border-blue-200 transition-colors cursor-pointer">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center">
                                        <i class="fas fa-atom text-white text-sm"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-900">Science</h4>

                                    </div>
                                </div>

                            </div>
                        @endfor
                    </div>
                </div>

                <!-- Popular Writers -->
                <div class="glass-effect rounded-xl p-6 border border-white shadow-lg">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">

                        Popular Writers
                    </h3>
                    <div class="space-y-3">
                        @for($i = 0; $i < 4; $i++)
                            <div class="flex items-center justify-between p-3 bg-white rounded-lg border border-gray-100 hover:border-blue-200 transition-colors cursor-pointer">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                        <span class="text-blue-600 font-semibold text-sm">SC</span>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-900">Dr. Sarah Chen</h4>

                                    </div>
                                </div>

                            </div>
                        @endfor
                    </div>
                </div>
            </div>
        </div>

        <!-- Polls Section -->
        @if($polls->isNotEmpty())
            <div class="mt-12">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Community Polls</h2>
                    <a href="{{ route('polls.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                        View All Polls →
                    </a>
                </div>

                <div class="grid lg:grid-cols-2 gap-6">
                    @foreach ($polls as $poll)
                        <x-poll_card :poll="$poll" />
                    @endforeach
                </div>
            </div>
        @endif
      </main>
</x-main_layout>
