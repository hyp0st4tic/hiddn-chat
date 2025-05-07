<?php
session_status();

require("config.php");

$message = $_POST['message'];
$sender_id = $_POST['sender_id'];
$channel_id = $_POST['channel_id'];



$insertMessage = $db->prepare("INSERT INTO messages(message, sender_id, channel_id) VALUES (?,?,?)");
$insertMessage->execute(array($message, $sender_id, $channel_id));


?>