<x-main_layout :categories="$categories">
    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
        <!-- Posts Section -->
        <div class="lg:grid lg:grid-cols-3">
            @foreach ($posts as $post)
                <x-post_card :post="$post"></x-post_card>
            @endforeach
        </div>

        <!-- Polls Section -->
        @if($polls->isNotEmpty())
            <div class="mt-12">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Community Polls</h2>
                    <a href="{{ route('polls.index') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                        View All Polls →
                    </a>
                </div>

                <div class="grid lg:grid-cols-2 gap-6">
                    @foreach ($polls as $poll)
                        <x-poll_card :poll="$poll" />
                    @endforeach
                </div>
            </div>
        @endif
      </main>
</x-main_layout>
