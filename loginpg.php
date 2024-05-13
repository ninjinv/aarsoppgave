<?php
  require_once 'config.php';
  include 'include/login.php';
?>

<!doctype html>
<html class="h-full bg-white">

<head >
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./src/output.css" rel="stylesheet">
  <link href="./src/input.css" rel="stylesheet">
</head>

<body class="h-full">

<div class="relative inset-x-0 z-50 bg-orange-50">
    <header class=" bg-zinc-600">
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
          <!--boing-->
        </div>
      </nav>

      <!-- mobil meny. -->
      <div class="lg:hidden" role="dialog" aria-modal="true">
        <!-- slideeeeeeeeeeeee -->
        <div class="fixed inset-0 z-50"></div>
        <div class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
          <div class="flex items-center justify-between">
            <a href="#" class="-m-1.5 p-1.5">
              <span class="sr-only">Your Company</span> <!-- Screenreader-only -->
              <img class="h-8 w-auto" src="img/seal.gif" alt="">
            </a>
            <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700">
              <span class="sr-only">Close menu</span> <!-- Screenreader-only -->
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
                <!--boing-->
              </div>
            </div>
          </div>
        </div>
      </div>
    </header>
    

<div class="flex min-h-full flex-col justify-center pt-40 pb-20 px-6 py-12 lg:px-8">
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
      <!-- Logo placeholder -->
      <img class="mx-auto h-10 w-auto" src="img/seal.gif" alt="logo?">
      <h2 class="mt-10 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">Sign in to your account</h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
      <form class="space-y-6" action="#" method="POST">
        <div>

          <label for="text" class="block text-sm font-medium leading-6 text-gray-900">Username</label>
          <div class="mt-2">
            <input id="username" name="username" type="text" autocomplete="username" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
          </div>
        </div>

        <div>
          <div class="flex items-center justify-between">
            <label for="pwd" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
            <div class="text-sm">
              <a href="#" class="font-semibold text-indigo-600 hover:text-indigo-500">Forgot password?</a>
            </div>
          </div>

          <div class="mt-2">
            <input id="pwd" name="pwd" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
          </div>
          
        </div>

        <div>
              <button type="submit" class="flex w-full justify-center rounded-md bg-stone-500 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-stone-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Log in</button>
        </div>

      </form>

    </div>
  </div>
</div>

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


</body>
</html>