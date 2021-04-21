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


    $traerDatos = "SELECT   tCitas.id_registro,
                            t.nombre_tipificacion AS estado,
                            DATE_FORMAT(tCitas.fecha_registro, '%d/%m/%Y') AS fecha_registro,
                            tCitas.hora_registro,
                            t1.nombre_tipificacion AS tipo_solicitud,
                            t2.nombre_tipificacion AS tipo_usuario,
                            tCitas.documento,
                            tCitas.contrato,
                            tCitas.nombres_usuario,
                            tCitas.correo,
                            tCitas.nomPersona_preguntar,
                            tCitas.telefono,
                            tCitas.celular,
                            tCitas.ciudad,
                            t3.nombre_tipificacion AS centro_medico,
                            tCitas.tipificacionOrdResPed,
                            t4.nombre_tipificacion AS centroMedico_back,
                            t5.nombre_tipificacion AS servicios_complementarios,
                            t6.nombre_tipificacion AS centro_costo,
                            tCitas.Nombre_Profesional,
                            tCitas.FechaServicio,
                            tCitas.ServicioSolicitado,
                            tCitas.respuesta,
                            tCitas.gestion_llamada,
                            u.username AS user_crea
                            FROM (((((((( inf_investigar_citas tCitas
                            LEFT JOIN tipificaciones t 
                                ON tCitas.id_tipificacionEstado = t.id_tipificacion)
                            LEFT JOIN tipificaciones t1 
                                ON tCitas.id_tipificacionTipoSol = t1.id_tipificacion)
                            LEFT JOIN tipificaciones t2
                                ON tCitas.id_tipificacionTipoUsu = t2.id_tipificacion)
                            LEFT JOIN tipificaciones t3
                                ON tCitas.Id_tipificacioncentroMedico = t3.id_tipificacion)
                            LEFT JOIN tipificaciones t4
                                ON tCitas.Id_tipificacioncentroMedicoBack = t4.id_tipificacion)
                                LEFT JOIN tipificaciones t5
                                ON tCitas.id_tipificacionServiciosCom = t5.id_tipificacion)
                            LEFT JOIN tipificaciones t6
                                ON tCitas.id_tipificacionCentroCosto  = t6.id_tipificacion)                           
                            LEFT JOIN usuarios u
                                ON tCitas.id_userCrea = u.id_usuario)
                            WHERE tCitas.id_registro = '$registro'";
                            

    $ver = $con ->query($traerDatos) or die ('Ocurrio un problema al traer los registros');    

    if ($filaR = mysqli_fetch_row($ver)) {
        $estado = $filaR[5];
        if ($filaR[5] = 'NONE') {
            $correos = EnvioCorreo($filaR[6], $filaR[5], $filaR[4], $filaR[8], $filaR[7]);
        }
    } 
    
?>

