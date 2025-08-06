<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Factly</title>
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
                    <a href="#" class="text-blue-600 border-b-2 border-blue-600 px-3 py-2 text-sm font-medium">
                        Admin
                    </a>
                </div>

                <!-- User Actions -->
                <div class="flex items-center space-x-3">
                    <div class="relative">
                        <button class="bg-red-100 text-red-600 px-3 py-2 rounded-lg text-sm font-medium hover:bg-red-200 transition-colors">
                            <i class="fas fa-bell mr-1"></i> Reports (7)
                        </button>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                            <span class="text-red-600 text-xs font-medium">AD</span>
                        </div>
                        <span class="text-sm text-gray-700 hidden sm:block">Admin User</span>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <!-- Admin Header Section -->
    <div class="gradient-bg">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="text-center text-white">
                <h1 class="text-4xl font-bold mb-4">Admin Dashboard</h1>
                <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                    Manage reports, moderate content, and oversee the Factly community platform.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <button onclick="openCategoryModal()" class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-blue-50 transition-colors">
                        <i class="fas fa-plus mr-2"></i> Add Category
                    </button>
                    <button onclick="openPollModal()" class="border-2 border-white text-white px-6 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition-all">
                        <i class="fas fa-poll mr-2"></i> Create Community Poll
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="max-w-6xl mx-auto mt-8 px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Left and Middle Columns: Reports -->
            <div class="lg:col-span-2">
                <div class="mb-8">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-900">Recent Reports</h2>
                    </div>

                    <div class="space-y-4">
                        <!-- Report 1 - Discussion Post -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 card-hover">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-flag text-red-600"></i>
                                    </div>
                                    <div>
                                        <span class="text-sm font-medium text-gray-900">Discussion Post Reported</span>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <button class="bg-red-100 text-red-600 px-3 py-1 rounded text-xs hover:bg-red-200">
                                        Check
                                    </button>
                                </div>
                            </div>
                            <div class="mb-3">
                                <p class="text-gray-700 text-sm mb-2">
                                    <strong>Reported Content:</strong> "Should nuclear energy be prioritized over renewable sources?"
                                </p>
                                <p class="text-gray-600 text-xs">
                                    <strong>Reporter:</strong> Dr. Emma Rodriguez • <strong>Reason:</strong> False or unverified information • <strong>Time:</strong> 2 hours ago
                                </p>
                            </div>
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <p class="text-xs text-gray-600">
                                    <strong>Report Details:</strong> "The discussion contains misleading statistics about nuclear safety without proper scientific backing."
                                </p>
                            </div>
                        </div>

                        <!-- Report 2 - Argument Post -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 card-hover">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-orange-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-flag text-orange-600"></i>
                                    </div>
                                    <div>
                                        <span class="text-sm font-medium text-gray-900">Argument Reported</span>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <button class="bg-red-100 text-red-600 px-3 py-1 rounded text-xs hover:bg-red-200">
                                        Check
                                    </button>
                                </div>
                            </div>
                            <div class="mb-3">
                                <p class="text-gray-700 text-sm mb-2">
                                    <strong>Reported Content:</strong> Argument by Dr. Michael Thomson about nuclear capacity factors
                                </p>
                                <p class="text-gray-600 text-xs">
                                    <strong>Reporter:</strong> Sarah Kim • <strong>Reason:</strong> Inappropriate content • <strong>Time:</strong> 5 hours ago
                                </p>
                            </div>
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <p class="text-xs text-gray-600">
                                    <strong>Report Details:</strong> "Argument contains biased language and fails to present balanced perspective."
                                </p>
                            </div>
                        </div>

                        <!-- Report 3 - Reference -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 card-hover">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-flag text-yellow-600"></i>
                                    </div>
                                    <div>
                                        <span class="text-sm font-medium text-gray-900">Reference Reported</span>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <button class="bg-red-100 text-red-600 px-3 py-1 rounded text-xs hover:bg-red-200">
                                        Check
                                    </button>
                                </div>
                            </div>
                            <div class="mb-3">
                                <p class="text-gray-700 text-sm mb-2">
                                    <strong>Reported Content:</strong> "Land Use Comparison - Nuclear vs Wind" reference
                                </p>
                                <p class="text-gray-600 text-xs">
                                    <strong>Reporter:</strong> Prof. James Walker • <strong>Reason:</strong> Copyright violation • <strong>Time:</strong> 1 day ago
                                </p>
                            </div>
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <p class="text-xs text-gray-600">
                                    <strong>Report Details:</strong> "This reference appears to use copyrighted material without proper attribution."
                                </p>
                            </div>
                        </div>

                        <!-- Report 4 - Spam -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 card-hover">
                            <div class="flex items-start justify-between mb-4">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                                        <i class="fas fa-flag text-red-600"></i>
                                    </div>
                                    <div>
                                        <span class="text-sm font-medium text-gray-900">Spam Content Reported</span>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2">
                                    <button class="bg-red-100 text-red-600 px-3 py-1 rounded text-xs hover:bg-red-200">
                                        Check
                                    </button>
                                </div>
                            </div>
                            <div class="mb-3">
                                <p class="text-gray-700 text-sm mb-2">
                                    <strong>Reported Content:</strong> Argument by Marcus Chen about renewable energy storage
                                </p>
                                <p class="text-gray-600 text-xs">
                                    <strong>Reporter:</strong> Multiple Users • <strong>Reason:</strong> Spam or misleading content • <strong>Time:</strong> 2 days ago
                                </p>
                            </div>
                            <div class="bg-gray-50 p-3 rounded-lg">
                                <p class="text-xs text-gray-600">
                                    <strong>Report Details:</strong> "Content appears to be promotional material disguised as scientific argument."
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Load More Button -->
                    <div class="text-center mt-8">
                        <button class="bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                            <i class="fas fa-plus mr-2"></i> Load More Reports
                        </button>
                    </div>
                </div>
            </div>

            <!-- Right Column: Admin Stats & Quick Actions -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Admin Statistics -->
                <div class="glass-effect rounded-xl p-6 border border-white shadow-lg">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Platform Statistics</h2>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Total Users</span>
                            <span class="font-semibold text-gray-900">1,247</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Active Discussions</span>
                            <span class="font-semibold text-gray-900">156</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Pending Reports</span>
                            <span class="font-semibold text-red-600">7</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Categories</span>
                            <span class="font-semibold text-gray-900">12</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Active Polls</span>
                            <span class="font-semibold text-gray-900">8</span>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="glass-effect rounded-xl p-6 border border-white shadow-lg">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Quick Actions</h2>
                    <div class="space-y-3">
                        <button onclick="openCategoryModal()" class="w-full bg-blue-100 text-blue-600 px-4 py-3 rounded-lg text-sm font-medium hover:bg-blue-200 transition-colors text-left">
                            <i class="fas fa-plus mr-2"></i> Add New Category
                        </button>
                        <button onclick="openPollModal()" class="w-full bg-purple-100 text-purple-600 px-4 py-3 rounded-lg text-sm font-medium hover:bg-purple-200 transition-colors text-left">
                            <i class="fas fa-poll mr-2"></i> Create Community Poll
                        </button>
                        <button class="w-full bg-green-100 text-green-600 px-4 py-3 rounded-lg text-sm font-medium hover:bg-green-200 transition-colors text-left">
                            <i class="fas fa-users mr-2"></i> Manage Users
                        </button>
                        <button class="w-full bg-red-100 text-red-600 px-4 py-3 rounded-lg text-sm font-medium hover:bg-red-200 transition-colors text-left">
                            <i class="fas fa-ban mr-2"></i> Moderate Content
                        </button>
                    </div>
                </div>

                <!-- Recent Activity -->
                <div class="glass-effect rounded-xl p-6 border border-white shadow-lg">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Recent Activity</h2>
                    <div class="space-y-3">
                        <div class="text-xs text-gray-600">
                            <span class="font-medium">2 hours ago:</span> New discussion created by Dr. Sarah Chen
                        </div>
                        <div class="text-xs text-gray-600">
                            <span class="font-medium">4 hours ago:</span> Report resolved for argument #1247
                        </div>
                        <div class="text-xs text-gray-600">
                            <span class="font-medium">6 hours ago:</span> New user registration: Marcus Rodriguez
                        </div>
                        <div class="text-xs text-gray-600">
                            <span class="font-medium">1 day ago:</span> Community poll ended: "AI Development Speed"
                        </div>
                        <div class="text-xs text-gray-600">
                            <span class="font-medium">2 days ago:</span> Category "Climate Science" updated
                        </div>
                    </div>
                </div>
            </div>
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
                    <span class="text-xl font-bold">Factly Admin</span>
                </div>
                <div class="text-sm text-gray-400 text-center md:text-right">
                    © 2025 Factly. Administrative Dashboard.
                </div>
            </div>
        </div>
    </footer>

    <!-- Add Category Modal -->
    <div id="categoryModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-xl shadow-xl max-w-md w-full">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-gray-900">Add New Category</h2>
                        <button onclick="closeCategoryModal()" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>

                    <form class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Category Name</label>
                            <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter category name">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                            <textarea rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Describe this category..."></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Icon</label>
                            <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                <option>fas fa-atom (Science)</option>
                                <option>fas fa-robot (Technology)</option>
                                <option>fas fa-heartbeat (Health)</option>
                                <option>fas fa-seedling (Environment)</option>
                                <option>fas fa-landmark (Politics)</option>
                                <option>fas fa-users (Society)</option>
                                <option>fas fa-book (Education)</option>
                                <option>fas fa-chart-line (Economics)</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Color</label>
                            <div class="flex space-x-2">
                                <button type="button" class="w-8 h-8 bg-blue-600 rounded-full"></button>
                                <button type="button" class="w-8 h-8 bg-purple-600 rounded-full"></button>
                                <button type="button" class="w-8 h-8 bg-green-600 rounded-full"></button>
                                <button type="button" class="w-8 h-8 bg-red-600 rounded-full"></button>
                                <button type="button" class="w-8 h-8 bg-orange-600 rounded-full"></button>
                                <button type="button" class="w-8 h-8 bg-yellow-600 rounded-full"></button>
                            </div>
                        </div>
                    </form>

                    <div class="flex justify-end space-x-3 mt-6 pt-4 border-t">
                        <button onclick="closeCategoryModal()" class="px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                            Cancel
                        </button>
                        <button onclick="addCategory()" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            Add Category
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Community Poll Modal -->
    <div id="pollModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-xl shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-gray-900">Create Community Poll</h2>
                        <button onclick="closePollModal()" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>

                    <form class="space-y-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Poll Question</label>
                            <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="What question would you like to ask the community?">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Description (Optional)</label>
                            <textarea rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="Provide context for your poll..."></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Poll Options</label>
                            <div class="space-y-3">
                                <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="Option 1">
                                <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="Option 2">
                                <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" placeholder="Option 3">
                                <button type="button" class="text-purple-600 hover:text-purple-800 text-sm font-medium">
                                    <i class="fas fa-plus mr-1"></i> Add Another Option
                                </button>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Poll Duration</label>
                            <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                                <option value="1">1 Day</option>
                                <option value="3">3 Days</option>
                                <option value="7" selected>1 Week</option>
                                <option value="14">2 Weeks</option>
                                <option value="30">1 Month</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                            <select class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500">
                                <option>Science</option>
                                <option>Technology</option>
                                <option>Health</option>
                                <option>Politics</option>
                                <option>Environment</option>
                                <option>Society</option>
                                <option>General</option>
                            </select>
                        </div>

                        <div>
                            <label class="flex items-center">
                                <input type="checkbox" class="mr-2">
                                <span class="text-sm text-gray-700">Featured Poll (appears prominently on homepage)</span>
                            </label>
                        </div>
                    </form>

                    <div class="flex justify-end space-x-3 mt-6 pt-4 border-t">
                        <button onclick="closePollModal()" class="px-6 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                            Cancel
                        </button>
                        <button onclick="createPoll()" class="px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">
                            Create Poll
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        function openCategoryModal() {
            document.getElementById('categoryModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeCategoryModal() {
            document.getElementById('categoryModal').classList.add('hidden');
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

        function addCategory() {
            alert('Category added successfully! This would normally integrate with your backend.');
            closeCategoryModal();
        }

        function createPoll() {
            alert('Community poll created successfully! This would normally integrate with your backend.');
            closePollModal();
        }

        // Close modals when clicking outside
        document.getElementById('categoryModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeCategoryModal();
            }
        });

        document.getElementById('pollModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closePollModal();
            }
        });

        // Color selection for category
        document.querySelectorAll('#categoryModal button[type="button"]').forEach(button => {
            if (button.classList.contains('rounded-full')) {
                button.addEventListener('click', function() {
                    // Remove selection from all color buttons
                    document.querySelectorAll('#categoryModal .rounded-full').forEach(btn => {
                        btn.classList.remove('ring-4', 'ring-gray-300');
                    });
                    // Add selection to clicked button
                    this.classList.add('ring-4', 'ring-gray-300');
                });
            }
        });
    </script>
</body>
</html>
