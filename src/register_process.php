<?php
include_once 'config/database.php';
include_once 'classes/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if ($_POST['password'] !== $_POST['confirm_password']) {
    echo "Les mots de passe ne correspondent pas. Veuillez réessayer.";
    exit;
}

if (strlen($_POST['password']) < 4) {
    echo "Le mot de passe doit contenir au moins 4 caractères. Veuillez réessayer.";
    exit;
}

$user->username = $_POST['username'];
$user->password = password_hash($_POST['password'], PASSWORD_BCRYPT);

// Handle file upload
if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["profile_image"]["name"]);
    if (move_uploaded_file($_FILES["profile_image"]["tmp_name"], $target_file)) {
        $user->profile_image = $target_file;
    } else {
        $user->profile_image = null;
    }
} else {
    $user->profile_image = null;
}

if ($user->register()) {
    echo "User was registered.";
} else {
    echo "Unable to register the user. Username may already exist.";
}
?>