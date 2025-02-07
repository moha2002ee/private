<?php
session_start();
include_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate and sanitize input data
    $name = htmlspecialchars(strip_tags($_POST['name']));

    // Insert data into database
    $query = "INSERT INTO prof (name) VALUES (:name)";
    $stmt = $db->prepare($query);

    // Bind parameters
    $stmt->bindParam(':name', $name);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Le professeur a été ajouté avec succès.";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Désolé, une erreur s'est produite lors de l'ajout du professeur.";
        $_SESSION['message_type'] = "error";
    }

    header("Location: ajouter_prof.php");
    exit();
}
?>