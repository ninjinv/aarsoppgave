<?php
  require_once 'config.php';
  include 'include/db.connection.php';


if(isset($_SESSION['username'])){ 
  $username = $_SESSION['username'];
} else {
  header('location:index.php');
}


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
<header class="relative inset-x-0 z-50 bg-zinc-600 mb-14">
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
            <a href="#" class="text-xl font-semibold leading-6 text-white">Profile</a>
        </div>
        <div class="hidden lg:flex lg:flex-1 lg:justify-end">
          <a href="loginpg.php" class="text-sm font-semibold leading-6 text-white">Log in <span aria-hidden="true">&rarr;</span></a>
        </div>
      </nav>

      <!-- Mobile menu, show/hide based on menu open state. -->  <!-- Background backdrop, show/hide based on slide-over state. -->
      <!-- <div class="lg:hidden" role="dialog" aria-modal="true">
       
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
      </div> -->
    </header>

<!-- Innhold ellerno på pc -->

<div class="relative">
  <div class="container m-auto grid grid-cols-12 grid-rows-6 gap-1 relative isolate px-6">

    <div class="col-start-3 col-end-11 row-start-1 row-end-5 tile bg-orange-900 h-96 grid grid-cols-12 grid-rows-12 gap-5">
        <img class="object-fill col-start-1 col-end-12" src="#" alt="Do ma">

        <div class="z-50 col-start-1 col-end-13 row-start-8 row-end-13 tile bg-neutral-500"> <!-- grid grid-cols-10 grid-rows-10 -->
          <div id="spritebox" class="">
              <img src="#" alt="character sprite/feeling">
          </div>

          <div id="namebox">
              <span>Loading...</span>
          </div>

          <div id="textbox">
              <p>Loading...</p>
          </div>
          
          <!-- <div >
              Options will be dynamically added here
          </div> -->

          <div id="optionsbox" class="col-start-1 col-end-11 grid cols-12 gap-3">
              <button>loading</button>
          </div>
          
        </div>
        
    </div>

    <div class="col-start-1 col-end-3 row-start-5 row-end-7 bg-gray-500 ">
      <div class="tile">
        <h3 class="text-center flex justify-center items-center ">Your stats:</h3>
        <div class="px-3">
          <table class="text-wrap">
            <tr><td>urmom</td></tr>
            <tr><td>urmom</td></tr>
            <tr><td>urmom</td></tr>
            <tr><td>urmom</td></tr>
            <tr><td>urmom</td></tr>
            <tr><td>moneee eeeeeey</td></tr>
          </table>
        </div>
      </div>
    </div>

    <div class="col-start-3 col-end-11 row-start-5 row-end-7 tile bg-orange-700 container m-auto grid cols-12 gap-3 p-5">
          <div id="optionsbox" class="col-start-1 col-end-11 grid cols-12 gap-3">
              <button class="p-2 col-start-1 col-end-3 tile bg-orange-500" onclick="wtf()">69sss</button>
              <button class="p-2 col-start-5 col-end-7 tile bg-orange-500" onclick="wtf2()">urmom</button>
          </div>
        
    </div>        
    
  </div>
  
</div>

<!-- Footer, contact whateva -->
<footer class="text-white shadow relative inset-x-0 z-50 bg-zinc-600 mt-14">
    <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
    <div class="sm:flex sm:items-center sm:justify-between">
      <a href="#" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
          <img src="img/seal.gif" class="h-8" alt="logo-placeholder" />
          <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">yourmom</span>
      </a>
        <ul class="flex flex-wrap items-center mb-6 text-sm font-medium text-white sm:mb-0 dark:text-gray-200">
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
    <hr class="my-3 border-gray-200 sm:mx-auto  dark:border-white lg:my-3 " />
      <span class="text-sm text-white sm:text-center dark:text-white">© C for Cat miau <a href="#" class="hover:underline">Yourmom™</a>. All Rights Reserved. </span>
    </div>
</footer>



</div>

<script type="text/javascript" src="script.js" id='VisualNovelEngine'></script>

</body>
</html>