<x-main_layout :categories="$categories">

    <!-- Writer Header -->
    <div class="bg-gray-100 border-b">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex items-center space-x-6">
                <div class="w-20 h-20 {{ $writer['avatar_class'] }} rounded-full flex items-center justify-center">
                    <span class="{{ $writer['text_class'] }} text-2xl font-bold">{{ $writer['initials'] }}</span>
                </div>
                <div class="flex-1">
                    <h1 class="text-3xl font-bold text-gray-900">{{ $writer['name'] }}</h1>
                    <p class="text-gray-600 mt-1">{{ $writer['title'] }}</p>
                    <div class="flex items-center space-x-6 mt-3 text-sm text-gray-500">
                        <span><i class="fas fa-file-alt mr-1"></i> {{ $writer['posts_count'] }} discussions</span>
                        <span><i class="fas fa-thumbs-up mr-1"></i> {{ $writer['total_likes'] }} likes</span>
                        <span><i class="fas fa-calendar mr-1"></i> Joined {{ $writer['joined'] }}</span>
                    </div>
                </div>
                <div>
                    <button class="bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                        <i class="fas fa-plus mr-2"></i> Follow
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="max-w-6xl mx-auto mt-8 px-4 sm:px-6 lg:px-8">
        <!-- Posts Section -->
        <div class="mb-12">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Discussions by {{ $writer['name'] }}</h2>
                <span class="text-sm text-gray-500">{{ $user->posts_count ?? 0 }} discussions</span>
            </div>

            @if($user->posts_count > 0)
            <div class="lg:grid lg:grid-cols-3 gap-6 space-y-6 lg:space-y-0">
                @foreach($user->posts()->whereNull('parent_id')->with(['user', 'categories', 'references', 'children'])->get() as $post)
                    <x-post_card :post="$post" />
                @endforeach
            </div>
            @else
            <div class="bg-white rounded-xl shadow-sm p-8 text-center">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-file-alt text-gray-400 text-xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">No discussions yet</h3>
                <p class="text-gray-500">{{ $writer['name'] }} hasn't created any discussions yet.</p>
            </div>
            @endif
        </div>
    </main>

    <!-- Footer -->
   </x-main_layout>
