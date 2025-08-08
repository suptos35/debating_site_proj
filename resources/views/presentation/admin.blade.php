<x-main_layout :categories="$categories">

    <!-- Admin Header Section -->
    <div class="gradient-bg">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="text-center text-white">
                <h1 class="text-4xl font-bold mb-4">Admin Dashboard</h1>
                <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">
                    Manage reports, moderate content, and oversee the Factly community platform.
                </p>

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
                        @forelse($recentReports as $report)
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 card-hover">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                                            <i class="fas fa-flag text-red-600"></i>
                                        </div>
                                        <div>
                                            <span class="text-sm font-medium text-gray-900">
                                                {{ Str::contains($report['reportable_type'], 'Post') ? 'Post' : 'Reference' }} Reported
                                                <span class="ml-2 px-2 py-1 bg-red-100 text-red-600 text-xs rounded-full">
                                                    {{ $report['report_count'] }} {{ $report['report_count'] > 1 ? 'reports' : 'report' }}
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <button onclick="viewReportDetails('{{ Str::contains($report['reportable_type'], 'Post') ? 'post' : 'reference' }}', {{ $report['reportable_id'] }})" class="bg-blue-100 text-blue-600 px-3 py-1 rounded text-xs hover:bg-blue-200">
                                            Review
                                        </button>
                                        <button onclick="resolveReport('{{ Str::contains($report['reportable_type'], 'Post') ? 'post' : 'reference' }}', {{ $report['reportable_id'] }}, 'resolve')" class="bg-green-100 text-green-600 px-3 py-1 rounded text-xs hover:bg-green-200">
                                            Resolve
                                        </button>
                                        <button onclick="resolveReport('{{ Str::contains($report['reportable_type'], 'Post') ? 'post' : 'reference' }}', {{ $report['reportable_id'] }}, 'delete_content')" class="bg-red-100 text-red-600 px-3 py-1 rounded text-xs hover:bg-red-200">
                                            Delete
                                        </button>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <p class="text-gray-700 text-sm mb-2">
                                        <strong>Reported Content:</strong>
                                        @if(Str::contains($report['reportable_type'], 'Post'))
                                            <a href="{{ url('/post/' . $report['reportable_id']) }}" target="_blank" class="text-blue-600 hover:text-blue-800 underline">
                                                "{{ Str::limit($report['reportable']->content, 60) }}"
                                            </a>
                                        @else
                                            <a href="{{ $report['reportable']->url ?? '#' }}" target="_blank" class="text-blue-600 hover:text-blue-800 underline">
                                                "{{ Str::limit($report['reportable']->description ?? $report['reportable']->url ?? 'Reference', 60) }}"
                                            </a>
                                        @endif
                                    </p>
                                    <p class="text-gray-600 text-xs">
                                        <strong>First Reporter:</strong> {{ $report['first_reporter']->name }} •
                                        <strong>Reasons:</strong>
                                        @foreach($report['reason_summary'] as $reason)
                                            {{ $reason->reason }}({{ $reason->count }}){{ !$loop->last ? ', ' : '' }}
                                        @endforeach
                                         •
                                        <strong>Time:</strong> {{ \Carbon\Carbon::parse($report['first_reported_at'])->diffForHumans() }}
                                    </p>
                                </div>
                                <div class="bg-gray-50 p-3 rounded-lg">
                                    <p class="text-xs text-gray-600">
                                        <strong>Content Type:</strong>
                                        @if(Str::contains($report['reportable_type'], 'Post'))
                                            @if($report['reportable']->parent_id)
                                                Argument in discussion:
                                                <a href="{{ url('/post/' . $report['reportable']->parent_id) }}" target="_blank" class="text-blue-600 hover:text-blue-800 underline">
                                                    "{{ Str::limit($report['reportable']->parent->title ?? 'Unknown Discussion', 40) }}"
                                                </a>
                                            @else
                                                Main Discussion Post
                                            @endif
                                        @else
                                            Reference
                                            @if($report['reportable']->post)
                                                in post:
                                                <a href="{{ url('/post/' . $report['reportable']->post->id) }}" target="_blank" class="text-blue-600 hover:text-blue-800 underline">
                                                    "{{ Str::limit($report['reportable']->post->title ?? $report['reportable']->post->content, 40) }}"
                                                </a>
                                            @endif
                                        @endif
                                    </p>
                                </div>
                            </div>
                        @empty
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8 text-center">
                                <i class="fas fa-check-circle text-green-500 text-3xl mb-4"></i>
                                <p class="text-gray-600">No pending reports. Great job keeping the platform clean!</p>
                            </div>
                        @endforelse
                    </div>

                    <!-- Load More Button -->
                    @if($hasMoreReports)
                    <div class="text-center mt-8" id="loadMoreContainer">
                        <button onclick="loadMoreReports()" id="loadMoreBtn" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                            <i class="fas fa-plus mr-2"></i> Load More Reports
                        </button>
                        <div id="loadMoreSpinner" class="hidden text-center py-4">
                            <i class="fas fa-spinner fa-spin text-blue-600"></i>
                            <span class="ml-2 text-gray-600">Loading reports...</span>
                        </div>
                    </div>
                    @endif
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
                            <span class="font-semibold text-gray-900">{{ number_format($totalUsers) }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Active Discussions</span>
                            <span class="font-semibold text-gray-900">{{ number_format($activeDiscussions) }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Pending Reports</span>
                            <span class="font-semibold text-red-600">{{ number_format($pendingReports) }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Categories</span>
                            <span class="font-semibold text-gray-900">{{ number_format($totalCategories) }}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Active Polls</span>
                            <span class="font-semibold text-gray-900">{{ number_format($activePolls) }}</span>
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

                        <button onclick="openUserModal()" class="w-full bg-green-100 text-green-600 px-4 py-3 rounded-lg text-sm font-medium hover:bg-green-200 transition-colors text-left">
                            <i class="fas fa-users mr-2"></i> Manage Users
                        </button>
                        <button onclick="openContentModal()" class="w-full bg-red-100 text-red-600 px-4 py-3 rounded-lg text-sm font-medium hover:bg-red-200 transition-colors text-left">
                            <i class="fas fa-ban mr-2"></i> Moderate Content
                        </button>
                    </div>
                </div>


            </div>
        </div>
    </main>

    <!-- Footer -->
    </x-main_layout>

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

                    <form id="categoryForm" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Category Name</label>
                            <input type="text" id="categoryName" name="name" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Enter category name" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                            <textarea id="categoryDescription" name="description" rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Describe this category..."></textarea>
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



    <!-- Manage Users Modal -->
    <div id="userModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-xl shadow-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-gray-900">Manage Users</h2>
                        <button onclick="closeUserModal()" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>

                    <!-- Search Bar -->
                    <div class="mb-6">
                        <div class="relative">
                            <input type="text" id="userSearch" class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Search users by name, email, or username...">
                            <i class="fas fa-search absolute left-3 top-4 text-gray-400"></i>
                        </div>
                        <button onclick="searchUsers()" class="mt-2 bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition-colors">
                            <i class="fas fa-search mr-2"></i> Search Users
                        </button>
                    </div>

                    <!-- Loading Spinner -->
                    <div id="userLoadingSpinner" class="hidden text-center py-8">
                        <i class="fas fa-spinner fa-spin text-2xl text-gray-400"></i>
                        <p class="text-gray-500 mt-2">Searching users...</p>
                    </div>

                    <!-- Users Results -->
                    <div id="userResults" class="space-y-4">
                        <p class="text-gray-500 text-center py-8">Use the search bar above to find users</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Moderate Content Modal -->
    <div id="contentModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-xl shadow-xl max-w-4xl w-full max-h-[90vh] overflow-y-auto">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-bold text-gray-900">Moderate Content</h2>
                        <button onclick="closeContentModal()" class="text-gray-400 hover:text-gray-600">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>

                    <!-- Search Bar -->
                    <div class="mb-6">
                        <div class="relative">
                            <input type="text" id="contentSearch" class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Search posts by title or content...">
                            <i class="fas fa-search absolute left-3 top-4 text-gray-400"></i>
                        </div>
                        <button onclick="searchContent()" class="mt-2 bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors">
                            <i class="fas fa-search mr-2"></i> Search Content
                        </button>
                    </div>

                    <!-- Loading Spinner -->
                    <div id="contentLoadingSpinner" class="hidden text-center py-8">
                        <i class="fas fa-spinner fa-spin text-2xl text-gray-400"></i>
                        <p class="text-gray-500 mt-2">Searching content...</p>
                    </div>

                    <!-- Content Results -->
                    <div id="contentResults" class="space-y-4">
                        <p class="text-gray-500 text-center py-8">Use the search bar above to find content</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        function loadMoreReports() {
            const btn = document.getElementById('loadMoreBtn');
            const spinner = document.getElementById('loadMoreSpinner');
            const reportsContainer = document.querySelector('.space-y-4');

            // Show spinner, hide button
            btn.classList.add('hidden');
            spinner.classList.remove('hidden');

            // Get CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('/presentation/admin/reports/load-more', {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success && data.reports.length > 0) {
                    // Clear existing reports first
                    reportsContainer.innerHTML = '';

                    // Generate HTML for ALL reports
                    data.reports.forEach(report => {
                        const reportType = report.reportable_type.includes('Post') ? 'Post' : 'Reference';
                        const reportTypeClass = report.reportable_type.includes('Post') ? 'post' : 'reference';

                        let contentLink = '#';
                        let contentText = 'Content';

                        if (reportType === 'Post') {
                            contentLink = `/post/${report.reportable_id}`;
                            // Always show content for posts (both discussions and arguments)
                            contentText = report.reportable.content;
                        } else {
                            contentLink = report.reportable.url || '#';
                            contentText = report.reportable.description || report.reportable.url || 'Reference';
                        }

                        const reasonsText = report.reason_summary.map(r => `${r.reason}(${r.count})`).join(', ');
                        const timeAgo = new Date(report.first_reported_at).toLocaleString();

                        const reportHTML = `
                            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 card-hover">
                                <div class="flex items-start justify-between mb-4">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 bg-red-100 rounded-full flex items-center justify-center">
                                            <i class="fas fa-flag text-red-600"></i>
                                        </div>
                                        <div>
                                            <span class="text-sm font-medium text-gray-900">
                                                ${reportType} Reported
                                                <span class="ml-2 px-2 py-1 bg-red-100 text-red-600 text-xs rounded-full">
                                                    ${report.report_count} ${report.report_count > 1 ? 'reports' : 'report'}
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <button onclick="viewReportDetails('${reportTypeClass}', ${report.reportable_id})" class="bg-blue-100 text-blue-600 px-3 py-1 rounded text-xs hover:bg-blue-200">
                                            Review
                                        </button>
                                        <button onclick="resolveReport('${reportTypeClass}', ${report.reportable_id}, 'resolve')" class="bg-green-100 text-green-600 px-3 py-1 rounded text-xs hover:bg-green-200">
                                            Resolve
                                        </button>
                                        <button onclick="resolveReport('${reportTypeClass}', ${report.reportable_id}, 'delete_content')" class="bg-red-100 text-red-600 px-3 py-1 rounded text-xs hover:bg-red-200">
                                            Delete
                                        </button>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <p class="text-gray-700 text-sm mb-2">
                                        <strong>Reported Content:</strong>
                                        <a href="${contentLink}" target="_blank" class="text-blue-600 hover:text-blue-800 underline">
                                            "${contentText.substring(0, 60)}${contentText.length > 60 ? '...' : ''}"
                                        </a>
                                    </p>
                                    <p class="text-gray-600 text-xs">
                                        <strong>First Reporter:</strong> ${report.first_reporter.name} •
                                        <strong>Reasons:</strong> ${reasonsText} •
                                        <strong>Time:</strong> ${timeAgo}
                                    </p>
                                </div>
                                <div class="bg-gray-50 p-3 rounded-lg">
                                    <p class="text-xs text-gray-600">
                                        <strong>Content Type:</strong> ${reportType === 'Post' ? 'Post' : 'Reference'}
                                    </p>
                                </div>
                            </div>
                        `;

                        reportsContainer.insertAdjacentHTML('beforeend', reportHTML);
                    });

                    // Hide the load more container completely since all reports are now loaded
                    document.getElementById('loadMoreContainer').style.display = 'none';
                } else {
                    // No reports found
                    reportsContainer.innerHTML = '<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8 text-center"><i class="fas fa-check-circle text-green-500 text-3xl mb-4"></i><p class="text-gray-600">No pending reports. Great job keeping the platform clean!</p></div>';
                    document.getElementById('loadMoreContainer').style.display = 'none';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error loading reports. Please try again.');
                // Show button again, hide spinner
                btn.classList.remove('hidden');
                spinner.classList.add('hidden');
            });
        }

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

        function openUserModal() {
            document.getElementById('userModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeUserModal() {
            document.getElementById('userModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function openContentModal() {
            document.getElementById('contentModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeContentModal() {
            document.getElementById('contentModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        function addCategory() {
            const form = document.getElementById('categoryForm');
            const formData = new FormData(form);

            // Get CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('/presentation/admin/categories', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Category created successfully!');
                    // Reset form
                    form.reset();
                    // Close modal
                    closeCategoryModal();
                    // Optionally refresh the page to show updated category count
                    location.reload();
                } else {
                    alert('Error creating category: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error creating category. Please try again.');
            });
        }

        function createPoll() {
            alert('Community poll created successfully! This would normally integrate with your backend.');
            closePollModal();
        }

        function searchUsers() {
            const searchTerm = document.getElementById('userSearch').value.trim();
            const resultsContainer = document.getElementById('userResults');
            const loadingSpinner = document.getElementById('userLoadingSpinner');

            if (!searchTerm) {
                alert('Please enter a search term');
                return;
            }

            // Show loading spinner
            loadingSpinner.classList.remove('hidden');
            resultsContainer.innerHTML = '';

            // Get CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('/presentation/admin/users/search?search=' + encodeURIComponent(searchTerm), {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                loadingSpinner.classList.add('hidden');

                if (data.success && data.users.length > 0) {
                    resultsContainer.innerHTML = data.users.map(user => `
                        <div class="bg-white border border-gray-200 rounded-lg p-4">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <div class="flex items-center space-x-3 mb-2">
                                        <h3 class="font-semibold text-gray-900">${user.name}</h3>
                                        <span class="px-2 py-1 text-xs rounded-full ${user.role === 'admin' ? 'bg-purple-100 text-purple-600' : 'bg-gray-100 text-gray-600'}">${user.role}</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-1"><i class="fas fa-envelope mr-1"></i> ${user.email}</p>
                                    ${user.username ? `<p class="text-sm text-gray-600 mb-1"><i class="fas fa-user mr-1"></i> @${user.username}</p>` : ''}
                                    <p class="text-sm text-gray-500"><i class="fas fa-calendar mr-1"></i> Joined ${user.created_at}</p>
                                    <p class="text-sm text-gray-500"><i class="fas fa-comment mr-1"></i> ${user.posts_count} posts</p>
                                </div>
                                <div class="flex space-x-2">
                                    <button onclick="deleteUser(${user.id}, '${user.name}')" class="bg-red-100 text-red-600 px-3 py-1 rounded text-xs hover:bg-red-200 transition-colors">
                                        <i class="fas fa-trash mr-1"></i> Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    `).join('');
                } else {
                    resultsContainer.innerHTML = '<p class="text-gray-500 text-center py-8">No users found matching your search.</p>';
                }
            })
            .catch(error => {
                loadingSpinner.classList.add('hidden');
                console.error('Error:', error);
                resultsContainer.innerHTML = '<p class="text-red-500 text-center py-8">Error searching users. Please try again.</p>';
            });
        }

        function searchContent() {
            const searchTerm = document.getElementById('contentSearch').value.trim();
            const resultsContainer = document.getElementById('contentResults');
            const loadingSpinner = document.getElementById('contentLoadingSpinner');

            if (!searchTerm) {
                alert('Please enter a search term');
                return;
            }

            // Show loading spinner
            loadingSpinner.classList.remove('hidden');
            resultsContainer.innerHTML = '';

            // Get CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('/presentation/admin/posts/search?search=' + encodeURIComponent(searchTerm), {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                loadingSpinner.classList.add('hidden');

                if (data.success && data.posts.length > 0) {
                    resultsContainer.innerHTML = data.posts.map(post => `
                        <div class="bg-white border border-gray-200 rounded-lg p-4">
                            <div class="flex justify-between items-start">
                                <div class="flex-1">
                                    <div class="flex items-center space-x-3 mb-2">
                                        <h3 class="font-semibold text-gray-900">${post.title}</h3>
                                        <span class="px-2 py-1 text-xs rounded-full ${post.type === 'Discussion' ? 'bg-blue-100 text-blue-600' : 'bg-green-100 text-green-600'}">${post.type}</span>
                                    </div>
                                    <p class="text-sm text-gray-600 mb-2">${post.content}</p>
                                    <div class="flex items-center space-x-4 text-xs text-gray-500 mb-2">
                                        <span><i class="fas fa-user mr-1"></i> ${post.user.name} (${post.user.email})</span>
                                        <span><i class="fas fa-calendar mr-1"></i> ${post.created_at}</span>
                                    </div>
                                    <div class="flex items-center space-x-4 text-xs text-gray-500">
                                        <span><i class="fas fa-heart mr-1"></i> ${post.likes_count} likes</span>
                                        <span><i class="fas fa-comment mr-1"></i> ${post.comments_count} comments</span>
                                        ${post.categories.length > 0 ? `<span><i class="fas fa-tag mr-1"></i> ${post.categories.join(', ')}</span>` : ''}
                                    </div>
                                </div>
                                <div class="flex space-x-2">
                                    <button onclick="deletePost(${post.id}, '${post.title.replace(/'/g, '\\\'')}')" class="bg-red-100 text-red-600 px-3 py-1 rounded text-xs hover:bg-red-200 transition-colors">
                                        <i class="fas fa-trash mr-1"></i> Delete
                                    </button>
                                </div>
                            </div>
                        </div>
                    `).join('');
                } else {
                    resultsContainer.innerHTML = '<p class="text-gray-500 text-center py-8">No content found matching your search.</p>';
                }
            })
            .catch(error => {
                loadingSpinner.classList.add('hidden');
                console.error('Error:', error);
                resultsContainer.innerHTML = '<p class="text-red-500 text-center py-8">Error searching content. Please try again.</p>';
            });
        }

        function deleteUser(userId, userName) {
            if (!confirm(`Are you sure you want to delete user "${userName}"? This action cannot be undone and will also delete all their posts and related content.`)) {
                return;
            }

            // Get CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('/presentation/admin/users/' + userId, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('User deleted successfully!');
                    // Refresh the search results
                    searchUsers();
                } else {
                    alert('Error deleting user: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error deleting user. Please try again.');
            });
        }

        function deletePost(postId, postTitle) {
            if (!confirm(`Are you sure you want to delete the post "${postTitle}"? This action cannot be undone and will also delete all related comments and interactions.`)) {
                return;
            }

            // Get CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('/presentation/admin/posts/' + postId, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert('Post deleted successfully!');
                    // Refresh the search results
                    searchContent();
                } else {
                    alert('Error deleting post: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error deleting post. Please try again.');
            });
        }

        function viewReportDetails(type, id) {
            // Get CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch(`/admin/report/details?type=${type}&id=${id}`, {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const content = data.contentDetails;
                    const summary = data.reportSummary;
                    const total = data.totalReports;

                    let reasonText = summary.map(r => `${r.reason}(${r.count})`).join(', ');

                    let details = `Content: ${content.title}\n`;
                    details += `Type: ${content.type}\n`;
                    details += `Author: ${content.author} (${content.author_email})\n`;
                    details += `Created: ${content.created_at}\n`;
                    details += `Total Reports: ${total}\n`;
                    details += `Reasons: ${reasonText}\n\n`;

                    if (content.is_argument) {
                        details += `This is an argument in discussion: "${content.parent_post.title}"\n`;
                    }

                    if (content.parent_post && content.type === 'reference') {
                        details += `This reference is part of post: "${content.parent_post.title}"\n`;
                    }

                    if (content.url) {
                        details += `URL: ${content.url}\n`;
                    }

                    alert(details);
                } else {
                    alert('Error loading report details');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error loading report details');
            });
        }

        function resolveReport(type, id, action) {
            const actionText = action === 'delete_content' ? 'delete the content' : 'resolve the reports';
            if (!confirm(`Are you sure you want to ${actionText}? This action cannot be undone.`)) {
                return;
            }

            // Get CSRF token
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('/admin/report/resolve', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    type: type,
                    id: id,
                    action: action
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    // Refresh the page to show updated reports
                    location.reload();
                } else {
                    alert('Error resolving report: ' + (data.message || 'Unknown error'));
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error resolving report. Please try again.');
            });
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

        document.getElementById('userModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeUserModal();
            }
        });

        document.getElementById('contentModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeContentModal();
            }
        });

        // Enable Enter key search functionality
        document.getElementById('userSearch').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                searchUsers();
            }
        });

        document.getElementById('contentSearch').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                searchContent();
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
