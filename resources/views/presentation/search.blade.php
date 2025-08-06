<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results: "{{ $keyword ?? 'climate' }}" - Factly</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .gradient-bg { background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%); }
        .card-hover { transition: all 0.3s ease; }
               </div>
    </main>ver:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(0,0,0,0.15); }
        .glass-effect { backdrop-filter: blur(10px); background: rgba(255, 255, 255, 0.9); }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header - Based on homepage -->
    <nav class="bg-white border-b border-gray-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <a href="/presentation/homepage" class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-balance-scale text-white text-sm"></i>
                    </div>
                    <span class="text-2xl font-semibold text-gray-900">Factly</span>
                </a>

                <!-- Navigation Tabs -->
                <div class="hidden md:flex space-x-8">
                    <a href="/presentation/homepage" class="text-gray-500 hover:text-gray-700 px-3 py-2 text-sm font-medium border-b-2 border-transparent hover:border-gray-300">
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
                    <button onclick="openDiscussionModal()" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                        <i class="fas fa-plus mr-1"></i> New Discussion
                    </button>
                    <button onclick="openPollModal()" class="bg-purple-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-purple-700 transition-colors">
                        <i class="fas fa-poll mr-1"></i> New Poll
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

    <!-- Search Header Section -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                <div class="mb-4 md:mb-0">
                    <h1 class="text-2xl font-bold text-gray-900">Search Results</h1>
                    <p class="text-gray-600 mt-1">
                        Showing results for "<span class="font-semibold text-blue-600">{{ $keyword ?? 'climate' }}</span>"
                    </p>
                </div>

                <!-- Search Form -->
                <div class="relative max-w-md w-full">
                    <input type="text" value="{{ $keyword ?? 'climate' }}" placeholder="Search discussions, writers, categories..."
                           class="w-full px-4 py-2 pr-10 text-sm border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <button class="absolute inset-y-0 right-0 flex items-center pr-3">
                        <i class="fas fa-search text-gray-400 hover:text-blue-500"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="max-w-6xl mx-auto mt-6 px-4 sm:px-6 lg:px-8">

        <!-- Results Overview -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white p-4 rounded-lg border border-gray-200 text-center">
                <div class="text-2xl font-bold text-blue-600">3</div>
                <div class="text-sm text-gray-600">Discussions</div>
            </div>
            <div class="bg-white p-4 rounded-lg border border-gray-200 text-center">
                <div class="text-2xl font-bold text-green-600">2</div>
                <div class="text-sm text-gray-600">Categories</div>
            </div>
            <div class="bg-white p-4 rounded-lg border border-gray-200 text-center">
                <div class="text-2xl font-bold text-purple-600">1</div>
                <div class="text-sm text-gray-600">Writers</div>
            </div>
            <div class="bg-white p-4 rounded-lg border border-gray-200 text-center">
                <div class="text-2xl font-bold text-orange-600">2</div>
                <div class="text-sm text-gray-600">Polls</div>
            </div>
        </div>

        <!-- Filter Tabs -->
        <div class="flex flex-wrap gap-2 mb-6 border-b border-gray-200">
            <button class="px-4 py-2 text-sm font-medium text-blue-600 border-b-2 border-blue-600">
                All Results
            </button>
            <button class="px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-700 border-b-2 border-transparent">
                Discussions (3)
            </button>
            <button class="px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-700 border-b-2 border-transparent">
                Categories (2)
            </button>
            <button class="px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-700 border-b-2 border-transparent">
                Writers (1)
            </button>
            <button class="px-4 py-2 text-sm font-medium text-gray-500 hover:text-gray-700 border-b-2 border-transparent">
                Polls (2)
            </button>
        </div>

        <!-- Discussions Section -->
        <div class="mb-12">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-comments text-blue-600 mr-2"></i>
                    Discussions
                    <span class="ml-2 px-2 py-1 bg-blue-100 text-blue-600 text-xs rounded-full">3</span>
                </h2>
            </div>

            <div class="grid lg:grid-cols-2 gap-6">
                <!-- Discussion Result 1 -->
                <article class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-100 card-hover">
                    <div class="p-6">
                        <div class="w-full h-48 bg-gradient-to-br from-green-400 to-green-600 rounded-lg mb-4 flex items-center justify-center">
                            <i class="fas fa-leaf text-white text-4xl"></i>
                        </div>

                        <div class="space-x-2 mb-3">
                            <span class="px-3 py-1 bg-green-100 text-green-600 rounded-full text-xs font-medium">
                                Environment
                            </span>
                            <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-xs font-medium">
                                Science
                            </span>
                        </div>

                        <h3 class="text-xl font-semibold text-gray-900 mb-3 hover:text-blue-600 cursor-pointer transition-colors">
                            What's the most effective approach to <mark class="bg-yellow-200">climate</mark> change mitigation?
                        </h3>

                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            As global temperatures continue to rise, governments and organizations worldwide are implementing various strategies to combat <mark class="bg-yellow-200">climate</mark> change...
                        </p>

                        <div class="flex items-center justify-between text-sm text-gray-500 border-t pt-4">
                            <div class="flex items-center space-x-4">
                                <span class="flex items-center">
                                    <i class="fas fa-user mr-1"></i> Dr. Sarah Chen
                                </span>
                                <span class="flex items-center text-green-600">
                                    <i class="fas fa-thumbs-up mr-1"></i> 45
                                </span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <span class="flex items-center text-blue-600">
                                    <i class="fas fa-comments mr-1"></i> 67
                                </span>
                                <span class="flex items-center text-purple-600">
                                    <i class="fas fa-link mr-1"></i> 12
                                </span>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Discussion Result 2 -->
                <article class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-100 card-hover">
                    <div class="p-6">
                        <div class="w-full h-48 bg-gradient-to-br from-blue-400 to-blue-600 rounded-lg mb-4 flex items-center justify-center">
                            <i class="fas fa-thermometer-half text-white text-4xl"></i>
                        </div>

                        <div class="space-x-2 mb-3">
                            <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-xs font-medium">
                                Science
                            </span>
                            <span class="px-3 py-1 bg-green-100 text-green-600 rounded-full text-xs font-medium">
                                Environment
                            </span>
                        </div>

                        <h3 class="text-xl font-semibold text-gray-900 mb-3 hover:text-blue-600 cursor-pointer transition-colors">
                            Are current <mark class="bg-yellow-200">climate</mark> models accurate enough for policy decisions?
                        </h3>

                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            Recent debates among scientists question whether current <mark class="bg-yellow-200">climate</mark> prediction models provide sufficient accuracy for making long-term policy decisions...
                        </p>

                        <div class="flex items-center justify-between text-sm text-gray-500 border-t pt-4">
                            <div class="flex items-center space-x-4">
                                <span class="flex items-center">
                                    <i class="fas fa-user mr-1"></i> Prof. Michael Torres
                                </span>
                                <span class="flex items-center text-green-600">
                                    <i class="fas fa-thumbs-up mr-1"></i> 32
                                </span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <span class="flex items-center text-blue-600">
                                    <i class="fas fa-comments mr-1"></i> 54
                                </span>
                                <span class="flex items-center text-purple-600">
                                    <i class="fas fa-link mr-1"></i> 8
                                </span>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Discussion Result 3 -->
                <article class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-100 card-hover">
                    <div class="p-6">
                        <div class="w-full h-48 bg-gradient-to-br from-orange-400 to-orange-600 rounded-lg mb-4 flex items-center justify-center">
                            <i class="fas fa-industry text-white text-4xl"></i>
                        </div>

                        <div class="space-x-2 mb-3">
                            <span class="px-3 py-1 bg-orange-100 text-orange-600 rounded-full text-xs font-medium">
                                Economics
                            </span>
                            <span class="px-3 py-1 bg-green-100 text-green-600 rounded-full text-xs font-medium">
                                Environment
                            </span>
                        </div>

                        <h3 class="text-xl font-semibold text-gray-900 mb-3 hover:text-blue-600 cursor-pointer transition-colors">
                            Should carbon pricing be the primary tool for <mark class="bg-yellow-200">climate</mark> action?
                        </h3>

                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            Economists debate whether carbon pricing mechanisms are the most effective economic approach to addressing <mark class="bg-yellow-200">climate</mark> change challenges...
                        </p>

                        <div class="flex items-center justify-between text-sm text-gray-500 border-t pt-4">
                            <div class="flex items-center space-x-4">
                                <span class="flex items-center">
                                    <i class="fas fa-user mr-1"></i> Dr. Lisa Rodriguez
                                </span>
                                <span class="flex items-center text-green-600">
                                    <i class="fas fa-thumbs-up mr-1"></i> 28
                                </span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <span class="flex items-center text-blue-600">
                                    <i class="fas fa-comments mr-1"></i> 41
                                </span>
                                <span class="flex items-center text-purple-600">
                                    <i class="fas fa-link mr-1"></i> 6
                                </span>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>

        <!-- Categories Section -->
        <div class="mb-12">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-tags text-green-600 mr-2"></i>
                    Categories
                    <span class="ml-2 px-2 py-1 bg-green-100 text-green-600 text-xs rounded-full">2</span>
                </h2>
            </div>

            <div class="grid md:grid-cols-2 gap-6">
                <!-- Category Result 1 -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 card-hover">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-green-600 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-leaf text-white text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">
                                <mark class="bg-yellow-200">Climate</mark> Science
                            </h3>
                            <p class="text-sm text-gray-600">89 discussions • 234 followers</p>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">
                        Discussions about <mark class="bg-yellow-200">climate</mark> research, data analysis, and scientific findings related to global warming and environmental changes.
                    </p>
                    <div class="flex justify-between items-center">
                        <div class="flex space-x-2">
                            <span class="px-2 py-1 bg-green-100 text-green-600 text-xs rounded">Environment</span>
                            <span class="px-2 py-1 bg-blue-100 text-blue-600 text-xs rounded">Science</span>
                        </div>
                        <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                            Follow →
                        </button>
                    </div>
                </div>

                <!-- Category Result 2 -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 card-hover">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-orange-600 rounded-lg flex items-center justify-center mr-4">
                            <i class="fas fa-gavel text-white text-lg"></i>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">
                                <mark class="bg-yellow-200">Climate</mark> Policy
                            </h3>
                            <p class="text-sm text-gray-600">56 discussions • 178 followers</p>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm mb-4">
                        Analysis and debate on <mark class="bg-yellow-200">climate</mark> policies, international agreements, and governmental approaches to environmental regulation.
                    </p>
                    <div class="flex justify-between items-center">
                        <div class="flex space-x-2">
                            <span class="px-2 py-1 bg-orange-100 text-orange-600 text-xs rounded">Policy</span>
                            <span class="px-2 py-1 bg-green-100 text-green-600 text-xs rounded">Environment</span>
                        </div>
                        <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                            Follow →
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Writers Section -->
        <div class="mb-12">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-users text-purple-600 mr-2"></i>
                    Writers
                    <span class="ml-2 px-2 py-1 bg-purple-100 text-purple-600 text-xs rounded-full">1</span>
                </h2>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Writer Result 1 -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 card-hover">
                    <div class="text-center mb-4">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <span class="text-green-600 text-lg font-bold">SC</span>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900">Dr. Sarah Chen</h3>
                        <p class="text-sm text-gray-600"><mark class="bg-yellow-200">Climate</mark> Scientist</p>
                    </div>

                    <div class="text-center mb-4">
                        <p class="text-gray-600 text-sm">
                            Leading researcher in <mark class="bg-yellow-200">climate</mark> modeling and environmental impact assessment with over 15 years of experience.
                        </p>
                    </div>

                    <div class="grid grid-cols-3 gap-4 text-center text-sm mb-4">
                        <div>
                            <div class="font-semibold text-gray-900">23</div>
                            <div class="text-gray-600">Posts</div>
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900">1.2K</div>
                            <div class="text-gray-600">Followers</div>
                        </div>
                        <div>
                            <div class="font-semibold text-gray-900">89</div>
                            <div class="text-gray-600">Likes</div>
                        </div>
                    </div>

                    <div class="flex space-x-2 mb-4">
                        <span class="px-2 py-1 bg-green-100 text-green-600 text-xs rounded">Environment</span>
                        <span class="px-2 py-1 bg-blue-100 text-blue-600 text-xs rounded">Science</span>
                    </div>

                    <button class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 transition-colors">
                        Follow
                    </button>
                </div>
            </div>
        </div>

        <!-- Polls Section -->
        <div class="mb-12">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-poll text-orange-600 mr-2"></i>
                    Polls
                    <span class="ml-2 px-2 py-1 bg-orange-100 text-orange-600 text-xs rounded-full">2</span>
                </h2>
            </div>

            <div class="grid lg:grid-cols-2 gap-6">
                <!-- Poll Result 1 -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 card-hover">
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">
                            What's the most urgent <mark class="bg-yellow-200">climate</mark> action needed?
                        </h3>
                        <p class="text-sm text-gray-600">Posted by Dr. Sarah Chen • 2 days ago</p>
                    </div>

                    <div class="space-y-3 mb-4">
                        <div class="relative">
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-sm font-medium text-gray-700">Renewable energy transition</span>
                                <span class="text-sm text-gray-500">42%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-green-500 h-2 rounded-full" style="width: 42%"></div>
                            </div>
                        </div>

                        <div class="relative">
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-sm font-medium text-gray-700">Carbon pricing policies</span>
                                <span class="text-sm text-gray-500">31%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-500 h-2 rounded-full" style="width: 31%"></div>
                            </div>
                        </div>

                        <div class="relative">
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-sm font-medium text-gray-700">International cooperation</span>
                                <span class="text-sm text-gray-500">27%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-orange-500 h-2 rounded-full" style="width: 27%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between items-center text-sm text-gray-500 border-t pt-3">
                        <span>456 votes</span>
                        {{-- <button class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700 transition-colors">
                            Vote Now
                        </button> --}}
                    </div>
                </div>

                <!-- Poll Result 2 -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 card-hover">
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">
                            How optimistic are you about meeting <mark class="bg-yellow-200">climate</mark> targets?
                        </h3>
                        <p class="text-sm text-gray-600">Posted by Prof. Michael Torres • 1 day ago</p>
                    </div>

                    <div class="space-y-3 mb-4">
                        <div class="relative">
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-sm font-medium text-gray-700">Very optimistic</span>
                                <span class="text-sm text-gray-500">18%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-green-500 h-2 rounded-full" style="width: 18%"></div>
                            </div>
                        </div>

                        <div class="relative">
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-sm font-medium text-gray-700">Somewhat optimistic</span>
                                <span class="text-sm text-gray-500">35%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-yellow-500 h-2 rounded-full" style="width: 35%"></div>
                            </div>
                        </div>

                        <div class="relative">
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-sm font-medium text-gray-700">Not very optimistic</span>
                                <span class="text-sm text-gray-500">47%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-red-500 h-2 rounded-full" style="width: 47%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between items-center text-sm text-gray-500 border-t pt-3">
                        <span>623 votes</span>
                        {{-- <button class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700 transition-colors">
                            Vote Now
                        </button> --}}
                    </div>
                </div>
            </div>
        </div>

        <!-- No Results Example (commented out, but here's how empty sections would look) -->
        <!--
        <div class="mb-12">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-900 flex items-center">
                    <i class="fas fa-users text-purple-600 mr-2"></i>
                    Writers
                    <span class="ml-2 px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded-full">0</span>
                </h2>
            </div>

            <div class="bg-white rounded-xl border border-gray-200 p-12 text-center">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-search text-gray-400 text-xl"></i>
                </div>
                <h3 class="text-lg font-medium text-gray-900 mb-2">No writers found</h3>
                <p class="text-gray-600 text-sm mb-4">
                    We couldn't find any writers matching "<span class="font-semibold">your search term</span>".
                    Try searching with different keywords or browse all writers.
                </p>
                <button class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                    Browse All Writers
                </button>
            </div>
        </div>
        -->

        <!-- Load More Button -->
        {{-- <div class="text-center mb-8">
            <button class="bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                <i class="fas fa-arrow-down mr-2"></i> Load More Results
            </button> --}}
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

    <!-- JavaScript for Interactive Elements -->
    <script>
        // Filter tab functionality
        document.querySelectorAll('button[class*="px-4 py-2"]').forEach((button, index) => {
            if (button.textContent.includes('Results') || button.textContent.includes('(')) {
                button.addEventListener('click', function() {
                    // Remove active state from all tabs
                    document.querySelectorAll('button[class*="border-b-2"]').forEach(tab => {
                        tab.classList.remove('text-blue-600', 'border-blue-600');
                        tab.classList.add('text-gray-500', 'border-transparent');
                    });

                    // Add active state to clicked tab
                    this.classList.remove('text-gray-500', 'border-transparent');
                    this.classList.add('text-blue-600', 'border-blue-600');

                    // Here you would filter content based on the selected tab
                    // For demo purposes, we'll just show all content
                });
            }
        });

        // Search functionality
        document.querySelector('input[type="text"]').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                const searchTerm = this.value;
                // Here you would redirect to search results or update content
                console.log('Searching for:', searchTerm);
            }
        });

        // Mock modal functions (for header buttons)
        function openDiscussionModal() {
            console.log('Open discussion modal');
        }

        function openPollModal() {
            console.log('Open poll modal');
        }
    </script>
</body>
</html>
