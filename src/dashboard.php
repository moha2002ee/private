<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit();
}

include_once 'config/database.php';
include_once 'classes/User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$user->username = $_SESSION['username'];

// Récupérer l'image de profil de l'utilisateur
$query = "SELECT profile_image FROM users WHERE username = :username";
$stmt = $db->prepare($query);
$stmt->bindParam(':username', $user->username, PDO::PARAM_STR);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

// Définir une image par défaut si aucune n'est enregistrée
$profile_image = !empty($row['profile_image']) ? htmlspecialchars($row['profile_image']) : 'default_profile_image.jpg';
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord</title>
    <link rel="stylesheet" href="../dashboard.css">
</head>
<body>
    <?php include 'menu.php'; ?>

    <!-- Contenu principal -->
    <div class="container">
        <div class="box">
            <div class="code">
                <div class="terminal_toolbar">
                    <div class="butt">
                        <button class="btn btn-color"></button>
                        <button class="btn"></button>
                        <button class="btn"></button>
                    </div>
                    <p class="user"><?php echo htmlspecialchars($user->username); ?> ~</p>
                </div>
                <div class="terminal_body">
                    <div class="terminal_promt">
                        <span class="terminal_user">mohaosslm2002:</span>
                        <span class="terminal_location">~</span>
                        <span class="terminal_bling">$</span>
                        <span class="terminal_cursor"></span>
                        <span id="animated-message" class="animated-message"></span>
                    </div>
                </div>
            </div>
        </div>

        <div class="box">
            <div class="card">
                <p class="time-text"><span id="current-time"></span><span class="time-sub-text" id="current-period"></span></p>
                <p class="day-text" id="current-date"></p>
                <p class="weather-text" id="weather"></p>
                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16" stroke-width="0" fill="currentColor" stroke="currentColor" class="moon">
                    <path d="M6 .278a.768.768 0 0 1 .08.858..."></path>
                    <path d="M10.794 3.148a.217.217 0 0 1 .412 0..."></path>
                </svg>
            </div>
        </div>
    </div>

    <script src="../dashboard.js"></script>
    <script src="../scripts.js"></script>
    <audio id="background-music" src="Werenoi – 5 étoiless.mp3" autoplay loop></audio>
</body>
</html>
