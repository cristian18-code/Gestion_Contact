<?php
	include('sistema/logica/login.php'); // Incluye archivo del login
	
	if(isset($_SESSION['activas'])){ // Valida si ya hay una sesion iniciada
		header("location: principal.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Ingreso Gestion</title>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="media/css/login.css">
	<script src="sistema/js/libs/kitawesome.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="media/img/user.png" type="image/x-icon">
</head>
<body>


	<div class="container">
	<div class="circle"></div>
		<div class="img">
			<img src="media/img/bg.svg">
		</div>
		<div class="login-content">
			<form method="POST" action="#">
				<img src="media/img/avatar.svg">
				<h2 class="title">Bienvenidos</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Usuario</h5>
           		   		<input type="text" name="username" class="input" autocomplete="off">
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Contraseña</h5>
           		    	<input type="password" name="password"  class="input" autocomplete="off" id="contraseña">
						   <img src="media/img/mostrar.png" id="mostrar">
            	   </div>
				</div>
				<input type="submit" name="submit" class="btn" value="Ingresar">
				

				<div class="clear"></div>
					<span><?php echo $error; ?></span>
				</div>	
            </form>
        </div>
    </div>
    <script type="text/javascript" src="sistema/js/libs/main.js"></script>
</body>
<script>
 var mostrar = document.getElementById('mostrar');
 var input = document.getElementById('contraseña');

 mostrar.addEventListener('click', mostrarContraseña);

 function mostrarContraseña(){
     if(input.type == "password"){
         input.type = "text";
         mostrar.src = "media/img/ocultar.png";
         setTimeout("ocultar()", 10000);
     }else{
        input.type = "password";
        mostrar.src = "media/img/mostrar.png";
     }
 }
 function ocultar(){
        input.type = "password";
        mostrar.src = "media/img/mostrar.png";
 }
</script>
</html>
