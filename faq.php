<?php

require_once 'config.php';
include 'include/db.connection.php';

// Start the session
if(isset($_SESSION['username'])){ 
  $username = $_SESSION['username'];
} else {
  header('location:index.php');
}

// Fetch FAQ entries from the database
$faqEntries = $pdo->query("SELECT * FROM faq")->fetchAll(PDO::FETCH_ASSOC);

?>

<!doctype html>
<html>

<head>
  <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="./src/output.css" rel="stylesheet">
  <link href="./src/input.css" rel="stylesheet">
</head>

<body class="bg-orange-50">

  <!-- Header, navigator -->
  <header class="relative inset-x-0 z-50 bg-zinc-600">
    <nav class="flex items-center justify-between p-4 lg:px-8" aria-label="Global">
      <div class="flex lg:flex-1">
        <!-- Logo placeholder -->
        <a href="mainpage.php" class="-m-1.5 p-1.5">
          <span class="sr-only">urmom</span> <!-- Screenreader-only -->
          <img class="h-8 w-auto" src="#" alt="#">
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
            <a href="tutorial.php" class="text-xl font-semibold leading-6 text-white">Tutorial</a>
            <a href="faq.php" class="text-xl font-semibold leading-6 text-white">FAQ</a>
            <a href="game.php" class="text-xl font-semibold leading-6 text-white">Game</a>
            <a href="profile.php" class="text-xl font-semibold leading-6 text-white">Profile</a>
        </div>
      <div class="hidden lg:flex lg:flex-1 lg:justify-end">
        <a href="include/logout.php" class="text-sm font-semibold leading-6 text-white">Log out <span aria-hidden="true">&rarr;</span></a>
      </div>
    </nav>

    <!-- Mobile menu, show/hide based on menu open state. -->
    <div class="lg:hidden" role="dialog" aria-modal="true">
      <!-- Background backdrop, show/hide based on slide-over state. -->
      <div class="fixed inset-0 z-50"></div>
      <div class="fixed inset-y-0 right-0 z-50 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
        <div class="flex items-center justify-between">
          <a href="#" class="-m-1.5 p-1.5">
            <span class="sr-only"></span>
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

  <div class="container mx-auto px-6 lg:px-8">
    <div class="mx-auto max-w-2xl py-12 sm:py-24 lg:py-20">
        <div class="hidden sm:flex sm:justify-center mb-8">
            <div class="rounded-full px-3 py-1 text-sm leading-6 text-gray-900 ring-1 ring-gray-400 hover:ring-gray-900 bg-white">
              Frequently asked questions:
            </div>
        </div>
        <div class="text-center">
            <!-- FAQ section -->
            <div class="py-12">
                <div class="max-w-4xl mx-auto">
                <div class="accordion" id="faqAccordion">
    <?php foreach ($faqEntries as $faq): ?>
    <div class="accordion-item bg-white border border-gray-300 rounded-md p-4 mb-4 transition-all duration-300">
        <h2 class="accordion-header" id="heading<?= $faq['id'] ?>">
            <button class="accordion-button text-left text-lg font-semibold" type="button" aria-expanded="false"
                aria-controls="collapse<?= $faq['id'] ?>">
                <?= $faq['question'] ?>
            </button>
        </h2>
        <div id="collapse<?= $faq['id'] ?>" class="accordion-collapse border-t mt-2 mb-10 pt-2 hidden">
            <?= $faq['answer'] ?>
        </div>
    </div>
    <?php endforeach; ?>
</div>

                </div>
            </div>
        </div>
    </div>
</div>

  <!-- Footer, contact whateva -->
  <footer class="text-white shadow  bg-zinc-600 b-0">
    <div class="w-full max-w-screen-xl mx-auto p-4 md:py-8">
    <div class="sm:flex sm:items-center sm:justify-between">
      <a href="#" class="flex items-center mb-4 sm:mb-0 space-x-3 rtl:space-x-reverse">
          <img src="img/seal.gif" class="h-8" alt="logo-placeholder" />
          <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Study or Cat Videos</span>
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
      <span class="text-sm text-white sm:text-center dark:text-gray-200">© C for Cat miau <a href="#" class="hover:underline">Study or Cat Videos™</a>. All Rights Reserved. </span>
    </div>
</footer>

  <script type="text/javascript" src="script.js" id='VisualNovelEngine'></script>
</body>

</html>
