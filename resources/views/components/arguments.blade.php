@props(['post', 'pros', 'cons'])

<!-- Top Post Section -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 p-8 mb-8">
    <div class="flex items-center justify-between mb-4">
        <div class="text-sm text-gray-500">
            Started by <span class="font-semibold text-gray-700">{{ $post->user->name }}</span>
            • {{ \Carbon\Carbon::parse($post->created_at)->diffForHumans() }}
            • <i class="fas fa-eye mr-1"></i> {{ $viewCount ?? $post->viewCount() ?? 0 }} views
        </div>
        <button type="button" onclick="openReportModal('discussion-{{ $post->id }}')" class="text-red-500 hover:text-red-700 text-xs font-medium flex items-center">
            <i class="fas fa-flag mr-1"></i> Report
        </button>
    </div>
    <div class="text-lg text-gray-900 leading-relaxed">
        {{ $post->content }}
    </div>
</div>

<div class="grid lg:grid-cols-2 gap-8">
    <!-- Pros Section -->
    <div class="space-y-6">
        <div class="flex items-center justify-between mb-2">
            <h2 class="text-green-600 text-xl font-bold">Pros</h2>
            @auth
            <button type="button" data-modal-target="pro-modal" data-modal-toggle="pro-modal"
                class="bg-green-600 hover:bg-green-700 text-white font-bold py-1 px-2 rounded text-sm">
                Add Pro
            </button>
            @endauth
        </div>
        @foreach($pros as $pro)
        <article class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-2">
                <div class="flex items-center space-x-2">
                    <span class="font-semibold text-gray-700 text-sm">{{ $pro->user->name }}</span>
                    <span class="text-xs text-gray-400">• {{ \Carbon\Carbon::parse($pro->created_at)->diffForHumans() }}</span>
                </div>
                <div class="flex items-center space-x-2">
                    @auth
                        @if(Auth::id() === $pro->user_id)
                            <a href="{{ route('posts.edit', $pro) }}" class="text-blue-600 hover:text-blue-800 text-xs" title="Edit argument">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('posts.destroy', $pro) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this argument?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 text-xs" title="Delete argument">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        @endif
                    @endauth
                    <button type="button" onclick="openReportModal('argument-pro-{{ $pro->id }}')" class="text-red-500 hover:text-red-700 text-xs font-medium flex items-center">
                        <i class="fas fa-flag"></i>
                    </button>
                </div>
            </div>
            <a href="{{ url('/post/' . $pro->id) }}" class="text-gray-900 mb-4 block hover:text-blue-700">{{ $pro->content }}</a>
            <div class="flex items-center justify-between text-xs text-gray-500 border-t pt-2">
                <div class="flex items-center space-x-2">
                    <button type="button" data-modal-target="reference-modal-{{ $pro->id }}" data-modal-toggle="reference-modal-{{ $pro->id }}" class="flex items-center text-blue-600 hover:underline">
                        <i class="fas fa-link mr-1"></i> References
                    </button>
                    <span class="ml-1 text-xs text-gray-400">({{ $pro->references->count() }})</span>
                </div>
                <div class="flex items-center space-x-2">
                    <i class="fas fa-thumbs-up cursor-pointer text-gray-400 hover:text-green-500 like-button" data-post-id="{{ $pro->id }}" data-type="pro"></i>
                    <span class="text-xs ml-1 like-count">{{ $pro->like_count ?? 0 }}</span>
                </div>
            </div>

            <!-- Reference Modal -->
            <div id="reference-modal-{{ $pro->id }}" tabindex="-1" aria-hidden="true"
                class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full max-w-md mx-auto">
                    <div class="relative bg-white rounded-lg shadow">
                        <div class="flex items-start justify-between p-4 border-b rounded-t">
                            <h3 class="text-lg font-semibold text-blue-800">References</h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center" data-modal-hide="reference-modal-{{ $pro->id }}">
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <div class="p-6 space-y-4">
                            @forelse($pro->references as $reference)
                                <div class="flex items-center justify-between border-b pb-2 mb-2">
                                    <div class="flex-1">
                                        <div class="flex items-center mb-1">
                                            <a href="{{ $reference->url }}" target="_blank" class="text-blue-600 underline flex-1">
                                                {{ $reference->description ?? $reference->url }}
                                            </a>
                                        </div>
                                        <!-- Reference status badges -->
                                        <div class="flex items-center space-x-2 mt-1">
                                            @if($reference->is_valid)
                                                <span title="Valid URL" class="text-green-500 text-xs">✅ Valid</span>
                                            @else
                                                <span title="URL not reachable" class="text-red-500 text-xs">❌ Invalid</span>
                                            @endif

                                            @if($reference->is_reputable)
                                                <span title="Reputable Source" class="text-yellow-500 text-xs">⭐ Trusted</span>
                                            @else
                                                <span title="Source not in trusted list" class="text-orange-500 text-xs">⚠️ Unverified</span>
                                            @endif

                                            @if($reference->is_relevant)
                                                <span title="Relevant to claim ({{ number_format($reference->similarity_score * 100, 1) }}% match)" class="text-blue-500 text-xs">🔗 Relevant</span>
                                            @elseif($reference->similarity_score !== null)
                                                <span title="Low relevance ({{ number_format($reference->similarity_score * 100, 1) }}% match)" class="text-gray-500 text-xs">🔗 Low relevance</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        @auth
                                            @if(Auth::id() === $pro->user_id)
                                                <!-- Delete button -->
                                                <form action="{{ route('references.delete', $reference) }}" method="POST" onsubmit="return confirm('Delete this reference?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 text-xs ml-2">Delete</button>
                                                </form>
                                            @endif
                                        @endauth
                                        <!-- Report button for reference -->
                                        <button type="button" onclick="openReportModal('reference-{{ $reference->id }}')" class="text-red-500 hover:text-red-700 text-xs font-medium flex items-center ml-2">
                                            <i class="fas fa-flag"></i>
                                        </button>
                                    </div>
                                </div>
                            @empty
                                <div class="text-gray-400">No references yet.</div>
                            @endforelse

                            @auth
                                @if(Auth::id() === $pro->user_id)
                                    <!-- Add Reference Form -->
                                    <form action="{{ route('references.store', $pro) }}" method="POST" class="mt-4">
                                        @csrf
                                        <input type="url" name="url" class="w-full mb-2 p-2 border rounded" placeholder="Reference URL" required>
                                        <input type="text" name="description" class="w-full mb-2 p-2 border rounded" placeholder="Description (optional)">
                                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded text-sm">Add Reference</button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </article>
        @endforeach
    </div>

    <!-- Cons Section -->
    <div class="space-y-6">
        <div class="flex items-center justify-between mb-2">
            <h2 class="text-red-600 text-xl font-bold">Cons</h2>
            @auth
            <button type="button" data-modal-target="con-modal" data-modal-toggle="con-modal"
                class="bg-red-600 hover:bg-red-700 text-white font-bold py-1 px-2 rounded text-sm">
                Add Con
            </button>
            @endauth
        </div>
        @foreach($cons as $con)
        <article class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-2">
                <div class="flex items-center space-x-2">
                    <span class="font-semibold text-gray-700 text-sm">{{ $con->user->name }}</span>
                    <span class="text-xs text-gray-400">• {{ \Carbon\Carbon::parse($con->created_at)->diffForHumans() }}</span>
                </div>
                <div class="flex items-center space-x-2">
                    @auth
                        @if(Auth::id() === $con->user_id)
                            <a href="{{ route('posts.edit', $con) }}" class="text-blue-600 hover:text-blue-800 text-xs" title="Edit argument">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('posts.destroy', $con) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this argument?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 text-xs" title="Delete argument">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        @endif
                    @endauth
                    <button type="button" onclick="openReportModal('argument-con-{{ $con->id }}')" class="text-red-500 hover:text-red-700 text-xs font-medium flex items-center">
                        <i class="fas fa-flag"></i>
                    </button>
                </div>
            </div>
            <a href="{{ url('/post/' . $con->id) }}" class="text-gray-900 mb-4 block hover:text-blue-700">{{ $con->content }}</a>
            <div class="flex items-center justify-between text-xs text-gray-500 border-t pt-2">
                <div class="flex items-center space-x-2">
                    <button type="button" data-modal-target="reference-modal-{{ $con->id }}" data-modal-toggle="reference-modal-{{ $con->id }}" class="flex items-center text-blue-600 hover:underline">
                        <i class="fas fa-link mr-1"></i> References
                    </button>
                    <span class="ml-1 text-xs text-gray-400">({{ $con->references->count() }})</span>
                </div>
                <div class="flex items-center space-x-2">
                    <i class="fas fa-thumbs-up cursor-pointer text-gray-400 hover:text-green-500 like-button" data-post-id="{{ $con->id }}" data-type="con"></i>
                    <span class="text-xs ml-1 like-count">{{ $con->like_count ?? 0 }}</span>
                </div>
            </div>

            <!-- Reference Modal -->
            <div id="reference-modal-{{ $con->id }}" tabindex="-1" aria-hidden="true"
                class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative w-full max-w-md mx-auto">
                    <div class="relative bg-white rounded-lg shadow">
                        <div class="flex items-start justify-between p-4 border-b rounded-t">
                            <h3 class="text-lg font-semibold text-blue-800">References</h3>
                            <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center" data-modal-hide="reference-modal-{{ $con->id }}">
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <div class="p-6 space-y-4">
                            @forelse($con->references as $reference)
                                <div class="flex items-center justify-between border-b pb-2 mb-2">
                                    <div class="flex-1">
                                        <div class="flex items-center mb-1">
                                            <a href="{{ $reference->url }}" target="_blank" class="text-blue-600 underline flex-1">
                                                {{ $reference->description ?? $reference->url }}
                                            </a>
                                        </div>
                                        <!-- Reference status badges -->
                                        <div class="flex items-center space-x-2 mt-1">
                                            @if($reference->is_valid)
                                                <span title="Valid URL" class="text-green-500 text-xs">✅ Valid</span>
                                            @else
                                                <span title="URL not reachable" class="text-red-500 text-xs">❌ Invalid</span>
                                            @endif

                                            @if($reference->is_reputable)
                                                <span title="Reputable Source" class="text-yellow-500 text-xs">⭐ Trusted</span>
                                            @else
                                                <span title="Source not in trusted list" class="text-orange-500 text-xs">⚠️ Unverified</span>
                                            @endif

                                            @if($reference->is_relevant)
                                                <span title="Relevant to claim ({{ number_format($reference->similarity_score * 100, 1) }}% match)" class="text-blue-500 text-xs">🔗 Relevant</span>
                                            @elseif($reference->similarity_score !== null)
                                                <span title="Low relevance ({{ number_format($reference->similarity_score * 100, 1) }}% match)" class="text-gray-500 text-xs">🔗 Low relevance</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        @auth
                                            @if(Auth::id() === $con->user_id)
                                                <!-- Delete button -->
                                                <form action="{{ route('references.delete', $reference) }}" method="POST" onsubmit="return confirm('Delete this reference?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 text-xs ml-2">Delete</button>
                                                </form>
                                            @endif
                                        @endauth
                                        <!-- Report button for reference -->
                                        <button type="button" onclick="openReportModal('reference-{{ $reference->id }}')" class="text-red-500 hover:text-red-700 text-xs font-medium flex items-center ml-2">
                                            <i class="fas fa-flag"></i>
                                        </button>
                                    </div>
                                </div>
                            @empty
                                <div class="text-gray-400">No references yet.</div>
                            @endforelse

                            @auth
                                @if(Auth::id() === $con->user_id)
                                    <!-- Add Reference Form -->
                                    <form action="{{ route('references.store', $con) }}" method="POST" class="mt-4">
                                        @csrf
                                        <input type="url" name="url" class="w-full mb-2 p-2 border rounded" placeholder="Reference URL" required>
                                        <input type="text" name="description" class="w-full mb-2 p-2 border rounded" placeholder="Description (optional)">
                                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded text-sm">Add Reference</button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </article>
        @endforeach
    </div>
