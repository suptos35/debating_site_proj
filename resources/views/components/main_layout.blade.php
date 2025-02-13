<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />

</head>

<body>


  <nav class="bg-white border-blue-200 dark:bg-blue-900">
    <div class=" flex flex-wrap items-center  p-4">
      <a href="/" class="flex items-center space-x-3 rtl:space-x-reverse">
        <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo" />
        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Kialo</span>
      </a>

      <div
        class=" text-sm font-medium text-center text-gray-500 border-b border-gray-200 dark:text-gray-400 dark:border-gray-700 ml-4 mr-5">
        <ul class="flex flex-wrap -mb-px">
          <li class="me-2">
            <a href="#"
              class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300">Profile</a>
          </li>
          <li class="me-2">
            <a href="#"
              class="inline-block p-4 text-blue-600 border-b-2 border-blue-600 rounded-t-lg active dark:text-blue-500 dark:border-blue-500"
              aria-current="page">Dashboard</a>
          </li>

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
        @if(session('user') === null)
            <a href="/login"><button type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Login</button></a>
            <a href="/register"><button type="button" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Register</button></a>
        @else
            <a href="/logout"><button type="button" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">Logout</button></a>
        @endif
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
    <p class=" text-center text-3xl text-white p-2 mx-auto py-4">Explore lskjgogj dlgj dgjsdlg</p>
    <div class=" px-4 py-4 mx-20 max-w-screen-xl">
      <div class="grid grid-cols-6 items-center justify-between mx-20">
        <button type="button"
          class="text-gray-900  border border-blue-300 focus:outline-none hover: focus:ring-4 focus:ring-gray-100 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 dark: dark:text-white dark:border-blue-600 dark:hover: dark:hover:border-gray-600 dark:focus:ring-gray-700">Light</button>
        <button type="button"
          class="text-gray-900  border border-blue-300 focus:outline-none hover: focus:ring-4 focus:ring-gray-100 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 dark: dark:text-white dark:border-blue-600 dark:hover: dark:hover:border-gray-600 dark:focus:ring-gray-700">Light</button>
        <button type="button"
          class="text-gray-900  border border-blue-300 focus:outline-none hover: focus:ring-4 focus:ring-gray-100 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 dark: dark:text-white dark:border-blue-600 dark:hover: dark:hover:border-gray-600 dark:focus:ring-gray-700">Light</button>
        <button type="button"
          class="text-gray-900  border border-blue-300 focus:outline-none hover: focus:ring-4 focus:ring-gray-100 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 dark: dark:text-white dark:border-blue-600 dark:hover: dark:hover:border-gray-600 dark:focus:ring-gray-700">Light</button>
        <button type="button"
          class="text-gray-900  border border-blue-300 focus:outline-none hover: focus:ring-4 focus:ring-gray-100 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 dark: dark:text-white dark:border-blue-600 dark:hover: dark:hover:border-gray-600 dark:focus:ring-gray-700">Light</button>
        <button type="button"
          class="text-gray-900  border border-blue-300 focus:outline-none hover: focus:ring-4 focus:ring-gray-100 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 dark: dark:text-white dark:border-blue-600 dark:hover: dark:hover:border-gray-600 dark:focus:ring-gray-700">Light</button>
        <button type="button"
          class="col-start-2 text-gray-900  border border-blue-300 focus:outline-none hover: focus:ring-4 focus:ring-gray-100 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 dark: dark:text-white dark:border-blue-600 dark:hover: dark:hover:border-gray-600 dark:focus:ring-gray-700">Light</button>
        <button type="button"
          class="text-gray-900  border border-blue-300 focus:outline-none hover: focus:ring-4 focus:ring-gray-100 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 dark: dark:text-white dark:border-blue-600 dark:hover: dark:hover:border-gray-600 dark:focus:ring-gray-700">Light</button>
        <button type="button"
          class="text-gray-900  border border-blue-300 focus:outline-none hover: focus:ring-4 focus:ring-gray-100 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 dark: dark:text-white dark:border-blue-600 dark:hover: dark:hover:border-gray-600 dark:focus:ring-gray-700">Light</button>
        <button type="button"
          class="text-gray-900  border border-blue-300 focus:outline-none hover: focus:ring-4 focus:ring-gray-100 font-medium rounded-full text-sm px-5 py-2.5 me-2 mb-2 dark: dark:text-white dark:border-blue-600 dark:hover: dark:hover:border-gray-600 dark:focus:ring-gray-700">Light</button>

      </div>
  </nav>


  {{$slot}}




<footer class="bg-white rounded-lg shadow m-4 dark:bg-blue-800">
  <div class="w-full mx-auto max-w-screen-xl p-4 md:flex md:items-center md:justify-between">
    <span class="text-sm text-white sm:text-center dark:text-white">© 2023 <a href="https://flowbite.com/" class="hover:underline">Flowbite™</a>. All Rights Reserved.
  </span>
  <ul class="flex flex-wrap items-center mt-3 text-sm font-medium text-gray-500 dark:text-white sm:mt-0">
      <li>
          <a href="#" class="hover:underline me-4 md:me-6">About</a>
      </li>
      <li>
          <a href="#" class="hover:underline me-4 md:me-6">Privacy Policy</a>
      </li>
      <li>
          <a href="#" class="hover:underline me-4 md:me-6">Licensing</a>
      </li>
      <li>
          <a href="#" class="hover:underline">Contact</a>
      </li>
  </ul>
  </div>
</footer>








  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

</body>

</html>
