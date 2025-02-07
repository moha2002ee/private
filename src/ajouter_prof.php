<?php
session_start();
$message = isset($_SESSION['message']) ? $_SESSION['message'] : '';
$message_type = isset($_SESSION['message_type']) ? $_SESSION['message_type'] : '';
unset($_SESSION['message']);
unset($_SESSION['message_type']);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Professeur</title>
    <link rel="stylesheet" href="../synthese.css">
    <style>
        .message {
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 4px;
        }
        .message.success {
            background-color: #d4edda;
            color: #155724;
        }
        .message.error {
            background-color: #f8d7da;
            color: #721c24;
        }
    </style>
</head>
<body>
<div class="form-container dark">
    <?php include 'menu_synthese.php'; ?>
    <div class="form-box">
        <h2>Ajouter un Professeur</h2>
        <?php if ($message): ?>
            <div class="message <?php echo $message_type; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>
        <form action="process_prof.php" method="post">
            <label for="name">Nom</label>
            <input id="name" name="name" placeholder="Nom du professeur" type="text" required>
            <button type="submit">Ajouter</button>
        </form>
    </div>
</div>
</body>
</html>