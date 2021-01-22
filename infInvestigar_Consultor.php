<?php 
    include('config/session.php');
    include('config/conexion.php');

    if (empty($_GET['tabla'])) {
        header("location: principal.php");
    }

    $tabla = $_GET['tabla'];

    if ($tabla != 'citas' && $tabla != 'fono') {
        header("location: principal.php");
    }

    // valida si el usuario tiene permisos concedidos
	$permisoQsql = $con->query("SELECT inf_investigarConsultor
                                    FROM permisos WHERE id_usuario = '".$_SESSION['idUsers']."'");

    if ($filaP = mysqli_fetch_row($permisoQsql)) {
        $permiso = $filaP[0];
    } else {
        header("location: principal.php");
    }

    if($permiso != 1){ 
        header("location: principal.php");
    }

    /* Trae el ultimo registro creado */
    $traerDatos = "SELECT max(id_registro) FROM inf_investigar_".$tabla."";
    $ver = $con->query($traerDatos) or die ("No se obtuvieron datos en la consulta");

    if ($row = mysqli_fetch_row($ver)) {
        $id = $row[0];
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
        <h1>Datos Consultor <b> <?php echo strtoupper($tabla); if ($tabla == 'fono') {?>PLUS <?PHP } ?></b> </h1>
        <hr>
            <form method="post" name="form_infInvestigarConsultor" id="form_infInvestigarConsultor">
                <div class="form-group" id="cont-registro" style="text-align: center;">
                <label for="registro" style="font-weight: 700;">Registro N°</label>
                <input type="text" class="form-control" name="registro" id="registro" readonly value="<?php echo $id ?>"> <!-- Muestra el numero del registro a crear -->
                </div>
                <br>
                <div id="encabezado" class="form-group">
                    <input type="text" name="dia" id="dia" value="" readonly> <!-- Muestra el dia actual -->
                    <img src="media/img/<?php echo $img ?>.png" alt="anadir" width="80px">
                    <input type="text" name="hora" id="hora" value="" readonly> <!-- Muestra la hora actual en tiempo real -->
                    <input type="hidden" name="user" id="user" value="<?php echo $_SESSION['idUsers']; ?>">
                    <input type="hidden" name="tabla" id="tabla" value="<?php echo $tabla;?>">
                </div>

                <div id="cont-estado" class="form-group row">
                    <label for="estado" class="col-sm-4 col-form-label">Estado</label>
                    <div class="col-sm-8">
                        <select name="estado" id="estado" class="form-control" required>
                        <option value="" hidden>Selecciona una opcion</option>
                        <!-- consulta traer datos de la base -->
                        <?php $estadoSsql = "SELECT id_tipificacion, nombre_tipificacion FROM tipificaciones WHERE grupo_tipificacion = 'Estado' ORDER BY nombre_tipificacion ASC";
                            $estadoQsql = $con -> query($estadoSsql);
                        ?>
                        <!-- ciclo para mostrar las areas -->
                        <?php foreach ($estadoQsql as $row) { ?>
                        
                            <option value="<?php echo $row['id_tipificacion']; ?>"> <?php echo $row['nombre_tipificacion']; ?></option>
                        
                        <?php } ?>                        
                        </select>
                    </div>
                </div>

                <div class="form-group row" id="cont-documento">
                    <label for="documento" class="col-sm-4 col-form-label">N° Documento</label>
                    <div class="col-sm-8">
                        <input type="text" name="documento" class="form-control" autocomplete="off" placeholder="Ingrese el numero de documento" id="documento" required>
                    </div>
                </div>
            
                <div class="form-group row" id="cont-contrato">
                    <label for="contrato" class="col-sm-4 col-form-label">N° Contrato</label>
                    <div class="col-sm-8">
                        <input type="text" name="contrato" class="form-control" autocomplete="off" placeholder="Numero de contrato" id="contrato" required>
                    </div>
                </div>

                <div class="form-group row" id="cont-nombres">
                    <label for="nombres" class="col-sm-4 col-form-label">Nombre Usuario</label>
                    <div class="col-sm-8">
                        <input type="text" name="nombres" id="nombres" class="form-control" autocomplete="off" placeholder="Nombre Completo" required>
                    </div>
                </div>

                <div class="form-group row" id="cont-causal">
                    <label for="causal" class="col-sm-4 col-form-label">Causal</label>
                    <div class="col-sm-8">
                        <select name="causal" id="causal" class="form-control" required>
                            <option value="" hidden>Selecciona una opcion</option>
                            <!-- consulta traer datos de la base -->
                            <?php $causalSsql = "SELECT id_tipificacion, nombre_tipificacion FROM tipificaciones WHERE grupo_tipificacion = 'Causal' ORDER BY nombre_tipificacion ASC";
                                $causalQsql = $con -> query($causalSsql);
                            ?>
                            <!-- ciclo para mostrar las areas -->
                            <?php foreach ($causalQsql as $row) { ?>
                            
                                <option value="<?php echo $row['id_tipificacion']; ?>"> <?php echo $row['nombre_tipificacion']; ?></option>
                            
                            <?php } ?>                        
                        </select>
                    </div>
                </div>

                <div class="form-group row" id="cont-correo">
                    <label for="correo" class="col-sm-4 col-form-label">Correo electronico</label>
                    <div class="col-sm-8">
                        <input type="text" name="correo" id="correo" class="form-control" autocomplete="off" placeholder="Correo Usuario" required>
                    </div>
                </div>

                <div class="form-group row" id="cont-persona">
                    <label for="persona" class="col-sm-4 col-form-label">¿Persona a preguntar?</label>
                    <div class="col-sm-8">
                        <input type="text" name="persona" id="persona" class="form-control" autocomplete="off" placeholder="Nombre de la persona" required>
                    </div>
                </div>

                <div class="form-group row" id="cont-telefono">
                    <label for="telefono" class="col-sm-4 col-form-label">Telefono</label>
                    <div class="col-sm-8">
                        <input type="text" name="telefono" id="telefono" class="form-control" autocomplete="off" placeholder="Telefono fijo" required>
                    </div>
                </div>

                <div class="form-group row" id="cont-celular">
                    <label for="celular" class="col-sm-4 col-form-label">Celular</label>
                    <div class="col-sm-8">
                        <input type="text" name="celular" id="celular" class="form-control" autocomplete="off" placeholder="Numero celular" required>
                    </div>
                </div>

                <div class="form-group row" id="cont-ciudad">
                    <label for="ciudad" class="col-sm-4 col-form-label">Ciudad</label>
                    <div class="col-sm-8">
                        <input type="text" name="ciudad" id="ciudad" class="form-control" autocomplete="off" placeholder="Ciudad de residencia" required>
                    </div>
                </div>

                <div class="form-group row" id="cont-detalle">
                    <label for="detalle" class="col-sm-4 col-form-label">Descripción</label>
                    <div class="col-sm-8">
                        <textarea name="detalle" id="detalle" class="form-control" style="resize:none; text-align: center;" placeholder="Servicio solicitado" required></textarea>
                    </div>
                </div>
                <center><input type="submit" class="btn btn-primary" id="btnEnviar_infInvestigarConsultor" name="btnEnviar_infInvestigarConsultor" value="Guardar"></center>
            </form>
        </div>            

    </section>
</body>
    <script src="sistema/js/libs/sweetalert2.js"></script>
    <script src="sistema/js/ajax_formularios/form_infInvestigar_consultor.js"></script>
</html>