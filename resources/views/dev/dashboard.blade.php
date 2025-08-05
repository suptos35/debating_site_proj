<x-main_layout :categories="$categories">
    <main class="max-w-6xl mx-auto mt-6 lg:mt-10 p-6">
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <strong>⚠️ DEVELOPMENT MODE ONLY</strong> - This panel only works in local environment
        </div>

        <div class="bg-white rounded-lg shadow-md p-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-8">🛠️ Development Testing Dashboard</h1>

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

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

                <!-- User Management -->
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h2 class="text-xl font-bold mb-4">👥 User Management</h2>

                    <!-- Current User -->
                    <div class="mb-4 p-3 bg-blue-100 rounded">
                        @auth
                            <strong>Current User:</strong> {{ Auth::user()->name }} ({{ Auth::user()->username }})
                            <form action="{{ route('dev.logout') }}" method="POST" class="inline ml-2">
                                @csrf
                                <button type="submit" class="text-red-600 underline text-sm">Logout</button>
                            </form>
                        @else
                            <strong>Not logged in</strong>
                        @endauth
                    </div>

                    <!-- Quick Create User -->
                    <form action="{{ route('dev.create-user') }}" method="POST" class="mb-4">
                        @csrf
                        <div class="flex space-x-2">
                            <input type="text" name="name" placeholder="Full Name" class="flex-1 p-2 border rounded text-sm">
                            <input type="text" name="username" placeholder="Username" class="flex-1 p-2 border rounded text-sm">
                            <input type="text" name="password" placeholder="Password (default: password)" class="flex-1 p-2 border rounded text-sm">
                        </div>
                        <button type="submit" class="mt-2 bg-green-600 text-white px-4 py-2 rounded text-sm">Create User</button>
                    </form>

                    <!-- Existing Users -->
                    <div class="max-h-60 overflow-y-auto">
                        <h3 class="font-semibold mb-2">Quick Login As:</h3>
                        @foreach($users as $user)
                            <div class="flex justify-between items-center py-1 px-2 hover:bg-gray-200 rounded">
                                <span class="text-sm">{{ $user->name }} ({{ $user->username }})</span>
                                <form action="{{ route('dev.login-as', $user) }}" method="POST" class="inline">
                                    @csrf
                                    <button type="submit" class="text-blue-600 underline text-xs">Login</button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Content Creation -->
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h2 class="text-xl font-bold mb-4">📝 Content Creation</h2>

                    @auth
                        <div class="space-y-3">
                            <!-- Create Post -->
                            <form action="{{ route('dev.create-post') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded text-sm">
                                    Create Random Discussion Post
                                </button>
                            </form>

                            <!-- Create Poll -->
                            <form action="{{ route('dev.create-poll') }}" method="POST">
                                @csrf
                                <button type="submit" class="w-full bg-purple-600 text-white px-4 py-2 rounded text-sm">
                                    Create Random Poll
                                </button>
                            </form>
                        </div>
                    @else
                        <p class="text-gray-600 text-sm">Login to create content</p>
                    @endauth
                </div>

                <!-- Recent Posts -->
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h2 class="text-xl font-bold mb-4">📋 Recent Posts</h2>
                    <div class="max-h-60 overflow-y-auto space-y-2">
                        @foreach($posts as $post)
                            <div class="bg-white p-3 rounded border">
                                <div class="flex justify-between items-start">
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-sm">{{ $post->title }}</h4>
                                        <p class="text-xs text-gray-600">by {{ $post->user->name }}</p>
                                    </div>
                                    <div class="flex space-x-1">
                                        <a href="/post/{{ $post->id }}" class="text-blue-600 text-xs underline">View</a>
                                        @auth
                                            <form action="{{ route('dev.create-arguments', $post) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="text-green-600 text-xs underline">Add Args</button>
                                            </form>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h2 class="text-xl font-bold mb-4">⚡ Quick Actions</h2>
                    <div class="space-y-3">
                        <a href="/" class="block w-full bg-gray-600 text-white px-4 py-2 rounded text-sm text-center">
                            🏠 Go to Home Page
                        </a>

                        <form action="{{ route('dev.reset-data') }}" method="POST" onsubmit="return confirm('This will delete all test users. Continue?')">
                            @csrf
                            <button type="submit" class="w-full bg-red-600 text-white px-4 py-2 rounded text-sm">
                                🗑️ Reset Test Data
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Quick Tips -->
            <div class="mt-8 bg-yellow-50 border border-yellow-200 p-4 rounded">
                <h3 class="font-bold text-yellow-800 mb-2">💡 Quick Testing Tips:</h3>
                <ul class="text-sm text-yellow-700 space-y-1">
                    <li>• Default password for created users is "password"</li>
                    <li>• Test users have @test.com emails</li>
                    <li>• Use "Add Args" to quickly populate discussions</li>
                    <li>• Reset data cleans up only test users</li>
                    <li>• Access this panel anytime at <code>/dev</code></li>
                </ul>
            </div>
        </div>
    </main>
</x-main_layout>
