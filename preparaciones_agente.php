<?php 
    include('config/session.php');
    include('config/conexion.php');

    // valida si el usuario tiene permisos concedidos
	$permisoQsql = $con->query("SELECT envioPreparaciones_agente
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
    $traerDatos = "SELECT max(id_registro) FROM envio_preparaciones";
    $ver = $con->query($traerDatos) or die ("No se obtuvieron datos en la consulta");

    if ($row = mysqli_fetch_row($ver)) {
        $id = $row[0];
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
    <title>Envio preparaciones - Gestion Contact</title>
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
    
    <div id="formulario">    
        <h1>Envio de preparaciones <b> Gestion agente</b></h1>
        <hr>
            <form method="post" name="form_preparaciones_agente" id="form_preparaciones_agente">
                <div class="form-group" id="cont-registro" style="text-align: center;">
                <label for="registro" style="font-weight: 700;">Registro N°</label>
                <input type="text" class="form-control" name="registro" id="registro" readonly value="<?php echo $id + 1; ?>"> <!-- Muestra el numero del registro a crear -->
                </div>
                <br>
                <div id="encabezado" class="form-group">
                    <input type="text" name="dia" id="dia" value="" readonly> <!-- Muestra el dia actual -->
                    <img src="media/img/mensaje.png" alt="anadir" width="80px">
                    <input type="text" name="hora" id="hora" value="" readonly> <!-- Muestra la hora actual en tiempo real -->
                    <input type="hidden" name="user" id="user" value="<?php echo $_SESSION['idUsers']; ?>">
                </div>

                <div class="form-group row" id="cont-documento">
                    <label for="documento" class="col-sm-4 col-form-label">Número de Documento</label>
                    <div class="col-sm-8">
                        <input type="text" name="documento" class="form-control" autocomplete="off" placeholder="Ingrese el numero de documento" id="documento" required>
                    </div>
                </div>
            
                <div class="form-group row" id="cont-contrato">
                    <label for="contrato" class="col-sm-4 col-form-label">Número del Contrato</label>
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

                <div class="form-group row" id="cont-celular">
                    <label for="celular" class="col-sm-4 col-form-label">Celular</label>
                    <div class="col-sm-8">
                        <input type="text" name="celular" id="celular" class="form-control" autocomplete="off" placeholder="Numero celular" required>
                    </div>
                </div>

                <div class="form-group row" id="cont-examen">
                    <label for="examen" class="col-sm-4 col-form-label">Examen</label>
                    <div class="col-sm-8">
                        <input type="text" name="examen" id="examen" class="form-control" autocomplete="off" placeholder="Nombre de examen" required>
                    </div>
                </div>

                <div class="form-group row" id="cont-correo">
                    <label for="correo" class="col-sm-4 col-form-label">Correo electronico</label>
                    <div class="col-sm-8">
                        <input type="text" name="correo" id="correo" class="form-control" autocomplete="off" placeholder="Correo Usuario" required>
                    </div>
                </div>

                <div class="form-group row" id="cont-solicitud">
                    <label for="solicitud" class="col-sm-4 col-form-label">Tipo solicitud</label>
                    <div class="col-sm-8">
                        <select name="solicitud" id="solicitud" class="form-control" required>
                            <option value="" hidden>Selecciona una opcion</option>
                            <!-- consulta traer datos de la base -->
                            <?php $tipolSsql = "SELECT id_tipificacion, nombre_tipificacion FROM tipificaciones WHERE grupo_tipificacion = 'tipo solicitud' AND grupo_tipificacion2 = 'citas' ORDER BY nombre_tipificacion ASC";
                                $tipoQsql = $con -> query($tipolSsql);
                            ?>
                            <!-- ciclo para mostrar las areas -->
                            <?php foreach ($tipoQsql as $row) { ?>
                            
                                <option value="<?php echo $row['id_tipificacion']; ?>"> <?php echo $row['nombre_tipificacion']; ?></option>
                            
                            <?php } ?>                        
                        </select>
                    </div>
                </div>

                <div class="form-group row" id="cont-cmd">
                    <label for="cmd" class="col-sm-4 col-form-label">Centro Medico</label>
                    <div class="col-sm-8">
                        <select name="cmd" id="cmd" class="form-control" required>
                            <option value="" hidden>Selecciona una opcion</option>
                            <!-- consulta traer datos de la base -->
                            <?php $cmdSsql = "SELECT id_tipificacion, nombre_tipificacion FROM tipificaciones WHERE grupo_tipificacion = 'centro medico' AND grupo_tipificacion2 = 'citas' ORDER BY nombre_tipificacion ASC";
                                $cmdQsql = $con -> query($cmdSsql);
                            ?>
                            <!-- ciclo para mostrar las areas -->
                            <?php foreach ($cmdQsql as $row) { ?>
                            
                                <option value="<?php echo $row['id_tipificacion']; ?>"> <?php echo $row['nombre_tipificacion']; ?></option>
                            
                            <?php } ?>                        
                        </select>
                    </div>
                </div>

                <div class="form-group row" id="cont-tipo">
                    <label for="tipo" class="col-sm-4 col-form-label">Tipo</label>
                    <div class="col-sm-8">
                        <select name="tipo" id="tipo" class="form-control" required>
                            <option value="" hidden>Selecciona una opcion</option>
                            <!-- consulta traer datos de la base -->
                            <?php $tipoSsql = "SELECT id_tipificacion, nombre_tipificacion FROM tipificaciones WHERE grupo_tipificacion = 'tipo' AND grupo_tipificacion2 = 'citas' ORDER BY nombre_tipificacion ASC";
                                $tipoQsql = $con -> query($tipoSsql);
                            ?>
                            <!-- ciclo para mostrar las areas -->
                            <?php foreach ($tipoQsql as $row) { ?>
                            
                                <option value="<?php echo $row['id_tipificacion']; ?>"> <?php echo $row['nombre_tipificacion']; ?></option>
                            
                            <?php } ?>                        
                        </select>
                    </div>
                </div>

                <div class="form-group row" id="cont-tipoPaciente">
                    <label for="tipoPaciente" class="col-sm-4 col-form-label">Tipo paciente</label>
                    <div class="col-sm-8">
                        <select name="tipoPaciente" id="tipoPaciente" class="form-control" required>
                            <option value="" hidden>Selecciona una opcion</option>
                            <!-- consulta traer datos de la base -->
                            <?php $tipoPacienteSsql = "SELECT id_tipificacion, nombre_tipificacion FROM tipificaciones WHERE grupo_tipificacion = 'tipo paciente' AND grupo_tipificacion2 = 'citas' ORDER BY nombre_tipificacion ASC";
                                $tipoPacienteQsql = $con -> query($tipoPacienteSsql);
                            ?>
                            <!-- ciclo para mostrar las areas -->
                            <?php foreach ($tipoPacienteQsql as $row) { ?>
                            
                                <option value="<?php echo $row['id_tipificacion']; ?>"> <?php echo $row['nombre_tipificacion']; ?></option>
                            
                            <?php } ?>                        
                        </select>
                    </div>
                </div>

                <div class="form-group row" id="cont-observacion">
                    <label for="observacion" class="col-sm-4 col-form-label">Observaciones de solicitud</label>
                    <div class="col-sm-8">
                        <textarea name="observacion" id="observacion" class="form-control" style="resize:none; text-align: center;" rows="3" placeholder="Observaciones" required></textarea>
                    </div>
                </div>
                <center><input type="submit" class="btn btn-primary" id="btnEnviar_preparaciones_agente" name="btnEnviar_preparaciones_agente" value="Guardar"></center>
            </form>
        </div>    

    </section>
</body>
    <script src="sistema/js/libs/sweetalert2.js"></script>
    <script src="sistema/js/ajax_formularios/form_preparaciones_agente.js"></script>
</html>