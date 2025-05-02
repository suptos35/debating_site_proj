@props(['post'])

<article x-data="{ showModal: false }"
    class="transition-colors duration-300 hover:bg-gray-100 border border-black border-opacity-0 hover:border-opacity-5 rounded-xl cursor-pointer flex flex-col justify-between">

    <div class="py-6 px-5 flex-grow" @click="showModal = true">
        <!-- Post Image -->
        <div>
            <img src="./images/illustration-3.png" alt="Blog Post illustration" class="rounded-xl">
        </div>

        <!-- Post Details -->
        <div class="mt-8 flex flex-col flex-grow">
            <header>
                <div class="space-x-2">
                    @foreach ($post->categories as $category)
                        <a href="/categories/{{ $category->id }}"
                            class="px-3 py-1 border border-blue-300 rounded-full text-blue-300 text-xs uppercase font-semibold"
                            style="font-size: 10px">
                            {{ $category->name }}
                        </a>
                    @endforeach
                </div>

                <div class="mt-4">
                    <h1 class="text-3xl">
                        {{$post->title}}
                    </h1>

                    <span class="mt-2 block text-gray-400 text-xs">
                        Published <time>1 day ago</time>
                    </span>
                </div>
            </header>

            <!-- Excerpt: Show at most 3 lines -->
            <div class="text-sm mt-4 text-gray-700 overflow-hidden text-ellipsis line-clamp-3">
                {{$post->excerpt}}
            </div>
        </div>
    </div>

    <!-- Footer (Always at Bottom) -->
    <footer class="flex justify-between items-center mt-8 px-5 pb-6">
        <div class="flex items-center text-sm">
            <img src="./images/lary-avatar.svg" alt="Lary avatar" class="w-8 h-8 rounded-full">
            <div class="ml-3">
                <h5 class="font-bold">{{$post->user->name}}</h5>
                <h6 class="text-gray-500">Author</h6>
            </div>
        </div>
    </footer>

    <!-- Floating Modal with Blur Effect -->
    <div x-show="showModal"
        x-transition
        @keydown.escape.window="showModal = false"
        x-cloak
        class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-md flex items-center justify-center z-50"
        @click="showModal = false">

        <!-- Modal Content -->
        <div class="bg-white p-6 rounded-lg shadow-xl max-w-md w-full relative"
            @click.stop> <!-- Prevent closing when clicking inside modal -->

            <!-- Close Button -->
            <button @click="showModal = false"
                class="absolute -top-4 -right-4 bg-red-500 text-white w-10 h-10 flex items-center justify-center rounded-full shadow-md hover:bg-red-600 transition">
                <span class="text-2xl font-bold">&times;</span>
            </button>

            <!-- Post Image -->
            <img src="./images/illustration-3.png" alt="Blog Post illustration" class="rounded-lg w-full">

            <!-- Post Content -->
            <h2 class="text-xl font-bold mt-4">{{$post->title}}</h2>

            <!-- Scrollable Excerpt -->
            <div class="text-gray-700 mt-2 max-h-32 overflow-y-auto space-y-2 pr-2">
                <p>{{$post->excerpt}}</p>
                <p>{{$post->excerpt}}</p>
                <p>{{$post->excerpt}}</p>
            </div>

            <!-- Author Info -->
            <div class="flex items-center text-sm mt-4">
                <img src="./images/lary-avatar.svg" alt="Lary avatar" class="w-8 h-8 rounded-full">
                <div class="ml-3">
                    <h5 class="font-bold">{{$post->user->name}}</h5>
                    <h6 class="text-gray-500">Author</h6>
                </div>
            </div>

            <!-- Read More Button -->
            <div class="mt-4">
                <a href="/post/{{$post->id}}"
                    @click="showModal = false"
                    class="block w-full text-center bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600">
                    Read More
                </a>
            </div>
        </div>
    </div>
</article>
