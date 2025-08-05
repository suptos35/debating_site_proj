@props(['post', 'pros', 'cons'])

<!-- Topic content -->
<p class="border-2 border-blue-200 mx-64 my-8 p-4">
    {{$post->content}}
</p>

<div class="flex justify-between">
    <!-- Pros Section -->
    <div class="flex flex-col w-2/5 ml-4">
        <div class="flex justify-between items-center mb-2">
            <h2 class="text-green-600 text-xl font-bold">Pros</h2>
            @auth
            <button type="button" data-modal-target="pro-modal" data-modal-toggle="pro-modal"
                class="bg-green-600 hover:bg-green-700 text-white font-bold py-1 px-2 rounded text-sm">
                Add Pro
            </button>
            @endauth
        </div>

        @foreach($pros as $pro)
        <div class="mb-6">
            <!-- Argument content clickable link -->
            <a href="/post/{{$pro->id}}" class="block border-2 border-blue-200 m-2 p-2">
                <p class="text-center">{{$pro->content}}</p>
            </a>
            <!-- User name and Like icon on the same line -->
            <div class="flex justify-between items-center mt-2 text-sm text-gray-600">
                <!-- Username (Left aligned, smaller, moved right, underlined) -->
                <span class="underline text-xs ml-2">{{$pro->user->name}}</span>
                <!-- Reference icon/word -->
<button type="button"
    data-modal-target="reference-modal-{{ $pro->id }}"
    data-modal-toggle="reference-modal-{{ $pro->id }}"
    class="flex items-center text-blue-600 hover:underline text-xs ml-2">
    <i class="fas fa-link mr-1"></i> References
</button>
<span class="ml-1 text-xs text-gray-400">({{ $pro->references->count() }})</span>
                <!-- Like icon and count (Right aligned, slightly moved left) -->
                <div class="flex items-center">
                    <i
                        class="fas fa-thumbs-up cursor-pointer like-button {{ Auth::check() && $pro->isLikedByUser(Auth::id()) ? 'text-green-500' : 'text-gray-400 hover:text-green-500' }}"
                        data-post-id="{{$pro->id}}"
                        data-type="pro"
                        {{ !Auth::check() ? 'title="Login to like posts"' : '' }}>
                    </i>
                    <span class="text-xs ml-1 like-count">{{$pro->like_count}}</span>
                </div>
                <!-- Reference Modal -->
<div id="reference-modal-{{ $pro->id }}" tabindex="-1" aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md mx-auto">
        <div class="relative bg-white rounded-lg shadow dark:bg-white">
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-200">
                <h3 class="text-lg font-semibold text-blue-800">References</h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center"
                    data-modal-hide="reference-modal-{{ $pro->id }}">
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <div class="p-6 space-y-4">
                @forelse($pro->references as $reference)
                    <div class="flex items-center justify-between border-b pb-2 mb-2">
                        <div>
                            <a href="{{ $reference->url }}" target="_blank" class="text-blue-600 underline">
                                {{ $reference->description ?? $reference->url }}
                            </a>
                        </div>
                        @auth
                            @if(Auth::id() === $pro->user_id)
                                <!-- Delete button -->
                                <form action="{{ route('references.delete', $reference) }}" method="POST" onsubmit="return confirm('Delete this reference?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 text-xs ml-2">Delete</button>
                                </form>
                            @endif
                        @endauth
                    </div>
                @empty
                    <div class="text-gray-400">No references yet.</div>
                @endforelse

                @auth
                    @if(Auth::id() === $pro->user_id)
                        <!-- Add Reference Form -->
                        <form action="{{ route('references.store', $pro) }}" method="POST" class="mt-4">
                            @csrf
                            <input type="url" name="url" class="w-full mb-2 p-2 border rounded" placeholder="Reference URL" required>
                            <input type="text" name="description" class="w-full mb-2 p-2 border rounded" placeholder="Description (optional)">
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded text-sm">Add Reference</button>
                        </form>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Cons Section -->
    <div class="flex flex-col w-2/5 mr-4">
        <div class="flex justify-between items-center mb-2">
            <h2 class="text-red-600 text-xl font-bold">Cons</h2>
            @auth
            <button type="button" data-modal-target="con-modal" data-modal-toggle="con-modal"
                class="bg-red-600 hover:bg-red-700 text-white font-bold py-1 px-2 rounded text-sm">
                Add Con
            </button>
            @endauth
        </div>

        @foreach($cons as $con)
        <div class="mb-6">
            <!-- Argument content clickable link -->
            <a href="/post/{{$con->id}}" class="block border-2 border-blue-200 m-2 p-2">
                <p class="text-center">{{$con->content}}</p>
            </a>
            <!-- User name and Like icon on the same line -->
            <div class="flex justify-between items-center mt-2 text-sm text-gray-600">
                <!-- Username (Left aligned, smaller, moved right, underlined) -->
                <span class="underline text-xs ml-2">{{$con->user->name}}</span>
                <!-- Reference icon/word -->
<button type="button"
    data-modal-target="reference-modal-{{ $con->id }}"
    data-modal-toggle="reference-modal-{{ $con->id }}"
    class="flex items-center text-blue-600 hover:underline text-xs ml-2">
    <i class="fas fa-link mr-1"></i> References
