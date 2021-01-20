<!DOCTYPE HTML>
<html lang="es">
<head>
<title>Página de Inicio - Bitacora</title>
<!-- Estilos css -->
<link rel="stylesheet" href="media/styles/libs/bootstrap.min.css">
<link rel="stylesheet" href="media/styles/header.css">
<link rel="stylesheet" href="media/styles/principal.css">
<link rel="stylesheet" href="media/icons/style.css">
<link rel="stylesheet" href="media/styles/menu.css">
<!-- Estilos css -->
<!-- Scripts -->
<script src="sistema/js/libs/jquery-3.5.1.min.js"></script>
<script src="sistema/js/getTime.js"></script>
<!-- Scripts -->
<link rel="shortcut icon" href="media/images/favicon.png" type="image/x-icon">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<!--Fuentes de google-->
<link href='//fonts.googleapis.com/css?family=Signika:400,600' rel='stylesheet' type='text/css'>
<!--Fuentes de google-->

</head>
<body>
<!--header Inicia Aqui-->
<header>
    <?php include 'sistema/header.php';?>
    <nav>
        <?php include 'sistema/nav.php';?>
    </nav>
</header>
<!--header Termina Aqui-->	

    <div id="contenedor">
        <h5 class="bienvenida">Bienvenido(a) al sistema <i><?php echo $_SESSION['nombre']?></i> <p class="tickets">Tienes <span id="pendientes" name="pendientes"> <?php echo $tickets?></span> Ticket pendiente(s) </p></h5>
    </div>
<!--Section Inicia Aqui-->
<section>

    <div class="container-all" id="menu" >

        <div class="container-box">

            <a href="reportar_incidencia.php" target="_top">

                <div class="box box1">

                    <img src="media/images/reportar.png" alt="usuario-reportar" class="icon">

                    <h4 class="title">Reportar incidencia</h4>

                    <p><strong>¡Modulo administrador!</strong></p>

                <div class="background-hover"></div>

            </a>
            
        </div>  

                
        <a href="seguimiento_ticket.php">

            <div class="box box2">

                <img src="media/images/seguimiento.png" alt="seguimiento" class="icon">

                <h4 class="title">Seguimiento</h4>

                <p><strong>¡Modulo administrador!</strong></p>

            <div class="background-hover"></div>

        </a> 

        </div> 

        <?php if ($_SESSION['rols'] == 'Administrador') { ?>
        <a href="descargarReporteTicket.php">

            <div class="box box3">

            <img src="media/images/informes.png" alt="documento" class="icon">

            <h4 class="title">Informes</h4>

            <p><strong>Descargar informes</strong></p>

            <div class="background-hover"></div>

        </a> 
        <?php } ?>

        </div> 

        <?php if ($_SESSION['rols'] == 'Administrador') { ?>
        <a href="crear_usuario.php">

            <div class="box box4">

                <img src="media/images/agregar-usuario.png" class="icon">

                <h4 class="title">Crear usuario</h4>

                <p><strong>Añadir un nuevo usuario</strong></p>

            <div class="background-hover"></div>

        </a> 
        <?php } ?>

        </div> 

        <?php if ($_SESSION['rols'] == 'Administrador') { ?>
        <a href="listado_usuarios.php">

            <div class="box box5">

                <img src="media/images/cliente.png" class="icon">

                <h4 class="title">Lista de usuarios</h4>

                <p><strong>Usuarios registrados</strong></p>


            <div class="background-hover"></div>

        </a> 
        <?php } ?>

        </div> 

    </div>
</section>
<!--Section Termina Aqui-->

</body>
<script>
    $(document).ready(function() {	
        function update(){
            var roles = '<?php echo $_SESSION['rols'] ?>';
            var user = '<?php echo $_SESSION['idUser'] ?>';
            var param = {
                rol: roles,
                usuario: user
            }
            $.ajax({
                type: "POST",
                url: "sistema/logica/contador_ticket_pendiente.php",
                data: param,
                success: function(data) {
                    $('#pendientes').text(Number(data));
                }
            });
        }
        
        setInterval(update, 10000);
    });
</script>
<script src="sistema/js/sweetalert2.js"></script>
	<script>
        Swal.fire({
        title: "Bienvenido/a!",
        html:'<h2 class="user"><?php echo $_SESSION["rols"]?><?php echo ':'?> <?php echo $_SESSION["nombre"]?></h2>',
        timer:3000,
        timerProgressBar:true,
        confirmButtonText: 'Aceptar'
        });
    </script>
</html>