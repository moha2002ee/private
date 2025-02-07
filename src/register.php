<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page d'Inscription</title>
    <link rel="stylesheet" href="../styles.css"> <!-- Lien vers votre fichier CSS -->
</head>
<body>

    <section class="container">
        <div class="login-container">
            <div class="circle circle-one"></div>
            <div class="form-container">
                <img src="https://raw.githubusercontent.com/hicodersofficial/glassmorphism-login-form/master/assets/illustration.png" alt="illustration" class="illustration" />
                <h1 class="opacity">REGISTER</h1>
                <form action="register_process.php" method="post" enctype="multipart/form-data">
                    <input type="text" name="username" placeholder="USERNAME" required />
                    <input type="password" name="password" placeholder="PASSWORD" required />
                    <input type="password" name="confirm_password" placeholder="CONFIRM PASSWORD" required />
                    <input type="file" name="profile_image" accept="image/*" required />
                    <button type="submit" class="opacity">SUBMIT</button>
                </form>
                <div class="register-forget opacity">
                    <a href="../index.php">LOGIN</a>
                </div>
            </div>
            <div class="circle circle-two"></div>
        </div>
        <div class="theme-btn-container"></div>
    </section>
    <script src="../scripts.js"></script> <!-- Lien vers votre fichier JavaScript -->

</body>
</html>