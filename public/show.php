<?php

require_once __DIR__ . '/../config/bootstrap.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id) {
    http_response_code(400);
    exit('Invalid task ID.');
}

$task = $taskModel->find($id);

if (!$task) {
    http_response_code(404);
    exit('Task not found.');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style.css">
    <title><?= htmlspecialchars($task['title']) ?></title>
</head>
<body>
    <p><a href="index.php">← Back to Tasks</a></p>

    <h1><?= htmlspecialchars($task['title']) ?></h1>

    <h2>Description</h2>

    <?php if (!empty($task['description'])): ?>

        <p><?= nl2br(htmlspecialchars($task['description'])) ?></p>

    <?php else: ?>

        <p>No description provided.</p>

    <?php endif; ?>

    <p>
        <a href="edit.php?id=<?= urlencode($task['id']) ?>">
            Edit Task
        </a>
    </p>

    <form
        method="POST"
        action="delete.php"
        onsubmit="return confirm('Are you sure you want to delete this task?');"
    >
        <input
            type="hidden"
            name="csrf_token"
            value="<?= htmlspecialchars(csrfToken()) ?>"
        >
        <input
            type="hidden"
            name="id"
            value="<?= htmlspecialchars($task['id']) ?>"
        >

        <button type="submit">Delete Task</button>
    </form>

    <p>
        <strong>Status:</strong>
        <?= htmlspecialchars($task['status']) ?>
    </p>

    <p>
        <strong>Created:</strong>
        <?= htmlspecialchars($task['created_at']) ?>
    </p>

    <p>
        <strong>Last Updated:</strong>
        <?= htmlspecialchars($task['updated_at']) ?>
    </p>

</body>
</html>