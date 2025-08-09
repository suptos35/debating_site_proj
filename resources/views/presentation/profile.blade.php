<x-main_layout :categories="collect()">

    <!-- Profile Header -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex items-center space-x-6">
                <!-- Profile Picture -->
                <div class="w-24 h-24 bg-blue-100 rounded-full flex items-center justify-center">
                    @php
                        $initials = strtoupper(substr(auth()->user()->name, 0, 1));
                        if (str_contains(auth()->user()->name, ' ')) {
                            $nameParts = explode(' ', auth()->user()->name);
                            $initials = strtoupper(substr($nameParts[0], 0, 1) . substr(end($nameParts), 0, 1));
                        }
                    @endphp
                    <span class="text-blue-600 text-3xl font-bold">{{ $initials }}</span>
                </div>

                <!-- Profile Info -->
                <div class="flex-1">
                    <h1 class="text-3xl font-bold text-gray-900">{{ auth()->user()->name }}</h1>
                    <p class="text-sm text-gray-500 mt-2">Joined {{ auth()->user()->created_at->format('F Y') }}</p>

                    <!-- Stats -->
                    <div class="flex items-center space-x-6 mt-4">
                        <div class="text-center">
                            <div class="text-xl font-bold text-gray-900">{{ auth()->user()->posts()->whereNull('parent_id')->count() }}</div>
                            <div class="text-xs text-gray-500">Discussions</div>
                        </div>
                        <div class="text-center">
                            <div class="text-xl font-bold text-gray-900">{{ auth()->user()->posts()->whereNotNull('parent_id')->count() }}</div>
                            <div class="text-xs text-gray-500">Arguments</div>
                        </div>
                        <div class="text-center">
                            <div class="text-xl font-bold text-gray-900">{{ auth()->user()->posts()->sum('like_count') ?? 0 }}</div>
                            <div class="text-xs text-gray-500">Likes Received</div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                {{-- <div class="flex flex-col space-y-2">
                    <button onclick="openEditProfileModal()" class="bg-blue-600 text-white px-6 py-2 rounded-lg text-sm font-medium hover:bg-blue-700 transition-colors">
                        <i class="fas fa-edit mr-2"></i> Edit Profile
                    </button>
                </div> --}}
            </div>

            <!-- Bio -->
            <div class="mt-6">
                <p class="text-gray-700 max-w-3xl">
                    {{ auth()->user()->description ?? 'No description available.' }}
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
                    <h2 class="text-2xl font-bold text-gray-900">My Discussions</h2>

                    @php
                        $userPosts = auth()->user()->posts()
                            ->whereNull('parent_id')
                            ->with(['categories', 'user'])
                            ->orderBy('created_at', 'desc')
                            ->limit(4)
                            ->get();
                    @endphp

                    @if($userPosts->count() > 0)
                        <div class="grid md:grid-cols-2 gap-6">
                            @foreach($userPosts as $post)
                                <x-post_card :post="$post" />
                            @endforeach
                        </div>

                        @if(auth()->user()->posts()->whereNull('parent_id')->count() > 4)
                            <!-- Load More Button -->
                            <div class="text-center">
                                <button class="bg-gray-100 text-gray-700 px-6 py-3 rounded-lg font-medium hover:bg-gray-200 transition-colors">
                                    Load More Posts
                                </button>
                            </div>
                        @endif
                    @else
                        <div class="col-span-2 bg-white rounded-xl shadow-sm border border-gray-100 p-8 text-center">
                            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-comments text-gray-400 text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 mb-2">No Discussions Yet</h3>
                            <p class="text-gray-500 mb-4">You haven't started any discussions yet. Why not create your first one?</p>
                            <button type="button" data-modal-target="post-modal" data-modal-toggle="post-modal"
                                class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                                Start a Discussion
                            </button>
                        </div>
                    @endif
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
                        @if($notifications && $notifications->count() > 0)
                            @foreach($notifications->take(5) as $notification)
                                @php
                                    $bgColor = '';
                                    $borderColor = '';
                                    $iconColor = '';
                                    $icon = '';
                                    $postUrl = '#';

                                    // Get the main post for URL generation
                                    $mainPost = $notification->post;
                                    if ($mainPost && $mainPost->parent_id) {
                                        // If this is a comment/reply, get the parent post
                                        $mainPost = $mainPost->parent;
                                    }

                                    if ($mainPost) {
                                        $postUrl = "/post/{$mainPost->id}";
                                    }

                                    switch($notification->type) {
                                        case 'post_liked':
                                            $bgColor = 'bg-green-50';
                                            $borderColor = 'border-green-500';
                                            $iconColor = 'bg-green-500';
                                            $icon = 'fas fa-thumbs-up';
                                            break;
                                        case 'post_commented':
                                            $bgColor = 'bg-purple-50';
                                            $borderColor = 'border-purple-500';
                                            $iconColor = 'bg-purple-500';
                                            $icon = 'fas fa-comment';
                                            break;
                                        case 'post_replied':
                                            $bgColor = 'bg-blue-50';
                                            $borderColor = 'border-blue-500';
                                            $iconColor = 'bg-blue-500';
                                            $icon = 'fas fa-reply';
                                            break;
                                        case 'new_post_by_user':
                                            $bgColor = 'bg-indigo-50';
                                            $borderColor = 'border-indigo-500';
                                            $iconColor = 'bg-indigo-500';
                                            $icon = 'fas fa-user-edit';
                                            break;
                                        case 'new_post_in_category':
                                            $bgColor = 'bg-yellow-50';
                                            $borderColor = 'border-yellow-500';
                                            $iconColor = 'bg-yellow-500';
                                            $icon = 'fas fa-folder-plus';
                                            break;
                                        default:
                                            $bgColor = 'bg-gray-50';
                                            $borderColor = 'border-gray-500';
                                            $iconColor = 'bg-gray-500';
                                            $icon = 'fas fa-bell';
                                            break;
                                    }
                                @endphp

                                <a href="{{ $postUrl }}" class="block hover:bg-gray-50 transition-colors rounded-lg">
                                    <div class="flex items-start space-x-3 p-3 {{ $bgColor }} rounded-lg border-l-4 {{ $borderColor }}">
                                        <div class="w-8 h-8 {{ $iconColor }} rounded-full flex items-center justify-center">
                                            <i class="{{ $icon }} text-white text-xs"></i>
                                        </div>
                                        <div class="flex-1">
                                            <p class="text-sm text-gray-800">
                                                @if($notification->type === 'post_liked')
                                                    <span class="font-medium">{{ $notification->triggeredBy->name }}</span> liked your post
                                                    @if($notification->post && $notification->post->parent_id)
                                                        @php $parentPost = $notification->post->parent; @endphp
                                                        @if($parentPost)
                                                            <span class="font-medium text-blue-600">"{{ Str::limit($parentPost->title, 40) }}"</span>
                                                        @endif
                                                    @elseif($notification->post)
                                                        <span class="font-medium text-blue-600">"{{ Str::limit($notification->post->title, 40) }}"</span>
                                                    @endif

                                                @elseif($notification->type === 'post_commented')
                                                    <span class="font-medium">{{ $notification->triggeredBy->name }}</span> commented on your post
                                                    @if($notification->post && $notification->post->parent_id)
                                                        @php $parentPost = $notification->post->parent; @endphp
                                                        @if($parentPost)
                                                            <span class="font-medium text-blue-600">"{{ Str::limit($parentPost->title, 40) }}"</span>
                                                        @endif
                                                    @elseif($notification->post)
                                                        <span class="font-medium text-blue-600">"{{ Str::limit($notification->post->title, 40) }}"</span>
                                                    @endif

                                                @elseif($notification->type === 'post_replied')
                                                    <span class="font-medium">{{ $notification->triggeredBy->name }}</span> replied to your comment
                                                    @if($notification->post && $notification->post->parent_id)
                                                        @php $parentPost = $notification->post->parent; @endphp
                                                        @if($parentPost && $parentPost->parent_id)
                                                            @php $mainPost = $parentPost->parent; @endphp
                                                            @if($mainPost)
                                                                on <span class="font-medium text-blue-600">"{{ Str::limit($mainPost->title, 35) }}"</span>
                                                            @endif
                                                        @elseif($parentPost)
                                                            on <span class="font-medium text-blue-600">"{{ Str::limit($parentPost->title, 35) }}"</span>
                                                        @endif
                                                    @endif

                                                @elseif($notification->type === 'new_post_by_user')
                                                    <span class="font-medium">{{ $notification->triggeredBy->name }}</span> created a new post
                                                    @if($notification->post)
                                                        <span class="font-medium text-blue-600">"{{ Str::limit($notification->post->title, 40) }}"</span>
                                                    @endif

                                                @elseif($notification->type === 'new_post_in_category')
                                                    <span class="font-medium">{{ $notification->triggeredBy->name }}</span> posted in
                                                    @if($notification->notifiable_type === 'App\Models\Category' && $notification->notifiable)
                                                        <span class="font-medium text-blue-600">{{ $notification->notifiable->name }}</span>
                                                    @endif
                                                    @if($notification->post)
                                                        : <span class="font-medium text-gray-900">"{{ Str::limit($notification->post->title, 30) }}"</span>
                                                    @endif

                                                @else
                                                    You have a new notification from
                                                    @if($notification->triggeredBy)
                                                        <span class="font-medium">{{ $notification->triggeredBy->name }}</span>
                                                    @else
                                                        the system
                                                    @endif
                                                @endif
                                            </p>
                                            <p class="text-xs text-gray-500 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @else
                            <div class="text-center py-8">
                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-bell text-gray-400 text-2xl"></i>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-900 mb-2">No Notifications</h3>
                                <p class="text-gray-500">You're all caught up! New notifications will appear here.</p>
                            </div>
                        @endif
                    </div>
                    @if($notifications && $notifications->count() > 5)
                        <div class="text-center mt-4">
                            <button class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                                View All {{ $notifications->count() }} Notifications
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Additional Profile Sections - 2 Columns -->
        <div class="grid lg:grid-cols-2 gap-6 mt-12">
            <!-- Following Categories -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-bookmark mr-2 text-blue-600"></i>
                    Following Categories
                </h3>
                @if($followedCategories->count() > 0)
                    <div class="space-y-3">
                        @foreach($followedCategories as $category)
                            <a href="/presentation/category/{{ $category->id }}" class="flex items-center justify-between p-3 bg-white rounded-lg border border-gray-100 hover:border-blue-200 transition-colors cursor-pointer">
                                <div class="flex items-center space-x-3">
                                    @php
                                        // Choose icon based on category name
                                        $icon = 'fas fa-folder';
                                        $bgColor = 'bg-gray-600';
                                        $categoryName = strtolower($category->name);

                                        if (strpos($categoryName, 'science') !== false) {
                                            $icon = 'fas fa-atom';
                                            $bgColor = 'bg-blue-600';
                                        } elseif (strpos($categoryName, 'tech') !== false) {
                                            $icon = 'fas fa-robot';
                                            $bgColor = 'bg-purple-600';
                                        } elseif (strpos($categoryName, 'environment') !== false || strpos($categoryName, 'nature') !== false) {
                                            $icon = 'fas fa-seedling';
                                            $bgColor = 'bg-green-600';
                                        } elseif (strpos($categoryName, 'health') !== false || strpos($categoryName, 'medical') !== false) {
                                            $icon = 'fas fa-heartbeat';
                                            $bgColor = 'bg-red-600';
                                        } elseif (strpos($categoryName, 'politic') !== false || strpos($categoryName, 'government') !== false) {
                                            $icon = 'fas fa-landmark';
                                            $bgColor = 'bg-yellow-600';
                                        } elseif (strpos($categoryName, 'econom') !== false || strpos($categoryName, 'financ') !== false) {
                                            $icon = 'fas fa-chart-line';
                                            $bgColor = 'bg-indigo-600';
                                        }
                                    @endphp
                                    <div class="w-10 h-10 {{ $bgColor }} rounded-lg flex items-center justify-center">
                                        <i class="{{ $icon }} text-white text-sm"></i>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-900">{{ $category->name }}</h4>
                                        <span class="text-xs text-gray-500">{{ $category->getFollowersCount() }} followers</span>
                                    </div>
                                </div>
                                <span class="text-xs text-blue-600 bg-blue-50 px-2 py-1 rounded-full">{{ $category->posts_count }} posts</span>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="p-4 bg-gray-50 rounded-lg text-center">
                        <i class="fas fa-bookmark text-gray-400 text-2xl mb-2"></i>
                        <p class="text-gray-500 text-sm mb-3">You're not following any categories yet.</p>
                        <a href="/presentation/categories" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                            Browse Categories
                        </a>
                    </div>
                @endif
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <a href="/presentation/categories" class="w-full text-blue-600 hover:text-blue-800 text-sm font-medium block text-center">
                        Browse More Categories
                    </a>
                </div>
            </div>

            <!-- Following People -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-user-friends mr-2 text-blue-600"></i>
                    Following Writers
                </h3>
                @if($followedUsers->count() > 0)
                    <div class="space-y-3">
                        @foreach($followedUsers as $writer)
                            <a href="/presentation/writer/{{ strtolower(str_replace(' ', '-', $writer->name)) }}" class="flex items-center justify-between p-3 bg-white rounded-lg border border-gray-100 hover:border-blue-200 transition-colors cursor-pointer">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10
                                        @php
                                            // Generate avatar background color based on user ID
                                            $avatarClasses = ['bg-blue-100', 'bg-green-100', 'bg-purple-100', 'bg-yellow-100', 'bg-pink-100', 'bg-indigo-100'];
                                            $textClasses = ['text-blue-600', 'text-green-600', 'text-purple-600', 'text-yellow-600', 'text-pink-600', 'text-indigo-600'];
                                            $avatarIndex = $writer->id % count($avatarClasses);
                                            echo $avatarClasses[$avatarIndex];
                                        @endphp
                                        rounded-full flex items-center justify-center">
                                        <span class="{{ $textClasses[$avatarIndex] }} font-semibold text-sm">
                                            @php
                                                // Generate initials from name
                                                $nameParts = explode(' ', $writer->name);
                                                $initials = '';
                                                if (count($nameParts) >= 1) {
                                                    $initials .= strtoupper(substr($nameParts[0], 0, 1));
                                                    if (count($nameParts) >= 2) {
                                                        $initials .= strtoupper(substr($nameParts[1], 0, 1));
                                                    }
                                                }
                                                echo $initials;
                                            @endphp
                                        </span>
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-gray-900">{{ $writer->name }}</h4>
                                        <span class="text-xs text-gray-500">{{ number_format($writer->posts_sum_like_count ?? 0) }} likes received</span>
                                    </div>
                                </div>
                                <span class="text-xs text-blue-600 bg-blue-50 px-2 py-1 rounded-full">
                                    {{ $writer->posts_count }} posts
                                </span>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="p-4 bg-gray-50 rounded-lg text-center">
                        <i class="fas fa-user-friends text-gray-400 text-2xl mb-2"></i>
                        <p class="text-gray-500 text-sm mb-3">You're not following any writers yet.</p>
                        <a href="/presentation/writers" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                            Discover Writers
                        </a>
                    </div>
                @endif
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <a href="/presentation/writers" class="w-full text-blue-600 hover:text-blue-800 text-sm font-medium block text-center">
                        Discover More Writers
                    </a>
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
                            <input type="text" value="{{ auth()->user()->name }}" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
                            <textarea rows="3" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Tell others about yourself...">{{ auth()->user()->description }}</textarea>
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

</x-main_layout>
