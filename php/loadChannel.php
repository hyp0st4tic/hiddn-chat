<?php
session_status();

require("config.php");

$getChannel = $db->prepare("SELECT * FROM channels");
$getChannel->execute();

while($channel = $getChannel->fetch(PDO::FETCH_ASSOC)){
    echo "<li class='item' data-channel-id='".$channel['id']."'><i class='fa-solid fa-hashtag' style='color: #000000;'></i>".$channel['name']."</li><div id='action' class=''></div>";
}


?>