</div>

<!-- Pro Modal -->
<div id="pro-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-white">
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-200">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-blue-800">Add Supporting Argument</h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-100 dark:hover:text-blue-800" data-modal-hide="pro-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <div class="p-6 space-y-6">
                <form action="{{ route('arguments.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="parent_id" value="{{ $post->id }}">
                    <input type="hidden" name="type" value="pro">
                    <div class="mb-6">
                        <label for="pro-content" class="block mb-2 text-sm font-medium text-gray-900 dark:text-blue-800">Your Argument</label>
                        <textarea id="pro-content" name="content" rows="6" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white dark:border-gray-300 dark:placeholder-blue-400 dark:text-blue-800 dark:focus:ring-blue-500 dark:focus:border-blue-500" required></textarea>
                    </div>
                    <div class="flex items-center pt-4 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-200">
                        <button type="submit" class="text-white bg-green-600 hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Post Argument</button>
                        <button type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-white dark:text-blue-800 dark:border-gray-300 dark:hover:text-blue-900 dark:hover:bg-gray-100 dark:focus:ring-gray-300" data-modal-hide="pro-modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Con Modal -->
<div id="con-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative w-full max-w-2xl max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-white">
            <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-200">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-blue-800">Add Counter Argument</h3>
                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-100 dark:hover:text-blue-800" data-modal-hide="con-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <div class="p-6 space-y-6">
                <form action="{{ route('arguments.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="parent_id" value="{{ $post->id }}">
                    <input type="hidden" name="type" value="con">
                    <div class="mb-6">
                        <label for="con-content" class="block mb-2 text-sm font-medium text-gray-900 dark:text-blue-800">Your Argument</label>
                        <textarea id="con-content" name="content" rows="6" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white dark:border-gray-300 dark:placeholder-blue-400 dark:text-blue-800 dark:focus:ring-blue-500 dark:focus:border-blue-500" required></textarea>
                    </div>
                    <div class="flex items-center pt-4 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-200">
                        <button type="submit" class="text-white bg-red-600 hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Post Argument</button>
                        <button type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-white dark:text-blue-800 dark:border-gray-300 dark:hover:text-blue-900 dark:hover:bg-gray-100 dark:focus:ring-gray-300" data-modal-hide="con-modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Report Modal (shared for all report actions) -->
