<?php 

session_start();
require "database.php";

$upload_dir = "repo";

$tmp_name = $_FILES["mp3"]["tmp_name"];
$name = $_FILES["mp3"]["name"];
rename($tmp_name, $upload_dir."\\".$name);

$db = new DB();
$db->createSong($name, $_SESSION["username"]);

echo "Cargado ok.";

header("Location: account.php");

?>