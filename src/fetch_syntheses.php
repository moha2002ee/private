<?php
require_once 'config/database.php';

$database = new Database();
$db = $database->getConnection();

$query = "SELECT * FROM syntheses";
$stmt = $db->prepare($query);
$stmt->execute();

$syntheses = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($syntheses);
?>