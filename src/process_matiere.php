<?php
session_start();
include_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate and sanitize input data
    $name = htmlspecialchars(strip_tags($_POST['name']));

    // Insert data into database
    $query = "INSERT INTO matiere (name) VALUES (:name)";
    $stmt = $db->prepare($query);

    // Bind parameters
    $stmt->bindParam(':name', $name);

    if ($stmt->execute()) {
        $_SESSION['message'] = "La matière a été ajoutée avec succès.";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Désolé, une erreur s'est produite lors de l'ajout de la matière.";
        $_SESSION['message_type'] = "error";
    }

    header("Location: ajouter_matieres.php");
    exit();
}
?>