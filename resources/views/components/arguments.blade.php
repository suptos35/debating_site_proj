@props(['post', 'pros', 'cons'])

<!-- Topic content -->
<p class="border-2 border-blue-200 mx-64 my-8 p-4">
    {{$post->content}}
</p>

<div class="flex justify-between">
    <!-- Pros Section -->
    <div class="flex flex-col w-2/5 ml-4">
        <h2 class="text-green-600 text-xl font-bold text-center">Pros</h2>
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
                <!-- Like icon and count (Right aligned, slightly moved left) -->
                <div class="flex items-center">
                    <i
                        class="fas fa-thumbs-up text-gray-400 hover:text-green-500 cursor-pointer"
                        onclick="toggleLike(event, this)">
                    </i>
                    <span class="text-xs ml-1">{{$pro->like_count}}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Cons Section -->
    <div class="flex flex-col w-2/5 mr-4">
        <h2 class="text-red-600 text-xl font-bold text-center">Cons</h2>
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
                <!-- Like icon and count (Right aligned, slightly moved left) -->
                <div class="flex items-center">
                    <i
                        class="fas fa-thumbs-up text-gray-400 hover:text-red-500 cursor-pointer"
                        onclick="toggleLike(event, this)">
                    </i>
                    <span class="text-xs ml-1">{{$con->like_count}}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<script>
    function toggleLike(event, element) {
        // Stop the click event from propagating
        event.stopPropagation();

        // Toggle the like state
        const isLiked = element.classList.contains('text-green-500') || element.classList.contains('text-red-500');
        if (isLiked) {
            // Reset to default gray if already liked
            element.classList.remove('text-green-500', 'text-red-500');
            element.classList.add('text-gray-400');
        } else {
            // Change to the like color based on the section
            const isProSection = element.classList.contains('hover:text-green-500');
            element.classList.remove('text-gray-400');
            element.classList.add(isProSection ? 'text-green-500' : 'text-red-500');
        }
    }
</script>
