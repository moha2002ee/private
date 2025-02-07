<?php
session_start();
include_once 'config/database.php';
include_once 'classes/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

$user->username = $_POST['username'];
$user->password = $_POST['password'];

if ($user->login()) {
    $_SESSION['username'] = $user->username;
    $_SESSION['profile_image'] = $user->profile_image; // Store profile image path in session
    header("Location: dashboard.php");
    exit();
} else {
    $error_message = "Invalid username or password.";
    header("Location: ../index.php?error=" . urlencode($error_message));
    exit();
}
?>