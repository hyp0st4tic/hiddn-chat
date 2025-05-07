<?php

require("./php/config.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Vérification que tous les champs sont présents
    if (!empty($_POST['username']) && !empty($_POST['mail']) && !empty($_POST['password'])) {

        // Nettoyage basique
        $username = htmlspecialchars(trim($_POST['username']));
        $mail = filter_var(trim($_POST['mail']), FILTER_SANITIZE_EMAIL);
        $password = $_POST['password']; // pas de htmlspecialchars ici pour le hash

        // Validation email
        if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            die("Adresse e-mail invalide.");
        }

        // Vérifier si l'utilisateur existe déjà
        $checkUser = $db->prepare("SELECT userId FROM user WHERE mail = ? OR username = ?");
        $checkUser->execute([$mail, $username]);

        if ($checkUser->rowCount() > 0) {
            die("Ce compte existe déjà.");
        }

        // Hachage sécurisé du mot de passe
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insertion en base
        $registerUser = $db->prepare("INSERT INTO user (username, mail, password) VALUES (?, ?, ?)");
        $registerUser->execute([$username, $mail, $hashedPassword]);

        $getUserId = $db->prepare("SELECT userId WHERE mail = $mail");
        $getUserId = $db->execute();
        $userId = $getUserId->fetch();

        session_start();
        $_SESSION['userId'] = $userId;
        $_SESSION['username'] = $username;
        header("Location: hiddn.php");

        // echo "Inscription réussie !";
    } else {
        echo "Veuillez remplir tous les champs.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="resources/css/main.css" rel="stylesheet" />
    <link href="resources/css/register.css" rel="stylesheet" />
    <title>Hiddn</title>
    <script src="https://cdn.jsdelivr.net/npm/tsparticles@2/tsparticles.bundle.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Concert+One&family=Londrina+Solid:wght@100;300;400;900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
</head>
<body>
<div class="custom-cursor"></div>

    <a href="index.php"><h1 class="title" id="title">Hiddn.</h1></a>

    <div class="landing">
        <h2 class="fade-in" id="welcome-text">Your secret place</h2>
    </div>
    <div id="card">
    <div id="card-content">
      <div id="card-title">
        <h2>REGISTER</h2>
        <div class="underline-title"></div>
      </div>
      <form method="post" class="form">
      <label for="user-username" style="padding-top:13px">
            &nbsp;Username
          </label>
        <input id="user-username" class="form-content" type="username" name="username" autocomplete="on" required />
        <div class="form-border"></div>
        <label for="user-email" style="padding-top:13px">
            &nbsp;Email
          </label>
        <input id="user-email" class="form-content" type="email" name="mail" autocomplete="on" required />
        <div class="form-border"></div>
        <label for="user-password" style="padding-top:22px">&nbsp;Password
          </label>
        <input id="user-password" class="form-content" type="password" name="password" required />
        <div class="form-border"></div>
        <a href="#">
          <legend id="forgot-pass">Forgot password?</legend>
        </a>
        <input id="submit-btn" type="submit" name="submit" value="REGISTER" />
        <a href="#" id="signup">Don't have account yet?</a>
      </form>
    </div>
  </div>

    <div id="tsparticles"></div>
    <script src="resources/js/app.js"></script> 
</body>
</html>