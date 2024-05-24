<?php
include 'include/db.connection.php';
require_once 'config.php';

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header('Location: index.php');
    exit;
}

$username = $_SESSION['username'];

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $new_nickname = $_POST['nickname'];
    $new_email = $_POST['email'];

    $stmt = $pdo->prepare('UPDATE users SET kallenavn = ?, email = ? WHERE username = ?');
    $stmt->execute([$new_nickname, $new_email, $username]);

    // Refresh user data
    header("Location: profile.php");
    exit;
}

// Fetch user data
$stmt = $pdo->prepare('SELECT * FROM users WHERE username = ?');
$stmt->execute([$username]);
$user = $stmt->fetch();

if (!$user) {
    echo "User not found.";
    exit;
}

// Fetch user inventory
$stmt = $pdo->prepare('
    SELECT i.name, i.rarity, ui.quantity
    FROM user_inventory ui
    JOIN items i ON ui.itemid = i.item_id
    WHERE ui.user_id = ?
');
$stmt->execute([$user['user_id']]);
$inventory = $stmt->fetchAll();

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
    </header>

    <!-- Content -->
    <div class="relative px-6 pt-8 lg:px-8 flex-grow">
      <div class="mx-auto max-w-2xl py-16 sm:py-24 lg:py-32">
        <h2 class="text-3xl font-bold text-gray-800 text-center">Profile</h2>
        <div class="mt-8 space-y-6">
          <div>
            <h3 class="text-2xl font-semibold text-gray-700">User Information</h3>
            <p><strong>Username:</strong> <?= htmlspecialchars($user['username']) ?></p>
            <p><strong>Money:</strong> <?= htmlspecialchars($user['money']) ?></p>
            <p><strong>Current Page:</strong> <?= htmlspecialchars($user['current_page']) ?></p>
          </div>
          <div>
            <h3 class="text-2xl font-semibold text-gray-700">Edit Profile</h3>
            <form action="profile.php" method="post" class="space-y-4">
              <div>
                <label for="nickname" class="block text-sm font-medium text-gray-700">Nickname</label>
                <input type="text" name="nickname" id="nickname" value="<?= htmlspecialchars($user['kallenavn']) ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
              </div>
              <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" value="<?= htmlspecialchars($user['email']) ?>" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
              </div>
              <div>
                <button type="submit" class="w-full inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-black bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Update Profile</button>
              </div>
            </form>
          </div>
          <div>
            <h3 class="text-2xl font-semibold text-gray-700">Inventory</h3>
            <?php if ($inventory): ?>
              <ul class="mt-2 space-y-2">
                <?php foreach ($inventory as $item): ?>
                  <li>
                    <span class="font-medium"><?= htmlspecialchars($item['name']) ?></span>
                    (<?= htmlspecialchars($item['rarity']) ?>) - 
                    Quantity: <?= htmlspecialchars($item['quantity']) ?>
                  </li>
                <?php endforeach; ?>
              </ul>
            <?php else: ?>
              <p class="mt-2 text-gray-600">No items in inventory.</p>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->
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
</body>
</html>
