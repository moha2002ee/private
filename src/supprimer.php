<?php
session_start();
include_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();

// Fetch Prof Data
$query = "SELECT id, name FROM prof";
$stmt = $db->prepare($query);
$stmt->execute();
$profs = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch Matiere Data
$query = "SELECT id, name FROM matiere";
$stmt = $db->prepare($query);
$stmt->execute();
$matieres = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch Synthese Data
$query = "SELECT id, title, file_path FROM syntheses";
$stmt = $db->prepare($query);
$stmt->execute();
$syntheses = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
    <title>Supprimer des Professeurs, Matières et Synthèses</title>
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
        <?php if ($message): ?>
            <div class="message <?php echo $message_type; ?>">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>
        <h2>Supprimer des Professeurs</h2>
        <form action="process_delete.php" method="post">
            <input type="hidden" name="type" value="prof">
            <select name="id" required>
                <?php foreach ($profs as $prof): ?>
                    <option value="<?php echo htmlspecialchars($prof['id']); ?>"><?php echo htmlspecialchars($prof['name']); ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Supprimer</button>
        </form>
    </div>
    <div class="form-box">
        <h2>Supprimer des Matières</h2>
        <form action="process_delete.php" method="post">
            <input type="hidden" name="type" value="matiere">
            <select name="id" required>
                <?php foreach ($matieres as $matiere): ?>
                    <option value="<?php echo htmlspecialchars($matiere['id']); ?>"><?php echo htmlspecialchars($matiere['name']); ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Supprimer</button>
        </form>
    </div>
    <div class="form-box">
        <h2>Supprimer des Synthèses</h2>
        <form action="process_delete.php" method="post">
            <input type="hidden" name="type" value="synthese">
            <select name="id" required>
                <?php foreach ($syntheses as $synthese): ?>
                    <option value="<?php echo htmlspecialchars($synthese['id']); ?>"><?php echo htmlspecialchars($synthese['title']); ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Supprimer</button>
        </form>
    </div>
</div>
</body>
</html>