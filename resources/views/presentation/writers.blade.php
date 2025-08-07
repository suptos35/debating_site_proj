<x-main_layout :writers="$writers">

    <!-- Main Content -->
    <main class="max-w-6xl mx-auto mt-8 px-4 sm:px-6 lg:px-8">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">All Writers</h1>
            <p class="text-gray-600">Discover expert voices and researchers</p>
        </div>

        <!-- Writers Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
            @foreach($writers as $writer)
            <a href="/presentation/writer/{{ $writer['slug'] }}" class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-100 card-hover">
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-16 h-16 {{ $writer['avatar_class'] }} rounded-full flex items-center justify-center mr-4">
                            <span class="{{ $writer['text_class'] }} text-xl font-bold">{{ $writer['initials'] }}</span>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-semibold text-gray-900">{{ $writer['name'] }}</h3>
                            <p class="text-sm text-gray-600">{{ $writer['title'] }}</p>
                        </div>
                    </div>

                    <div class="mb-4">
                        <p class="text-gray-600 text-sm">{{ $writer['bio'] }}</p>
                    </div>

                    <div class="grid grid-cols-3 gap-4 mb-4 text-center">
                        <div>
                            <div class="text-lg font-semibold text-gray-900">{{ $writer['posts_count'] }}</div>
                            <div class="text-xs text-gray-500">Discussions</div>
                        </div>
                        <div>
                            <div class="text-lg font-semibold text-gray-900">{{ $writer['total_likes'] }}</div>
                            <div class="text-xs text-gray-500">Likes</div>
                        </div>
                        <div>
                            <div class="text-lg font-semibold text-gray-900">{{ $writer['followers'] }}</div>
                            <div class="text-xs text-gray-500">Followers</div>
                        </div>
                    </div>

                    <div class="flex flex-wrap gap-1 mb-4">
                        @foreach($writer['specialties'] as $specialty)
                        <span class="px-2 py-1 bg-gray-100 text-gray-600 rounded text-xs">{{ $specialty }}</span>
                        @endforeach
                    </div>

                    <div class="flex items-center justify-between text-xs text-gray-500">
                        <span>Active {{ $writer['last_active'] }}</span>
                        <span class="flex items-center">
                            <i class="fas fa-star text-yellow-500 mr-1"></i> {{ $writer['rating'] }}
                        </span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    </main>

    </x-main_layout>
