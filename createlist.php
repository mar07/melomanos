<?php

require "database.php";
session_start(); 

$db = new DB();

$playlistId = $db->createList($_POST["list-name"], $_SESSION["username"]);

echo $playlistId;

?>