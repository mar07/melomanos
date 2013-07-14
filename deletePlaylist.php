<?php

require "database.php";

$db = new DB();

$db->deleteList($_POST["ID_Playlist"]);

?>