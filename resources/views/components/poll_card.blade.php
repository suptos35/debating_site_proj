@props(['poll'])

<div class="bg-white rounded-lg shadow-md p-6 mb-4 border border-gray-200">
    <!-- Poll Header -->
    <div class="flex justify-between items-start mb-4">
        <div class="flex-1">
            <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $poll->title }}</h3>
            @if($poll->description)
                <p class="text-gray-600 text-sm mb-3">{{ $poll->description }}</p>
            @endif
            <div class="flex items-center text-xs text-gray-500 space-x-4">
                <span>By {{ $poll->user->name }}</span>
                <span>{{ $poll->created_at->diffForHumans() }}</span>
                @if($poll->expires_at)
                    <span class="text-orange-600">
                        Expires {{ $poll->expires_at->diffForHumans() }}
                    </span>
                @endif
            </div>
        </div>
        @auth
            @if(Auth::id() === $poll->user_id)
                <form action="{{ route('polls.destroy', $poll) }}" method="POST"
                      onsubmit="return confirm('Delete this poll?');" class="ml-4">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            @endif
        @endauth
    </div>

    <!-- Poll Status -->
    @if(!$poll->canVote())
        <div class="mb-4 p-3 bg-gray-100 rounded-lg">
            <p class="text-gray-600 text-sm">
                @if($poll->isExpired())
                    <i class="fas fa-clock text-orange-500"></i> This poll has expired
                @else
                    <i class="fas fa-pause text-gray-500"></i> This poll is inactive
                @endif
            </p>
        </div>
    @endif

    <!-- Poll Options -->
    <div class="space-y-3" id="poll-{{ $poll->id }}">
        @foreach($poll->options as $option)
            <div class="poll-option" data-option-id="{{ $option->id }}">
                <div class="flex items-center justify-between mb-1">
                    <label class="flex items-center cursor-pointer flex-1">
                        @auth
                            @if($poll->canVote())
                                <input type="{{ $poll->multiple_choice ? 'checkbox' : 'radio' }}"
                                       name="poll_{{ $poll->id }}_options{{ $poll->multiple_choice ? '[]' : '' }}"
                                       value="{{ $option->id }}"
                                       class="poll-vote-input mr-3 text-blue-600 focus:ring-blue-500"
                                       {{ $poll->votes()->where('user_id', Auth::id())->where('poll_option_id', $option->id)->exists() ? 'checked' : '' }}>
                            @endif
                        @endauth
                        <span class="text-gray-800">{{ $option->option_text }}</span>
                    </label>
                    <div class="text-right">
                        <span class="text-sm font-medium text-gray-900">{{ $option->votes_count ?? 0 }}</span>
                        <span class="text-xs text-gray-500 ml-1">({{ $option->vote_percentage ?? 0 }}%)</span>
                    </div>
                </div>
                <!-- Progress Bar -->
                <div class="w-full bg-gray-200 rounded-full h-2">
                    <div class="bg-blue-600 h-2 rounded-full transition-all duration-300"
                         style="width: {{ $option->vote_percentage }}%"></div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Vote Button -->
    @auth
        @if($poll->canVote())
            <div class="mt-4 pt-4 border-t border-gray-200">
                <button type="button"
                        onclick="submitVote({{ $poll->id }})"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                    <i class="fas fa-vote-yea mr-1"></i> Submit Vote
                </button>
                <span class="text-xs text-gray-500 ml-3">
                    @if($poll->multiple_choice)
                        {{ $poll->total_users_voted }} {{ Str::plural('user', $poll->total_users_voted) }} voted
                        • {{ $poll->total_selections }} {{ Str::plural('selection', $poll->total_selections) }}
                    @else
                        {{ $poll->total_votes }} {{ Str::plural('vote', $poll->total_votes) }}
                    @endif
                </span>
            </div>
        @endif
    @else
        <div class="mt-4 pt-4 border-t border-gray-200">
            <p class="text-gray-600 text-sm">
                <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a> to vote
                • @if($poll->multiple_choice)
                    {{ $poll->total_users_voted }} {{ Str::plural('user', $poll->total_users_voted) }} voted
                @else
                    {{ $poll->total_votes }} {{ Str::plural('vote', $poll->total_votes) }}
                @endif
            </p>
        </div>
    @endauth
</div>

<script>
async function submitVote(pollId) {
    console.log('submitVote called for poll:', pollId);

    const selectedOptions = [];
    const inputs = document.querySelectorAll(`input[name^="poll_${pollId}_options"]:checked`);

    console.log('Found inputs:', inputs.length);

    inputs.forEach(input => {
        selectedOptions.push(input.value);
        console.log('Selected option:', input.value);
    });

    if (selectedOptions.length === 0) {
        alert('Please select at least one option');
        return;
    }

    console.log('Submitting options:', selectedOptions);

    try {
        const response = await fetch(`/polls/${pollId}/vote`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({
                option_ids: selectedOptions
            })
        });

        console.log('Response status:', response.status);
        const data = await response.json();
        console.log('Response data:', data);

        if (response.ok) {
            // Reload page to show updated results
            window.location.reload();
        } else {
            alert(data.error || 'Error submitting vote');
        }
    } catch (error) {
        alert('Error submitting vote');
        console.error('Error:', error);
    }
}
</script>
