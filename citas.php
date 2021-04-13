<?php 
    include('config/session.php');
    include('config/conexion.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
<!-- Estilos css -->
    <link rel="stylesheet" href="media/css/libs/bootstrap.min.css">
    <link rel="stylesheet" href="media/css/libs/reset.css">
    <link rel="stylesheet" href="media/icons/style.css">
    <link rel="stylesheet" href="media/css/header.css">
<!-- Estilos css -->
    <link rel="shortcut icon" href="media/img/favicon.png" type="image/x-icon">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Scripts -->
    <script src="sistema/js/libs/jquery-3.5.1.min.js"></script>
<!-- Scripts -->    
    <title>Informacion a investigar</title>
</head>
<body style="overflow: hidden;">
<header>
    <?php 
        include 'sistema/includes/header.php';
    ?>
        <nav>
        <?php
            include 'sistema/includes/nav.php';
        ?>
        </nav>
</header>

<section>

<div class="container-all" id="menu" >

    <div class="container-box">

        <a href="preparaciones_agente.php" target="_top">

            <div class="box box1">

                <img src="media/img/crear.png" alt="usuario-reportar" class="icon">

                <h4 class="title">Investigar</h4>

                <p><strong>Información a Investigar</strong></p>

            <div class="background-hover"></div>

        </a>
        
    </div>  

            
    <a href="tabla_envioPreparaciones.php">

        <div class="box box2">

            <img src="media/img/seguimiento.png" alt="seguimiento" class="icon">

            <h4 class="title">Backoffice</h4>

            <p><strong>Seguimiento</strong></p>

        <div class="background-hover"></div>

    </a> 

    </div> 

    <?php if ($_SESSION['roles'] == 'Administrador') { ?>
    <a href="descargarReporteTicket.php">

        <div class="box box3">

        <img src="media/img/informes.png" alt="documento" class="icon">

        <h4 class="title">Informes</h4>

        <p><strong>Descargar informes</strong></p>

        <div class="background-hover"></div>

    </a> 
    <?php } ?>

    </div> 

    </div> 

</div>
</section>
    <script src="sistema/js/libs/sweetalert2.js"></script>
</body>
</html>