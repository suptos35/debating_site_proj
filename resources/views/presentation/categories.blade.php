<x-main_layout :categories="$categories">

    <!-- Main Content -->
    <main class="max-w-6xl mx-auto mt-8 px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">All Categories</h1>
            <p class="text-gray-600">Explore discussions across all topic areas</p>
        </div>

        <!-- Categories Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            @foreach($categoriesForView as $category)
            <a href="/presentation/category/{{ $category['id'] }}" class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-100 card-hover">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 {{ $category['bg_color'] }} rounded-lg flex items-center justify-center mr-4">
                            <i class="{{ $category['icon'] }} text-white text-xl"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">{{ $category['name'] }}</h3>
                            <p class="text-sm text-gray-500">{{ $category['discussions_count'] }} discussions</p>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">{{ $category['description'] }}</p>
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-gray-500">{{ $category['weekly_posts'] }} new this week</span>
                        <div class="flex items-center space-x-1">
                            @foreach($category['top_writers'] as $writer)
                            <div class="w-6 h-6 {{ $writer['bg'] }} rounded-full flex items-center justify-center">
                                <span class="text-xs {{ $writer['text'] }} font-medium">{{ $writer['initials'] }}</span>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </main>

    </x-main_layout>
