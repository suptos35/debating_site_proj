@props(['categories' => collect()])
<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ isset($title) ? $title . ' - ' : '' }}{{ config('app.name') }} - A Structured Discussion System</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
</head>

<body>


  <nav class="bg-white border-blue-200 dark:bg-blue-900">
    <div class=" flex flex-wrap items-center  p-4">
      <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
        <img src="{{ asset('images/factly-logo.svg') }}" class="h-8 w-8" alt="Factly Logo" />
        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Factly</span>
      </a>

      <div
        class=" text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700 ml-4 mr-5">

        <ul class="flex flex-wrap -mb-px">
          <li class="me-2">
            <a href="#"
              class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Profile</a>
          </li>
          <li class="me-2">
            <a href="/"
              class="inline-block p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active dark:text-blue-500 dark:border-blue-500"
              aria-current="page">Home</a>
          </li>
          @auth
          <li class="me-2">
            <button type="button" data-modal-target="post-modal" data-modal-toggle="post-modal"
              class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">
              New Discussion
            </button>
          </li>
          <li class="me-2">
            <button type="button" data-modal-target="poll-modal" data-modal-toggle="poll-modal"
              class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">
              Create Poll
            </button>
          </li>
          @endauth
        </ul>
      </div>


      <button data-collapse-toggle="navbar-default" type="button"
        class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
        aria-controls="navbar-default" aria-expanded="false">
        <span class="sr-only">Open main menu</span>
        <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M1 1h15M1 7h15M1 13h15" />
        </svg>
      </button>
      <div class="ml-auto w-full md:block md:w-auto" id="navbar-default">
        @auth
        <span class="text-white">Welcome, {{ Auth::user()->name }}</span> |
        <a href="{{ route('logout') }}"
           class="text-white hover:text-gray-300"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
    @else
        <a href="{{ route('login') }}" class="text-white hover:text-gray-300">Login</a> |
        <a href="{{ route('register') }}" class="text-white hover:text-gray-300">Register</a>
    @endauth
        {{-- <ul
          class="flex flex-row-reverse font-medium flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-blue-50 md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-white dark:bg-blue-800 md:dark:bg-blue-900 dark:border-blue-700 ">
          <li>
            <a href="#"
              class="block py-2 px-3 text-white bg-blue-700 rounded md:bg-transparent md:text-blue-700 md:p-0 dark:text-white md:dark:text-blue-500"
              aria-current="page">Home</a>
          </li>
          <li>
            <a href="#"
              class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">About</a>
          </li>
          <li>
            <a href="#"
              class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Services</a>
          </li>
          <li>
            <a href="#"
              class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Pricing</a>
          </li>
          <li>
            <a href="#"
              class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Contact</a>
          </li>
        </ul> --}}
      </div>
    </div>
    <div class="text-center text-lg text-white p-2 mx-auto py-4 bg-gradient-to-r from-blue-600 to-blue-800">
      <h1 class="font-medium">Empowering Evidence-Based Discussions</h1>
      <p class="text-sm opacity-90 mt-1">A Structured Discussion System with Integrated Reference Validation</p>
    </div>
    <div class="px-4 py-4 mx-20 max-w-screen-xl">
        <div class="grid grid-cols-6 gap-2 mx-20">
            {{-- First row (6 buttons) --}}
            @foreach($categories->take(6) as $category)
                <button type="button"
                    class="text-gray-900 border border-blue-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 dark:text-white dark:border-blue-600 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                    {{ $category->name }}
                </button>
            @endforeach

            {{-- Second row (4 buttons, centered) --}}
            <button type="button"
                    class="col-start-2 text-gray-900 border border-blue-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 dark:text-white dark:border-blue-600 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                    {{ $categories->get(6)->name }}
                </button>
            @foreach($categories->skip(7)->take(2) as $index => $category)
                <button type="button"
                    class="text-gray-900 border border-blue-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 dark:text-white dark:border-blue-600 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                    {{ $category->name }}
                </button>
            @endforeach

            <button type="button"
                    class="text-gray-900 border border-blue-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 dark:text-white dark:border-blue-600 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                    more..
                </button>

            {{-- "More.." button (only if more than 10 categories exist) --}}
            {{-- @if($categories->count() > 10)
                <button type="button"
                    class="col-start-3 col-span-2 text-gray-900 border border-blue-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-100 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 dark:text-white dark:border-blue-600 dark:hover:border-gray-600 dark:focus:ring-gray-700">
                    More..
                </button>
            @endif --}}
        </div>

    </div>

  </nav>


  {{$slot}}