</button>
<span class="ml-1 text-xs text-gray-400">({{ $con->references->count() }})</span>
                <!-- Like icon and count (Right aligned, slightly moved left) -->
                <div class="flex items-center">
                    <i
                        class="fas fa-thumbs-up cursor-pointer like-button {{ Auth::check() && $con->isLikedByUser(Auth::id()) ? 'text-red-500' : 'text-gray-400 hover:text-red-500' }}"
                        data-post-id="{{$con->id}}"
                        data-type="con"
                        {{ !Auth::check() ? 'title="Login to like posts"' : '' }}>
                    </i>
                    <span class="text-xs ml-1 like-count">{{$con->like_count}}</span>
                </div>
                <!-- Reference Modal -->
<div id="reference-modal-{{ $con->id }}" tabindex="-1" aria-hidden="true"
    class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-md mx-auto">
        <div class="relative bg-white rounded-lg shadow dark:bg-white">
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-200">
                <h3 class="text-lg font-semibold text-blue-800">References</h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center"
                    data-modal-hide="reference-modal-{{ $con->id }}">
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <div class="p-6 space-y-4">
                @forelse($con->references as $reference)
                    <div class="flex items-center justify-between border-b pb-2 mb-2">
                        <div>
                            <a href="{{ $reference->url }}" target="_blank" class="text-blue-600 underline">
                                {{ $reference->description ?? $reference->url }}
                            </a>
                        </div>
                        @auth
                            @if(Auth::id() === $con->user_id)
                                <!-- Delete button -->
                                <form action="{{ route('references.delete', $reference) }}" method="POST" onsubmit="return confirm('Delete this reference?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 text-xs ml-2">Delete</button>
                                </form>
                            @endif
                        @endauth
                    </div>
                @empty
                    <div class="text-gray-400">No references yet.</div>
                @endforelse

                @auth
                    @if(Auth::id() === $con->user_id)
                        <!-- Add Reference Form -->
                        <form action="{{ route('references.store', $con) }}" method="POST" class="mt-4">
                            @csrf
                            <input type="url" name="url" class="w-full mb-2 p-2 border rounded" placeholder="Reference URL" required>
                            <input type="text" name="description" class="w-full mb-2 p-2 border rounded" placeholder="Description (optional)">
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded text-sm">Add Reference</button>
                        </form>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<!-- Pro and Con Modals remain unchanged -->
<!-- Pro Modal -->
<div id="pro-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-white">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-200">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-blue-800">
                    Add Supporting Argument
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-100 dark:hover:text-blue-800" data-modal-hide="pro-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <form action="{{ route('arguments.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="parent_id" value="{{ $post->id }}">
                    <input type="hidden" name="type" value="pro">
                    <div class="mb-6">
                        <label for="pro-content" class="block mb-2 text-sm font-medium text-gray-900 dark:text-blue-800">Your Argument</label>
                        <textarea id="pro-content" name="content" rows="6" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white dark:border-gray-300 dark:placeholder-blue-400 dark:text-blue-800 dark:focus:ring-blue-500 dark:focus:border-blue-500" required></textarea>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center pt-4 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-200">
                        <button type="submit" class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Post Argument</button>
                        <button type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-white dark:text-blue-800 dark:border-gray-300 dark:hover:text-blue-900 dark:hover:bg-gray-100 dark:focus:ring-gray-300" data-modal-hide="pro-modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Con Modal -->
<div id="con-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-white">
            <!-- Modal header -->
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-200">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-blue-800">
                    Add Counter Argument
                </h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-100 dark:hover:text-blue-800" data-modal-hide="con-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-6 space-y-6">
                <form action="{{ route('arguments.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="parent_id" value="{{ $post->id }}">
                    <input type="hidden" name="type" value="con">
                    <div class="mb-6">
                        <label for="con-content" class="block mb-2 text-sm font-medium text-gray-900 dark:text-blue-800">Your Argument</label>
                        <textarea id="con-content" name="content" rows="6" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white dark:border-gray-300 dark:placeholder-blue-400 dark:text-blue-800 dark:focus:ring-blue-500 dark:focus:border-blue-500" required></textarea>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center pt-4 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-200">
                        <button type="submit" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Post Argument</button>
                        <button type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-white dark:text-blue-800 dark:border-gray-300 dark:hover:text-blue-900 dark:hover:bg-gray-100 dark:focus:ring-gray-300" data-modal-hide="con-modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Add event listeners to all like buttons
        const likeButtons = document.querySelectorAll('.like-button');
        likeButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                event.stopPropagation();

                @auth
                const postId = this.getAttribute('data-post-id');
                const type = this.getAttribute('data-type');
                const button = this;
                const countElement = button.nextElementSibling;

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
                        // Update UI based on like status
                        if (data.liked) {
                            button.classList.remove('text-gray-400');
                            button.classList.add(type === 'pro' ? 'text-green-500' : 'text-red-500');
                        } else {
                            button.classList.remove(type === 'pro' ? 'text-green-500' : 'text-red-500');
                            button.classList.add('text-gray-400');
                        }

                        // Update the like count
                        countElement.textContent = data.likeCount;
                    }
                })
                .catch(error => console.error('Error:', error));
                @else
                    // If not logged in, don't do anything (or show login prompt)
                    alert('Please log in to like posts');
                @endauth
            });
        });
    });
</script>
