<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Polls - Factly</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.1/dist/flowbite.min.js"></script>
    <style>
        .gradient-bg { background: linear-gradient(135deg, #3b82f6 0%, #1e40af 100%); }
        .card-hover { transition: all 0.3s ease; }
        .card-hover:hover { transform: translateY(-2px); box-shadow: 0 8px 25px rgba(0,0,0,0.15); }
        .poll-bar {
            background: linear-gradient(135deg, #6366f1 0%, #8b5cf6 100%);
            transition: all 0.3s ease;
        }
        .poll-option:hover .poll-bar {
            opacity: 0.8;
        }
        .active-poll { border-left: 4px solid #10b981; }
        .expired-poll { border-left: 4px solid #ef4444; }
        .community-badge { background: linear-gradient(135deg, #10b981 0%, #059669 100%); }
        .public-badge { background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Header -->
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

                <!-- Navigation -->
                <div class="hidden md:flex space-x-8">
                    <a href="/presentation/homepage" class="text-gray-500 hover:text-gray-700 px-3 py-2 text-sm font-medium border-b-2 border-transparent hover:border-gray-300">
                        Home
                    </a>
                    <a href="/presentation/argument" class="text-gray-500 hover:text-gray-700 px-3 py-2 text-sm font-medium border-b-2 border-transparent hover:border-gray-300">
                        Discussions
                    </a>
                    <a href="#" class="text-blue-600 border-b-2 border-blue-600 px-3 py-2 text-sm font-medium">
                        Polls
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-700 px-3 py-2 text-sm font-medium border-b-2 border-transparent hover:border-gray-300">
                        Categories
                    </a>
                </div>

                <!-- User Actions -->
                <div class="flex items-center space-x-4">
                    <button class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                        <i class="fas fa-plus mr-1"></i> Create Poll
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

    <!-- Main Content -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Page Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-4">Community Polls</h1>
            <p class="text-lg text-gray-600">Cast your vote on important topics and see what the community thinks</p>
        </div>

        <!-- Filter Tabs -->
        <div class="mb-8 border-b border-gray-200">
            <nav class="-mb-px flex space-x-8">
                <button onclick="showSection('active')" id="activeTab" class="poll-tab border-blue-500 text-blue-600 whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
                    Active Polls
                    <span class="ml-2 bg-blue-100 text-blue-600 py-1 px-2 rounded-full text-xs">8</span>
                </button>
                <button onclick="showSection('expired')" id="expiredTab" class="poll-tab border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
                    Expired Polls
                    <span class="ml-2 bg-gray-100 text-gray-600 py-1 px-2 rounded-full text-xs">15</span>
                </button>
                <button onclick="showSection('community')" id="communityTab" class="poll-tab border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-2 px-1 border-b-2 font-medium text-sm">
                    Community Only
                    <span class="ml-2 bg-green-100 text-green-600 py-1 px-2 rounded-full text-xs">5</span>
                </button>
            </nav>
        </div>

        <!-- Active Polls Section -->
        <div id="activeSection" class="poll-section">
            <div class="grid gap-6">
                <!-- Active Poll 1 - Public -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 card-hover active-poll">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <div class="flex items-center space-x-3 mb-3">
                                <span class="public-badge text-white px-3 py-1 rounded-full text-sm font-medium">Public Poll</span>
                                <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-sm">Technology</span>
                                <span class="bg-green-100 text-green-600 px-2 py-1 rounded-full text-xs font-medium">
                                    <i class="fas fa-clock mr-1"></i> 2 days left
                                </span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">
                                Should AI development be regulated by government agencies?
                            </h3>
                            <p class="text-gray-600 mb-4">
                                With rapid advances in artificial intelligence, there's growing debate about the need for regulatory oversight to ensure safety and ethical development.
                            </p>
                            <div class="flex items-center space-x-6 text-sm text-gray-500 mb-4">
                                <span class="flex items-center">
                                    <i class="fas fa-user mr-2"></i> Created by Dr. Tech Policy
                                </span>
                                <span class="flex items-center">
                                    <i class="fas fa-users mr-2"></i> 1,247 votes
                                </span>
                                <span class="flex items-center">
                                    <i class="fas fa-calendar mr-2"></i> Ends Aug 9, 2025
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Poll Options -->
                    <div class="space-y-3">
                        <div class="poll-option cursor-pointer" onclick="vote('poll1', 'yes')">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium text-gray-900">Yes, strict regulation is needed</span>
                                <span class="text-sm text-gray-600">62%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="poll-bar h-2 rounded-full" style="width: 62%"></div>
                            </div>
                        </div>
                        <div class="poll-option cursor-pointer" onclick="vote('poll1', 'no')">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium text-gray-900">No, industry self-regulation is sufficient</span>
                                <span class="text-sm text-gray-600">28%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="poll-bar h-2 rounded-full" style="width: 28%"></div>
                            </div>
                        </div>
                        <div class="poll-option cursor-pointer" onclick="vote('poll1', 'partial')">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium text-gray-900">Partial regulation for high-risk AI only</span>
                                <span class="text-sm text-gray-600">10%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="poll-bar h-2 rounded-full" style="width: 10%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 pt-4 border-t flex justify-between items-center">
                        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                            Cast Vote
                        </button>
                        <div class="flex items-center space-x-4 text-sm text-gray-500">
                            <button class="hover:text-blue-600"><i class="fas fa-share mr-1"></i> Share</button>
                            <button class="hover:text-blue-600"><i class="fas fa-bookmark mr-1"></i> Save</button>
                        </div>
                    </div>
                </div>

                <!-- Active Poll 2 - Community -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 card-hover active-poll">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <div class="flex items-center space-x-3 mb-3">
                                <span class="community-badge text-white px-3 py-1 rounded-full text-sm font-medium">Community Poll</span>
                                <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-sm">Environment</span>
                                <span class="bg-green-100 text-green-600 px-2 py-1 rounded-full text-xs font-medium">
                                    <i class="fas fa-clock mr-1"></i> 5 hours left
                                </span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">
                                What's the most effective way to reduce personal carbon footprint?
                            </h3>
                            <p class="text-gray-600 mb-4">
                                Community members share their views on the most impactful individual actions for climate change.
                            </p>
                            <div class="flex items-center space-x-6 text-sm text-gray-500 mb-4">
                                <span class="flex items-center">
                                    <i class="fas fa-user mr-2"></i> Created by EcoWarrior23
                                </span>
                                <span class="flex items-center">
                                    <i class="fas fa-users mr-2"></i> 428 votes
                                </span>
                                <span class="flex items-center">
                                    <i class="fas fa-calendar mr-2"></i> Ends today
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Poll Options -->
                    <div class="space-y-3">
                        <div class="poll-option cursor-pointer" onclick="vote('poll2', 'transport')">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium text-gray-900">Use public transport/bike/walk</span>
                                <span class="text-sm text-gray-600">35%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="poll-bar h-2 rounded-full" style="width: 35%"></div>
                            </div>
                        </div>
                        <div class="poll-option cursor-pointer" onclick="vote('poll2', 'diet')">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium text-gray-900">Reduce meat consumption</span>
                                <span class="text-sm text-gray-600">28%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="poll-bar h-2 rounded-full" style="width: 28%"></div>
                            </div>
                        </div>
                        <div class="poll-option cursor-pointer" onclick="vote('poll2', 'energy')">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium text-gray-900">Switch to renewable energy</span>
                                <span class="text-sm text-gray-600">22%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="poll-bar h-2 rounded-full" style="width: 22%"></div>
                            </div>
                        </div>
                        <div class="poll-option cursor-pointer" onclick="vote('poll2', 'consumption')">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium text-gray-900">Reduce overall consumption</span>
                                <span class="text-sm text-gray-600">15%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="poll-bar h-2 rounded-full" style="width: 15%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 pt-4 border-t flex justify-between items-center">
                        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                            Cast Vote
                        </button>
                        <div class="flex items-center space-x-4 text-sm text-gray-500">
                            <button class="hover:text-blue-600"><i class="fas fa-comment mr-1"></i> Discuss</button>
                            <button class="hover:text-blue-600"><i class="fas fa-share mr-1"></i> Share</button>
                        </div>
                    </div>
                </div>

                <!-- Active Poll 3 -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 card-hover active-poll">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <div class="flex items-center space-x-3 mb-3">
                                <span class="public-badge text-white px-3 py-1 rounded-full text-sm font-medium">Public Poll</span>
                                <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-sm">Economics</span>
                                <span class="bg-green-100 text-green-600 px-2 py-1 rounded-full text-xs font-medium">
                                    <i class="fas fa-clock mr-1"></i> 1 week left
                                </span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">
                                Should universal basic income be implemented globally?
                            </h3>
                            <p class="text-gray-600 mb-4">
                                As automation increases and job markets evolve, UBI is being considered as a potential solution for economic security.
                            </p>
                            <div class="flex items-center space-x-6 text-sm text-gray-500 mb-4">
                                <span class="flex items-center">
                                    <i class="fas fa-user mr-2"></i> Created by Economic Institute
                                </span>
                                <span class="flex items-center">
                                    <i class="fas fa-users mr-2"></i> 2,156 votes
                                </span>
                                <span class="flex items-center">
                                    <i class="fas fa-calendar mr-2"></i> Ends Aug 14, 2025
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Poll Options -->
                    <div class="space-y-3">
                        <div class="poll-option cursor-pointer" onclick="vote('poll3', 'yes')">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium text-gray-900">Yes, it's necessary for future economy</span>
                                <span class="text-sm text-gray-600">45%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="poll-bar h-2 rounded-full" style="width: 45%"></div>
                            </div>
                        </div>
                        <div class="poll-option cursor-pointer" onclick="vote('poll3', 'no')">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium text-gray-900">No, it would reduce work incentives</span>
                                <span class="text-sm text-gray-600">32%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="poll-bar h-2 rounded-full" style="width: 32%"></div>
                            </div>
                        </div>
                        <div class="poll-option cursor-pointer" onclick="vote('poll3', 'pilot')">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium text-gray-900">Start with pilot programs first</span>
                                <span class="text-sm text-gray-600">23%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="poll-bar h-2 rounded-full" style="width: 23%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 pt-4 border-t flex justify-between items-center">
                        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                            Cast Vote
                        </button>
                        <div class="flex items-center space-x-4 text-sm text-gray-500">
                            <button class="hover:text-blue-600"><i class="fas fa-share mr-1"></i> Share</button>
                            <button class="hover:text-blue-600"><i class="fas fa-bookmark mr-1"></i> Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Expired Polls Section -->
        <div id="expiredSection" class="poll-section hidden">
            <div class="grid gap-6">
                <!-- Expired Poll 1 -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 card-hover expired-poll opacity-75">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <div class="flex items-center space-x-3 mb-3">
                                <span class="public-badge text-white px-3 py-1 rounded-full text-sm font-medium">Public Poll</span>
                                <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-sm">Politics</span>
                                <span class="bg-red-100 text-red-600 px-2 py-1 rounded-full text-xs font-medium">
                                    <i class="fas fa-clock mr-1"></i> Expired
                                </span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">
                                Should voting age be lowered to 16?
                            </h3>
                            <p class="text-gray-600 mb-4">
                                A debate on whether younger citizens should have voting rights to shape policies that will affect their future.
                            </p>
                            <div class="flex items-center space-x-6 text-sm text-gray-500 mb-4">
                                <span class="flex items-center">
                                    <i class="fas fa-user mr-2"></i> Created by Youth Rights Org
                                </span>
                                <span class="flex items-center">
                                    <i class="fas fa-users mr-2"></i> 3,847 votes
                                </span>
                                <span class="flex items-center">
                                    <i class="fas fa-calendar mr-2"></i> Ended Aug 5, 2025
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Final Results -->
                    <div class="space-y-3">
                        <div class="poll-option">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium text-gray-900">No, 18 is appropriate</span>
                                <span class="text-sm text-gray-600 font-bold">54%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-red-500 h-2 rounded-full" style="width: 54%"></div>
                            </div>
                        </div>
                        <div class="poll-option">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium text-gray-900">Yes, lower to 16</span>
                                <span class="text-sm text-gray-600">32%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-gray-400 h-2 rounded-full" style="width: 32%"></div>
                            </div>
                        </div>
                        <div class="poll-option">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium text-gray-900">Depends on the election type</span>
                                <span class="text-sm text-gray-600">14%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-gray-400 h-2 rounded-full" style="width: 14%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 pt-4 border-t flex justify-between items-center">
                        <span class="text-red-600 font-medium text-sm">
                            <i class="fas fa-lock mr-1"></i> Poll Closed
                        </span>
                        <div class="flex items-center space-x-4 text-sm text-gray-500">
                            <button class="hover:text-blue-600"><i class="fas fa-chart-bar mr-1"></i> View Analysis</button>
                            <button class="hover:text-blue-600"><i class="fas fa-share mr-1"></i> Share Results</button>
                        </div>
                    </div>
                </div>

                <!-- Expired Poll 2 -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 card-hover expired-poll opacity-75">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <div class="flex items-center space-x-3 mb-3">
                                <span class="community-badge text-white px-3 py-1 rounded-full text-sm font-medium">Community Poll</span>
                                <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-sm">Lifestyle</span>
                                <span class="bg-red-100 text-red-600 px-2 py-1 rounded-full text-xs font-medium">
                                    <i class="fas fa-clock mr-1"></i> Expired
                                </span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">
                                Best time management technique for productivity?
                            </h3>
                            <p class="text-gray-600 mb-4">
                                Community poll on effective productivity methods and time management strategies.
                            </p>
                            <div class="flex items-center space-x-6 text-sm text-gray-500 mb-4">
                                <span class="flex items-center">
                                    <i class="fas fa-user mr-2"></i> Created by ProductivityGuru
                                </span>
                                <span class="flex items-center">
                                    <i class="fas fa-users mr-2"></i> 892 votes
                                </span>
                                <span class="flex items-center">
                                    <i class="fas fa-calendar mr-2"></i> Ended Aug 3, 2025
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Final Results -->
                    <div class="space-y-3">
                        <div class="poll-option">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium text-gray-900">Pomodoro Technique</span>
                                <span class="text-sm text-gray-600 font-bold">38%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-green-500 h-2 rounded-full" style="width: 38%"></div>
                            </div>
                        </div>
                        <div class="poll-option">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium text-gray-900">Time blocking</span>
                                <span class="text-sm text-gray-600">27%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-gray-400 h-2 rounded-full" style="width: 27%"></div>
                            </div>
                        </div>
                        <div class="poll-option">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium text-gray-900">Getting Things Done (GTD)</span>
                                <span class="text-sm text-gray-600">20%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-gray-400 h-2 rounded-full" style="width: 20%"></div>
                            </div>
                        </div>
                        <div class="poll-option">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium text-gray-900">Eisenhower Matrix</span>
                                <span class="text-sm text-gray-600">15%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="bg-gray-400 h-2 rounded-full" style="width: 15%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 pt-4 border-t flex justify-between items-center">
                        <span class="text-red-600 font-medium text-sm">
                            <i class="fas fa-lock mr-1"></i> Poll Closed
                        </span>
                        <div class="flex items-center space-x-4 text-sm text-gray-500">
                            <button class="hover:text-blue-600"><i class="fas fa-comment mr-1"></i> Discussion</button>
                            <button class="hover:text-blue-600"><i class="fas fa-share mr-1"></i> Share Results</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Community Only Section -->
        <div id="communitySection" class="poll-section hidden">
            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                <div class="flex items-center">
                    <i class="fas fa-users text-green-600 mr-3"></i>
                    <div>
                        <h3 class="font-medium text-green-800">Community Exclusive Polls</h3>
                        <p class="text-sm text-green-700">These polls are created by and for community members only.</p>
                    </div>
                </div>
            </div>

            <div class="grid gap-6">
                <!-- Community Poll 1 -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 card-hover active-poll">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <div class="flex items-center space-x-3 mb-3">
                                <span class="community-badge text-white px-3 py-1 rounded-full text-sm font-medium">Community Poll</span>
                                <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-sm">Health</span>
                                <span class="bg-green-100 text-green-600 px-2 py-1 rounded-full text-xs font-medium">
                                    <i class="fas fa-clock mr-1"></i> 3 days left
                                </span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">
                                What's your preferred workout schedule?
                            </h3>
                            <p class="text-gray-600 mb-4">
                                Community members share their fitness routines and preferred workout timing.
                            </p>
                            <div class="flex items-center space-x-6 text-sm text-gray-500 mb-4">
                                <span class="flex items-center">
                                    <i class="fas fa-user mr-2"></i> Created by FitnessEnthusiast
                                </span>
                                <span class="flex items-center">
                                    <i class="fas fa-users mr-2"></i> 156 votes
                                </span>
                                <span class="flex items-center">
                                    <i class="fas fa-calendar mr-2"></i> Ends Aug 10, 2025
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Poll Options -->
                    <div class="space-y-3">
                        <div class="poll-option cursor-pointer" onclick="vote('community1', 'morning')">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium text-gray-900">Early morning (5-7 AM)</span>
                                <span class="text-sm text-gray-600">42%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="poll-bar h-2 rounded-full" style="width: 42%"></div>
                            </div>
                        </div>
                        <div class="poll-option cursor-pointer" onclick="vote('community1', 'evening')">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium text-gray-900">Evening (6-8 PM)</span>
                                <span class="text-sm text-gray-600">35%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="poll-bar h-2 rounded-full" style="width: 35%"></div>
                            </div>
                        </div>
                        <div class="poll-option cursor-pointer" onclick="vote('community1', 'afternoon')">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium text-gray-900">Afternoon (12-3 PM)</span>
                                <span class="text-sm text-gray-600">23%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="poll-bar h-2 rounded-full" style="width: 23%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 pt-4 border-t flex justify-between items-center">
                        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                            Cast Vote
                        </button>
                        <div class="flex items-center space-x-4 text-sm text-gray-500">
                            <button class="hover:text-blue-600"><i class="fas fa-comment mr-1"></i> Discuss</button>
                            <button class="hover:text-blue-600"><i class="fas fa-share mr-1"></i> Share</button>
                        </div>
                    </div>
                </div>

                <!-- Community Poll 2 -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 card-hover active-poll">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <div class="flex items-center space-x-3 mb-3">
                                <span class="community-badge text-white px-3 py-1 rounded-full text-sm font-medium">Community Poll</span>
                                <span class="bg-gray-100 text-gray-600 px-3 py-1 rounded-full text-sm">Food</span>
                                <span class="bg-green-100 text-green-600 px-2 py-1 rounded-full text-xs font-medium">
                                    <i class="fas fa-clock mr-1"></i> 1 day left
                                </span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">
                                Best cuisine for a community potluck?
                            </h3>
                            <p class="text-gray-600 mb-4">
                                Planning our next community gathering - what type of food should we focus on?
                            </p>
                            <div class="flex items-center space-x-6 text-sm text-gray-500 mb-4">
                                <span class="flex items-center">
                                    <i class="fas fa-user mr-2"></i> Created by CommunityOrganizer
                                </span>
                                <span class="flex items-center">
                                    <i class="fas fa-users mr-2"></i> 89 votes
                                </span>
                                <span class="flex items-center">
                                    <i class="fas fa-calendar mr-2"></i> Ends tomorrow
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Poll Options -->
                    <div class="space-y-3">
                        <div class="poll-option cursor-pointer" onclick="vote('community2', 'international')">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium text-gray-900">International variety</span>
                                <span class="text-sm text-gray-600">38%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="poll-bar h-2 rounded-full" style="width: 38%"></div>
                            </div>
                        </div>
                        <div class="poll-option cursor-pointer" onclick="vote('community2', 'comfort')">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium text-gray-900">Comfort food classics</span>
                                <span class="text-sm text-gray-600">34%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="poll-bar h-2 rounded-full" style="width: 34%"></div>
                            </div>
                        </div>
                        <div class="poll-option cursor-pointer" onclick="vote('community2', 'healthy')">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-medium text-gray-900">Healthy & fresh options</span>
                                <span class="text-sm text-gray-600">28%</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="poll-bar h-2 rounded-full" style="width: 28%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 pt-4 border-t flex justify-between items-center">
                        <button class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                            Cast Vote
                        </button>
                        <div class="flex items-center space-x-4 text-sm text-gray-500">
                            <button class="hover:text-blue-600"><i class="fas fa-comment mr-1"></i> Discuss</button>
                            <button class="hover:text-blue-600"><i class="fas fa-users mr-1"></i> Event Planning</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Load More Button -->
        <div class="text-center mt-8">
            <button class="bg-gray-100 text-gray-700 px-6 py-3 rounded-lg font-medium hover:bg-gray-200 transition-colors">
                Load More Polls
            </button>
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

    <script>
        function showSection(sectionType) {
            // Hide all sections
            document.querySelectorAll('.poll-section').forEach(section => {
                section.classList.add('hidden');
            });

            // Remove active styles from all tabs
            document.querySelectorAll('.poll-tab').forEach(tab => {
                tab.classList.remove('border-blue-500', 'text-blue-600');
                tab.classList.add('border-transparent', 'text-gray-500');
            });

            // Show selected section
            const targetSection = sectionType + 'Section';
            document.getElementById(targetSection).classList.remove('hidden');

            // Add active styles to clicked tab
            const targetTab = sectionType + 'Tab';
            const tab = document.getElementById(targetTab);
            tab.classList.remove('border-transparent', 'text-gray-500');
            tab.classList.add('border-blue-500', 'text-blue-600');
        }

        function vote(pollId, option) {
            // Here you would normally send the vote to your backend
            console.log(`Voted for ${option} in poll ${pollId}`);

            // Show feedback
            alert(`Thank you for voting! Your choice: ${option}`);
        }

        // Initialize with active polls shown
        document.addEventListener('DOMContentLoaded', function() {
            showSection('active');
        });
    </script>

</body>
</html>
