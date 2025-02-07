<?php
session_start();
include_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = htmlspecialchars(strip_tags($_POST['id']));
    $type = htmlspecialchars(strip_tags($_POST['type']));

    switch ($type) {
        case 'prof':
            $query = "DELETE FROM prof WHERE id = :id";
            break;
        case 'matiere':
            $query = "DELETE FROM matiere WHERE id = :id";
            break;
        case 'synthese':
            // Fetch the file path to delete the file
            $query = "SELECT file_path FROM syntheses WHERE id = :id";
            $stmt = $db->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row && file_exists($row['file_path'])) {
                unlink($row['file_path']);
            }
            $query = "DELETE FROM syntheses WHERE id = :id";
            break;
        default:
            $_SESSION['message'] = "Type invalide.";
            $_SESSION['message_type'] = "error";
            header("Location: supprimer.php");
            exit();
    }

    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $id);

    if ($stmt->execute()) {
        $_SESSION['message'] = "L'élément a été supprimé avec succès.";
        $_SESSION['message_type'] = "success";
    } else {
        $_SESSION['message'] = "Désolé, une erreur s'est produite lors de la suppression de l'élément.";
        $_SESSION['message_type'] = "error";
    }

    header("Location: supprimer.php");
    exit();
}
?>