<!DOCTYPE html>
<html lang="es">
<head>
<!-- Estilos css -->
    <link rel="stylesheet" href="media/css/libs/pushbar.css">	
    <link rel="stylesheet" href="media/css/libs/bootstrap.min.css">
    <link rel="stylesheet" href="media/css/libs/bootstrap5.min.css">
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
    <title>Informacion a investigar Gestor - CITAS</title>

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
                        <div class="form-group row col-5" id="cont-telefono">
                            <label for="telefono" class="col-sm-3 col-form-label">Telefono fijo</label>
                            <div class="col-sm-9">
                                <input type="text" name="telefono" id="telefono" class="form-control" value="<?php echo $dato['telefono']; ?>" readonly>
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
                        <div class="form-group row col-5" id="cont-persona">
                            <label for="persona" class="col-sm-3 col-form-label">Persona a preguntar</label>
                            <div class="col-sm-9">
                                <input type="text" name="persona" id="persona" class="form-control" value="<?php echo $dato['nomPersona_preguntar']; ?>" readonly>
                            </div>
                        </div>    

                        <div class="form-group row col-5" id="cont-ciudad">
                            <label for="ciudad" class="col-sm-3 col-form-label">Ciudad</label>
                            <div class="col-sm-9">
                                <input type="text" name="ciudad" id="ciudad" class="form-control" value="<?php echo $dato['ciudad']; ?>" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="justify-content: center;">
                        <div id="cont-estado" class="form-group row col-8">
                            <label for="estado1" class="col-sm-3 col-form-label">Estado</label>
                            <div class="col-sm-9">
                                <input type="text" name="estado1" id="estado1" class="form-control" value="<?php echo $dato['estado']; ?>" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="justify-content: center;">
                        <div class="form-group row col-10" style="justify-content: center;" id="cont-detalle">
                            <label for="detalle" class="col-sm-3 col-form-label">Detalle servicio</label>
                            <div class="col-sm-9">
                                <textarea name="detalle" id="detalle" class="form-control" cols="30" rows="5" style="resize: none;" readonly><?php echo $dato['ServicioSolicitado']; ?></textarea>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                </form>
                <hr>
                <?php if($permiso == 1 && $filaR[1] != "GESTIONADO" && $filaR[1] != "ANULADO"){ ?>
                <form method="post" name="form_infInvestigarCitas_gestor" id="form_infInvestigarCitas_gestor">
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
                        <center><a href="<?php echo $correos; ?>"><img src="media/img/gmail.png" title="enviar correo" alt="enviar correo" width="50px"></a></center>
                    </div>
                    <?php if($filaR[22] != '' || $filaR[23] != '') { ?>
                    <div class="rows">
                    <?php if ($filaR[22] != '') { ?>     
                    <h4>Respuesta Anterior</h4>
                        <textarea class="left form-control" readonly> <?php echo $filaR[22] ?></textarea>
                    <?php } ?>
                    <?php if ($filaR[23] != '') { ?>    
                    <h4>Gestion de llamada anterior</h4>
                        <textarea class="right form-control" readonly> <?php echo $filaR[23] ?></textarea>
                    <?php } ?>        
                    </div>
                    <?php } ?>
                    
                    <div class="row" style="justify-content: center;">
                        <div class="form-group row col-6" style="justify-content: center;" id="cont-respuesta">
                            <label for="respuesta" class="col-sm-3 col-form-label">Respuesta</label>
                            <div class="col-sm-9">
                                <textarea name="respuesta" id="respuesta" class="form-control" cols="30" rows="5" style="resize: none;" autofocus> </textarea>
                            </div>
                        </div>
                        
                        <div class="form-group row col-6" style="justify-content: center;" id="cont-gestion">
                            <label for="gestion" class="col-sm-3 col-form-label">Gestión llamada</label>
                            <div class="col-sm-9">
                                <textarea name="gestion" id="gestion" class="form-control" cols="30" rows="5" style="resize: none;" ></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="justify-content: center;">
                        <div class="form-group row col-5" id="cont-cmd">
                            <label for="cmd" class="col-sm-3 col-form-label">Centro Medico</label>
                            <div class="col-sm-9">
                                <select name="cmd" id="cmd" class="form-control">
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

                        <div class="form-group row col-5" id="cont-estado">
                            <label for="estado" class="col-sm-3 col-form-label">Estado</label>
                            <div class="col-sm-9">
                                <select name="estado" id="estado" class="form-control">
                                    <option value="" hidden>Selecciona una opcion</option>
                                    <!-- consulta traer datos de la base -->
                                    <?php $tipolSsql = "SELECT id_tipificacion, nombre_tipificacion FROM tipificaciones WHERE grupo_tipificacion = 'Estado Cierre InfInvCitas' AND grupo_tipificacion2 = 'citas' ORDER BY nombre_tipificacion ASC";
                                        $tipoQsql = $con -> query($tipolSsql);
                                    ?>
                                    <!-- ciclo para mostrar las areas -->
                                    <?php foreach ($tipoQsql as $row) { ?>
                                    
                                        <option value="<?php echo $row['id_tipificacion']; ?>"> <?php echo $row['nombre_tipificacion']; ?></option>
                                    
                                    <?php } ?>                        
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="justify-content: center;">

                        <div class="form-group row col-5" id="cont-centroCosto">
                            <label for="centroCosto" class="col-sm-3 col-form-label">Centro de costo</label>
                            <div class="col-sm-9">
                                <select name="centroCosto" id="centroCosto" class="form-control" onchange="selectNuevo(this)">
                                    <option value="" hidden>Selecciona una opcion</option>
                                    <!-- consulta traer datos de la base -->
                                    <?php $cmdSsql = "SELECT id_tipificacion, nombre_tipificacion FROM tipificaciones WHERE grupo_tipificacion = 'Centro Costos' AND grupo_tipificacion2 = 'citas' ORDER BY nombre_tipificacion ASC";
                                        $cmdQsql = $con -> query($cmdSsql);
                                    ?>
                                    <!-- ciclo para mostrar las areas -->
                                    <?php foreach ($cmdQsql as $row) { ?>
                                    
                                        <option value="<?php echo $row['id_tipificacion']; ?>"> <?php echo $row['nombre_tipificacion']; ?></option>
                                    
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div id="cont-servicio">
                        </div>
                    </div>

                    <center><input type="submit" class="btn btn-primary" id="btnEnviar_infInvestigarCitas_gestor" name="btnEnviar_infInvestigarCitas_gestor" value="Guardar"></center>

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
    <script src="sistema/js/ajax_formularios/form_infInvestigarCitas_gestor.js"></script>
    <script src="sistema/js/libs/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>                