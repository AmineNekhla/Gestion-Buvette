<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Responses</title>
</head>
<body>
    <h1>Admin Responses</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Response ID</th>
                <th>Validation ID</th>
                <th>Response</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($responses)): ?>
                <?php foreach ($responses as $response): ?>
                    <tr>
                        <td><?= $response['id'] ?></td>
                        <td><?= $response['validation_id'] ?></td>
                        <td><?= $response['response'] ?></td>
                        <td><?= $response['created_at'] ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">No responses available.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
