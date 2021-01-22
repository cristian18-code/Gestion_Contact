<?php 
    include('config/session.php');
    include('config/conexion.php');

    // valida que se envie el parametro
    if (empty($_POST['tabla'])) {
        header("location: principal.php");
    }

    $tabla = $_POST['tabla'];

    // valida que el valor enviado este correcto
    if ($tabla != 'citas' && $tabla != 'fono') {
        header("location: principal.php");
    }

    // valida que se envie un registro
    if (empty($_POST['registro'])) {
        header("location: principal.php");
    }
    
    $registro = $_POST['registro'];

    // valida si el usuario tiene permisos concedidos
	$permisoQsql = $con->query("SELECT inf_investigarGestor
                                    FROM permisos WHERE id_usuario = '".$_SESSION['idUsers']."'") or die (header("location: principal.php"));

    if ($filaP = mysqli_fetch_row($permisoQsql)) {
        $permiso = $filaP[0];
    } else {
        header("location: principal.php");
    }

    if($permiso != 1){ 
        header("location: principal.php");
    }

    // direccion de imagen
    switch ($tabla) {
        case 'citas':
            $img = 'investigar';
        break;
        case 'fono':
            $img = 'datos-del-usuario';
        break;
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
<!-- Estilos css -->
    <link rel="stylesheet" href="media/css/libs/bootstrap.min.css">
    <link rel="stylesheet" href="media/css/libs/reset.css">
    <link rel="stylesheet" href="media/css/header.css">
    <link rel="stylesheet" href="media/icons/style.css">
    <link rel="stylesheet" href="media/css/informacion_investigar.css">
<!-- Estilos css -->
    <link rel="shortcut icon" href="media/img/favicon.png" type="image/x-icon">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Scripts -->
    <script src="sistema/js/libs/jquery-3.5.1.min.js"></script>
    <script src="sistema/js/getTime.js"></script>
<!-- Scripts -->    
    <title>Informacion a investigar <?php echo $tabla ?> - Gestion Contact</title>

    <style>
        section {max-width: 1400px;} section form {max-width: 1200px;}
    </style>
</head>
<body>
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

        <div id="formulario_infInvestigar_Consultor">    
            <h1>Datos a gestionar <b> <?php echo strtoupper($tabla); if ($tabla == 'fono') {?>PLUS <?PHP } ?></b> </h1>
            <hr>
                <form method="post" name="form_infInvestigarConsultor" id="form_infInvestigarConsultor">
                    <div class="form-group" id="cont-registro" style="text-align: center;">
                    <label for="registro" style="font-weight: 700;">Registro N°</label>
                    <input type="text" class="form-control" name="registro" id="registro" readonly value="<?php echo $registro ?>"> <!-- Muestra el numero del registro a crear -->
                    </div>
                    <br>
                    <div id="encabezado" class="form-group">
                        <input type="text" name="dia" id="dia" value="" readonly> <!-- Muestra el dia actual -->
                        <img src="media/img/<?php echo $img ?>.png" alt="anadir" width="80px">
                        <input type="text" name="hora" id="hora" value="" readonly> <!-- Muestra la hora actual en tiempo real -->
                        <input type="hidden" name="user" id="user" value="<?php echo $_SESSION['idUsers']; ?>">
                        <input type="hidden" name="tabla" id="tabla" value="<?php echo $tabla;?>">
                    </div>          

                    <div class="row" style="justify-content: center;">
                        <div id="cont-estado" class="form-group row col-5">
                            <label for="estado" class="col-sm-3 col-form-label">Estado</label>
                            <div class="col-sm-8">
                                <input type="text" name="estado" id="estado" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="form-group row col-5" id="cont-documento">
                            <label for="documento" class="col-sm-4 col-form-label">N° Documento</label>
                            <div class="col-sm-8">
                                <input type="text" name="documento" id="documento" class="form-control" readonly>
                            </div>
                        </div>
                    </div>

            </form>
        </div>  
    </section>
</body>
<script src="sistema/js/libs/sweetalert2.js"></script>
<script src="sistema/js/ajax_formularios/form_infInvestigar_consultor.js"></script>
</html>                