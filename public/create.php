<?php

require_once __DIR__ . '/../config/Database.php';
require_once __DIR__ . '/../classes/Task.php';

$database = new Database();
$pdo = $database->connect();

$task = new Task($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style.css">
    <title>Create Task</title>
</head>
<body>
    <h1>Create Task</h1>

    <form action="store.php" method="post">
        <input
            type="hidden"
            name="csrf_token"
            value="<?= htmlspecialchars(csrfToken()) ?>"
        >
        <div>
            <label for="title">Title:</label><br>
            <input type="text" id="title" name="title" required>
        </div>

        <br>

        <div>
            <label for="description">Description:</label><br>
            <textarea name="description" id="description" rows="5"></textarea>
        </div>

        <br>

        <button type="submit">Create Task</button>
    </form>
</body>
</html>