<!DOCTYPE html>
<html>
<head>
    <title>Responses</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid black;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Responses</h1>
    <?php if (!empty($responses)): ?>
        <table>
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Total Price</th>
                    <th>Response</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($responses as $response): ?>
                    <tr>
                        <td><?= esc($response['products']) ?></td>
                        <td><?= esc($response['total_price']) ?></td>
                        <td><?= esc($response['response']) ?></td>
                        <td><?= esc($response['created_at']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No responses available.</p>
    <?php endif; ?>
</body>
</html>
