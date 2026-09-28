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
    <title>Edit Task</title>
</head>
<body>
    <h1>Edit Task</h1>
    <form method="POST" action="update.php">
        <input
            type="hidden"
            name="csrf_token"
            value="<?= htmlspecialchars(csrfToken()) ?>"
        >
        <input type="hidden" name="id" value="<?= htmlspecialchars($task['id']) ?>">
        <div>
            <label for="title">Title</label>

            <input type="text" id="title" name="title" 
                value="<?= htmlspecialchars($task['title']) ?>"
                required
            >
        </div>

        <br>

        <div>
            <label for="description">Description</label>

            <textarea id="description" name="description" rows="5">
                <?= htmlspecialchars($task['description'] ?? '') ?>
            </textarea>
        </div>

        <br>

        <div>
            <label for="status">Status</label>

            <select id="status" name="status">
                <option
                    value="pending"
                    <?= $task['status'] === 'pending' ? 'selected' : '' ?>
                >
                    Pending
                </option>

                <option
                    value="completed"
                    <?= $task['status'] === 'completed' ? 'selected' : '' ?>
                >
                    Completed
                </option>
            </select>
        </div>

        <br>

        <button type="submit">Update Task</button>
    </form>

    <p>
        <a href="show.php?id=<?= urlencode($task['id']) ?>">
            Cancel
        </a>
    </p>
</body>
</html>