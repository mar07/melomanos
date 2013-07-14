<?php 

require "database.php";
session_start(); 

$songIds = explode(",", $_POST["songIds"]);
$playListId = $_POST["playListId"];

$db = new DB();
$db->savePlaylist($songIds, $playListId);

?>