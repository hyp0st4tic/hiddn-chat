<?php


session_status();

require("config.php");

$channel_id = $_POST['channel_id']??$_GET['channel_id'];

$fetchMessage = $db->prepare("SELECT * FROM messages m JOIN user ON m.sender_id = user.userId WHERE channel_id = '$channel_id'");
$fetchMessage->execute();

while($getMessage = $fetchMessage->fetch(PDO::FETCH_ASSOC)){
    ?>

<div class="msgBox">

    <div class="profil">
        <p><?=$getMessage['username']?></p>
    </div>

    <div class="message">
    <p><?=$getMessage['message']?></p>
    </div>
</div>
    <?php
}

?>
