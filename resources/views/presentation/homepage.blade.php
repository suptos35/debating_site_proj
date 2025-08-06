<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factly - Evidence-Based Discussions</title>
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
    <!-- Header - Based on your main_layout -->
    <nav class="bg-white border-b border-gray-200 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo - Matching your current design -->
                <a href="/" class="flex items-center space-x-3">
                    <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center">
                        <i class="fas fa-balance-scale text-white text-sm"></i>
                    </div>
                    <span class="text-2xl font-semibold text-gray-900">Factly</span>
                </a>

                <!-- Navigation Tabs - Like your current layout -->
                <div class="hidden md:flex space-x-8">
                    <a href="#" class="text-blue-600 border-b-2 border-blue-600 px-3 py-2 text-sm font-medium">
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

    <!-- Enhanced Hero Section (Easy to add) -->
    <div class="gradient-bg">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <!-- Search Field in Top Right -->
            <div class="flex justify-end mb-8">
                <form action="/presentation/search" method="GET" class="relative">
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
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <button class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-blue-50 transition-colors">
                        Start a Discussion
                    </button>
                    <button class="border-2 border-white text-white px-6 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition-all">
                        Browse Topics
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="max-w-6xl mx-auto mt-6 lg:mt-10 px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-3 gap-6">
            <!-- Left and Middle Columns: Posts Section -->
            <div class="lg:col-span-2">
                <div class="mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Latest Discussions</h2>
                    <div class="lg:grid lg:grid-cols-2 gap-6 space-y-6 lg:space-y-0">

                        <!-- Discussion Card 1 -->
                        <article class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-100 card-hover">
                            <div class="p-6">
                                <!-- Image placeholder -->
                                <div class="w-full h-48 bg-gradient-to-br from-blue-400 to-blue-600 rounded-lg mb-4 flex items-center justify-center">
                                    <i class="fas fa-atom text-white text-4xl"></i>
                                </div>

                                <!-- Categories -->
                                <div class="space-x-2 mb-3">
                                    <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-xs font-medium">
                                        Science
                                    </span>
                                    <span class="px-3 py-1 bg-green-100 text-green-600 rounded-full text-xs font-medium">
                                        Environment
                                    </span>
                                </div>

                                <!-- Title -->
                                <h3 class="text-xl font-semibold text-gray-900 mb-3 hover:text-blue-600 cursor-pointer transition-colors">
                                    Should nuclear energy be prioritized over renewable sources?
                                </h3>

                                <!-- Excerpt -->
                                <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                    With climate targets becoming increasingly urgent, the debate between nuclear and renewable energy intensifies. Nuclear provides consistent baseload power...
                                </p>

                                <!-- Stats -->
                                <div class="flex items-center justify-between text-sm text-gray-500 border-t pt-4">
                                    <div class="flex items-center space-x-4">
                                        <span class="flex items-center">
                                            <i class="fas fa-user mr-1"></i> Dr. Sarah Chen
                                        </span>
                                        <span class="flex items-center text-green-600">
                                            <i class="fas fa-thumbs-up mr-1"></i> 23
                                        </span>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <span class="flex items-center text-blue-600">
                                            <i class="fas fa-comments mr-1"></i> 41
                                        </span>
                                        <span class="flex items-center text-purple-600">
                                            <i class="fas fa-link mr-1"></i> 8
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <!-- Discussion Card 2 -->
                        <article class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-100 card-hover">
                            <div class="p-6">
                                <div class="w-full h-48 bg-gradient-to-br from-purple-400 to-purple-600 rounded-lg mb-4 flex items-center justify-center">
                                    <i class="fas fa-robot text-white text-4xl"></i>
                                </div>

                                <div class="space-x-2 mb-3">
                                    <span class="px-3 py-1 bg-purple-100 text-purple-600 rounded-full text-xs font-medium">
                                        Technology
                                    </span>
                                    <span class="px-3 py-1 bg-orange-100 text-orange-600 rounded-full text-xs font-medium">
                                        Society
                                    </span>
                                </div>

                                <h3 class="text-xl font-semibold text-gray-900 mb-3 hover:text-blue-600 cursor-pointer transition-colors">
                                    Is AI a threat to human employment?
                                </h3>

                                <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                    As AI capabilities expand rapidly, concerns grow about widespread job displacement. While some argue AI will create new opportunities...
                                </p>

                                <div class="flex items-center justify-between text-sm text-gray-500 border-t pt-4">
                                    <div class="flex items-center space-x-4">
                                        <span class="flex items-center">
                                            <i class="fas fa-user mr-1"></i> Marcus Rodriguez
                                        </span>
                                        <span class="flex items-center text-green-600">
                                            <i class="fas fa-thumbs-up mr-1"></i> 18
                                        </span>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <span class="flex items-center text-blue-600">
                                            <i class="fas fa-comments mr-1"></i> 32
                                        </span>
                                        <span class="flex items-center text-purple-600">
                                            <i class="fas fa-link mr-1"></i> 5
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <!-- Discussion Card 3 -->
                        <article class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-100 card-hover">
                            <div class="p-6">
                                <div class="w-full h-48 bg-gradient-to-br from-green-400 to-green-600 rounded-lg mb-4 flex items-center justify-center">
                                    <i class="fas fa-seedling text-white text-4xl"></i>
                                </div>

                                <div class="space-x-2 mb-3">
                                    <span class="px-3 py-1 bg-green-100 text-green-600 rounded-full text-xs font-medium">
                                        Health
                                    </span>
                                    <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-xs font-medium">
                                        Science
                                    </span>
                                </div>

                                <h3 class="text-xl font-semibold text-gray-900 mb-3 hover:text-blue-600 cursor-pointer transition-colors">
                                    Are plant-based diets healthier than omnivorous diets?
                                </h3>

                                <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                    Recent studies suggest plant-based diets reduce disease risk, but nutritionists debate whether they provide all essential nutrients...
                                </p>

                                <div class="flex items-center justify-between text-sm text-gray-500 border-t pt-4">
                                    <div class="flex items-center space-x-4">
                                        <span class="flex items-center">
                                            <i class="fas fa-user mr-1"></i> Dr. James Park
                                        </span>
                                        <span class="flex items-center text-green-600">
                                            <i class="fas fa-thumbs-up mr-1"></i> 34
                                        </span>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <span class="flex items-center text-blue-600">
                                            <i class="fas fa-comments mr-1"></i> 28
                                        </span>
                                        <span class="flex items-center text-purple-600">
                                            <i class="fas fa-link mr-1"></i> 12
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </article>

                        <!-- Discussion Card 4 -->
                        <article class="bg-white rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 border border-gray-100 card-hover">
                            <div class="p-6">
                                <div class="w-full h-48 bg-gradient-to-br from-red-400 to-red-600 rounded-lg mb-4 flex items-center justify-center">
                                    <i class="fas fa-landmark text-white text-4xl"></i>
                                </div>

                                <div class="space-x-2 mb-3">
                                    <span class="px-3 py-1 bg-red-100 text-red-600 rounded-full text-xs font-medium">
                                        Politics
                                    </span>
                                    <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-medium">
                                        Society
                                    </span>
                                </div>

                                <h3 class="text-xl font-semibold text-gray-900 mb-3 hover:text-blue-600 cursor-pointer transition-colors">
                                    Should social media platforms be regulated by government?
                                </h3>

                                <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                    Growing concerns about misinformation and privacy breaches fuel debates about government regulation of social media companies...
                                </p>

                                <div class="flex items-center justify-between text-sm text-gray-500 border-t pt-4">
                                    <div class="flex items-center space-x-4">
                                        <span class="flex items-center">
                                            <i class="fas fa-user mr-1"></i> Prof. Emily Watson
                                        </span>
                                        <span class="flex items-center text-green-600">
                                            <i class="fas fa-thumbs-up mr-1"></i> 27
                                        </span>
                                    </div>
                                    <div class="flex items-center space-x-3">
                                        <span class="flex items-center text-blue-600">
                                            <i class="fas fa-comments mr-1"></i> 53
                                        </span>
                                        <span class="flex items-center text-purple-600">
                                            <i class="fas fa-link mr-1"></i> 6
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>

                    <!-- More Posts Button -->
                    <div class="text-center mt-8">
                        <button class="bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                            <i class="fas fa-plus mr-2"></i> Load More Discussions
                        </button>
                    </div>
                </div>
            </div>

            <!-- Right Column: Popular Categories and Writers -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Popular Categories -->
                <div class="glass-effect rounded-xl p-6 border border-white shadow-lg">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold text-gray-900">Popular Categories</h2>
                        <a href="/presentation/categories" class="text-blue-600 hover:text-blue-800 text-sm font-medium transition-colors">
                            See All →
                        </a>
                    </div>
                    <div class="space-y-3">
                        <a href="/presentation/category/science" class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition-colors cursor-pointer">
                            <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-atom text-white text-sm"></i>
                            </div>
                            <div class="flex-1">
                                <div class="font-medium text-gray-900 text-sm">Science</div>
                                <div class="text-xs text-gray-500">127 discussions</div>
                            </div>
                        </a>
                        <a href="/presentation/category/technology" class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition-colors cursor-pointer">
                            <div class="w-10 h-10 bg-purple-600 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-robot text-white text-sm"></i>
                            </div>
                            <div class="flex-1">
                                <div class="font-medium text-gray-900 text-sm">Technology</div>
                                <div class="text-xs text-gray-500">98 discussions</div>
                            </div>
                        </a>
                        <a href="/presentation/category/health" class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition-colors cursor-pointer">
                            <div class="w-10 h-10 bg-green-600 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-heartbeat text-white text-sm"></i>
                            </div>
                            <div class="flex-1">
                                <div class="font-medium text-gray-900 text-sm">Health</div>
                                <div class="text-xs text-gray-500">84 discussions</div>
                            </div>
                        </a>
                        <a href="/presentation/category/environment" class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition-colors cursor-pointer">
                            <div class="w-10 h-10 bg-green-500 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-seedling text-white text-sm"></i>
                            </div>
                            <div class="flex-1">
                                <div class="font-medium text-gray-900 text-sm">Environment</div>
                                <div class="text-xs text-gray-500">72 discussions</div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Popular Writers -->
                <div class="glass-effect rounded-xl p-6 border border-white shadow-lg">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-lg font-semibold text-gray-900">Popular Writers</h2>
                        <a href="/presentation/writers" class="text-blue-600 hover:text-blue-800 text-sm font-medium transition-colors">
                            See All →
                        </a>
                    </div>
                    <div class="space-y-3">
                        <a href="/presentation/writer/dr-sarah-chen" class="flex items-center p-2 rounded-lg hover:bg-gray-50 transition-colors cursor-pointer">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                <span class="text-blue-600 text-xs font-medium">SC</span>
                            </div>
                            <div class="flex-1">
                                <div class="font-medium text-gray-900 text-sm">Dr. Sarah Chen</div>
                                <div class="text-xs text-gray-500">Environmental Scientist</div>
                            </div>
                        </a>
                        <a href="/presentation/writer/marcus-rodriguez" class="flex items-center p-2 rounded-lg hover:bg-gray-50 transition-colors cursor-pointer">
                            <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                                <span class="text-purple-600 text-xs font-medium">MR</span>
                            </div>
                            <div class="flex-1">
                                <div class="font-medium text-gray-900 text-sm">Marcus Rodriguez</div>
                                <div class="text-xs text-gray-500">Tech Policy Analyst</div>
                            </div>
                        </a>
                        <a href="/presentation/writer/dr-james-park" class="flex items-center p-2 rounded-lg hover:bg-gray-50 transition-colors cursor-pointer">
                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                <span class="text-green-600 text-xs font-medium">JP</span>
                            </div>
                            <div class="flex-1">
                                <div class="font-medium text-gray-900 text-sm">Dr. James Park</div>
                                <div class="text-xs text-gray-500">Health Researcher</div>
                            </div>
                        </a>
                        <a href="/presentation/writer/prof-emily-watson" class="flex items-center p-2 rounded-lg hover:bg-gray-50 transition-colors cursor-pointer">
                            <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center mr-3">
                                <span class="text-red-600 text-xs font-medium">EW</span>
                            </div>
                            <div class="flex-1">
                                <div class="font-medium text-gray-900 text-sm">Prof. Emily Watson</div>
                                <div class="text-xs text-gray-500">Political Scientist</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Polls Section - Enhanced version of your current polls -->
        <div class="mb-12">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold text-gray-900">Community Polls</h2>
                <a href="#" class="text-blue-600 hover:text-blue-800 text-sm font-medium transition-colors">
                    View All Polls →
                </a>
            </div>

            <div class="grid lg:grid-cols-2 gap-6">
                <!-- Poll Card 1 - Enhanced version of your poll_card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 card-hover">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        Which renewable energy source is most promising for the future?
                    </h3>

                    <!-- Poll Options -->
                    <div class="space-y-3 mb-4">
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 cursor-pointer transition-colors">
                            <div class="flex items-center">
                                <input type="radio" name="poll1" class="mr-3 text-blue-600">
                                <span class="text-sm font-medium">Solar Energy</span>
                            </div>
                            <span class="text-sm text-gray-600">45%</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 cursor-pointer transition-colors">
                            <div class="flex items-center">
                                <input type="radio" name="poll1" class="mr-3 text-blue-600">
                                <span class="text-sm font-medium">Wind Energy</span>
                            </div>
                            <span class="text-sm text-gray-600">32%</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 cursor-pointer transition-colors">
                            <div class="flex items-center">
                                <input type="radio" name="poll1" class="mr-3 text-blue-600">
                                <span class="text-sm font-medium">Hydroelectric</span>
                            </div>
                            <span class="text-sm text-gray-600">23%</span>
                        </div>
                    </div>

                    <!-- Poll Stats -->
                    <div class="flex items-center justify-between text-sm text-gray-500 border-t pt-4">
                        <span>1,247 votes</span>
                        <span>2 days remaining</span>
                    </div>
                </div>

                <!-- Poll Card 2 -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 card-hover">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">
                        Should social media platforms require age verification?
                    </h3>

                    <div class="space-y-3 mb-4">
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 cursor-pointer transition-colors">
                            <div class="flex items-center">
                                <input type="radio" name="poll2" class="mr-3 text-blue-600">
                                <span class="text-sm font-medium">Yes, it's necessary</span>
                            </div>
                            <span class="text-sm text-gray-600">67%</span>
                        </div>
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 cursor-pointer transition-colors">
                            <div class="flex items-center">
                                <input type="radio" name="poll2" class="mr-3 text-blue-600">
                                <span class="text-sm font-medium">No, privacy concerns</span>
                            </div>
                            <span class="text-sm text-gray-600">33%</span>
                        </div>
                    </div>

                    <div class="flex items-center justify-between text-sm text-gray-500 border-t pt-4">
                        <span>892 votes</span>
                        <span>5 days remaining</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Polls Section -->
        <div class="mb-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Current Polls</h2>
            <div class="grid lg:grid-cols-2 gap-6">
                <!-- Poll Card 1 -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">
                            Which renewable energy source should receive the most government funding?
                        </h3>
                        <p class="text-sm text-gray-600">Posted by Dr. Sarah Chen • 2 days ago</p>
                    </div>

                    <div class="space-y-3 mb-4">
                        <div class="relative">
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-sm font-medium text-gray-700">Solar Power</span>
                                <span class="text-sm text-gray-500">45%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-yellow-500 h-2 rounded-full" style="width: 45%"></div>
                            </div>
                        </div>

                        <div class="relative">
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-sm font-medium text-gray-700">Wind Energy</span>
                                <span class="text-sm text-gray-500">32%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-500 h-2 rounded-full" style="width: 32%"></div>
                            </div>
                        </div>

                        <div class="relative">
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-sm font-medium text-gray-700">Hydroelectric</span>
                                <span class="text-sm text-gray-500">23%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-cyan-500 h-2 rounded-full" style="width: 23%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between items-center text-sm text-gray-500 border-t pt-3">
                        <span>284 votes</span>
                        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700 transition-colors">
                            Vote Now
                        </button>
                    </div>
                </div>

                <!-- Poll Card 2 -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">
                            Should artificial intelligence development be slowed down for safety?
                        </h3>
                        <p class="text-sm text-gray-600">Posted by Marcus Rodriguez • 1 day ago</p>
                    </div>

                    <div class="space-y-3 mb-4">
                        <div class="relative">
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-sm font-medium text-gray-700">Yes, prioritize safety</span>
                                <span class="text-sm text-gray-500">58%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-red-500 h-2 rounded-full" style="width: 58%"></div>
                            </div>
                        </div>

                        <div class="relative">
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-sm font-medium text-gray-700">No, continue current pace</span>
                                <span class="text-sm text-gray-500">42%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-green-500 h-2 rounded-full" style="width: 42%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between items-center text-sm text-gray-500 border-t pt-3">
                        <span>412 votes</span>
                        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700 transition-colors">
                            Vote Now
                        </button>
                    </div>
                </div>

                <!-- Poll Card 3 -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">
                            What's the most effective way to combat climate change?
                        </h3>
                        <p class="text-sm text-gray-600">Posted by Dr. James Park • 3 days ago</p>
                    </div>

                    <div class="space-y-3 mb-4">
                        <div class="relative">
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-sm font-medium text-gray-700">Carbon pricing/taxes</span>
                                <span class="text-sm text-gray-500">35%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-green-500 h-2 rounded-full" style="width: 35%"></div>
                            </div>
                        </div>

                        <div class="relative">
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-sm font-medium text-gray-700">Technology innovation</span>
                                <span class="text-sm text-gray-500">28%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-blue-500 h-2 rounded-full" style="width: 28%"></div>
                            </div>
                        </div>

                        <div class="relative">
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-sm font-medium text-gray-700">Lifestyle changes</span>
                                <span class="text-sm text-gray-500">24%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-orange-500 h-2 rounded-full" style="width: 24%"></div>
                            </div>
                        </div>

                        <div class="relative">
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-sm font-medium text-gray-700">Government regulation</span>
                                <span class="text-sm text-gray-500">13%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-red-500 h-2 rounded-full" style="width: 13%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between items-center text-sm text-gray-500 border-t pt-3">
                        <span>567 votes</span>
                        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700 transition-colors">
                            Vote Now
                        </button>
                    </div>
                </div>

                <!-- Poll Card 4 -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <div class="mb-4">
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">
                            Should social media platforms fact-check political content?
                        </h3>
                        <p class="text-sm text-gray-600">Posted by Prof. Emily Watson • 4 days ago</p>
                    </div>

                    <div class="space-y-3 mb-4">
                        <div class="relative">
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-sm font-medium text-gray-700">Yes, they should fact-check</span>
                                <span class="text-sm text-gray-500">52%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-green-500 h-2 rounded-full" style="width: 52%"></div>
                            </div>
                        </div>

                        <div class="relative">
                            <div class="flex justify-between items-center mb-1">
                                <span class="text-sm font-medium text-gray-700">No, freedom of speech</span>
                                <span class="text-sm text-gray-500">48%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-red-500 h-2 rounded-full" style="width: 48%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between items-center text-sm text-gray-500 border-t pt-3">
                        <span>329 votes</span>
                        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm hover:bg-blue-700 transition-colors">
                            Vote Now
                        </button>
                    </div>
                </div>
            </div>

            <!-- More Polls Button -->
            <div class="text-center mt-8">
                <button class="bg-purple-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-purple-700 transition-colors">
                    <i class="fas fa-poll mr-2"></i> More Polls
                </button>
            </div>
        </div>
    </main>

    <!-- Footer - Simplified version -->
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

    <!-- New Discussion Modal -->
    <div id="discussionModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-xl shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                <div class="p-6">
                    <!-- Modal Header -->
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-900">Create New Discussion</h2>
                        <button onclick="closeDiscussionModal()" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>

                    <!-- Discussion Form -->
                    <form class="space-y-6">
                        <!-- Title -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Discussion Title</label>
                            <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Enter a compelling question or topic">
                        </div>

                        <!-- Description -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                            <textarea rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Provide context and background for your discussion..."></textarea>
                        </div>

                        <!-- Statement -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Statement</label>
                            <textarea rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" placeholder="Enter the main statement or proposition to debate..."></textarea>
                        </div>

                        <!-- Categories -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Categories</label>
                            <div class="flex flex-wrap gap-2">
                                <button type="button" class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-sm hover:bg-blue-200 transition-colors">Science</button>
                                <button type="button" class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm hover:bg-gray-200 transition-colors">Technology</button>
                                <button type="button" class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm hover:bg-gray-200 transition-colors">Health</button>
                                <button type="button" class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm hover:bg-gray-200 transition-colors">Politics</button>
                                <button type="button" class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm hover:bg-gray-200 transition-colors">Environment</button>
                                <button type="button" class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm hover:bg-gray-200 transition-colors">Society</button>
                            </div>
                        </div>

                        <!-- Picture Upload -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Discussion Image (Optional)</label>
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-gray-400 transition-colors">
                                <div class="space-y-2">
                                    <i class="fas fa-cloud-upload-alt text-3xl text-gray-400"></i>
                                    <div class="text-sm text-gray-600">
                                        <span class="font-medium text-blue-600 hover:text-blue-500 cursor-pointer">Click to upload</span> or drag and drop
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                                </div>
                                <input type="file" class="hidden" accept="image/*">
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex justify-end space-x-3 pt-4 border-t">
                            <button type="button" onclick="closeDiscussionModal()" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                                Cancel
                            </button>
                            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                Create Discussion
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- New Poll Modal -->
    <div id="pollModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-xl shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                <div class="p-6">
                    <!-- Modal Header -->
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-900">Create New Poll</h2>
                        <button onclick="closePollModal()" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>

                    <!-- Poll Form -->
                    <form class="space-y-6">
                        <!-- Poll Question -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Poll Question</label>
                            <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="What question would you like to ask the community?">
                        </div>

                        <!-- Poll Type -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Poll Type</label>
                            <div class="flex space-x-4">
                                <label class="flex items-center">
                                    <input type="radio" name="poll_type" value="single" checked class="mr-2 text-purple-600">
                                    <span class="text-sm">Single Choice</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="poll_type" value="multiple" class="mr-2 text-purple-600">
                                    <span class="text-sm">Multiple Choice</span>
                                </label>
                            </div>
                        </div>

                        <!-- Poll Options -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Poll Options</label>
                            <div class="space-y-3">
                                <div class="flex items-center space-x-2">
                                    <div class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center">
                                        <span class="text-blue-600 text-xs font-medium">1</span>
                                    </div>
                                    <input type="text" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="Option 1">
                                </div>
                                <div class="flex items-center space-x-2">
                                    <div class="w-6 h-6 bg-purple-100 rounded-full flex items-center justify-center">
                                        <span class="text-purple-600 text-xs font-medium">2</span>
                                    </div>
                                    <input type="text" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="Option 2">
                                </div>
                                <div class="flex items-center space-x-2">
                                    <div class="w-6 h-6 bg-green-100 rounded-full flex items-center justify-center">
                                        <span class="text-green-600 text-xs font-medium">3</span>
                                    </div>
                                    <input type="text" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="Option 3">
                                </div>
                                <div class="flex items-center space-x-2">
                                    <div class="w-6 h-6 bg-orange-100 rounded-full flex items-center justify-center">
                                        <span class="text-orange-600 text-xs font-medium">4</span>
                                    </div>
                                    <input type="text" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="Option 4 (optional)">
                                </div>
                                <button type="button" class="text-purple-600 hover:text-purple-800 text-sm font-medium">
                                    <i class="fas fa-plus mr-1"></i> Add Another Option
                                </button>
                            </div>
                        </div>

                        <!-- Poll Duration -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Poll Duration</label>
                            <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                                <option value="1">1 Day</option>
                                <option value="3">3 Days</option>
                                <option value="7" selected>1 Week</option>
                                <option value="14">2 Weeks</option>
                                <option value="30">1 Month</option>
                                <option value="0">No Expiration</option>
                            </select>
                        </div>

                        <!-- Categories -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Related Categories</label>
                            <div class="flex flex-wrap gap-2">
                                <button type="button" class="px-3 py-1 bg-purple-100 text-purple-600 rounded-full text-sm hover:bg-purple-200 transition-colors">Science</button>
                                <button type="button" class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm hover:bg-gray-200 transition-colors">Technology</button>
                                <button type="button" class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm hover:bg-gray-200 transition-colors">Health</button>
                                <button type="button" class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm hover:bg-gray-200 transition-colors">Politics</button>
                                <button type="button" class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm hover:bg-gray-200 transition-colors">Environment</button>
                                <button type="button" class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm hover:bg-gray-200 transition-colors">Society</button>
                            </div>
                        </div>

                        <!-- Description -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Description (Optional)</label>
                            <textarea rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent" placeholder="Provide additional context for your poll..."></textarea>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex justify-end space-x-3 pt-4 border-t">
                            <button type="button" onclick="closePollModal()" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                                Cancel
                            </button>
                            <button type="submit" class="px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                                Create Poll
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Modals -->
    <script>
        function openDiscussionModal() {
            document.getElementById('discussionModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeDiscussionModal() {
            document.getElementById('discussionModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function openPollModal() {
            document.getElementById('pollModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closePollModal() {
            document.getElementById('pollModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Close modals when clicking outside
        document.getElementById('discussionModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDiscussionModal();
            }
        });

        document.getElementById('pollModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closePollModal();
            }
        });

        // Category selection for discussion modal
        document.querySelectorAll('#discussionModal button[type="button"]').forEach(button => {
            if (button.textContent.trim().match(/^(Science|Technology|Health|Politics|Environment|Society)$/)) {
                button.addEventListener('click', function() {
                    this.classList.toggle('bg-blue-100');
                    this.classList.toggle('text-blue-600');
                    this.classList.toggle('bg-gray-100');
                    this.classList.toggle('text-gray-600');
                });
            }
        });

        // Category selection for poll modal
        document.querySelectorAll('#pollModal button[type="button"]').forEach(button => {
            if (button.textContent.trim().match(/^(Science|Technology|Health|Politics|Environment|Society)$/)) {
                button.addEventListener('click', function() {
                    this.classList.toggle('bg-purple-100');
                    this.classList.toggle('text-purple-600');
                    this.classList.toggle('bg-gray-100');
                    this.classList.toggle('text-gray-600');
                });
            }
        });

        // File upload handling
        document.querySelector('#discussionModal input[type="file"]').addEventListener('change', function(e) {
            if (e.target.files[0]) {
                const fileName = e.target.files[0].name;
                const uploadArea = e.target.closest('.border-dashed');
                uploadArea.innerHTML = `
                    <div class="space-y-2">
                        <i class="fas fa-image text-3xl text-green-600"></i>
                        <div class="text-sm text-gray-600">
                            <span class="font-medium text-green-600">${fileName}</span>
                        </div>
                        <button type="button" onclick="this.closest('.border-dashed').innerHTML=originalUploadHTML" class="text-xs text-red-600 hover:text-red-800">Remove</button>
                    </div>
                `;
            }
        });

        // Store original upload HTML for reset
        const originalUploadHTML = document.querySelector('.border-dashed').innerHTML;
    </script>
</body>
</html>