<footer class="bg-white rounded-lg shadow m-4 dark:bg-blue-800">
  <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between">
    <span class="text-sm text-white sm:text-center dark:text-white">© 2025 <a href="/" class="hover:underline font-semibold">Factly</a>. Empowering Evidence-Based Discussions.
  </span>
  <ul class="flex flex-wrap items-center mt-3 text-sm font-medium text-gray-500 dark:text-white sm:mt-0">
      <li>
          <a href="#" class="hover:underline me-4 md:me-6">About</a>
      </li>
      <li>
          <a href="#" class="hover:underline me-4 md:me-6">Privacy Policy</a>
      </li>
      <li>
          <a href="#" class="hover:underline me-4 md:me-6">Guidelines</a>
      </li>
      <li>
          <a href="#" class="hover:underline">Contact</a>
      </li>
  </ul>
  </div>
</footer>








<script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

<!-- Post Modal -->
<div id="post-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
  <div class="relative w-full max-w-2xl max-h-full">
    _layout.blade.php
<!-- Modal content -->
<div class="relative bg-white rounded-lg shadow dark:bg-white">
  <!-- Modal header -->
  <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-200">
    <h3 class="text-xl font-semibold text-gray-900 dark:text-blue-800">
      Start New Discussion
    </h3>
    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-100 dark:hover:text-blue-800" data-modal-hide="post-modal">
      <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
      </svg>
      <span class="sr-only">Close modal</span>
    </button>
  </div>
