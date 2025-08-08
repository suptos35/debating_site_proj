<x-main_layout :categories="$categories">

    <!-- Category Header -->
    <div class="bg-gray-100 border-b">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="w-16 h-16 bg-blue-600 rounded-xl flex items-center justify-center">
                        @php
                            $categoryName = strtolower(isset($category_model) ? $category_model->name : $category);
                            $icon = 'fa-folder';

                            if (strpos($categoryName, 'science') !== false) {
                                $icon = 'fa-atom';
                            } elseif (strpos($categoryName, 'tech') !== false) {
                                $icon = 'fa-robot';
                            } elseif (strpos($categoryName, 'environment') !== false || strpos($categoryName, 'nature') !== false) {
                                $icon = 'fa-seedling';
                            } elseif (strpos($categoryName, 'health') !== false || strpos($categoryName, 'medical') !== false) {
                                $icon = 'fa-heartbeat';
                            } elseif (strpos($categoryName, 'politic') !== false || strpos($categoryName, 'government') !== false) {
                                $icon = 'fa-landmark';
                            } elseif (strpos($categoryName, 'econom') !== false || strpos($categoryName, 'financ') !== false) {
                                $icon = 'fa-chart-line';
                            }
                        @endphp
                        <i class="fas {{ $icon }} text-white text-2xl"></i>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">{{ isset($category_model) ? $category_model->name : ucfirst($category) }}</h1>
                        {{-- <p class="text-gray-600 mt-1">Discussions about {{ isset($category_model) && $category_model->description ? $category_model->description : $category.' topics' }}</p> --}}
                    </div>
                </div>
                <div>
                    <button id="followCategoryBtn" onclick="toggleFollow('category', {{ $category_model->id }}, this)"
                            class="follow-btn bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors"
                            data-following="{{ Auth::check() && Auth::user()->isFollowing($category_model) ? 'true' : 'false' }}">
                        <i class="fas {{ Auth::check() && Auth::user()->isFollowing($category_model) ? 'fa-check' : 'fa-plus' }} mr-2"></i>
                        <span class="follow-text">{{ Auth::check() && Auth::user()->isFollowing($category_model) ? 'Following' : 'Follow Category' }}</span>
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
                <h2 class="text-2xl font-bold text-gray-900">{{ isset($category_model) ? $category_model->name : ucfirst($category) }} Discussions</h2>
                <span class="text-sm text-gray-500">{{ $discussionsCount }} discussions • {{ number_format($viewCount) }} views • <span id="followersCount">{{ $category_model->getFollowersCount() }}</span> followers</span>
            </div>

            @if($discussionsCount > 0)
            <div class="lg:grid lg:grid-cols-3 gap-6 space-y-6 lg:space-y-0">
                @foreach($category_model->posts()->whereNull('parent_id')->with(['user', 'categories', 'references', 'children'])->get() as $post)
                    <x-post_card :post="$post" />
                @endforeach
            </div>
            @else
            <div class="text-center py-12 bg-white rounded-xl shadow-sm">
                <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-folder-open text-gray-400 text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-700 mb-2">No discussions found</h3>
                <p class="text-gray-500">Be the first to start a discussion in this category!</p>
                <button class="mt-6 bg-blue-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                    <i class="fas fa-plus mr-2"></i> Start Discussion
                </button>
            </div>
            @endif
        </div>
    </main>

    <!-- Footer -->
    </x-main_layout>

<script>
function toggleFollow(type, id, button) {
    @guest
        alert('Please log in to follow categories and writers');
        return;
    @endguest

    const isFollowing = button.dataset.following === 'true';
    const method = isFollowing ? 'DELETE' : 'POST';
    const url = `/follow/${type}/${id}`;

    // Update button state immediately for better UX
    const followText = button.querySelector('.follow-text');
    const icon = button.querySelector('i');

    // Disable button during request
    button.disabled = true;
    followText.textContent = isFollowing ? 'Unfollowing...' : 'Following...';

    fetch(url, {
        method: method,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json',
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update button state
            if (isFollowing) {
                followText.textContent = 'Follow Category';
                icon.className = 'fas fa-plus mr-2';
                button.className = 'follow-btn bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 transition-colors';
                button.dataset.following = 'false';
            } else {
                followText.textContent = 'Following';
                icon.className = 'fas fa-check mr-2';
                button.className = 'follow-btn bg-green-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-green-700 transition-colors';
                button.dataset.following = 'true';
            }

            // Update follower count if element exists
            const followerCounter = document.getElementById('followersCount');
            if (followerCounter && data.followers_count !== undefined) {
                followerCounter.textContent = data.followers_count;
            }
        } else {
            alert(data.message || 'An error occurred. Please try again.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred. Please try again.');
    })
    .finally(() => {
        // Re-enable button
        button.disabled = false;
    });
}
</script>
