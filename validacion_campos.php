<?php
$username= $_POST["username"];

// Validamos el nombre
 function validar_username($username)	
 {			
		
		 if (ereg("^[a-zA-Z]{5,10}$", $username)) { 
      echo " $username <br>"; 
       
   } else { 
       echo "El nombre $nombre no es válido <br>"; 
      return false; 
   } 
		
	
}				

?>

<b><?php echo validar_username($username);?></b>