<?php

require_once 'config.php';
include 'include/db.connection.php';

// Start the session
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Check if the logged-in user is an admin
    try {
        $query = "SELECT role_id FROM users WHERE username = :username";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user === false || $user['role_id'] != 2) {
            // User is not an admin
            header('location: mainpage.php');
            exit;
        }
    } catch (PDOException $e) {
        echo "Something went wrong, please try again! Error message: " . $e->getMessage();
        exit;
    }
} else {
    header('location: index.php');
    exit;
}

$jsonFile = 'VNData.json';

// Read JSON data
function readJson($file) {
    if (file_exists($file)) {
        $json = file_get_contents($file);
        return json_decode($json, true);
    }
    return [];
}

// Write JSON data
function writeJson($file, $data) {
    $json = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents($file, $json);
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];
    $jsonData = readJson($jsonFile);

    if ($action == 'addPage' || $action == 'editPage') {
        $scene = $_POST['scene'];
        $page = $_POST['page'];
        $character = $_POST['character'];
        $sprite = $_POST['sprite'];
        $pageText = $_POST['pageText'];

        $jsonData[$scene]['PAGES'][$page] = [
            'Character' => $character,
            'Sprite' => $sprite,
            'PageText' => $pageText,
        ];
    } elseif ($action == 'deletePage') {
        $scene = $_POST['scene'];
        $page = $_POST['page'];

        unset($jsonData[$scene]['PAGES'][$page]);
    } elseif ($action == 'addCharacter') {
        $characterName = $_POST['characterName'];
        $characterDescription = $_POST['characterDescription'];

        if (!isset($jsonData['CHARACTERS'])) {
            $jsonData['CHARACTERS'] = [];
        }

        $jsonData['CHARACTERS'][$characterName] = [
            'Description' => $characterDescription,
            'Sprites' => []
        ];
    }

    writeJson($jsonFile, $jsonData);
    header("Location: changedia.php");
    exit;
}

// Handle file upload
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['spriteFile'])) {
    $characterName = $_POST['characterName'];
    $emotion = $_POST['emotion'];
    $uploadDir = 'uploads/';

    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $uploadFile = $uploadDir . basename($_FILES['spriteFile']['name']);

    if (move_uploaded_file($_FILES['spriteFile']['tmp_name'], $uploadFile)) {
        $jsonData = readJson($jsonFile);

        if (!isset($jsonData['CHARACTERS'][$characterName]['Sprites'])) {
            $jsonData['CHARACTERS'][$characterName]['Sprites'] = [];
        }

        $jsonData['CHARACTERS'][$characterName]['Sprites'][$emotion] = $uploadFile;

        writeJson($jsonFile, $jsonData);
        header("Location: admin.php");
        exit;
    } else {
        echo "File upload failed.";
    }
}

$jsonData = readJson($jsonFile);
?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="./src/output.css" rel="stylesheet">
    <link href="./src/input.css" rel="stylesheet">
