<?php 
    include('config/session.php');
    include('config/conexion.php');
    include('sistema/logica/envio_correo.php');

    // valida que se envie un registro
    if (empty($_POST['registro'])) {
        header("location: principal.php");
    }
    
    $registro = $_POST['registro'];

    // valida si el usuario tiene permisos concedidos
	$permisoQsql = $con->query("SELECT preparaciones_gestor
                                    FROM permisos WHERE id_usuario = '".$_SESSION['idUsers']."'") or die (header("location: principal.php"));

    if ($filaP = mysqli_fetch_row($permisoQsql)) {
        $permiso = $filaP[0];
    } else {
        header("location: principal.php");
    }

    if($permiso != 1){ 
        header("location: principal.php");
    }

    $traerDatos = "SELECT   preparaciones.id_registro,
                            t.nombre_tipificacion AS estado,
                            DATE_FORMAT(preparaciones.fecha_registro, '%d/%m/%Y') AS fecha_registro,
                            preparaciones.hora_registro,
                            preparaciones.documento,
                            preparaciones.contrato,
                            preparaciones.nombres_usuario,
                            preparaciones.examen,
                            preparaciones.correo,
                            preparaciones.celular,
                            preparaciones.observaciones,
                            preparaciones.fecha_envio,
                            preparaciones.hora_envio,
                            t1.nombre_tipificacion AS cmd,
                            t2.nombre_tipificacion AS tipo,
                            t3.nombre_tipificacion AS solicitud,
                            t4.nombre_tipificacion AS tipoPaciente,
                            u.username AS user_crea
                            FROM ((((( envio_preparaciones preparaciones
                            LEFT JOIN tipificaciones t 
                                ON preparaciones.id_tipificacionEstado = t.id_tipificacion)
                            INNER JOIN tipificaciones t1 
                                ON preparaciones.id_tipificacionCmd = t1.id_tipificacion)
                            INNER JOIN tipificaciones t2 
                                ON preparaciones.id_tipificacionTipo = t2.id_tipificacion)
                            INNER JOIN tipificaciones t3
                                ON preparaciones.id_tipificacionSolicitud = t3.id_tipificacion)
                            INNER JOIN tipificaciones t4
                                ON preparaciones.id_tipificacionTipo_paciente = t4.id_tipificacion)
                            INNER JOIN usuarios u
                                ON preparaciones.id_userCrea = u.id_usuario
                            WHERE preparaciones.id_registro = '$registro'";

    $ver = $con ->query($traerDatos) or die ('Ocurrio un problema al traer los registros');
    
    if ($filaR = mysqli_fetch_row($ver)) {
        $estado = $filaR[1];
        if ($estado == 'CORREO ENVIADO') {
            header("location: principal.php");
        }

        if ($filaR[16] = 'MEDPLUS') {
            $correo = usuarioMedplus($filaR[8], $filaR[6], $filaR[7]);
        }
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
    <title>Envio de preparaciones - Gestion Contact</title>

    <style>
        section {max-width: 1400px;} section form {max-width: 1200px;} section form input{font-size: 16px;} 
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

        <div id="formulario">    
            <h1>Gestion agente <b>Preparaciones</b> </h1>
            <hr>
                <form>
                    <div class="form-group" id="cont-registro" style="text-align: center;">
                    <label for="registro" style="font-weight: 700;">Registro N°</label>
                    <input type="text" class="form-control" name="registro" id="registro" readonly value="<?php echo $registro ?>"> <!-- Muestra el numero del registro a crear -->
                    </div>
                    <br>
  
                <?php foreach ($ver as $dato) { ?>
                    <div class="row" style="justify-content: center;">
                        <div id="cont-fecha" class="form-group row col-5">
                            <label for="fecha" class="col-sm-3   col-form-label">Fecha de registro</label>
                            <div class="col-sm-9">
                                <input type="text" name="fecha" id="fecha" value="Dia: <?php echo $dato['fecha_registro']; ?>  Hora: <?php echo $dato['hora_registro']; ?>" class="form-control" readonly>
                            </div>
                        </div>

                        <div class="form-group row col-5" id="cont-consultor">
                            <label for="consultor" class="col-sm-3 col-form-label">Consultor</label>
                            <div class="col-sm-9">
                                <input type="text" name="consultor" id="consultor" class="form-control" value="<?php echo $dato['user_crea']; ?>" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="justify-content: center;">
                        <div class="form-group row col-5" id="cont-documento">
                            <label for="documento" class="col-sm-3 col-form-label">N° Documento</label>
                            <div class="col-sm-9">
                                <input type="text" name="documento" id="documento" class="form-control" value="<?php echo $dato['documento']; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row col-5" id="cont-contrato">
                            <label for="contrato" class="col-sm-3 col-form-label">N° contrato</label>
                            <div class="col-sm-9">
                                <input type="text" name="contrato" id="contrato" class="form-control" value="<?php echo $dato['contrato']; ?>" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="justify-content: center;">
                        <div class="form-group row col-5" id="cont-nombres">
                            <label for="nombres" class="col-sm-3 col-form-label">Nombres usuario</label>
                            <div class="col-sm-9">
                                <input type="text" name="nombres" id="nombres" class="form-control" value="<?php echo $dato['nombres_usuario']; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row col-5" id="cont-correo">
                            <label for="correo" class="col-sm-3 col-form-label">Correo electronico</label>
                            <div class="col-sm-9">
                                <input type="text" name="correo" id="correo" class="form-control" value="<?php echo $dato['correo']; ?>" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="justify-content: center;">
                        <div class="form-group row col-5" id="cont-examen">
                            <label for="examen" class="col-sm-3 col-form-label">Examen</label>
                            <div class="col-sm-9">
                                <input type="text" name="examen" id="examen" class="form-control" value="<?php echo $dato['examen']; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row col-5" id="cont-celular">
                            <label for="celular" class="col-sm-3 col-form-label">Celular</label>
                            <div class="col-sm-9">
                                <input type="text" name="celular" id="celular" class="form-control" value="<?php echo $dato['celular']; ?>" readonly>
                            </div>
                        </div>
                    </div>


                    <div class="row" style="justify-content: center;">
                        <div class="form-group row col-10" style="justify-content: center;" id="cont-observacion">
                            <label for="observacion" class="col-sm-3 col-form-label">Observaciones de solicitud</label>
                            <div class="col-sm-9">
                                <textarea name="observacion" id="observacion" class="form-control" cols="30" rows="5" style="resize: none;" readonly><?php echo $dato['observaciones']; ?></textarea>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                </form>
                <hr>
                <form method="post" name="form_infInvestigar_gestor" id="form_infInvestigar_gestor">
                    <h1 style="text-align: center;">Gestion<b> BACK OFFICE</b></h1>
                    <hr>

                    <div id="encabezado" class="form-group">
                        <input type="text" name="dia" id="dia" value="" readonly> <!-- Muestra el dia actual -->
                        <img src="media/img/datos-del-usuario.png" class="mover" class="mover" alt="anadir" width="80px">
                        <input type="text" name="hora" id="hora" value="" readonly> <!-- Muestra la hora actual en tiempo real -->
                        <input type="hidden" name="user" id="user" value="<?php echo $_SESSION['idUsers']; ?>">
                        <input type="hidden" name="registro" id="registro" value="<?php echo $registro ?>"> <!-- Muestra el numero del registro a crear -->
                    </div>

                        <div class="form-group row col-8" id="cont-estado" style="margin-left:auto; margin-right:auto;">
                            <label for="estado" class="col-sm-4 col-form-label">Estado</label>
                            <div class="col-sm-8">
                                <select name="estado" id="estado" class="form-control" autofocus required>
                                    <option value="" hidden>Selecciona una opcion</option>
                                    <!-- consulta traer datos de la base -->
                                <?php $estadoSsql = "SELECT id_tipificacion, nombre_tipificacion FROM tipificaciones WHERE grupo_tipificacion = 'Estado' AND grupo_tipificacion2 = 'citas' ORDER BY nombre_tipificacion ASC";
                                    $estadoQsql = $con->query($estadoSsql);
                                ?>
                                <!-- ciclo para mostrar las areas -->
                                <?php foreach ($estadoQsql as $row) { ?>
                                
                                    <option value="<?php echo $row['id_tipificacion']; ?>"> <?php echo $row['nombre_tipificacion']; ?></option>
                                
                                <?php } ?>                        
                                </select>
                            </div>
                        </div>

                    <div id="cont-enviarCorreo">
                        <center><a href="<?php echo $correo; ?>"><img src="media/img/gmail.png" title="enviar correo" alt="enviar correo" width="50px"></a></center>
                    </div>
                    
                    <div class="form-group row  col-8" id="cont-observacion" style="margin-left:auto; margin-right:auto;">
                        <label for="observacion" class="col-sm-4 col-form-label">Observaciones Gestión</label>
                        <div class="col-sm-8">
                            <textarea name="observacion" id="observacion" class="form-control" rows="4" style="resize:none; text-align: center;" required></textarea>
                        </div>
                    </div>

                    <center><input type="submit" class="btn btn-primary" id="btnEnviar_infInvestigarGestor" name="btnEnviar_infInvestigarGestor" value="Guardar"></center>

                </form>
        </div>
    </section>
</body>
    <script src="sistema/js/libs/sweetalert2.js"></script>
    <script src="sistema/js/ajax_formularios/form_infInvestigar_gestor.js"></script>
</html>                