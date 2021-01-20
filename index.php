<?php
	include('sistema/logica/login.php'); // Incluye archivo del login
	
	if(isset($_SESSION['activa'])){ // Valida si ya hay una sesion iniciada
		header("location: infInvestigar_Consultor.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Ingreso Gestion</title>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="js/kitawesome.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
	<img class="wave" src="img/wave.png">
	<div class="container">
		<div class="img">
			<img src="img/bg.svg">
		</div>
		<div class="login-content">
			<form method="POST" action="#">
				<img src="img/avatar.svg">
				<h2 class="title">Bienvenidos</h2>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Usuario</h5>
           		   		<input type="text" name="usernames" class="input">
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Contraseña</h5>
           		    	<input type="password" name="password"  class="input">
            	   </div>
				</div>
				<input type="submit" name="submit" class="btn" value="Ingresar">
				<div class="clear"></div>
					<span><?php echo $error; ?></span>
				</div>	
            </form>
        </div>
    </div>
    <script type="text/javascript" src="js/main.js"></script>
</body>
</html>
