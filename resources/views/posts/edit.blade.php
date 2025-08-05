<x-main_layout :categories="$categories">
    <main class="max-w-4xl mx-auto mt-6 lg:mt-10 p-6">
        <div class="bg-white rounded-lg shadow-md p-8">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Edit Discussion</h1>
                <a href="/" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                    ← Back to Home
                </a>
            </div>

            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('posts.update', $post) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-6">
                    <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Title</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}" maxlength="255"
                           class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                    @error('title')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="excerpt" class="block mb-2 text-sm font-medium text-gray-900">Summary/Excerpt</label>
                    <textarea id="excerpt" name="excerpt" maxlength="1000" rows="3"
                              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                              placeholder="Brief summary of your discussion topic...">{{ old('excerpt', $post->excerpt) }}</textarea>
                    @error('excerpt')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="content" class="block mb-2 text-sm font-medium text-gray-900">Content</label>
                    <textarea id="content" name="content" rows="8"
                              class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                              placeholder="Detailed content of your discussion..." required>{{ old('content', $post->content) }}</textarea>
                    @error('content')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="categories" class="block mb-2 text-sm font-medium text-gray-900">Categories</label>
                    <select id="categories" name="categories[]" multiple
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                    {{ in_array($category->id, old('categories', $postCategories)) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <p class="mt-1 text-sm text-gray-500">Hold Ctrl (Windows) or Cmd (Mac) to select multiple categories</p>
                    @error('categories')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                    <div class="flex space-x-3">
                        <button type="submit"
                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                            Update Discussion
                        </button>
                        <a href="/"
                           class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900">
                            Cancel
                        </a>
                    </div>

                    <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline"
                          onsubmit="return confirm('Are you sure you want to delete this discussion? This action cannot be undone and will also delete all related arguments and references.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5">
                            <i class="fas fa-trash mr-1"></i>
                            Delete Discussion
                        </button>
                    </form>
                </div>
            </form>
        </div>
    </main>
</x-main_layout>
