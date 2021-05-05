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
	$permisoQsql = $con->query("SELECT GestorCitas
                                    FROM permisos WHERE id_usuario = '".$_SESSION['idUsers']."'") or die (header("location: principal.php"));

    if ($filaP = mysqli_fetch_row($permisoQsql)) {
        $permiso = $filaP[0];
    } else {
        header("location: alerta.php");
    }


    $traerDatos = "SELECT   tlaboratorios.id_registro,
                            t2.nombre_tipificacion AS estado,
                            DATE_FORMAT(tlaboratorios.fechaRegistro, '%d/%m/%Y') AS fecha_registro,
                            tlaboratorios.horaRegistro,
                            tlaboratorios.modalidadPago,
                            tlaboratorios.tipoPaciente,
                            tlaboratorios.tipoSolicitud,
                            tlaboratorios.nombrePaciente,
                            tlaboratorios.documento,
                            tlaboratorios.direccion,
                            tlaboratorios.barrio,
                            tlaboratorios.localidad,
                            tlaboratorios.celular,
                            tlaboratorios.telefono_fijo,
                            tlaboratorios.correo,
                            tlaboratorios.centroMedico,
                            tlaboratorios.posibleCovid,
                            tlaboratorios.plan,
                            tlaboratorios.servicio_programado,
                            tlaboratorios.observaciones,
                            tlaboratorios.observacionesBack,
                            tlaboratorios.fechaServicio,
                            u.username AS user_crea,
                            u.username AS user_cierre
                            FROM ((( laboratorios_adomicilio tlaboratorios
                            LEFT JOIN tipificaciones t2
                                ON tlaboratorios.id_tipificacionEstado = t2.id_tipificacion)        
                            LEFT JOIN usuarios u
                                ON tlaboratorios.id_UserCrea = u.id_usuario)
                            LEFT JOIN usuarios u1
                                ON tlaboratorios.id_UserCierre = u1.id_usuario)
                            WHERE tlaboratorios.id_registro = '$registro'";
                            

    $ver = $con ->query($traerDatos) or die ('Ocurrio un problema al traer los registros');    

    
    if ($filaR = mysqli_fetch_row($ver)) {
        switch($filaR[6]) {
            case "Programacion":
                $correo = correo_laboratorioCitas_programacion($filaR[7], $filaR[9], $filaR[10], $filaR[11], $filaR[12], $filaR[13],
                $filaR[14], $filaR[15], $filaR[16], $filaR[4], $filaR[5], $filaR[19], $filaR[18], $filaR[21]);
                break;
            case "Demora programacion":
                $correo = correo_laboratorioCitas_demoraProgramacion($filaR[7], $filaR[9], $filaR[10], $filaR[21]);
            break;    
            case "Demora resultados":
                $correo = correo_laboratorioCitas_demoraResultados($filaR[7], $filaR[9], $filaR[10], $filaR[16], $filaR[22], $filaR[17], $filaR[21]);
            break;
            case "Cancelacion del servicio":
                $correo = correo_laboratorioCitas_cancelacionServicio($filaR[7], $filaR[9], $filaR[10], $filaR[16], $filaR[22], $filaR[21]);
            break;
            case "Otros":
                $correo = correo_laboratorioCitas_otros($filaR[7], $filaR[9], $filaR[10], $filaR[16], $filaR[22], $filaR[21]);
            break;
        }
    }
    
?>

<!DOCTYPE html>
<html lang="es">
<head>
<!-- Estilos css -->
    <link rel="stylesheet" href="media/css/libs/pushbar.css">	
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
    <title>Laboratorios - CITAS</title>

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
            <h1>Datos a gestionar <b>CITAS</b> </h1>
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
                                <input type="text" name="fecha" id="fecha" value="Dia: <?php echo $dato['fecha_registro']; ?>  Hora: <?php echo $dato['horaRegistro']; ?>" class="form-control" readonly>
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

                        <div class="form-group row col-5" id="cont-nombres">
                            <label for="nombres" class="col-sm-3 col-form-label">Nombres Paciente</label>
                            <div class="col-sm-9">
                                <input type="text" name="nombres" id="nombres" class="form-control" value="<?php echo $dato['nombrePaciente']; ?>" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="justify-content: center;">
                        <div class="form-group row col-5" id="cont-tipoSolicitud">
                            <label for="tipoSolicitud" class="col-sm-3 col-form-label">Tipo Solicitud</label>
                            <div class="col-sm-9">
                                <input type="text" name="tipoSolicitud" id="tipoSolicitud" class="form-control" value="<?php echo $dato['tipoSolicitud']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row col-5" id="cont-direccion">
                            <label for="direccion" class="col-sm-3 col-form-label">Dirección</label>
                            <div class="col-sm-9">
                                <input type="text" name="direccion" id="direccion" class="form-control" value="<?php echo $dato['direccion']; ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row" style="justify-content: center;">
                        <div class="form-group row col-5" id="cont-barrio">
                            <label for="barrio" class="col-sm-3 col-form-label">Barrio</label>
                            <div class="col-sm-9">
                                <input type="text" name="barrio" id="barrio" class="form-control" value="<?php echo $dato['barrio']; ?>" readonly>
                            </div>
                        </div>    

                        <div class="form-group row col-5" id="cont-localidad">
                            <label for="localidad" class="col-sm-3 col-form-label">Localidad</label>
                            <div class="col-sm-9">
                                <input type="text" name="localidad" id="localidad" class="form-control" value="<?php echo $dato['localidad']; ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row" style="justify-content: center;">
                        <div id="cont-celular" class="form-group row col-5">
                            <label for="celular" class="col-sm-3 col-form-label">Celular</label>
                            <div class="col-sm-9">
                                <input type="text" name="celular" id="celular" class="form-control" value="<?php echo $dato['celular']; ?>" readonly>
                            </div>
                        </div>
                        <div id="cont-telefono" class="form-group row col-5">
                            <label for="telefono" class="col-sm-3 col-form-label">Telefono</label>
                            <div class="col-sm-9">
                                <input type="text" name="telefono" id="telefono" class="form-control" value="<?php echo $dato['telefono_fijo']; ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row" style="justify-content: center;">
                        <div id="cont-correo" class="form-group row col-5">
                            <label for="correo" class="col-sm-3 col-form-label">Correo</label>
                            <div class="col-sm-9">
                                <input type="text" name="correo" id="correo" class="form-control" value="<?php echo $dato['correo']; ?>" readonly>
                            </div>
                        </div>
                        <div id="cont-modalidadPago" class="form-group row col-5">
                            <label for="modalidadPago" class="col-sm-3 col-form-label">Modalidad Pago</label>
                            <div class="col-sm-9">
                                <input type="text" name="modalidadPago" id="modalidadPago" class="form-control" value="<?php echo $dato['modalidadPago']; ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="justify-content: center;">

                    <div id="cont-tipoPaciente" class="form-group row col-5">
                            <label for="tipoPaciente" class="col-sm-3 col-form-label">Tipo Paciente</label>
                            <div class="col-sm-9">
                                <input type="text" name="tipoPaciente" id="tipoPaciente" class="form-control" value="<?php echo $dato['tipoPaciente']; ?>" readonly>
                            </div>
                        </div>
                        <div id="cont-plan" class="form-group row col-5">
                            <label for="plan" class="col-sm-3 col-form-label">Plan</label>
                            <div class="col-sm-9">
                                <input type="text" name="plan" id="plan" class="form-control" value="<?php echo $dato['plan']; ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="justify-content: center;">

                    <div id="cont-posiblecasoCovid" class="form-group row col-5">
                            <label for="posiblecasoCovid" class="col-sm-3 col-form-label">Posible caso Covid</label>
                            <div class="col-sm-9">
                                <input type="text" name="posiblecasoCovid" id="posiblecasoCovid" class="form-control" value="<?php echo $dato['posibleCovid']; ?>" readonly>
                            </div>
                        </div>
                        <div id="cont-fechaServicio" class="form-group row col-5">
                            <label for="fechaServicio" class="col-sm-3 col-form-label">Fecha Servicio</label>
                            <div class="col-sm-9">
                                <input type="text" name="fechaServicio" id="fechaServicio" class="form-control" value="<?php echo $dato['fechaServicio']; ?>" readonly>
                            </div>
                        </div>
                    </div>
                    

                    <div class="row" style="justify-content: center;">
                        <div class="form-group row col-10" style="justify-content: center;" id="cont-observaciones">
                            <label for="observaciones" class="col-sm-3 col-form-label">Observaciones</label>
                            <div class="col-sm-9">
                                <textarea name="observaciones" id="observaciones" class="form-control" cols="30" rows="5" style="resize: none;" readonly><?php echo $dato['observaciones']; ?></textarea>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                </form>
                <hr>
                <?php if($permiso == 1 && $filaR[1] != "CORREO ENVIADO"){ ?>
                <form method="post" name="form_laboratorios_gestor" id="form_laboratorios_gestor">
                    <h1 style="text-align: center;">Datos<b> BACK OFFICE </b></h1>
                    <hr>

                    <div id="encabezado" class="form-group">
                        <input type="text" name="dia" id="dia" value="" readonly> <!-- Muestra el dia actual -->
                        <img src="media/img/datos-del-usuario.png" class="mover" alt="anadir" width="80px">
                        <input type="text" name="hora" id="hora" value="" readonly> <!-- Muestra la hora actual en tiempo real -->
                        <input type="hidden" name="user" id="user" value="<?php echo $_SESSION['idUsers']; ?>">
                        <input type="hidden" name="registro" id="registro" value="<?php echo $registro ?>"> <!-- Muestra el numero del registro a crear -->
                    </div>        

                    
                    <div id="cont-enviarCorreo">
                        <center><a href="<?php echo $correo; ?>"><img src="media/img/gmail.png" title="enviar correo" alt="enviar correo" width="50px"></a></center>
                    </div>
                <?php if($filaR[20] != '') { ?>
                    <div class="rows" style="justify-content: center;">
                    <?php if ($filaR[20] != '') { ?>     
                    <h4>Respuesta Anterior</h4>
        
                        <textarea class="left form-control" readonly> <?php echo $filaR[20] ?></textarea>
                  
                         <?php } ?>
                    </div>
                 <?php } ?>
                 <?php if(!is_null($filaR[1])) { ?>
                    <div class="row" style="justify-content: center;">
                    <?php if(!is_null($filaR[1])) { ?>     
                        <div class="form-group row col-6" style="justify-content: center;" id="cont-CentroMedicoB">
                            <label for="CentroMedicoB" class="col-sm-3 col-form-label">Estado Anterior</label>
                            <div class="col-sm-9">
                                 <input class="form-control" readonly value="<?php echo $filaR[1] ?>">
                            </div>
                        </div>
        
                    <?php } ?>
                     
                    </div>
                    <?php } ?>

                   
                    <br>
                    
                    <div class="row" style="justify-content: center;">
                        <div class="form-group row col-6" style="justify-content: center;" id="cont-observacionesBack">
                            <label for="observacionesBack" class="col-sm-3 col-form-label">Observaciones</label>
                            <div class="col-sm-9">
                                <textarea name="observacionesBack" id="observacionesBack" class="form-control"  rows="5" style="resize: none;" autofocus> </textarea>
                            </div>
                        </div>   
                    </div>

                
                    <div class="row" id="cont-estado"  style="justify-content: center;">
                            <label for="estado" class="col-sm-1 col-form-label">Estado</label>
                            <div class="col-sm-3">
                                <select name="estado" id="estado" class="form-control">
                                    <option value="" hidden>Selecciona una opcion</option>
                                    <!-- consulta traer datos de la base -->
                                    <?php $tipolSsql = "SELECT id_tipificacion, nombre_tipificacion FROM tipificaciones WHERE grupo_tipificacion = 'Estado - Laboratorios' AND grupo_tipificacion2 = 'citas' ORDER BY nombre_tipificacion ASC";
                                        $tipoQsql = $con -> query($tipolSsql);
                                    ?>
                                    <!-- ciclo para mostrar las areas -->
                                    <?php foreach ($tipoQsql as $row) { ?>
                                    
                                        <option value="<?php echo $row['id_tipificacion']; ?>"> <?php echo $row['nombre_tipificacion']; ?></option>
                                    
                                    <?php } ?>                        
                                </select>
                            </div>
                     </div>
                  

                    <br>

                    <center><input type="submit" class="btn btn-primary" id="btnEnviar_laboratorios_gestor" name="btnEnviar_laboratorios_gestor" value="Guardar"></center>

                </form>
                <?php } ?>
        </div>
    </section>
</body>
<script src="sistema/js/libs/pushbar.js"></script>


<script type="text/javascript">
    const pushbar = new Pushbar({
          blur:true,
          overlay:true,
        });
</script>
    <script src="sistema/js/libs/sweetalert2.js"></script>
    <script src="sistema/js/ajax_formularios/form_laboratorioCitas_gestor.js"></script>
    <script src="sistema/js/libs/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>                