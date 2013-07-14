<?php

require "database.php";

$db = new DB();
$songs = $db->showPlaylist($_POST["ID_Playlist"]);

echo json_encode($songs);

?>