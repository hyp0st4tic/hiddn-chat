<?php

session_start();
$db_name = "hiddn";
$user = "root";
$pass = "";

$db = new PDO("mysql:host=localhost;dbname=".$db_name, $user, $pass);

?>