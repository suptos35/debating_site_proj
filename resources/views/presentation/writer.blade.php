<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $writer['name'] }} - Factly</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .gradient-bg { background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%); }
        .card-hover { transition: all 0.3s ease; }
        .card-hover:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(0,0,0,0.15); }
        .glass-effect { backdrop-filter: blur(10px); background: rgba(255, 255, 255, 0.9); }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <nav class="bg-white border-b border-gray-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <a href="/presentation" class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-balance-scale text-white text-sm"></i>
                    </div>
                    <span class="text-2xl font-semibold text-gray-900">Factly</span>
                </a>

                <!-- Navigation Tabs -->
                <div class="hidden md:flex space-x-8">
                    <a href="/presentation" class="text-gray-500 hover:text-gray-700 px-3 py-2 text-sm font-medium border-b-2 border-transparent hover:border-gray-300">
                        Home
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-700 px-3 py-2 text-sm font-medium border-b-2 border-transparent hover:border-gray-300">
                        Categories
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-700 px-3 py-2 text-sm font-medium border-b-2 border-transparent hover:border-gray-300">
                        Polls
                    </a>
                    <a href="#" class="text-blue-600 border-b-2 border-blue-600 px-3 py-2 text-sm font-medium">
                        Writers
                    </a>
                </div>

                <!-- User Actions -->
                <div class="flex items-center space-x-4">
                    <button class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                        <i class="fas fa-plus mr-1"></i> New Discussion
                    </button>
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                            <span class="text-blue-600 text-xs font-medium">AJ</span>
                        </div>
                        <span class="text-sm text-gray-700 hidden sm:block">Alex Johnson</span>
                    </div>
                </div>
            </div>
        </div>
    </nav>

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
                <span class="text-sm text-gray-500">{{ count($posts) }} discussions</span>
            </div>

            @if(count($posts) > 0)
            <div class="lg:grid lg:grid-cols-3 gap-6 space-y-6 lg:space-y-0">
                @foreach($posts as $post)
                <a href="/post/{{ $post['id'] }}" class="block">
                    <article class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-100 card-hover">
                        <div class="p-6">
                            <!-- Image placeholder -->
                            <div class="w-full h-48 bg-gradient-to-br {{ $post['gradient'] }} rounded-lg mb-4 flex items-center justify-center">
                                <i class="{{ $post['icon'] }} text-white text-4xl"></i>
                            </div>

                            <!-- Categories -->
                            <div class="space-x-2 mb-3">
                                @foreach($post['categories'] as $cat)
                                <span class="px-3 py-1 {{ $cat['class'] }} rounded-full text-xs font-medium">
                                    {{ $cat['name'] }}
                                </span>
                                @endforeach
                            </div>

                            <!-- Title -->
                            <h3 class="text-xl font-semibold text-gray-900 mb-3 hover:text-blue-600 transition-colors">
                                {{ $post['title'] }}
                            </h3>

                            <!-- Excerpt -->
                            <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                {{ $post['excerpt'] }}
                            </p>

                            <!-- Stats -->
                            <div class="flex items-center justify-between text-sm text-gray-500 border-t pt-4">
                                <div class="flex items-center space-x-4">
                                    <span class="flex items-center">
                                        <i class="fas fa-calendar mr-1"></i> {{ $post['date'] }}
                                    </span>
                                    <span class="flex items-center text-green-600">
                                        <i class="fas fa-thumbs-up mr-1"></i> {{ $post['likes'] }}
                                    </span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <span class="flex items-center text-blue-600">
                                        <i class="fas fa-comments mr-1"></i> {{ $post['comments'] }}
                                    </span>
                                    <span class="flex items-center text-purple-600">
                                        <i class="fas fa-link mr-1"></i> {{ $post['references'] }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </article>
                </a>
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
    <footer class="bg-gray-900 text-white mt-16">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="flex items-center space-x-3 mb-4 md:mb-0">
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-balance-scale text-white text-sm"></i>
                    </div>
                    <span class="text-xl font-bold">Factly</span>
                </div>
                <div class="text-sm text-gray-400 text-center md:text-right">
                    © 2025 Factly. Building the future of evidence-based discourse.
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
