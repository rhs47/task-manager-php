<?php

require_once __DIR__ . '/../config/bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] !== "POST") {
    header('Location: create.php');
    exit;
}

if (!verifyCsrfToken($_POST['csrf_token'] ?? null)) {
    http_response_code(403);
    exit('Invalid CSRF token.');
}

$title = trim($_POST['title'] ?? '');
$description = trim($_POST['description'] ?? '');

if ($title === '') {
    exit('Title is required.');
}

$database = new Database();
$pdo = $database->connect();

$task = new Task($pdo);

$task->create(
    $title,
    $description !== '' ? $description : null
);

header('Location: index.php');
exit;