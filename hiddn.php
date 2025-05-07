<?php
session_start();

if(!$_SESSION['userId']){
    header("index.php");
}

// echo "Connecté en tant que ID : ".$_SESSION['userId'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"/>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="resources/css/main.css" rel="stylesheet" />
    <link href="resources/css/hiddn.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Hiddn</title>
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/tsparticles@2/tsparticles.bundle.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Concert+One&family=Londrina+Solid:wght@100;300;400;900&family=Playfair+Display:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
</head>
<body data-user-id="<?=$_SESSION['userId']?>">

<div class="custom-cursor"></div>

<div class="mainContent">

    <div class="leftBar">
        <div class="menu">
            <ul id="channel-list">

            </ul>
        </div>
    </div>

    <div class="rightContent" id="container">

        <div id="message-container">

        </div>

        <div class="quill-container">

            <div id="editor"></div>

        </div>
        <form method="POST" id="message-form">
            <input type="textarea" style="display:none;" name="text-message" id="text-message">
            <input type="submit" style="" name="submitButton" id='submitButton'>
        </form>

    </div>

</div>

    <script src="resources/js/hiddn.js"></script> 
</body>
</html>

<?php



?>