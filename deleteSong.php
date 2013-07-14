<?php

require "database.php";

$db = new DB();

$db->deleteSong($_POST["ID_Song"]);

?>