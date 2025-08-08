<x-main_layout :categories="$allCategories">

    <!-- Search Header Section -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div class="mb-4 md:mb-0">
                    <h1 class="text-2xl font-bold text-gray-900">Search Results</h1>
                    <p class="text-gray-600 mt-1">
                        @if($keyword)
                            Showing results for "<span class="font-semibold text-blue-600">{{ $keyword }}</span>"
                        @else
                            Enter a search term to find discussions, categories, writers, and polls
                        @endif
                    </p>
                </div>

                <!-- Search Form -->
                <div class="relative max-w-md w-full">
                    <form action="{{ route('presentation.search') }}" method="GET">
                        <input type="text" name="q" value="{{ $keyword }}" placeholder="Search discussions, writers, categories..."
                               class="w-full px-4 py-2 pr-10 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <button type="submit" class="absolute inset-y-0 right-0 flex items-center pr-3">
                            <i class="fas fa-search text-gray-400 hover:text-blue-500"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="max-w-6xl mx-auto mt-6 px-4 sm:px-6 lg:px-8">

        <!-- Results Overview -->
        @if($keyword)
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white p-4 rounded-lg border border-gray-200 text-center">
                <div class="text-2xl font-bold text-blue-600">{{ $posts->count() }}</div>
                <div class="text-sm text-gray-600">Discussions</div>
            </div>
            <div class="bg-white p-4 rounded-lg border border-gray-200 text-center">
                <div class="text-2xl font-bold text-green-600">{{ $categories->count() }}</div>
                <div class="text-sm text-gray-600">Categories</div>
            </div>
            <div class="bg-white p-4 rounded-lg border border-gray-200 text-center">
                <div class="text-2xl font-bold text-purple-600">{{ $writers->count() }}</div>
                <div class="text-sm text-gray-600">Writers</div>
            </div>
            <div class="bg-white p-4 rounded-lg border border-gray-200 text-center">
                <div class="text-2xl font-bold text-orange-600">{{ $polls->count() }}</div>
                <div class="text-sm text-gray-600">Polls</div>
            </div>
        </div>
        @endif

        <!-- Filter Tabs -->
        @if($keyword)
        <div class="flex flex-wrap gap-2 mb-6 border-b border-gray-200">
            <button class="px-4 py-2 text-sm font-medium text-blue-600 border-b-2 border-blue-600">
                All Results
            </button>
            <button class="px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-700 border-b-2 border-transparent">
                Discussions ({{ $posts->count() }})
            </button>
            <button class="px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-700 border-b-2 border-transparent">
                Categories ({{ $categories->count() }})
            </button>
            <button class="px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-700 border-b-2 border-transparent">
                Writers ({{ $writers->count() }})
            </button>
            <button class="px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-700 border-b-2 border-transparent">
                Polls ({{ $polls->count() }})
            </button>
        </div>
        @endif

        <!-- Discussions Section -->
        @if($keyword)
        <div class="mb-12">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-comments text-blue-600 mr-2"></i>
                    Discussions
                    <span class="ml-2 px-2 py-1 bg-blue-100 text-blue-600 text-xs rounded-full">{{ $posts->count() }}</span>
                </h2>
            </div>

            @if($posts->count() > 0)
                <div class="grid lg:grid-cols-2 gap-6">
                    @foreach($posts as $post)
                        <x-post_card :post="$post" />
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-xl border border-gray-200 p-12 text-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-search text-gray-400 text-xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No discussions found</h3>
                    <p class="text-gray-600 text-sm mb-4">
                        We couldn't find any discussions matching "<strong>{{ $keyword }}</strong>". Try different keywords or explore our categories.
                    </p>
                    <a href="/presentation/categories" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                        Browse Categories
                    </a>
                </div>
            @endif
        </div>
        @endif

        <!-- Categories Section -->
        @if($keyword)
        <div class="mb-12">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-tags text-green-600 mr-2"></i>
                    Categories
                    <span class="ml-2 px-2 py-1 bg-green-100 text-green-600 text-xs rounded-full">{{ $categories->count() }}</span>
                </h2>
            </div>

            @if($categories->count() > 0)
                <div class="grid md:grid-cols-2 gap-6">
                    @foreach($categories as $category)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 card-hover">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-600 rounded-lg flex items-center justify-center mr-4">
                                    <i class="fas fa-tag text-white text-lg"></i>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">
                                        {{ $category->name }}
                                    </h3>
                                    <p class="text-sm text-gray-600">{{ $category->posts->count() }} discussions • {{ $category->followers_count ?? 0 }} followers</p>
                                </div>
                            </div>
                            <p class="text-gray-600 text-sm mb-4">
                                {{ $category->description ?? 'Discussions about ' . $category->name }}
                            </p>
                            <div class="flex justify-between items-center">
                                <div class="flex space-x-2">
                                    <span class="px-2 py-1 bg-blue-100 text-blue-600 text-xs rounded">{{ $category->name }}</span>
                                </div>
                                <a href="/presentation/category/{{ $category->id }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                    View →
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-xl border border-gray-200 p-12 text-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-search text-gray-400 text-xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No categories found</h3>
                    <p class="text-gray-600 text-sm mb-4">
                        We couldn't find any categories matching "<strong>{{ $keyword }}</strong>". Browse all categories to find what you're looking for.
                    </p>
                    <a href="/presentation/categories" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                        Browse All Categories
                    </a>
                </div>
            @endif
        </div>
        @endif

        <!-- Writers Section -->
        @if($keyword)
        <div class="mb-12">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-users text-purple-600 mr-2"></i>
                    Writers
                    <span class="ml-2 px-2 py-1 bg-purple-100 text-purple-600 text-xs rounded-full">{{ $writers->count() }}</span>
                </h2>
            </div>

            @if($writers->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($writers as $writer)
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 card-hover">
                            <div class="text-center mb-4">
                                <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <span class="text-white text-lg font-bold">
                                        {{ strtoupper(substr($writer->name, 0, 1)) }}{{ strtoupper(substr(explode(' ', $writer->name)[1] ?? '', 0, 1)) }}
                                    </span>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900">{{ $writer->name }}</h3>
                                <p class="text-sm text-gray-600">{{ $writer->email }}</p>
                            </div>

                            <div class="text-center mb-4">
                                <p class="text-gray-600 text-sm">
                                    Active member sharing insights and participating in discussions across various topics.
                                </p>
                            </div>

                            <div class="grid grid-cols-3 gap-4 text-center text-sm mb-4">
                                <div>
                                    <div class="font-semibold text-gray-900">{{ $writer->posts->count() }}</div>
                                    <div class="text-gray-600">Posts</div>
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900">{{ $writer->followers_count ?? 0 }}</div>
                                    <div class="text-gray-600">Followers</div>
                                </div>
                                <div>
                                    <div class="font-semibold text-gray-900">{{ $writer->likes_count ?? 0 }}</div>
                                    <div class="text-gray-600">Likes</div>
                                </div>
                            </div>

                            <div class="flex space-x-2 mb-4 flex-wrap">
                                @foreach($writer->posts->take(2) as $post)
                                    @foreach($post->categories->take(1) as $category)
                                        <span class="px-2 py-1 bg-blue-100 text-blue-600 text-xs rounded">{{ $category->name }}</span>
                                    @endforeach
                                @endforeach
                            </div>

                            <a href="/presentation/writer/{{ strtolower(str_replace(' ', '-', $writer->name)) }}" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition-colors text-center block">
                                View Profile
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-xl border border-gray-200 p-12 text-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-search text-gray-400 text-xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No writers found</h3>
                    <p class="text-gray-600 text-sm mb-4">
                        We couldn't find any writers matching "<strong>{{ $keyword }}</strong>". Explore our community to discover talented writers.
                    </p>
                    <a href="/presentation/writers" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                        Browse Writers
                    </a>
                </div>
            @endif
        </div>
        @endif

        <!-- Polls Section -->
        @if($keyword)
        <div class="mb-12">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-poll text-orange-600 mr-2"></i>
                    Polls
                    <span class="ml-2 px-2 py-1 bg-orange-100 text-orange-600 text-xs rounded-full">{{ $polls->count() }}</span>
                </h2>
            </div>

            @if($polls->count() > 0)
                <div class="grid lg:grid-cols-2 gap-6">
                    @foreach($polls as $poll)
                        <x-poll_card :poll="$poll" />
                    @endforeach
                </div>
            @else
                <div class="bg-white rounded-xl border border-gray-200 p-12 text-center">
                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-search text-gray-400 text-xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">No polls found</h3>
                    <p class="text-gray-600 text-sm mb-4">
                        We couldn't find any polls matching "<strong>{{ $keyword }}</strong>". Check out our latest polls to participate in community discussions.
                    </p>
                    <a href="/presentation/all-polls" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                        Browse Polls
                    </a>
                </div>
            @endif
        </div>
        @endif

    </main>

    <!-- Footer -->
</x-main_layout>

