@props(['post'])

<!-- Discussion Card -->
<div x-data="{ showModal: false }">
    <article class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-100 card-hover">
        <div class="p-6 cursor-pointer" @click="showModal = true">
            <!-- Image placeholder -->
            <div class="w-full h-48 bg-gradient-to-br from-blue-400 to-blue-600 rounded-lg mb-4 flex items-center justify-center">
                <i class="fas fa-atom text-white text-4xl"></i>
            </div>

            <!-- Categories -->
            <div class="space-x-2 mb-3">
                @foreach ($post->categories as $category)
                    <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-xs font-medium">
                        {{ $category->name }}
                    </span>
                @endforeach
            </div>

            <!-- Title -->
            <h3 class="text-xl font-semibold text-gray-900 mb-3 hover:text-blue-600 cursor-pointer transition-colors">
                {{$post->title}}
            </h3>

            <!-- Excerpt -->
            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                {{$post->excerpt}}
            </p>

            <!-- Stats -->
            <div class="flex items-center justify-between text-sm text-gray-500 border-t pt-4">
                <div class="flex items-center space-x-4">
                    <span class="flex items-center">
                        <i class="fas fa-user mr-1"></i> {{$post->user->name}}
                    </span>
                    <span class="flex items-center text-green-600 like-button cursor-pointer"
                          data-post-id="{{ $post->id }}"
                          onclick="event.stopPropagation(); toggleLike(this, {{ $post->id }})">
                        <i class="fas fa-thumbs-up mr-1 {{ Auth::check() && $post->isLikedByUser(Auth::id()) ? 'text-green-600' : 'text-gray-400' }}"></i>
                        <span class="like-count">{{ $post->like_count ?? 0 }}</span>
                    </span>
                </div>
                <div class="flex items-center space-x-3">
                    <span class="flex items-center text-blue-600">
                        <i class="fas fa-comments mr-1"></i>
                        {{ $post->totalCommentCount() }}
                    </span>
                    <!-- Edit/Delete buttons for post owner -->
                    @auth
                        @if(Auth::id() === $post->user_id && $post->parent_id === null)
                            <div class="flex items-center space-x-2" onclick="event.stopPropagation();">
                                <a href="{{ route('posts.edit', $post) }}"
                                   class="text-blue-600 hover:text-blue-800 p-1 rounded-full hover:bg-blue-50 transition-colors"
                                   title="Edit Discussion">
                                    <i class="fas fa-edit text-xs"></i>
                                </a>
                                <form action="{{ route('posts.destroy', $post) }}" method="POST" class="inline"
                                      onsubmit="event.stopPropagation(); return confirm('Are you sure you want to delete this discussion? This action cannot be undone.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="text-red-600 hover:text-red-800 p-1 rounded-full hover:bg-red-50 transition-colors"
                                            title="Delete Discussion">
                                        <i class="fas fa-trash text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </article>

    <!-- Modal Portal - Outside the card, full screen overlay -->
    <div x-show="showModal"
         x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @keydown.escape.window="showModal = false"
         class="fixed inset-0 z-50 overflow-y-auto"
         style="display: none;">

        <!-- Backdrop -->
        <div class="fixed inset-0 bg-black/50 backdrop-blur-sm" @click="showModal = false"></div>

        <!-- Modal Container -->
        <div class="relative min-h-screen flex items-center justify-center p-4">
            <!-- Modal Content -->
            <div class="relative bg-white rounded-xl shadow-2xl max-w-2xl w-full h-[80vh] overflow-hidden flex flex-col"
                 @click.stop
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 translate-y-4 scale-95"
                 x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                 x-transition:leave="transition ease-in duration-200 transform"
                 x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                 x-transition:leave-end="opacity-0 translate-y-4 scale-95">

                <!-- Close Button - Inside modal bounds -->
                <button @click="showModal = false"
                    class="absolute top-4 right-4 bg-red-500 text-white w-8 h-8 flex items-center justify-center rounded-full shadow-lg hover:bg-red-600 transition-colors z-10">
                    <i class="fas fa-times text-sm"></i>
                </button>

                <!-- Fixed Header Section -->
                <div class="flex-shrink-0 p-6 pb-0">
                    <!-- Post Image -->
                    <div class="w-full h-48 bg-gradient-to-br from-blue-400 to-blue-600 rounded-lg mb-4 flex items-center justify-center">
                        <i class="fas fa-atom text-white text-4xl"></i>
                    </div>

                    <!-- Categories -->
                    <div class="space-x-2 mb-3">
                        @foreach ($post->categories as $category)
                            <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-xs font-medium">
                                {{ $category->name }}
                            </span>
                        @endforeach
                    </div>

                    <!-- Post Title -->
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">{{$post->title}}</h2>
                </div>

                <!-- Scrollable Excerpt Section -->
                <div class="flex-1 px-6 overflow-hidden">
                    <div class="bg-gray-50 rounded-lg p-4 h-full">
                        <div class="text-gray-700 h-full overflow-y-auto">
                            <p class="text-base leading-relaxed">{{$post->excerpt}}</p>
                        </div>
                    </div>
                </div>

                <!-- Fixed Footer Section -->
                <div class="flex-shrink-0 p-6 pt-4">
                    <!-- Author Info -->
                    <div class="flex items-center justify-between border-t pt-4 mb-4">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                <span class="text-blue-600 font-semibold text-sm">{{substr($post->user->name, 0, 2)}}</span>
                            </div>
                            <div class="ml-3">
                                <h5 class="font-bold text-gray-900 text-sm">{{$post->user->name}}</h5>
                                <h6 class="text-gray-500 text-xs">Author</h6>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        {{-- <div class="flex items-center space-x-4">
                            <div class="flex items-center space-x-4 text-sm text-gray-500">
                                <span class="flex items-center cursor-pointer" onclick="event.stopPropagation(); toggleLike(this, {{ $post->id }})">
                                    <i class="fas fa-thumbs-up mr-1 {{ Auth::check() && $post->isLikedByUser(Auth::id()) ? 'text-green-600' : 'text-gray-400' }}"></i>
                                    <span class="like-count">{{ $post->like_count ?? 0 }}</span>
                                </span>
                                <span class="flex items-center">
                                    <i class="fas fa-comments mr-1 text-blue-600"></i> {{ $post->totalCommentCount() }}
                                </span>
                            </div>
                        </div> --}}
                    </div>

                    <!-- Read More Button -->
                    <div>
                        <a href="/post/{{$post->id}}"
                            @click="showModal = false"
                            class="block w-full text-center bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition-colors font-semibold text-sm">
                            Read Full Discussion
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Function to toggle like for a post
    function toggleLike(element, postId) {
        @auth
            // Send AJAX request
            fetch(`/posts/${postId}/like`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({})
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update all instances of this post's like count
                    const likeCountElements = document.querySelectorAll(`.like-button[data-post-id="${postId}"] .like-count, .modal-like-count-${postId}`);
                    likeCountElements.forEach(el => {
                        el.textContent = data.likeCount;
                    });

                    // Update all like button icons for this post
                    const likeIcons = document.querySelectorAll(`.like-button[data-post-id="${postId}"] i, .modal-like-icon-${postId}`);
                    likeIcons.forEach(icon => {
                        if (data.liked) {
                            icon.classList.remove('text-gray-400');
                            icon.classList.add('text-green-600');
                        } else {
                            icon.classList.remove('text-green-600');
                            icon.classList.add('text-gray-400');
                        }
                    });
                }
            })
            .catch(error => console.error('Error:', error));
        @else
            // Redirect to login or show login modal
            alert('Please log in to like posts');
        @endauth
    }
</script>
