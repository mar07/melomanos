<?php
session_start(); 

if ($_POST) {

	require_once("database.php");

	$db = new DB();
	$db->new_user($_POST["username"], $_POST["nombre"], $_POST["apellido"], $_POST["password"]);

	$db->session_start($_POST["username"]);

	header("Location: login.php");
}

?>

<html>
<meta charset="utf-8">

<head>
<link href="Estilo/Estilo.css" rel="stylesheet" type="text/css">

<style type="text/css">
body{ background:url(img/fondo.jpg);}
</style>

</head>

<body>
<div id="contenedor">
<div class="image">
<img src="img/melomanos.jpg" width="194" height="183">
</div>

<form action="register.php" method="post" class="form-formulario" name="formulario" ><br>
		<h1>Registracion</h1>
	
	<div class="Username">
	 	 <label>Username</label>
		<input type="text" name="username" id="campo1"><br>
	
	</div>
	
	<div>
		<label>Nombre</label>
		<input type="text" name="nombre" ><br>
	</div>
	
	<div>
		<label>Apellido</label>
		<input type="text" name="apellido" ><br>
	</div>
	
	<div>
		<label>Password</label>
		<input type="password" name="password" ><br>
	</div>
	
	<br>
	<input type="submit" class="bottom" value="Registrarse">
</form>
</div>
</body>

</html>