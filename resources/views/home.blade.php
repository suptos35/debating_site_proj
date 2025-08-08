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
                    <a href="/presentation/categories" class="border-2 border-white text-white px-6 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition-all">
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
                        <i class="fas fa-chart-pie mr-2 text-blue-600"></i>
                        Popular Categories
                    </h3>
                    <div class="space-y-3">
                        @forelse($popularCategories as $category)
                            <a href="/presentation/category/{{ $category->id }}" class="flex items-center justify-between p-3 bg-white rounded-lg border border-gray-100 hover:border-blue-200 transition-colors cursor-pointer">
                                <div class="flex items-center space-x-3">
                                    @php
                                        // Choose icon based on category name
                                        $icon = 'fas fa-folder';
                                        $bgColor = 'bg-gray-600';
                                        $categoryName = strtolower($category->name);

                                        if (strpos($categoryName, 'science') !== false) {
                                            $icon = 'fas fa-atom';
                                            $bgColor = 'bg-blue-600';
                                        } elseif (strpos($categoryName, 'tech') !== false) {
                                            $icon = 'fas fa-robot';
                                            $bgColor = 'bg-purple-600';
                                        } elseif (strpos($categoryName, 'environment') !== false || strpos($categoryName, 'nature') !== false) {
                                            $icon = 'fas fa-seedling';
                                            $bgColor = 'bg-green-600';
                                        } elseif (strpos($categoryName, 'health') !== false || strpos($categoryName, 'medical') !== false) {
                                            $icon = 'fas fa-heartbeat';
                                            $bgColor = 'bg-red-600';
                                        } elseif (strpos($categoryName, 'politic') !== false || strpos($categoryName, 'government') !== false) {
                                            $icon = 'fas fa-landmark';
                                            $bgColor = 'bg-yellow-600';
                                        } elseif (strpos($categoryName, 'econom') !== false || strpos($categoryName, 'financ') !== false) {
                                            $icon = 'fas fa-chart-line';
                                            $bgColor = 'bg-indigo-600';
                                        }
                                    @endphp
                                    <div class="w-10 h-10 {{ $bgColor }} rounded-lg flex items-center justify-center">
                                        <i class="{{ $icon }} text-white text-sm"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-900">{{ $category->name }}</h4>
                                        <span class="text-xs text-gray-500">{{ number_format($category->view_count) }} views</span>
                                    </div>
                                </div>
                                <span class="text-xs text-blue-600 bg-blue-50 px-2 py-1 rounded-full">{{ $category->posts_count }} posts</span>
                            </a>
                        @empty
                            <div class="p-3 bg-white rounded-lg border border-gray-100">
                                <p class="text-gray-500 text-sm">No categories found</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Popular Writers -->
                <div class="glass-effect rounded-xl p-6 border border-white shadow-lg">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-crown mr-2 text-amber-500"></i>
                        Popular Writers
                    </h3>
                    <div class="space-y-3">
                        @forelse($popularWriters as $writer)
                            <a href="/presentation/writer/{{ strtolower(str_replace(' ', '-', $writer->name)) }}" class="flex items-center justify-between p-3 bg-white rounded-lg border border-gray-100 hover:border-blue-200 transition-colors cursor-pointer">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10
                                        @php
                                            // Generate avatar background color based on user ID
                                            $avatarClasses = ['bg-blue-100', 'bg-green-100', 'bg-purple-100', 'bg-yellow-100', 'bg-pink-100', 'bg-indigo-100'];
                                            $textClasses = ['text-blue-600', 'text-green-600', 'text-purple-600', 'text-yellow-600', 'text-pink-600', 'text-indigo-600'];
                                            $avatarIndex = $writer->id % count($avatarClasses);
                                            echo $avatarClasses[$avatarIndex];
                                        @endphp
                                        rounded-full flex items-center justify-center">
                                        <span class="{{ $textClasses[$avatarIndex] }} font-semibold text-sm">
                                            @php
                                                // Generate initials from name
                                                $nameParts = explode(' ', $writer->name);
                                                $initials = '';
                                                if (count($nameParts) >= 1) {
                                                    $initials .= strtoupper(substr($nameParts[0], 0, 1));
                                                    if (count($nameParts) >= 2) {
                                                        $initials .= strtoupper(substr($nameParts[1], 0, 1));
                                                    }
                                                }
                                                echo $initials;
                                            @endphp
                                        </span>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-900">{{ $writer->name }}</h4>
                                        <span class="text-xs text-gray-500">{{ number_format($writer->total_views) }} views</span>
                                    </div>
                                </div>
                                <span class="text-xs text-blue-600 bg-blue-50 px-2 py-1 rounded-full">
                                    {{ $writer->posts()->whereNull('parent_id')->count() }} posts
                                </span>
                            </a>
                        @empty
                            <div class="p-3 bg-white rounded-lg border border-gray-100">
                                <p class="text-gray-500 text-sm">No writers found</p>
                            </div>
                        @endforelse
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
