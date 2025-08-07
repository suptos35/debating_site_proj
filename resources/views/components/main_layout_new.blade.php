@props(['categories' => collect()])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title . ' - ' : '' }}Factly - Evidence-Based Discussions</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
    <style>
        .gradient-bg { background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%); }
        .card-hover { transition: all 0.3s ease; }
        .card-hover:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(0,0,0,0.15); }
        .glass-effect { backdrop-filter: blur(10px); background: rgba(255, 255, 255, 0.9); }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header - Based on homepage design -->
    <nav class="bg-white border-b border-gray-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo - Matching homepage design -->
                <a href="/" class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-balance-scale text-white text-sm"></i>
                    </div>
                    <span class="text-2xl font-semibold text-gray-900">Factly</span>
                </a>

                <!-- Navigation Tabs - Like homepage -->
                <div class="hidden md:flex space-x-8">
                    <a href="/" class="text-blue-600 border-b-2 border-blue-600 px-3 py-2 text-sm font-medium">
                        Home
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-700 px-3 py-2 text-sm font-medium border-b-2 border-transparent hover:border-gray-300">
                        Discussions
                    </a>
                    <a href="/presentation/categories" class="text-gray-500 hover:text-gray-700 px-3 py-2 text-sm font-medium border-b-2 border-transparent hover:border-gray-300">
                        Categories
                    </a>
                    <a href="/presentation/writers" class="text-gray-500 hover:text-gray-700 px-3 py-2 text-sm font-medium border-b-2 border-transparent hover:border-gray-300">
                        Writers
                    </a>
                    <a href="/presentation/groups" class="text-gray-500 hover:text-gray-700 px-3 py-2 text-sm font-medium border-b-2 border-transparent hover:border-gray-300">
                        Groups
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-700 px-3 py-2 text-sm font-medium border-b-2 border-transparent hover:border-gray-300">
                        Polls
                    </a>
                </div>

                <!-- User Actions -->
                <div class="flex items-center space-x-3">
                    @auth
                        <button type="button" data-modal-target="post-modal" data-modal-toggle="post-modal"
                            class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                            <i class="fas fa-plus mr-1"></i> New Discussion
                        </button>
                        <button type="button" data-modal-target="poll-modal" data-modal-toggle="poll-modal"
                            class="bg-purple-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-purple-700 transition-colors">
                            <i class="fas fa-poll mr-1"></i> New Poll
                        </button>
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                <span class="text-blue-600 text-xs font-medium">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</span>
                            </div>
                            <span class="text-sm text-gray-700 hidden sm:block">{{ Auth::user()->name }}</span>
                            <div class="relative group">
                                <button class="text-gray-500 hover:text-gray-700">
                                    <i class="fas fa-chevron-down text-xs"></i>
                                </button>
                                <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 hidden group-hover:block">
                                    <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Profile</a>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</a>
                                </div>
                            </div>
                        </div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                            @csrf
                        </form>
                    @else
                        <div class="flex items-center space-x-2">
                            <a href="{{ route('login') }}" class="text-gray-600 hover:text-gray-800 px-4 py-2 text-sm font-medium">Login</a>
                            <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">Register</a>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

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
                    <a href="/categories" class="border-2 border-white text-white px-6 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition-all">
                        Browse Topics
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main>
        {{ $slot }}
    </main>

    <!-- Footer - From homepage -->
    <footer class="bg-gray-900 text-white mt-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid md:grid-cols-4 gap-8">
                <div class="md:col-span-2">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-balance-scale text-white text-sm"></i>
                        </div>
                        <span class="text-2xl font-semibold">Factly</span>
                    </div>
                    <p class="text-gray-400 mb-4 max-w-md">
                        Join evidence-based discussions where every argument is backed by credible sources and verified references.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-facebook"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition-colors">
                            <i class="fab fa-linkedin"></i>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="font-semibold mb-4">Platform</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">How it Works</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Community Guidelines</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Verification Process</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Help Center</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-semibold mb-4">Legal</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="hover:text-white transition-colors">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Terms of Service</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Cookie Policy</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Contact Us</a></li>
                    </ul>
                </div>
            </div>

            <div class="border-t border-gray-800 pt-8 mt-8 text-center text-sm text-gray-400">
                <p>&copy; 2024 Factly. All rights reserved. Building better discourse through evidence.</p>
            </div>
        </div>
    </footer>

    <!-- Post Modal -->
    <div id="post-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-white">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-blue-800">
                        Start New Discussion
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-100 dark:hover:text-blue-800" data-modal-hide="post-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    <form action="{{ route('posts.store') }}" method="POST">
                        @csrf
                        <div class="mb-6">
                            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-blue-800">Title</label>
                            <input type="text" id="title" name="title" maxlength="255" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white dark:border-gray-300 dark:placeholder-blue-400 dark:text-blue-800 dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        </div>
                        <div class="mb-6">
                            <label for="excerpt" class="block mb-2 text-sm font-medium text-gray-900 dark:text-blue-800">Excerpt</label>
                            <textarea id="excerpt" name="excerpt" maxlength="1000" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white dark:border-gray-300 dark:placeholder-blue-400 dark:text-blue-800 dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                        </div>
                        <div class="mb-6">
                            <label for="content" class="block mb-2 text-sm font-medium text-gray-900 dark:text-blue-800">Content</label>
                            <textarea id="content" name="content" rows="6" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white dark:border-gray-300 dark:placeholder-blue-400 dark:text-blue-800 dark:focus:ring-blue-500 dark:focus:border-blue-500" required></textarea>
                        </div>
                        <div class="mb-6">
                            <label for="categories" class="block mb-2 text-sm font-medium text-gray-900 dark:text-blue-800">Categories</label>
                            <select id="categories" name="categories[]" multiple class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white dark:border-gray-300 dark:placeholder-blue-400 dark:text-blue-800 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <p class="mt-1 text-sm text-gray-500 dark:text-blue-700">Hold Ctrl (Windows) or Cmd (Mac) to select multiple categories</p>
                        </div>
                        <!-- Modal footer -->
                        <div class="flex items-center pt-4 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-200">
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Start Discussion</button>
                            <button type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-white dark:text-blue-800 dark:border-gray-300 dark:hover:text-blue-900 dark:hover:bg-gray-100 dark:focus:ring-gray-300" data-modal-hide="post-modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Poll Modal -->
    <div id="poll-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-white">
                <!-- Modal header -->
                <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-blue-800">
                        Create New Poll
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-100 dark:hover:text-blue-800" data-modal-hide="poll-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    <form action="{{ route('polls.store') }}" method="POST" id="poll-form">
                        @csrf
                        <div class="mb-6">
                            <label for="poll-title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-blue-800">Poll Title</label>
                            <input type="text" id="poll-title" name="title" maxlength="255" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white dark:border-gray-300 dark:placeholder-blue-400 dark:text-blue-800 dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        </div>

                        <div class="mb-6">
                            <label for="poll-description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-blue-800">Description (Optional)</label>
                            <textarea id="poll-description" name="description" maxlength="1000" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white dark:border-gray-300 dark:placeholder-blue-400 dark:text-blue-800 dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                        </div>

                        <div class="mb-6">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-blue-800">Poll Options</label>
                            <div id="poll-options-container">
                                <div class="poll-option-input mb-2">
                                    <input type="text" name="options[]" placeholder="Option 1" maxlength="255" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white dark:border-gray-300 dark:placeholder-blue-400 dark:text-blue-800 dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                </div>
                                <div class="poll-option-input mb-2">
                                    <input type="text" name="options[]" placeholder="Option 2" maxlength="255" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white dark:border-gray-300 dark:placeholder-blue-400 dark:text-blue-800 dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                </div>
                            </div>
                            <button type="button" id="add-poll-option-btn" class="mt-2 text-blue-600 hover:text-blue-800 text-sm font-medium">
                                + Add Another Option
                            </button>
                        </div>

                        <div class="mb-6">
                            <label class="flex items-center">
                                <input type="checkbox" name="multiple_choice" value="1" class="mr-2 text-blue-600 focus:ring-blue-500 rounded">
                                <span class="text-sm text-gray-900 dark:text-blue-800">Allow multiple choice selection</span>
                            </label>
                        </div>

                        <div class="mb-6">
                            <label for="poll-expires" class="block mb-2 text-sm font-medium text-gray-900 dark:text-blue-800">Expiration Date (Optional)</label>
                            <input type="datetime-local" id="poll-expires" name="expires_at" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white dark:border-gray-300 dark:placeholder-blue-400 dark:text-blue-800 dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        </div>

                        <!-- Modal footer -->
                        <div class="flex items-center pt-4 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-200">
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create Poll</button>
                            <button type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-white dark:text-blue-800 dark:border-gray-300 dark:hover:text-blue-900 dark:hover:bg-gray-100 dark:focus:ring-gray-300" data-modal-hide="poll-modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>
    <script>
    (function() {
        'use strict';

        let pollOptionCount = 2;

        function addPollOption() {
            try {
                if (pollOptionCount >= 10) {
                    alert('Maximum 10 options allowed');
                    return;
                }

                pollOptionCount++;
                const container = document.getElementById('poll-options-container');
                if (container) {
                    const newOptionDiv = document.createElement('div');
                    newOptionDiv.className = 'poll-option-input mb-2 flex items-center space-x-2';
                    newOptionDiv.innerHTML = `
                        <input type="text" name="options[]" placeholder="Option ${pollOptionCount}" maxlength="255"
                               class="flex-1 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white dark:border-gray-300 dark:placeholder-blue-400 dark:text-blue-800 dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        <button type="button" onclick="removePollOption(this)" class="text-red-600 hover:text-red-800 p-2">
                            <i class="fas fa-trash text-sm"></i>
                        </button>
                    `;
                    container.appendChild(newOptionDiv);
                }
            } catch (error) {
                console.error('Error adding poll option:', error);
            }
        }

        function removePollOption(button) {
            try {
                if (pollOptionCount <= 2) {
                    alert('Minimum 2 options required');
                    return;
                }

                const optionDiv = button.closest('.poll-option-input');
                if (optionDiv) {
                    optionDiv.remove();
                    pollOptionCount--;

                    // Update placeholder numbers
                    const options = document.querySelectorAll('#poll-options-container input[name="options[]"]');
                    options.forEach((input, index) => {
                        input.placeholder = `Option ${index + 1}`;
                    });
                }
            } catch (error) {
                console.error('Error removing poll option:', error);
            }
        }

        // Make removePollOption globally accessible
        window.removePollOption = removePollOption;

        // Initialize when DOM is ready
        document.addEventListener('DOMContentLoaded', function() {
            try {
                // Add event listener to the add option button
                const addBtn = document.getElementById('add-poll-option-btn');
                if (addBtn) {
                    addBtn.addEventListener('click', addPollOption);
                }

                // Add CSRF token meta tag if not exists
                if (!document.querySelector('meta[name="csrf-token"]')) {
                    const meta = document.createElement('meta');
                    meta.name = 'csrf-token';
                    meta.content = '{{ csrf_token() }}';
                    document.head.appendChild(meta);
                }
            } catch (error) {
                console.error('Error initializing poll functionality:', error);
            }
        });
    })();
    </script>
</body>
</html>
