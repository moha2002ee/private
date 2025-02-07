<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    header("Location: ../index.php");
    exit();
}

include_once 'config/database.php';
include_once 'classes/User.php';

// Establish database connection
$database = new Database();
$db = $database->getConnection();

// Retrieve user information
$user = new User($db);
$user->username = $_SESSION['username'];

$query = "SELECT profile_image FROM " . $user->getTableName() . " WHERE username = :username LIMIT 0,1";
$stmt = $db->prepare($query);
$stmt->bindParam(':username', $user->username, PDO::PARAM_STR);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

// Define a default image if none is set
$profile_image = !empty($row['profile_image']) ? 'uploads/' . htmlspecialchars($row['profile_image']) : 'default_profile_image.jpg';

// Debugging output
echo "<!-- Profile Image Path: " . htmlspecialchars($profile_image) . " -->";
?>

<input type="checkbox" id="burger-toggle">
<label for="burger-toggle" class="burger-menu">
    <div class="line"></div>
    <div class="line"></div>
    <div class="line"></div>
</label>
<div class="menu">
    <div class="utilisateur-image">
        <h1 class="utilisateur-nom"><?php echo htmlspecialchars($user->username); ?></h1>
        <img src="<?php echo htmlspecialchars($profile_image); ?>" alt="Profil de <?php echo htmlspecialchars($user->username); ?>">
    </div>
    <div class="menu-inner">
        <?php include 'navbar.php'; ?>
        <div class="gallery">
            <div class="title">
                <p>By <?php echo htmlspecialchars($user->username); ?></p>
            </div>
            <div class="images">
                <a class="image-link" href="#"><div class="image" data-label="Star"><img src="https://i.loli.net/2019/11/23/cnKl1Ykd5rZCVwm.jpg" alt=""></div></a>
                <a class="image-link" href="#"><div class="image" data-label="Sun"><img src="https://i.loli.net/2019/11/16/FLnzi5Kq4tkRZSm.jpg" alt=""></div></a>
                <a class="image-link" href="#"><div class="image" data-label="Tree"><img src="https://i.loli.net/2019/10/18/uXF1Kx7lzELB6wf.jpg" alt=""></div></a>
                <a class="image-link" href="#"><div class="image" data-label="Sky"><img src="https://i.loli.net/2019/10/18/buDT4YS6zUMfHst.jpg" alt=""></div></a>
            </div>
        </div>
    </div>
</div>