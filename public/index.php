<?php

require_once __DIR__ . '/../config/bootstrap.php';

$tasks = $taskModel->getAll();
$flash = getFlash();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/css/style.css">
    <title>Task Manager</title>
</head>
<body>
    <?php if ($flash): ?>
        <div class="alert <?= htmlspecialchars($flash['type']) ?>">
            <?= htmlspecialchars($flash['message']) ?>
        </div>
    <?php endif; ?>

    <h1>Task Manager</h1>
    <p><a href="create.php">Create New Task</a></p>

    <?php if (empty($tasks)): ?>

        <p>No tasks found.</p>

    <?php else: ?>
        <table border="1" cellpadding="10">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Created</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($tasks as $task): ?>
                    <tr>
                        <td><?= htmlspecialchars($task['id']) ?></td>
                        <td>
                            <a href="show.php?id=<?= urlencode($task['id']) ?>">
                                <?= htmlspecialchars($task['title']) ?>
                            </a>
                        </td>
                        <td><?= htmlspecialchars($task['status']) ?></td>
                        <td><?= htmlspecialchars($task['created_at']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>