<div id="reportModal" class="fixed inset-0 bg-black bg-opacity-50 hidden z-50">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-xl shadow-xl max-w-md w-full">
            <div class="p-6">
                <div id="reportContext" class="mb-4 text-gray-700 font-semibold flex items-center">
                    <i class="fas fa-flag text-red-500 mr-2"></i>Reporting: <span id="reportTarget">Content</span>
                </div>
                <form onsubmit="submitReport(); return false;">
                    <label for="reportReason" class="block mb-2 text-sm font-medium text-gray-900">Reason</label>
                    <select id="reportReason" class="w-full mb-4 p-2 border rounded">
                        <option value="spam">Spam</option>
                        <option value="abuse">Abusive Content</option>
                        <option value="misinfo">Misinformation</option>
                        <option value="irrelevant">Irrelevant Content</option>
                        <option value="contradiction">Contradiction</option>
                        <option value="other">Other</option>
                    </select>
                    {{-- <label for="reportDetails" class="block mb-2 text-sm font-medium text-gray-900">Details (optional)</label>
                    <textarea id="reportDetails" class="w-full mb-4 p-2 border rounded" rows="3"></textarea> --}}
                    <div class="flex justify-end space-x-2">
                        <button type="button" onclick="closeReportModal()" class="bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300">Cancel</button>
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">Submit Report</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    let currentReportTarget = null;

    function openReportModal(targetId) {
        currentReportTarget = targetId;
        document.getElementById('reportModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
        document.getElementById('reportTarget').textContent = targetId.replace(/[-_]/g, ' ');
    }

    function closeReportModal() {
        document.getElementById('reportModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
        currentReportTarget = null;
    }

    function submitReport() {
        if (!currentReportTarget) return;

        const reason = document.getElementById('reportReason').value;

        // Parse the target to determine type and ID
        let reportableType, reportableId;

        if (currentReportTarget.includes('discussion-')) {
            reportableType = 'App\\Models\\Post';
            reportableId = currentReportTarget.replace('discussion-', '');
        } else if (currentReportTarget.includes('argument-pro-') || currentReportTarget.includes('argument-con-')) {
            reportableType = 'App\\Models\\Post';
            reportableId = currentReportTarget.replace('argument-pro-', '').replace('argument-con-', '');
        } else if (currentReportTarget.includes('reference-')) {
            reportableType = 'App\\Models\\Reference';
            reportableId = currentReportTarget.replace('reference-', '');
        }

        fetch('/report/content', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                reportable_type: reportableType,
                reportable_id: reportableId,
                reason: reason
            })
        })
        .then(response => {
            // Handle authentication redirects
            if (response.status === 401 || response.status === 419) {
                alert('Please log in to report content.');
                closeReportModal();
                return;
            }

            // For successful responses (200-299), parse JSON
            if (response.ok) {
                return response.json();
            }

            // For other error responses, throw error
            throw new Error(`Server returned ${response.status}: ${response.statusText}`);
        })
        .then(data => {
            // Only process data if we actually got some (not from auth redirect)
            if (data && data.success === true) {
                alert('Report submitted successfully!');
            }
            // Silently handle errors - no alert for failed submissions
        })
        .catch(error => {
            console.error('Report submission error:', error);
            // Silently handle errors - no alert for failed submissions
        })
        .finally(() => {
            closeReportModal();
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        // Add event listeners to all like buttons
        const likeButtons = document.querySelectorAll('.like-button');
        likeButtons.forEach(button => {
            button.addEventListener('click', function(event) {
                event.stopPropagation();

                @auth
                const postId = this.getAttribute('data-post-id');
                const type = this.getAttribute('data-type');
                const button = this;
                const countElement = button.nextElementSibling;

                // Send AJAX request
                fetch(`/posts/${postId}/like`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({})
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update UI based on like status
                        if (data.liked) {
                            button.classList.remove('text-gray-400');
                            button.classList.add(type === 'pro' ? 'text-green-500' : 'text-red-500');
                        } else {
                            button.classList.remove(type === 'pro' ? 'text-green-500' : 'text-red-500');
                            button.classList.add('text-gray-400');
                        }

                        // Update the like count
                        countElement.textContent = data.likeCount;
                    }
                })
                .catch(error => console.error('Error:', error));
                @else
                    alert('Please log in to like posts');
                @endauth
            });
        });
    });
</script>
