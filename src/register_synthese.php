<?php
include_once 'config/database.php';

function getSyntheses($db) {
    $query = "SELECT * FROM syntheses";
    $stmt = $db->prepare($query);
    $stmt->execute();

    $syntheses = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $syntheses;
}

// Example usage
$database = new Database();
$db = $database->getConnection();
$syntheses = getSyntheses($db);

foreach ($syntheses as $synthese) {
    echo "Title: " . htmlspecialchars($synthese['title']) . "<br>";
    echo "Description: " . htmlspecialchars($synthese['description']) . "<br>";
    echo "File Path: " . htmlspecialchars($synthese['file_path']) . "<br>";
    echo "Created At: " . htmlspecialchars($synthese['created_at']) . "<br><br>";
}
?>