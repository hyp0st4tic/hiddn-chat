<?php

require("./php/config.php");


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if(!empty($_POST['mail']) && !empty($_POST['password'])){

        $mail = trim($_POST['mail']);
        $password = $_POST['password'];

        $stmt = $db->prepare("SELECT userId, username, password FROM user WHERE mail = ?");
        $stmt->execute([$mail]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($user && password_verify($password, $user['password'])) {
            // Mot de passe correct
            session_start();
            $_SESSION['userId'] = $user['userId'];
            $_SESSION['username'] = $user['username'];
    
            echo "Connexion réussie. Bienvenue " . htmlspecialchars($user['username']) . " !";
            // Rediriger vers le tableau de bord ou autre page
            header("Location: hiddn.php");
        } else {
            // Email ou mot de passe incorrect
            echo "Identifiants invalides.";
        }

    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="resources/css/main.css" rel="stylesheet" />
    <link href="resources/css/login.css" rel="stylesheet" />
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
        <h2>LOGIN</h2>
        <div class="underline-title"></div>
      </div>
      <form method="post" class="form">
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
        <input id="submit-btn" type="submit" name="submit" value="LOGIN" />
        <a href="#" id="signup">Don't have account yet?</a>
      </form>
    </div>
  </div>

    <div id="tsparticles"></div>
    <script src="resources/js/app.js"></script> 
</body>
</html>