<?php

require_once __DIR__ . '/../config/bootstrap.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

if (!verifyCsrfToken($_POST['csrf_token'] ?? null)) {
    http_response_code(403);
    exit('Invalid CSRF token.');
}

$id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

$title = trim($_POST['title'] ?? '');
$description = trim($_POST['description'] ?? '');
$status = $_POST['status'] ?? '';

if (!$id) {
    http_response_code(400);
    exit('Invalid task ID.');
}

if ($title === '') {
    exit('Title is required.');
}

$allowedStatuses = ['pending', 'completed'];

if (!in_array($status, $allowedStatuses, true)) {
    exit('Invalid status.');
}

$task = $taskModel->find($id);

if (!$task) {
    http_response_code(404);
    exit('Task not found.');
}

$taskModel->update(
    $id,
    $title,
    $description !== '' ? $description : null,
    $status
);

setFlash('success', 'Task updated successfully.');

header('Location: show.php?id=' . $id);
exit;