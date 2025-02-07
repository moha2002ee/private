<?php
// filepath: /c:/laragon/www/private/src/synthese.php

include_once 'config/database.php';
include_once 'register_synthese.php';

// Establish database connection
$database = new Database();
$db = $database->getConnection();

// Retrieve syntheses
$syntheses = getSyntheses($db);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../synthese.css">
</head>
<body>
    <?php include 'menu_synthese.php'; ?>
<div class="site-container">
    <?php foreach ($syntheses as $synthese) : ?>
        <div class="card">
            <h2><?php echo htmlspecialchars($synthese['title']); ?></h2>
            <p><?php echo htmlspecialchars($synthese['content']); ?></p>
        </div>
    <?php endforeach; ?>
    <script ></script>


</div>
</body>
</html>