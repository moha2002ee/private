<?php
include_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();

// Fetch Matiere Data
$query = "SELECT id, name FROM matiere";
$stmt = $db->prepare($query);
$stmt->execute();
$matieres = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch Prof Data
$query = "SELECT id, name FROM prof";
$stmt = $db->prepare($query);
$stmt->execute();
$profs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Synthèse</title>
    <link rel="stylesheet" href="../synthese.css">
</head>
<body>
<div class="form-container dark">
    <?php include 'menu_synthese.php'; ?>
    <div class="form-box">
        <h2>Ajouter une Synthèse</h2>
        <form action="process_synthese.php" method="post" enctype="multipart/form-data">
            <label for="title">Titre</label>
            <input id="title" name="title" placeholder="Titre de la synthèse" type="text" required>
            
            <label for="subject">Matière</label>
            <select id="subject" name="subject" required>
                <?php foreach ($matieres as $matiere): ?>
                    <option value="<?php echo htmlspecialchars($matiere['id']); ?>"><?php echo htmlspecialchars($matiere['name']); ?></option>
                <?php endforeach; ?>
            </select>
            
            <label for="prof">Professeur</label>
            <select id="prof" name="prof" required>
                <?php foreach ($profs as $prof): ?>
                    <option value="<?php echo htmlspecialchars($prof['id']); ?>"><?php echo htmlspecialchars($prof['name']); ?></option>
                <?php endforeach; ?>
            </select>
            
            <label for="file">Fichier</label>
            <input id="file" name="file" type="file" required>
            
            <label for="description">Description</label>
            <textarea id="description" name="description" placeholder="Description de la synthèse" required></textarea>
            
            <button type="submit">Ajouter</button>
        </form>
    </div>
</div>
</body>
</html>