<!-- Modal body -->
<div class="p-6 space-y-6">
    <form action="{{ route('posts.store') }}" method="POST">
      @csrf
      <div class="mb-6">
        <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-blue-800">Title</label>
        <input type="text" id="title" name="title" maxlength="255" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white dark:border-gray-300 dark:placeholder-blue-400 dark:text-blue-800 dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
      </div>
      <div class="mb-6">
        <label for="excerpt" class="block mb-2 text-sm font-medium text-gray-900 dark:text-blue-800">Excerpt</label>
        <textarea id="excerpt" name="excerpt" maxlength="1000" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white dark:border-gray-300 dark:placeholder-blue-400 dark:text-blue-800 dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
      </div>
      <div class="mb-6">
        <label for="content" class="block mb-2 text-sm font-medium text-gray-900 dark:text-blue-800">Content</label>
        <textarea id="content" name="content" rows="6" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white dark:border-gray-300 dark:placeholder-blue-400 dark:text-blue-800 dark:focus:ring-blue-500 dark:focus:border-blue-500" required></textarea>
      </div>
      <div class="mb-6">
        <label for="categories" class="block mb-2 text-sm font-medium text-gray-900 dark:text-blue-800">Categories</label>
        <select id="categories" name="categories[]" multiple class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white dark:border-gray-300 dark:placeholder-blue-400 dark:text-blue-800 dark:focus:ring-blue-500 dark:focus:border-blue-500">
          @foreach($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
          @endforeach
        </select>
        <p class="mt-1 text-sm text-gray-500 dark:text-blue-700">Hold Ctrl (Windows) or Cmd (Mac) to select multiple categories</p>
      </div>
      <!-- Modal footer -->
      <div class="flex items-center pt-4 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-200">
        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Start Discussion</button>
        <button type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-white dark:text-blue-800 dark:border-gray-300 dark:hover:text-blue-900 dark:hover:bg-gray-100 dark:focus:ring-gray-300" data-modal-hide="post-modal">Cancel</button>
      </div>
    </form>
  </div>
  </div>
</div>

  </div>
</div>

<!-- Poll Modal -->
<div id="poll-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
  <div class="relative w-full max-w-2xl max-h-full">
    <!-- Modal content -->
    <div class="relative bg-white rounded-lg shadow dark:bg-white">
      <!-- Modal header -->
      <div class="flex items-start justify-between p-4 border-b rounded-t dark:border-gray-200">
        <h3 class="text-xl font-semibold text-gray-900 dark:text-blue-800">
          Create New Poll
        </h3>
        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-100 dark:hover:text-blue-800" data-modal-hide="poll-modal">
          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
          </svg>
          <span class="sr-only">Close modal</span>
        </button>
      </div>
      <!-- Modal body -->
      <div class="p-6 space-y-6">
        <form action="{{ route('polls.store') }}" method="POST" id="poll-form">
          @csrf
          <div class="mb-6">
            <label for="poll-title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-blue-800">Poll Title</label>
            <input type="text" id="poll-title" name="title" maxlength="255" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white dark:border-gray-300 dark:placeholder-blue-400 dark:text-blue-800 dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
          </div>

          <div class="mb-6">
            <label for="poll-description" class="block mb-2 text-sm font-medium text-gray-900 dark:text-blue-800">Description (Optional)</label>
            <textarea id="poll-description" name="description" maxlength="1000" rows="3" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white dark:border-gray-300 dark:placeholder-blue-400 dark:text-blue-800 dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
          </div>

          <div class="mb-6">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-blue-800">Poll Options</label>
            <div id="poll-options-container">
              <div class="poll-option-input mb-2">
                <input type="text" name="options[]" placeholder="Option 1" maxlength="255" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white dark:border-gray-300 dark:placeholder-blue-400 dark:text-blue-800 dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
              </div>
              <div class="poll-option-input mb-2">
                <input type="text" name="options[]" placeholder="Option 2" maxlength="255" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white dark:border-gray-300 dark:placeholder-blue-400 dark:text-blue-800 dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
              </div>
            </div>
            <button type="button" id="add-poll-option-btn" class="mt-2 text-blue-600 hover:text-blue-800 text-sm font-medium">
              + Add Another Option
            </button>
          </div>

          <div class="mb-6">
            <label class="flex items-center">
              <input type="checkbox" name="multiple_choice" value="1" class="mr-2 text-blue-600 focus:ring-blue-500 rounded">
              <span class="text-sm text-gray-900 dark:text-blue-800">Allow multiple choice selection</span>
            </label>
          </div>

          <div class="mb-6">
            <label for="poll-expires" class="block mb-2 text-sm font-medium text-gray-900 dark:text-blue-800">Expiration Date (Optional)</label>
            <input type="datetime-local" id="poll-expires" name="expires_at" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white dark:border-gray-300 dark:placeholder-blue-400 dark:text-blue-800 dark:focus:ring-blue-500 dark:focus:border-blue-500">
          </div>

          <!-- Modal footer -->
          <div class="flex items-center pt-4 space-x-2 border-t border-gray-200 rounded-b dark:border-gray-200">
            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Create Poll</button>
            <button type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-white dark:text-blue-800 dark:border-gray-300 dark:hover:text-blue-900 dark:hover:bg-gray-100 dark:focus:ring-gray-300" data-modal-hide="poll-modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
// Poll functionality - wrapped in IIFE to avoid conflicts
(function() {
    'use strict';

    let pollOptionCount = 2;

    function addPollOption() {
        try {
            if (pollOptionCount >= 10) {
                alert('Maximum 10 options allowed');
                return;
            }

            pollOptionCount++;
            const container = document.getElementById('poll-options-container');
            if (!container) {
                console.error('Poll options container not found');
                return;
            }

            const newOption = document.createElement('div');
            newOption.className = 'poll-option-input mb-2 flex items-center';
            newOption.innerHTML = `
                <input type="text" name="options[]" placeholder="Option ${pollOptionCount}" maxlength="255" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-white dark:border-gray-300 dark:placeholder-blue-400 dark:text-blue-800 dark:focus:ring-blue-500 dark:focus:border-blue-500 mr-2" required>
                <button type="button" class="remove-option-btn text-red-600 hover:text-red-800 p-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </button>
            `;
            container.appendChild(newOption);

            // Add event listener to the remove button
            const removeBtn = newOption.querySelector('.remove-option-btn');
            if (removeBtn) {
                removeBtn.addEventListener('click', function() {
                    removePollOption(this);
                });
            }
        } catch (error) {
            console.error('Error adding poll option:', error);
        }
    }

    function removePollOption(button) {
        try {
            if (pollOptionCount <= 2) {
                alert('Minimum 2 options required');
                return;
            }

            const optionDiv = button.closest('.poll-option-input');
            if (optionDiv) {
                optionDiv.remove();
                pollOptionCount--;

                // Update placeholder numbers
                const options = document.querySelectorAll('#poll-options-container input[name="options[]"]');
                options.forEach((input, index) => {
                    input.placeholder = `Option ${index + 1}`;
                });
            }
        } catch (error) {
            console.error('Error removing poll option:', error);
        }
    }

    // Initialize when DOM is ready
    document.addEventListener('DOMContentLoaded', function() {
        try {
            // Add event listener to the add option button
            const addBtn = document.getElementById('add-poll-option-btn');
            if (addBtn) {
                addBtn.addEventListener('click', addPollOption);
            }

            // Add CSRF token meta tag if not exists
            if (!document.querySelector('meta[name="csrf-token"]')) {
                const meta = document.createElement('meta');
                meta.name = 'csrf-token';
                meta.content = '{{ csrf_token() }}';
                document.head.appendChild(meta);
            }
        } catch (error) {
            console.error('Error initializing poll functionality:', error);
        }
    });
})();
</script>

</body>

</html>
