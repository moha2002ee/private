<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Connexion</title>
    <link rel="stylesheet" href="styles.css"> <!-- Lien vers votre fichier CSS -->
</head>
<body>

    <section class="container">
        <div class="login-container">
            <div class="circle circle-one"></div>
            <div class="form-container">
                <img src="https://raw.githubusercontent.com/hicodersofficial/glassmorphism-login-form/master/assets/illustration.png" alt="illustration" class="illustration" />
                <h1 class="opacity">LOGIN</h1>
                <?php if (isset($_GET['error'])): ?>
                    <p class="error-message"><?php echo htmlspecialchars($_GET['error']); ?></p>
                <?php endif; ?>
                <form action="src/login.php" method="post">
                    <input type="text" name="username" placeholder="USERNAME" required />
                    <input type="password" name="password" placeholder="PASSWORD" required />
                    <button type="submit" class="opacity">SUBMIT</button>
                </form>
                <div class="register-forget opacity">
                    <a href="src/register.php">REGISTER</a>
                    <a href="#">FORGOT PASSWORD</a>
                </div>
            </div>
            <div class="circle circle-two"></div>
        </div>
        <div class="theme-btn-container"></div>
    </section>

    <script src="scripts.js"></script> <!-- Lien vers votre fichier JavaScript -->
</body>
</html>