<?php
  require_once 'config.php';
?>

<!doctype html>
<html>

<head >
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <link href="./src/output.css" rel="stylesheet">
  <link href="./src/input.css" rel="stylesheet">
  
</head>

<body >
  <!-- Color of bg, div: -->
<div class=" bg-orange-50">

<!-- Header, navigator -->
<header class="relative inset-x-0 z-50 bg-zinc-600">
    <nav class="flex items-center justify-between p-4 lg:px-8" aria-label="Global">
      <div class="flex lg:flex-1">
        <!-- Logo placeholder -->
        <a href="index.php" class="-m-1.5 p-1.5">
          <span class="sr-only">urmom</span> <!-- Screenreader-only -->
          <img class="h-8 w-auto" src="img/seal.gif" alt="#">
        </a>
      </div>
      <div class="flex lg:hidden">
        <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
          <span class="sr-only">Open main menu</span> <!-- Screenreader-only -->
          <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
        </button>
      </div>
      <div class="hidden lg:flex lg:gap-x-12">
          <a href="#" class="text-xl font-semibold leading-6 text-white">Tutorial</a>
          <a href="#" class="text-xl font-semibold leading-6 text-white">Credits</a>
          <a href="#" class="text-xl font-semibold leading-6 text-white">FAQ</a>
          <a href="#" class="text-xl font-semibold leading-6 text-white">Help</a>
      </div>
      <div class="hidden lg:flex lg:flex-1 lg:justify-end">
        <a href="loginpg.php" class="text-sm font-semibold leading-6 text-white">Log in <span aria-hidden="true">&rarr;</span></a>
      </div>

      

    </nav>

    <!-- Mobile menu, show/hide based on menu open state. -->
    <div class="lg:hidden" role="dialog" aria-modal="true">
      <!-- Background backdrop, show/hide based on slide-over state. -->
      <div class="fixed inset-0 z-50"></div>
      <div class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
        <div class="flex items-center justify-between">
          <a href="#" class="-m-1.5 p-1.5">
            <span class="sr-only">Your Company</span>
            <img class="h-8 w-auto" src="#" alt="urmom">
          </a>
          <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700">
            <span class="sr-only">Close menu</span>
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </button>
        </div>
        <div class="mt-6 flow-root">
          <div class="-my-6 divide-y divide-gray-500/10">
            <div class="space-y-2 py-6">
              <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Tutorial</a>
              <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Credits</a>
              <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">FAQ</a>
              <a href="#" class="-mx-3 block rounded-lg px-3 py-2 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Help</a>
            </div>
            <div class="py-6">
              <a href="loginpg.php" class="-mx-3 block rounded-lg px-3 py-2.5 text-base font-semibold leading-7 text-gray-900 hover:bg-gray-50">Log in</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>

<!-- Innhold ellerno -->
  <div class="relative isolate px-6 pt-0 lg:px-8">
    
    <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-36">
      <div class="hidden sm:mb-8 sm:flex sm:justify-center">
        <div class="relative rounded-full px-3 py-1 text-sm leading-6 text-gray-900 ring-1 ring-gray-400 hover:ring-gray-900 bg-white">
          Don't have an account yet?  <a href="registration.php" class="font-semibold text-indigo-600"><span class="absolute inset-0" aria-hidden="true"></span>Sign up now!<span aria-hidden="true">&rarr;</span></a>
        </div>
      </div>
      <div class="text-center">
        <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">Domain expansion: infinite backshots</h1>
        <p class="mt-6 text-lg leading-8 text-gray-600">Anim aute id magna aliqua ad ad non deserunt sunt. Qui irure qui lorem cupidatat commodo. Elit sunt amet fugiat veniam occaecat fugiat aliqua. ok info abt game hurray short summary blablaabl. miau something</p>
        <div class="mt-10 flex items-center justify-center gap-x-6">
          <a href="loginpg.php" class="rounded-md bg-zinc-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-zinc-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-zinc-400 " >Log in</a>
          <a href="#" class="text-sm font-semibold leading-6 text-gray-900">Sign up <span aria-hidden="true">→</span></a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- pop up window idk why not -->
<div id="info-popup" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 w-full md:inset-0 h-modal md:h-full">
  <div class="relative p-4 w-full max-w-lg h-full md:h-auto">
      <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 md:p-8">
          <div class="mb-4 text-sm font-light text-gray-500 dark:text-gray-400">
              <h3 class="mb-3 text-2xl font-bold text-gray-900 dark:text-white">Privacy info</h3>
              <p>
                  The backup created with this export functionnality may contain some sensitive data. We suggest you to save this archive in a securised location.
              </p>
          </div>
          <div class="justify-between items-center pt-0 space-y-4 sm:flex sm:space-y-0">
              <a href="#" class="font-medium text-primary-600 dark:text-primary-500 hover:underline">Learn more about privacy</a>
              <div class="items-center space-y-4 sm:space-x-4 sm:flex sm:space-y-0">
                  <button id="close-modal" type="button"  class="py-2 px-4 w-full text-sm font-medium text-gray-500 bg-white rounded-lg border border-gray-200 sm:w-auto hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-primary-300 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">Cancel</button>
                  <button id="confirm-button" type="button" class="py-2 px-4 w-full text-sm font-medium text-center text-white rounded-lg bg-primary-700 sm:w-auto hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Confirm</button>
              </div>
          </div>
      </div>
  </div>
</div>

<!-- Footer, contact whateva -->
<footer class="text-white shadow  bg-zinc-600">
    <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
    <div class="sm:flex sm:items-center sm:justify-between">
      <a href="#" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
          <img src="img/seal.gif" class="h-8" alt="logo-placeholder" />
          <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">yourmom</span>
      </a>
        <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-gray-300 sm:mb-0 dark:text-gray-200">
          <li>
              <a href="#" class="hover:underline me-4 md:me-6">About</a>
          </li>
          <li>
            
              <a href="#" class="hover:underline me-4 md:me-6">FAQ</a>
          </li>
          <li>
              <a href="#" class="hover:underline me-4 md:me-6">Credits</a>
          </li>
          <li>
              <a href="#" class="hover:underline">Contact</a>
          </li>
        </ul>
      </div>
    <hr class="my-3 border-gray-200 sm:mx-auto  dark:border-white lg:my-3" />
      <span class="text-sm text-white sm:text-center dark:text-gray-200">© C for Cat miau <a href="#" class="hover:underline">Yourmom™</a>. All Rights Reserved. </span>
    </div>
</footer>



<script src="script.js"></script>


</body>
</html>