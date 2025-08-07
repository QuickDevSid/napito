<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Terms & Conditions</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            line-height: 1.6;
        }
        .container {
            max-width: 800px;
            margin: auto;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        .policy-content {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .policy-item {
            margin-bottom: 20px;
        }
        .policy-item h2 {
            font-size: 1.2em;
            color: #555;
            margin-bottom: 10px;
        }
        .policy-item p {
            font-size: 1em;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Terms & Conditions</h1>
        <div class="policy-content">
            <?php $i = 1; if (!empty($data)): ?>
                <?php foreach ($data as $policy): ?>
                    <div class="policy-item">
                        <p><b><?=$i++;?>)</b> <?php echo nl2br(htmlspecialchars($policy->text)); ?></p>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No terms & conditions available.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
