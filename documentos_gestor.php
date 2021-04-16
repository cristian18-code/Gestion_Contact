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
	$permisoQsql = $con->query("SELECT GestorFono
                                    FROM permisos WHERE id_usuario = '".$_SESSION['idUsers']."'") or die (header("location: principal.php"));

    if ($filaP = mysqli_fetch_row($permisoQsql)) {
        $permiso = $filaP[0];
    } else {
        header("location: alerta.php");
    }


    $traerDatos = "SELECT tFono.id_registro,
                            DATE_FORMAT(tFono.fechaRegistro, '%d/%m/%Y') AS fecha_registro,
                            tFono.horaRegistro,
                            tFono.documento,
                            tFono.contrato,
                            tFono.correo,
                            tFono.observaciones,
                            t1.nombre_tipificacion AS Servicio_Solicitado,
                            tFono.ciudad,
                            u.username AS user_crea
                            FROM (( envio_documentos tFono
                            INNER JOIN tipificaciones t1 
                                ON tFono.id_tipificacionServicioSo = t1.id_tipificacion)
                            INNER JOIN usuarios u
                                ON tFono.id_userCrea = u.id_usuario)
                            WHERE tFono.id_registro = '$registro'";
                            

    $ver = $con ->query($traerDatos) or die ('Ocurrio un problema al traer los registros');    

if ($filaR = mysqli_fetch_row($ver)) {
    $correos = EnvioCorreoDocumentos($filaR[5], $filaR[4]);
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
    <title>Envio Documentos - Gestor</title>

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
            <h1>Datos a gestionar <b>FONOPLUS</b> </h1>
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

                        <div class="form-group row col-5" id="cont-contrato">
                            <label for="contrato" class="col-sm-3 col-form-label">N° contrato</label>
                            <div class="col-sm-9">
                                <input type="text" name="contrato" id="contrato" class="form-control" value="<?php echo $dato['contrato']; ?>" readonly>
                            </div>
                        </div>
                    </div>



                    <div class="row" style="justify-content: center;">
                        <div class="form-group row col-5" id="cont-causal">
                            <label for="causal" class="col-sm-3 col-form-label">Servicio Solicitado</label>
                            <div class="col-sm-9">
                                <input type="text" name="causal" id="causal" class="form-control" value="<?php echo $dato['Servicio_Solicitado']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row col-5" id="cont-correo">
                            <label for="correo" class="col-sm-3 col-form-label">Correo</label>
                            <div class="col-sm-9">
                                <input type="text" name="correo" id="correo" class="form-control" value="<?php echo $dato['correo']; ?>" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="justify-content: center;">
                      
                                        <div class="form-group row col-5" id="cont-ciudad">
                            <label for="ciudad" class="col-sm-3 col-form-label">Ciudad</label>
                            <div class="col-sm-9">
                                <input type="text" name="ciudad" id="ciudad" class="form-control" value="<?php echo $dato['ciudad']; ?>" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="justify-content: center;">
                        <div class="form-group row col-10" style="justify-content: center;" id="cont-detalle">
                            <label for="detalle" class="col-sm-3 col-form-label">Observaciones</label>
                            <div class="col-sm-9">
                                <textarea name="detalle" id="detalle" class="form-control" cols="30" rows="5" style="resize: none;" readonly><?php echo $dato['observaciones']; ?></textarea>
                            </div>
                        </div>
                    </div>
                <?php } ?>
                </form>
                <hr>

                <!-- formlario a llenar por el gestor-->

                <?php if($permiso == 1){ ?>
                <form method="post" name="form_documentosFono_gestor" id="form_documentosFono_gestor">
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
                    
                    <div class="row" style="justify-content: center;">
                        <div class="form-group row col-6" style="justify-content: center;" id="cont-gestion">
                            <label for="observacionesBack" class="col-sm-3 col-form-label">Observaciones Back Office</label>
                            <div class="col-sm-9">
                                <textarea name="observacionesBack" id="observacionesBack" class="form-control" cols="30" rows="5" style="resize: none;"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row col-6" id="cont-estado" style="margin-left:auto; margin-right:auto; margin-top: 1%;">
                    <label for="estado" class="col-sm-4 col-form-label">Estado</label>
                    <div class="col-sm-8">
                        <select name="estado" id="estado" class="form-control" autofocus>
                            <option value="" hidden>Selecciona una opcion</option>
                            <!-- consulta traer datos de la base -->
                    
                            <?php $estadoSsql = "SELECT id_tipificacion, nombre_tipificacion FROM tipificaciones WHERE grupo_tipificacion = 'Estado Documento' AND grupo_tipificacion2 = 'fono' ORDER BY nombre_tipificacion ASC";
                                $estadoQsql = $con->query($estadoSsql);
                            ?>
                            <!-- ciclo para mostrar las areas -->
                            <?php foreach ($estadoQsql as $row) { ?>
                            
                                <option value="<?php echo $row['id_tipificacion']; ?>"> <?php echo $row['nombre_tipificacion']; ?></option>
                            
                            <?php } ?>                        
                        </select>
                    </div>
                    </div>
                    <center><input type="submit" class="btn btn-primary" id="btnEnviar_documentosFono_gestor" name="btnEnviar_documentosFono_gestor" value="Guardar"></center>
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
    <script src="sistema/js/ajax_formularios/form_documentosFono_gestor.js"></script>
    <script src="sistema/js/libs/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>                