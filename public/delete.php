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

if (!$id) {
    http_response_code(400);
    exit('Invalid task ID.');
}
$task = $taskModel->find($id);

if (!$task) {
    http_response_code(404);
    exit('Task not found.');
}

$taskModel->delete($id);

setFlash('success', 'Task deleted successfully.');

header('Location: index.php');
exit;