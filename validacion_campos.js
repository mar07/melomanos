function validar(formulario)
{
//variables
	txt=/[a-z]/;
    num=/^([0-9])*$/;
	em=/[\w-\.]{3,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;
// fin variables

 //inicio validacion nombre y apellido 
  if(formulario.username.value=="")
  {
	alert('INGRESE NOMBRE');
	formulario.username.focus();
    return false;   
  }  //fin validacion campo nombre y apellido