</head>
<body>
<div class="bg-orange-50 min-h-screen flex flex-col">

    <header class="relative inset-x-0 z-50 bg-zinc-600">
        <nav class="flex items-center justify-between p-4 lg:px-8" aria-label="Global">
            <div class="flex lg:flex-1">
                <a href="mainpage.php" class="-m-1.5 p-1.5">
                    <span class="sr-only">urmom</span>
                    <img class="h-8 w-auto" src="#" alt="#">
                </a>
            </div>
            <div class="flex lg:hidden">
                <button type="button" class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700">
                    <span class="sr-only">Open main menu</span>
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
                <a href="include/logout.php" class="text-sm font-semibold leading-6 text-white">Log out <span aria-hidden="true">&rarr;</span></a>
            </div>
        </nav>
    </header>

    <main class="flex-grow flex items-center justify-center py-16">
        <div class="max-w-4xl w-full bg-white rounded-lg shadow-lg p-8 space-y-8">
            <h1 class="text-4xl font-bold text-gray-900 text-center">Admin Interface</h1>
            <p class="text-lg leading-8 text-gray-600 text-center">Manage your story content here.</p>

            <section>
                <h2 class="text-2xl font-bold text-gray-900">Add/Edit Page</h2>
                <form method="POST" class="space-y-6 mt-4">
                    <input type="hidden" name="action" value="editPage">
                    <div>
                        <label for="scene" class="block text-sm font-medium text-gray-700">Scene:</label>
                        <input type="text" name="scene" id="scene" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label for="page" class="block text-sm font-medium text-gray-700">Page:</label>
                        <input type="text" name="page" id="page" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label for="character" class="block text-sm font-medium text-gray-700">Character:</label>
                        <input type="text" name="character" id="character" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label for="sprite" class="block text-sm font-medium text-gray-700">Sprite:</label>
                        <input type="text" name="sprite" id="sprite" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label for="pageText" class="block text-sm font-medium text-gray-700">Page Text:</label>
                        <textarea name="pageText" id="pageText" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-zinc-600 text-white py-2 px-4 rounded-md">Submit</button>
                </form>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-gray-900">Delete Page</h2>
                <form method="POST" class="space-y-6 mt-4">
                    <input type="hidden" name="action" value="deletePage">
                    <div>
                        <label for="sceneDelete" class="block text-sm font-medium text-gray-700">Scene:</label>
                        <input type="text" name="scene" id="sceneDelete" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label for="pageDelete" class="block text-sm font-medium text-gray-700">Page:</label>
                        <input type="text" name="page" id="pageDelete" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <button type="submit" class="w-full bg-red-600 text-white py-2 px-4 rounded-md">Delete</button>
                </form>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-gray-900">Add Character</h2>
                <form method="POST" class="space-y-6 mt-4">
                    <input type="hidden" name="action" value="addCharacter">
                    <div>
                        <label for="characterName" class="block text-sm font-medium text-gray-700">Character Name:</label>
                        <input type="text" name="characterName" id="characterName" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label for="characterDescription" class="block text-sm font-medium text-gray-700">Character Description:</label>
                        <textarea name="characterDescription" id="characterDescription" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                    </div>
                    <button type="submit" class="w-full bg-zinc-600 text-white py-2 px-4 rounded-md">Submit</button>
                </form>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-gray-900">Upload Character Sprite</h2>
                <form method="POST" enctype="multipart/form-data" class="space-y-6 mt-4">
                    <div>
                        <label for="characterNameUpload" class="block text-sm font-medium text-gray-700">Character Name:</label>
                        <input type="text" name="characterName" id="characterNameUpload" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label for="emotion" class="block text-sm font-medium text-gray-700">Emotion:</label>
                        <input type="text" name="emotion" id="emotion" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <div>
                        <label for="spriteFile" class="block text-sm font-medium text-gray-700">Sprite File:</label>
                        <input type="file" name="spriteFile" id="spriteFile" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                    </div>
                    <button type="submit" class="w-full bg-zinc-600 text-white py-2 px-4 rounded-md">Upload</button>
                </form>
            </section>

            <section>
                <h2 class="text-2xl font-bold text-gray-900">Current Story Data</h2>
                <pre class="bg-gray-100 p-4 rounded-md mt-4 overflow-x-auto"><?php echo json_encode($jsonData, JSON_PRETTY_PRINT); ?></pre>
            </section>
        </div>
    </main>

    <footer class="text-white shadow bg-zinc-600">
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
            <hr class="my-3 border-gray-200 sm:mx-auto dark:border-white lg:my-3" />
            <span class="text-sm text-white sm:text-center dark:text-gray-200">© C for Cat miau <a href="#" class="hover:underline">Yourmom™</a>. All Rights Reserved.</span>
        </div>
    </footer>

</div>
<script type="text/javascript" src="script.js" id='VisualNovelEngine'></script>
</body>
</html>
