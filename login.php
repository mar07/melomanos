

<html>
<meta charset="utf-8">

<head>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<link href="Estilo/Estilo.css" rel="stylesheet" type="text/css">
<style>
body{background:url(img/fondo.jpg);}


a{ margin-top:100px;
	}

#error {
	color: red;
	margin-left: 28px;
}
	
.boton .registrar{ background-color:#DDD;
    border-top:1px solid #ddd;
    clear:both;
    color:#000;
    text-shadow:1px 1px 1px #AAA;
	}	
</style> 

<script type="text/javascript">
function validate(form) {
	var form = $(form);

	if (!$.trim(form.find("input[name=username]").val())) {
		$("#error").text("Username no puede ser vacio");
		$("#error").show();
		return false;
	}

	if (!$.trim(form.find("input[name=password]").val())) {
		$("#error").text("Password no puede ser vacio");
		$("#error").show();
		return false;
	}

	return true;
}
</script>
</head>

<body>

<div id="contenedor">
<div class="image">
<img src="img/melomanos.jpg" width="194" height="183">
</div>


<form action="login.php" method="post" class="form-formulario" onsubmit="return validate(this);">

	<h1>Login</h1>

	<div style="display: none" id="error"></div>

	<div>
		<label>User Name:</label><input type="text" name="username"><br>	
	</div>	
	
	<div>
	<label>Password:</label><input type="password" name="password"><br>
	</div>
	
	<input type="submit" value="Login" class="bottom">
</form>
  <div class="boton">	
	<a href="register.php" class="registrar">Registrarse</a>
  </div>
 </div> 	
</body>

		<div class="BDD">
		<?php

		if ($_POST) {

			require_once("database.php");

			$db = new DB();
			if ($db->login($_POST["username"], $_POST["password"])) {
				
				$db->session_start($_POST["username"]);
				header("Location: account.php");
				
			} else {
				echo "Usuario o password incorrecto";		
			}

		}

		?>
		</div>
</html>