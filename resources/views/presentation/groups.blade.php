<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Groups - Factly</title>
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
                    <a href="/presentation/groups" class="text-blue-600 border-b-2 border-blue-600 px-3 py-2 text-sm font-medium">
                        Groups
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-700 px-3 py-2 text-sm font-medium border-b-2 border-transparent hover:border-gray-300">
                        Polls
                    </a>
                </div>

                <!-- User Actions -->
                <div class="flex items-center space-x-3">
                    <button onclick="openCreateGroupModal()" class="bg-green-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-green-700 transition-colors">
                        <i class="fas fa-plus mr-1"></i> Create Group
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

    <!-- Header Section -->
    <div class="gradient-bg">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="text-center text-white">
                <h1 class="text-4xl font-bold mb-4">Discussion Groups</h1>
                <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                    Join focused communities, share ideas, and engage in specialized discussions with like-minded members.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <button onclick="openCreateGroupModal()" class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-blue-50 transition-colors">
                        Create New Group
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="max-w-6xl mx-auto mt-8 px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-3 gap-6">
            <!-- Left and Middle Columns: Group Posts Feed -->
            <div class="lg:col-span-2">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Latest Group Posts</h2>
                </div>

                <div class="grid lg:grid-cols-2 gap-6 mb-8">
                    <!-- Group Post 1 -->
                    <article class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 card-hover">
                    <div class="flex items-start space-x-4">
                        <!-- Group Icon -->
                        <div class="w-12 h-12 bg-blue-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-flask text-white text-lg"></i>
                        </div>
                        <div class="flex-1">
                            <!-- Group Info -->
                            <div class="flex items-center space-x-2 mb-2">
                                <span class="font-semibold text-blue-600">Climate Research</span>
                                <span class="text-gray-400">•</span>
                                <span class="text-sm text-gray-500">12 members</span>
                                <span class="text-gray-400">•</span>
                                <span class="text-sm text-gray-500">3 hours ago</span>
                            </div>

                            <!-- Post Content -->
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                New IPCC report on carbon capture technologies
                            </h3>
                            <p class="text-gray-600 mb-4">
                                The latest IPCC report reveals promising developments in direct air capture and storage technologies. What are your thoughts on the feasibility of large-scale implementation?
                            </p>

                            <!-- Author and Stats -->
                            <div class="flex items-center justify-between text-sm text-gray-500">
                                <div class="flex items-center space-x-4">
                                    <span class="flex items-center">
                                        <i class="fas fa-user mr-1"></i> Dr. Sarah Chen
                                    </span>
                                    <span class="flex items-center text-green-600">
                                        <i class="fas fa-thumbs-up mr-1"></i> 15
                                    </span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <span class="flex items-center text-blue-600">
                                        <i class="fas fa-comments mr-1"></i> 8
                                    </span>
                                    <span class="flex items-center text-purple-600">
                                        <i class="fas fa-share mr-1"></i> 3
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Group Post 2 -->
                <article class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 card-hover">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-purple-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-code text-white text-lg"></i>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center space-x-2 mb-2">
                                <span class="font-semibold text-purple-600">AI Ethics</span>
                                <span class="text-gray-400">•</span>
                                <span class="text-sm text-gray-500">15 members</span>
                                <span class="text-gray-400">•</span>
                                <span class="text-sm text-gray-500">5 hours ago</span>
                            </div>

                            <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                EU's AI Act: Impact on innovation vs. safety
                            </h3>
                            <p class="text-gray-600 mb-4">
                                The European Union's Artificial Intelligence Act came into effect this year. How do you think it will balance innovation with safety concerns? Share your perspectives.
                            </p>

                            <div class="flex items-center justify-between text-sm text-gray-500">
                                <div class="flex items-center space-x-4">
                                    <span class="flex items-center">
                                        <i class="fas fa-user mr-1"></i> Marcus Rodriguez
                                    </span>
                                    <span class="flex items-center text-green-600">
                                        <i class="fas fa-thumbs-up mr-1"></i> 22
                                    </span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <span class="flex items-center text-blue-600">
                                        <i class="fas fa-comments mr-1"></i> 12
                                    </span>
                                    <span class="flex items-center text-purple-600">
                                        <i class="fas fa-share mr-1"></i> 5
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Group Post 3 -->
                <article class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 card-hover">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-green-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-leaf text-white text-lg"></i>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center space-x-2 mb-2">
                                <span class="font-semibold text-green-600">Sustainable Living</span>
                                <span class="text-gray-400">•</span>
                                <span class="text-sm text-gray-500">8 members</span>
                                <span class="text-gray-400">•</span>
                                <span class="text-sm text-gray-500">1 day ago</span>
                            </div>

                            <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                Zero-waste challenges: Week 3 results and tips
                            </h3>
                            <p class="text-gray-600 mb-4">
                                Our community zero-waste challenge is showing amazing results! Here are some practical tips that have worked for our members this week.
                            </p>

                            <div class="flex items-center justify-between text-sm text-gray-500">
                                <div class="flex items-center space-x-4">
                                    <span class="flex items-center">
                                        <i class="fas fa-user mr-1"></i> Dr. Lisa Thompson
                                    </span>
                                    <span class="flex items-center text-green-600">
                                        <i class="fas fa-thumbs-up mr-1"></i> 18
                                    </span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <span class="flex items-center text-blue-600">
                                        <i class="fas fa-comments mr-1"></i> 6
                                    </span>
                                    <span class="flex items-center text-purple-600">
                                        <i class="fas fa-share mr-1"></i> 4
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Group Post 4 -->
                <article class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 card-hover">
                    <div class="flex items-start space-x-4">
                        <div class="w-12 h-12 bg-orange-600 rounded-lg flex items-center justify-center">
                            <i class="fas fa-microscope text-white text-lg"></i>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center space-x-2 mb-2">
                                <span class="font-semibold text-orange-600">Medical Research</span>
                                <span class="text-gray-400">•</span>
                                <span class="text-sm text-gray-500">24 members</span>
                                <span class="text-gray-400">•</span>
                                <span class="text-sm text-gray-500">2 days ago</span>
                            </div>

                            <h3 class="text-lg font-semibold text-gray-900 mb-2">
                                Breakthrough in gene therapy for rare diseases
                            </h3>
                            <p class="text-gray-600 mb-4">
                                Recent clinical trials show promising results for CRISPR-based treatments. What are the ethical implications we should consider?
                            </p>

                            <div class="flex items-center justify-between text-sm text-gray-500">
                                <div class="flex items-center space-x-4">
                                    <span class="flex items-center">
                                        <i class="fas fa-user mr-1"></i> Dr. James Park
                                    </span>
                                    <span class="flex items-center text-green-600">
                                        <i class="fas fa-thumbs-up mr-1"></i> 31
                                    </span>
                                </div>
                                <div class="flex items-center space-x-3">
                                    <span class="flex items-center text-blue-600">
                                        <i class="fas fa-comments mr-1"></i> 14
                                    </span>
                                    <span class="flex items-center text-purple-600">
                                        <i class="fas fa-share mr-1"></i> 7
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>

            <!-- Load More Button -->
            <div class="text-center mt-8">
                <button class="bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                    <i class="fas fa-plus mr-2"></i> Load More Posts
                </button>
            </div>
        </div>

        <!-- Right Column: Join Group Section -->
        <div class="lg:col-span-1">
            <div class="glass-effect rounded-xl p-6 border border-white shadow-lg">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Join a Group</h2>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Group Code</label>
                        <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-center font-mono" placeholder="XXXX-XXXX-XXXX">
                    </div>
                    <button class="w-full bg-blue-600 text-white px-4 py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                        Join Group
                    </button>
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                        <div class="flex items-start">
                            <i class="fas fa-info-circle text-blue-500 mt-0.5 mr-2"></i>
                            <div class="text-sm text-blue-800">
                                <p class="font-medium mb-1">How to get a group code:</p>
                                <ul class="text-xs space-y-1">
                                    <li>• Ask a group member to share their invitation code</li>
                                    <li>• Group admins can generate codes from group settings</li>
                                    <li>• Some groups may have public codes posted</li>
                                </ul>
                            </div>
                        </div>
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
                    <span class="text-xl font-bold">Factly</span>
                </div>
                <div class="text-sm text-gray-400 text-center md:text-right">
                    © 2025 Factly. Building the future of evidence-based discourse.
                </div>
            </div>
        </div>
    </footer>

    <!-- Create Group Modal -->
    <div id="createGroupModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-xl shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-gray-900">Create New Group</h2>
                        <button onclick="closeCreateGroupModal()" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>

                    <form class="space-y-6">
                        <!-- Group Name -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Group Name</label>
                            <input type="text" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter group name">
                        </div>

                        <!-- Description -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                            <textarea rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Describe your group's purpose and goals..."></textarea>
                        </div>

                        <!-- Group Code -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Group Code</label>
                            <div class="flex space-x-2">
                                <input type="text" id="groupCode" readonly class="flex-1 px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 font-mono text-center" value="CLMT-2025-RSCH">
                                <button type="button" onclick="generateGroupCode()" class="bg-gray-100 text-gray-700 px-4 py-3 rounded-lg hover:bg-gray-200 transition-colors">
                                    <i class="fas fa-refresh"></i>
                                </button>
                                <button type="button" onclick="copyGroupCode()" class="bg-blue-100 text-blue-600 px-4 py-3 rounded-lg hover:bg-blue-200 transition-colors">
                                    <i class="fas fa-copy"></i>
                                </button>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Members can use this code to join your group</p>
                        </div>

                        <!-- Invite Users -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Invite Users (Optional)</label>
                            <div class="space-y-3">
                                <!-- Search Users -->
                                <div class="relative">
                                    <input type="text" id="userSearch" placeholder="Search users to invite..." class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                                </div>

                                <!-- Search Results -->
                                <div id="searchResults" class="hidden space-y-2 max-h-40 overflow-y-auto border border-gray-200 rounded-lg p-2">
                                    <!-- Sample search results -->
                                    <div class="flex items-center justify-between p-2 hover:bg-gray-50 rounded cursor-pointer" onclick="addUser('Dr. Sarah Chen', 'SC')">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                                <span class="text-blue-600 text-xs font-medium">SC</span>
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium">Dr. Sarah Chen</div>
                                                <div class="text-xs text-gray-500">Environmental Scientist</div>
                                            </div>
                                        </div>
                                        <button class="text-blue-600 text-xs">Add</button>
                                    </div>
                                    <div class="flex items-center justify-between p-2 hover:bg-gray-50 rounded cursor-pointer" onclick="addUser('Marcus Rodriguez', 'MR')">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                                                <span class="text-purple-600 text-xs font-medium">MR</span>
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium">Marcus Rodriguez</div>
                                                <div class="text-xs text-gray-500">Tech Policy Analyst</div>
                                            </div>
                                        </div>
                                        <button class="text-blue-600 text-xs">Add</button>
                                    </div>
                                    <div class="flex items-center justify-between p-2 hover:bg-gray-50 rounded cursor-pointer" onclick="addUser('Dr. James Park', 'JP')">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                                <span class="text-green-600 text-xs font-medium">JP</span>
                                            </div>
                                            <div>
                                                <div class="text-sm font-medium">Dr. James Park</div>
                                                <div class="text-xs text-gray-500">Health Researcher</div>
                                            </div>
                                        </div>
                                        <button class="text-blue-600 text-xs">Add</button>
                                    </div>
                                </div>

                                <!-- Selected Users -->
                                <div id="selectedUsers" class="space-y-2">
                                    <!-- Selected users will appear here -->
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="flex justify-end space-x-3 mt-6 pt-4 border-t">
                        <button onclick="closeCreateGroupModal()" class="px-6 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                            Cancel
                        </button>
                        <button class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                            Create Group
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        function openCreateGroupModal() {
            document.getElementById('createGroupModal').classList.remove('hidden');
        }

        function closeCreateGroupModal() {
            document.getElementById('createGroupModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('createGroupModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeCreateGroupModal();
            }
        });

        // Generate random group code
        function generateGroupCode() {
            const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            const segments = [];
            for (let i = 0; i < 3; i++) {
                let segment = '';
                for (let j = 0; j < 4; j++) {
                    segment += characters.charAt(Math.floor(Math.random() * characters.length));
                }
                segments.push(segment);
            }
            document.getElementById('groupCode').value = segments.join('-');
        }

        // Copy group code to clipboard
        function copyGroupCode() {
            const codeInput = document.getElementById('groupCode');
            codeInput.select();
            document.execCommand('copy');

            // Show feedback
            const button = event.target.closest('button');
            const originalText = button.innerHTML;
            button.innerHTML = '<i class="fas fa-check"></i>';
            button.classList.remove('text-blue-600', 'bg-blue-100');
            button.classList.add('text-green-600', 'bg-green-100');

            setTimeout(() => {
                button.innerHTML = originalText;
                button.classList.remove('text-green-600', 'bg-green-100');
                button.classList.add('text-blue-600', 'bg-blue-100');
            }, 2000);
        }

        // Search functionality
        document.getElementById('userSearch').addEventListener('input', function(e) {
            const searchResults = document.getElementById('searchResults');
            if (e.target.value.length > 0) {
                searchResults.classList.remove('hidden');
            } else {
                searchResults.classList.add('hidden');
            }
        });

        // Add user to selected list
        function addUser(name, initials) {
            const selectedUsers = document.getElementById('selectedUsers');

            // Check if user is already added
            if (selectedUsers.querySelector(`[data-user="${name}"]`)) {
                return;
            }

            const userDiv = document.createElement('div');
            userDiv.className = 'flex items-center justify-between p-2 bg-blue-50 rounded-lg';
            userDiv.setAttribute('data-user', name);
            userDiv.innerHTML = `
                <div class="flex items-center space-x-3">
                    <div class="w-6 h-6 bg-blue-100 rounded-full flex items-center justify-center">
                        <span class="text-blue-600 text-xs font-medium">${initials}</span>
                    </div>
                    <span class="text-sm font-medium">${name}</span>
                </div>
                <button onclick="removeUser('${name}')" class="text-red-600 text-xs hover:text-red-800">
                    <i class="fas fa-times"></i>
                </button>
            `;
            selectedUsers.appendChild(userDiv);

            // Clear search
            document.getElementById('userSearch').value = '';
            document.getElementById('searchResults').classList.add('hidden');
        }

        // Remove user from selected list
        function removeUser(name) {
            const userElement = document.querySelector(`[data-user="${name}"]`);
            if (userElement) {
                userElement.remove();
            }
        }
    </script>
</body>
</html>
