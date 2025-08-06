<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alex Johnson - Profile | Factly</title>
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

                <!-- Navigation -->
                <div class="hidden md:flex space-x-8">
                    <a href="/presentation" class="text-gray-500 hover:text-gray-700 px-3 py-2 text-sm font-medium border-b-2 border-transparent hover:border-gray-300">
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
                    <a href="#" class="text-blue-600 border-b-2 border-blue-600 px-3 py-2 text-sm font-medium">
                        Profile
                    </a>
                </div>

                <!-- User Actions -->
                <div class="flex items-center space-x-3">
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

    <!-- Profile Header -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex items-center space-x-6">
                <!-- Profile Picture -->
                <div class="w-24 h-24 bg-blue-100 rounded-full flex items-center justify-center">
                    <span class="text-blue-600 text-3xl font-bold">AJ</span>
                </div>

                <!-- Profile Info -->
                <div class="flex-1">
                    <h1 class="text-3xl font-bold text-gray-900">Alex Johnson</h1>
                    <p class="text-lg text-gray-600 mt-1">Technology Enthusiast & Policy Analyst</p>
                    <p class="text-sm text-gray-500 mt-2">Joined March 2024 • San Francisco, CA</p>

                    <!-- Stats -->
                    <div class="flex items-center space-x-6 mt-4">
                        <div class="text-center">
                            <div class="text-xl font-bold text-gray-900">23</div>
                            <div class="text-xs text-gray-500">Discussions</div>
                        </div>
                        <div class="text-center">
                            <div class="text-xl font-bold text-gray-900">156</div>
                            <div class="text-xs text-gray-500">Arguments</div>
                        </div>
                        <div class="text-center">
                            <div class="text-xl font-bold text-gray-900">892</div>
                            <div class="text-xs text-gray-500">Likes Received</div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col space-y-2">
                    <button onclick="openEditProfileModal()" class="bg-blue-600 text-white px-6 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                        <i class="fas fa-edit mr-2"></i> Edit Profile
                    </button>
                </div>
            </div>

            <!-- Bio -->
            <div class="mt-6">
                <p class="text-gray-700 max-w-3xl">
                    Passionate about the intersection of technology and policy. I believe in evidence-based discussions and the power of collaborative thinking to solve complex problems. My background in computer science and public policy helps me bridge technical and social perspectives.
                </p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="max-w-6xl mx-auto mt-8 px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Left Column: My Posts -->
            <div class="lg:col-span-2 space-y-8">
                <!-- My Posts Section -->
                <div class="space-y-6">
                    <!-- Post 1 -->
                    <article class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 card-hover">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-purple-400 rounded-lg flex items-center justify-center">
                                <i class="fas fa-robot text-white text-lg"></i>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center space-x-2 mb-2">
                                    <span class="px-2 py-1 bg-purple-100 text-purple-600 rounded-full text-xs font-medium">Technology</span>
                                    <span class="px-2 py-1 bg-orange-100 text-orange-600 rounded-full text-xs font-medium">Society</span>
                                    <span class="text-xs text-gray-500">3 days ago</span>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2 hover:text-blue-600 cursor-pointer">
                                    Is AI a threat to human employment?
                                </h3>
                                <p class="text-gray-600 text-sm mb-4">
                                    As AI capabilities expand rapidly, concerns grow about widespread job displacement. While some argue AI will create new opportunities, others worry about the pace of change...
                                </p>
                                <div class="flex items-center justify-between text-sm text-gray-500">
                                    <div class="flex items-center space-x-4">
                                        <span class="flex items-center text-green-600">
                                            <i class="fas fa-thumbs-up mr-1"></i> 18
                                        </span>
                                        <span class="flex items-center text-blue-600">
                                            <i class="fas fa-comments mr-1"></i> 32
                                        </span>
                                        <span class="flex items-center text-purple-600">
                                            <i class="fas fa-link mr-1"></i> 5
                                        </span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <button class="text-gray-400 hover:text-blue-600">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-gray-400 hover:text-red-600">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>

                    <!-- Post 2 -->
                    <article class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 card-hover">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-green-400 rounded-lg flex items-center justify-center">
                                <i class="fas fa-shield-alt text-white text-lg"></i>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center space-x-2 mb-2">
                                    <span class="px-2 py-1 bg-blue-100 text-blue-600 rounded-full text-xs font-medium">Security</span>
                                    <span class="px-2 py-1 bg-red-100 text-red-600 rounded-full text-xs font-medium">Privacy</span>
                                    <span class="text-xs text-gray-500">1 week ago</span>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2 hover:text-blue-600 cursor-pointer">
                                    Should end-to-end encryption be regulated?
                                </h3>
                                <p class="text-gray-600 text-sm mb-4">
                                    Governments worldwide debate whether to mandate backdoors in encrypted communications for law enforcement access, raising questions about privacy vs security...
                                </p>
                                <div class="flex items-center justify-between text-sm text-gray-500">
                                    <div class="flex items-center space-x-4">
                                        <span class="flex items-center text-green-600">
                                            <i class="fas fa-thumbs-up mr-1"></i> 42
                                        </span>
                                        <span class="flex items-center text-blue-600">
                                            <i class="fas fa-comments mr-1"></i> 67
                                        </span>
                                        <span class="flex items-center text-purple-600">
                                            <i class="fas fa-link mr-1"></i> 12
                                        </span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <button class="text-gray-400 hover:text-blue-600">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-gray-400 hover:text-red-600">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>

                    <!-- Post 3 -->
                    <article class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 card-hover">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-blue-400 rounded-lg flex items-center justify-center">
                                <i class="fas fa-globe text-white text-lg"></i>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center space-x-2 mb-2">
                                    <span class="px-2 py-1 bg-purple-100 text-purple-600 rounded-full text-xs font-medium">Technology</span>
                                    <span class="px-2 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-medium">Society</span>
                                    <span class="text-xs text-gray-500">2 weeks ago</span>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2 hover:text-blue-600 cursor-pointer">
                                    Digital divide: Is internet access a human right?
                                </h3>
                                <p class="text-gray-600 text-sm mb-4">
                                    As digital services become essential for education, work, and healthcare, the question of universal internet access becomes increasingly important...
                                </p>
                                <div class="flex items-center justify-between text-sm text-gray-500">
                                    <div class="flex items-center space-x-4">
                                        <span class="flex items-center text-green-600">
                                            <i class="fas fa-thumbs-up mr-1"></i> 29
                                        </span>
                                        <span class="flex items-center text-blue-600">
                                            <i class="fas fa-comments mr-1"></i> 45
                                        </span>
                                        <span class="flex items-center text-purple-600">
                                            <i class="fas fa-link mr-1"></i> 8
                                        </span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <button class="text-gray-400 hover:text-blue-600">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="text-gray-400 hover:text-red-600">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                </div>

                <!-- Load More Button -->
                <div class="text-center">
                    <button class="bg-gray-100 text-gray-700 px-6 py-3 rounded-lg font-medium hover:bg-gray-200 transition-colors">
                        Load More Posts
                    </button>
                </div>
            </div>

            <!-- Right Column: Sidebar -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Messages/Notifications -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold text-gray-900">Notifications</h3>
                        <button class="text-blue-600 hover:text-blue-800 text-sm">Mark all read</button>
                    </div>
                    <div class="space-y-4">
                        <!-- Notification 1 -->
                        <div class="flex items-start space-x-3 p-3 bg-blue-50 rounded-lg border-l-4 border-blue-500">
                            <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                <i class="fas fa-thumbs-up text-white text-xs"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-800">
                                    <span class="font-medium">Dr. Sarah Chen</span> liked your argument in
                                    <span class="font-medium text-blue-600">"Is AI a threat to human employment?"</span>
                                </p>
                                <p class="text-xs text-gray-500 mt-1">2 hours ago</p>
                            </div>
                        </div>

                        <!-- Notification 2 -->
                        <div class="flex items-start space-x-3 p-3 bg-purple-50 rounded-lg border-l-4 border-purple-500">
                            <div class="w-8 h-8 bg-purple-500 rounded-full flex items-center justify-center">
                                <i class="fas fa-comment text-white text-xs"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-800">
                                    <span class="font-medium">Marcus Rodriguez</span> added a new argument to your discussion
                                    <span class="font-medium text-blue-600">"Should end-to-end encryption be regulated?"</span>
                                </p>
                                <p class="text-xs text-gray-500 mt-1">5 hours ago</p>
                            </div>
                        </div>

                        <!-- Notification 3 -->
                        <div class="flex items-start space-x-3 p-3 bg-red-50 rounded-lg border-l-4 border-red-500">
                            <div class="w-8 h-8 bg-red-500 rounded-full flex items-center justify-center">
                                <i class="fas fa-exclamation-triangle text-white text-xs"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-800">
                                    <span class="font-medium">Moderator</span> removed a reference from your post due to
                                    <span class="font-medium text-red-600">unreliable source</span>
                                </p>
                                <p class="text-xs text-gray-500 mt-1">1 day ago</p>
                            </div>
                        </div>

                        <!-- Notification 4 -->
                        <div class="flex items-start space-x-3 p-3 bg-yellow-50 rounded-lg border-l-4 border-yellow-500">
                            <div class="w-8 h-8 bg-yellow-500 rounded-full flex items-center justify-center">
                                <i class="fas fa-star text-white text-xs"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-800">
                                    Your discussion <span class="font-medium text-blue-600">"Digital divide: Is internet access a human right?"</span> was featured in
                                    <span class="font-medium">Technology category</span>
                                </p>
                                <p class="text-xs text-gray-500 mt-1">2 days ago</p>
                            </div>
                        </div>

                        <!-- Notification 5 -->
                        <div class="flex items-start space-x-3 p-3 bg-green-50 rounded-lg border-l-4 border-green-500">
                            <div class="w-8 h-8 bg-blue-500 rounded-full flex items-center justify-center">
                                <i class="fas fa-users text-white text-xs"></i>
                            </div>
                            <div class="flex-1">
                                <p class="text-sm text-gray-800">
                                    You were invited to join the group
                                    <span class="font-medium text-blue-600">"Tech Policy Experts"</span>
                                </p>
                                <p class="text-xs text-gray-500 mt-1">3 days ago</p>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                            View All Notifications
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Profile Sections - 3 Columns -->
        <div class="grid lg:grid-cols-3 gap-6 mt-12">
            <!-- My Groups -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold text-gray-900">My Groups</h3>
                    <a href="#" class="text-blue-600 hover:text-blue-800 text-sm">View All</a>
                </div>
                <div class="space-y-3">
                    <div class="flex items-center p-2 rounded-lg hover:bg-gray-50 transition-colors">
                        <div class="w-8 h-8 bg-blue-600 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-flask text-white text-xs"></i>
                        </div>
                        <div class="flex-1">
                            <div class="font-medium text-gray-900 text-sm">Climate Research</div>
                            <div class="text-xs text-gray-500">12 members</div>
                        </div>
                    </div>
                    <div class="flex items-center p-2 rounded-lg hover:bg-gray-50 transition-colors">
                        <div class="w-8 h-8 bg-purple-600 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-code text-white text-xs"></i>
                        </div>
                        <div class="flex-1">
                            <div class="font-medium text-gray-900 text-sm">AI Ethics</div>
                            <div class="text-xs text-gray-500">15 members</div>
                        </div>
                    </div>
                    <div class="flex items-center p-2 rounded-lg hover:bg-gray-50 transition-colors">
                        <div class="w-8 h-8 bg-green-600 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-leaf text-white text-xs"></i>
                        </div>
                        <div class="flex-1">
                            <div class="font-medium text-gray-900 text-sm">Sustainable Living</div>
                            <div class="text-xs text-gray-500">8 members</div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Following Categories -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Following Categories</h3>
                <div class="flex flex-wrap gap-2">
                    <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-full text-xs font-medium">Science</span>
                    <span class="px-3 py-1 bg-purple-100 text-purple-600 rounded-full text-xs font-medium">Technology</span>
                    <span class="px-3 py-1 bg-green-100 text-green-600 rounded-full text-xs font-medium">Environment</span>
                    <span class="px-3 py-1 bg-red-100 text-red-600 rounded-full text-xs font-medium">Politics</span>
                    <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-xs font-medium">Society</span>
                    <span class="px-3 py-1 bg-orange-100 text-orange-600 rounded-full text-xs font-medium">Health</span>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <button class="w-full text-blue-600 hover:text-blue-800 text-sm font-medium">
                        Browse More Categories
                    </button>
                </div>
            </div>

            <!-- Following People -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Following People</h3>
                <div class="space-y-3">
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                            <span class="text-blue-600 text-xs font-medium">SC</span>
                        </div>
                        <div class="flex-1">
                            <div class="font-medium text-gray-900 text-sm">Dr. Sarah Chen</div>
                            <div class="text-xs text-gray-500">Environmental Scientist</div>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center mr-3">
                            <span class="text-purple-600 text-xs font-medium">MR</span>
                        </div>
                        <div class="flex-1">
                            <div class="font-medium text-gray-900 text-sm">Marcus Rodriguez</div>
                            <div class="text-xs text-gray-500">Tech Policy Analyst</div>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3">
                            <span class="text-green-600 text-xs font-medium">JP</span>
                        </div>
                        <div class="flex-1">
                            <div class="font-medium text-gray-900 text-sm">Dr. James Park</div>
                            <div class="text-xs text-gray-500">Health Researcher</div>
                        </div>
                    </div>
                </div>
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <button class="w-full text-blue-600 hover:text-blue-800 text-sm font-medium">
                        Discover More Writers
                    </button>
                </div>
            </div>
        </div>
    </main>

    <!-- Edit Profile Modal -->
    <div id="editProfileModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
                <div class="flex justify-between items-center p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">Edit Profile</h3>
                    <button onclick="closeEditProfileModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times text-xl"></i>
                    </button>
                </div>

                <div class="p-6">
                    <form class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                            <input type="text" value="Alex Morgan" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
                            <textarea rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Tell others about yourself...">Passionate about the intersection of technology and policy. I believe in evidence-based discussions and the power of collaborative thinking to solve complex problems.</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Location</label>
                            <input type="text" value="San Francisco, CA" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Areas of Expertise</label>
                            <input type="text" value="Technology, Policy, AI Ethics" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Website</label>
                            <input type="url" value="https://alexmorgan.tech" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">LinkedIn</label>
                            <input type="url" value="https://linkedin.com/in/alexmorgan" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                    </form>
                </div>

                <div class="flex justify-end space-x-3 p-6 border-t border-gray-200">
                    <button onclick="closeEditProfileModal()" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                        Cancel
                    </button>
                    <button class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                        Save Changes
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for Modal -->
    <script>
        function openEditProfileModal() {
            document.getElementById('editProfileModal').classList.remove('hidden');
        }

        function closeEditProfileModal() {
            document.getElementById('editProfileModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('editProfileModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEditProfileModal();
            }
        });
    </script>

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
