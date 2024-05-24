<?php
   require_once 'config.php';
   include 'include/db.connection.php';

 // Start the session
 if(isset($_SESSION['username'])){ 
   $username = $_SESSION['username'];
 } else {
   header('location:index.php');
 }



?>

<!doctype html>
<html>

<head>
  <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
  <link href="./src/output.css" rel="stylesheet">
  <link href="./src/input.css" rel="stylesheet">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
    }
    .nav-link {
      transition: color 0.3s;
    }
    .nav-link:hover {
      color: #fbbf24; /* Tailwind amber-400 */
    }
    .download-link {
      transition: background-color 0.3s, color 0.3s;
    }
    .download-link:hover {
      background-color: #fbbf24; /* Tailwind amber-400 */
      color: #1f2937; /* Tailwind gray-800 */
    }
  </style>
</head>

<body>
  <!-- Background color and container -->
  <div class="bg-orange-50 min-h-screen flex flex-col">

    <!-- Header, navigator -->
    <header class="bg-zinc-600">
      <nav class="flex items-center justify-between p-4 lg:px-8" aria-label="Global">
        <div class="flex lg:flex-1">
          <!-- Logo placeholder -->
          <a href="mainpage.php" class="flex items-center space-x-2">
            <img class="h-8 w-auto" src="#" alt="Logo">
            <span class="text-white text-xl font-semibold"></span>
          </a>
        </div>
        <div class="flex lg:hidden">
          <button type="button" class="inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
            <span class="sr-only">Open main menu</span>
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
          </button>
        </div>
        <div class="hidden lg:flex lg:gap-x-12">
            <a href="tutorial.php" class="text-xl font-semibold leading-6 text-white">Tutorial</a>
            <a href="faq.php" class="text-xl font-semibold leading-6 text-white">FAQ</a>
            <a href="game.php" class="text-xl font-semibold leading-6 text-white">Game</a>
            <a href="profile.php" class="text-xl font-semibold leading-6 text-white">Profile</a>
        </div>
        <div class="hidden lg:flex lg:flex-1 lg:justify-end">
          <a href="include/logout.php" class="text-sm font-semibold text-white">Log out <span aria-hidden="true">&rarr;</span></a>
        </div>
      </nav>

      <!-- Mobile menu, show/hide based on menu open state. -->
      <div class="lg:hidden" role="dialog" aria-modal="true">
        <div class="fixed inset-0 z-50"></div>
        <div class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
          <div class="flex items-center justify-between">
            <a href="#" class="flex items-center space-x-2">
              <img class="h-8 w-auto" src="#" alt="Your Company">
            </a>
            <button type="button" class="rounded-md p-2.5 text-gray-700">
              <span class="sr-only">Close menu</span>
              <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
          <div class="mt-6 flow-root">
            <div class="-my-6 divide-y divide-gray-500/10">
              <div class="space-y-2 py-6">
                <a href="#" class="block rounded-lg px-3 py-2 text-base font-semibold text-gray-900 hover:bg-gray-50">Tutorial</a>
                <a href="#" class="block rounded-lg px-3 py-2 text-base font-semibold text-gray-900 hover:bg-gray-50">Credits</a>
                <a href="#" class="block rounded-lg px-3 py-2 text-base font-semibold text-gray-900 hover:bg-gray-50">FAQ</a>
                <a href="#" class="block rounded-lg px-3 py-2 text-base font-semibold text-gray-900 hover:bg-gray-50">Help</a>
              </div>
              <div class="py-6">
                <a href="loginpg.php" class="block rounded-lg px-3 py-2.5 text-base font-semibold text-gray-900 hover:bg-gray-50">Log in</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Content -->
    <div class="relative px-6 pt-8 lg:px-8 flex-grow h-11 w-11">
      <div class="mx-auto max-w-2xl py-16 sm:py-24 lg:py-32 text-center">
        <h2 class="text-3xl font-bold text-gray-800">Guides</h2>
        <div class="mt-8 space-y-6">
          <div>
            <h3 class="text-2xl font-semibold text-gray-700">Sluttbruker guide</h3>
            <a href="brukerveiledning/brukerveiledning_sluttbruker.pdf" target="_blank" class="download-link inline-block mt-2 px-4 py-2 text-lg font-medium text-white bg-zinc-600 rounded-md hover:bg-amber-400 hover:text-gray-800 transition">Download Sluttbruker guide</a>
          </div>
          <div>
            <h3 class="text-2xl font-semibold text-gray-700">IT_lærling guide</h3>
            <a href="brukerveiledning/brukerveiledning_ITlaerling.pdf" target="_blank" class="download-link inline-block mt-2 px-4 py-2 text-lg font-medium text-white bg-zinc-600 rounded-md hover:bg-amber-400 hover:text-gray-800 transition">Download IT_lærling guide</a>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer, contact whateva -->
    <footer class="bg-zinc-600 text-white">
      <div class="max-w-screen-xl mx-auto p-4 md:py-8">
        <div class="sm:flex sm:items-center sm:justify-between">
          <a href="#" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
            <img src="img/seal.gif" class="h-8" alt="logo-placeholder">
            <span class="self-center text-2xl font-semibold">Study or Cat Videos</span>
          </a>
          <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-300 sm:mb-0">
            <li><a href="#" class="hover:underline me-4 md:me-6">About</a></li>
            <li><a href="#" class="hover:underline me-4 md:me-6">FAQ</a></li>
            <li><a href="#" class="hover:underline me-4 md:me-6">Credits</a></li>
            <li><a href="#" class="hover:underline">Contact</a></li>
          </ul>
        </div>
        <hr class="my-3 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-3">
        <span class="text-sm text-center block">&copy; 2024 Yourmom™. All Rights Reserved.</span>
      </div>
    </footer>
  </div>

  <script type="text/javascript" src="script.js" id="VisualNovelEngine"></script>
</body>
</html>