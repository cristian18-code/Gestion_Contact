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


    $traerDatos = "SELECT   tFono.id_registro,
                            t.nombre_tipificacion AS motivoReversion,
                            DATE_FORMAT(tFono.fechaRegistro, '%d/%m/%Y') AS fecha_registro,
                            tFono.horaRegistro,
                            tFono.documento,
                            tFono.contrato,
                            tFono.nap_aReversar,
                            tFono.auxiliar_ips,
                            tFono.observaciones,
                            tFono.usuario,
                            tFono.error_linea_fuente,
                            u.username AS user_crea,
                            tFono.observacionesBack
                            FROM (reversiones_fono tFono
                            LEFT JOIN tipificaciones t 
                                ON tFono.id_motivoReversion = t.id_tipificacion)
                            INNER JOIN usuarios u
                                ON tFono.id_userCrea = u.id_usuario
                            WHERE tFono.id_registro = '$registro'";
                            

    $ver = $con ->query($traerDatos) or die ('Ocurrio un problema al traer los registros');    
    $filaR = mysqli_fetch_row($ver)

    
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
    <title>Reversion - Gestor</title>

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
                    <label for="registro" style="font-weight: 700;">Registro N??</label>
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
                            <label for="documento" class="col-sm-3 col-form-label">N?? Documento</label>
                            <div class="col-sm-9">
                                <input type="text" name="documento" id="documento" class="form-control" value="<?php echo $dato['documento']; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row col-5" id="cont-contrato">
                            <label for="contrato" class="col-sm-3 col-form-label">N?? contrato</label>
                            <div class="col-sm-9">
                                <input type="text" name="contrato" id="contrato" class="form-control" value="<?php echo $dato['contrato']; ?>" readonly>
                            </div>
                        </div>
                    </div>



                    <div class="row" style="justify-content: center;">
                        <div class="form-group row col-5" id="cont-napReversar">
                            <label for="napReversar" class="col-sm-3 col-form-label">Nap a Reversar</label>
                            <div class="col-sm-9">
                                <input type="text" name="napReversar" id="napReversar" class="form-control" value="<?php echo $dato['nap_aReversar']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row col-5" id="cont-auxiliarIPS">
                            <label for="auxiliarIPS" class="col-sm-3 col-form-label">Auxiliar IPS</label>
                            <div class="col-sm-9">
                                <input type="text" name="auxiliarIPS" id="auxiliarIPS" class="form-control" value="<?php echo $dato['auxiliar_ips']; ?>" readonly>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="justify-content: center;">
                      
                         <div class="form-group row col-5" id="cont-motivoReversion">
                            <label for="motivoReversion" class="col-sm-3 col-form-label">Motivo Reversion</label>
                            <div class="col-sm-9">
                                <input type="text" name="motivoReversion" id="motivoReversion" class="form-control" value="<?php echo $dato['motivoReversion']; ?>" readonly>
                            </div>
                        </div>

                        <div class="form-group row col-5" id="cont-lineaFrente">
                            <label for="lineaFrente" class="col-sm-3 col-form-label"> linea de Frente</label>
                            <div class="col-sm-9">
                                <input type="text" name="lineaFrente" id="lineaFrente" class="form-control" value="<?php echo $dato['error_linea_fuente']; ?>" readonly>
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
                <form method="post" name="form_reversionesfono_gestor" id="form_reversionesfono_gestor">
                    <h1 style="text-align: center;">Datos<b> BACK OFFICE </b></h1>
                    <hr>
                    <div id="encabezado" class="form-group">
                        <input type="text" name="dia" id="dia" value="" readonly> <!-- Muestra el dia actual -->
                        <img src="media/img/datos-del-usuario.png" class="mover" alt="anadir" width="80px">
                        <input type="text" name="hora" id="hora" value="" readonly> <!-- Muestra la hora actual en tiempo real -->
                        <input type="hidden" name="user" id="user" value="<?php echo $_SESSION['idUsers']; ?>">
                        <input type="hidden" name="registro" id="registro" value="<?php echo $registro ?>"> <!-- Muestra el numero del registro a crear -->
                    </div>        

    
                    <div class="row" style="justify-content: center;">
                    <?php if ($filaR[12] != "" || $filaR[12] != "'") { ?>
                        <div class="form-group row col-6" style="justify-content: center;" id="cont-gestion">
                            <label for="observacionesAntBack" class="col-sm-3 col-form-label">Observacion anterior Back Office</label>
                            <div class="col-sm-9">
                                <textarea name="observacionesAntBack" id="observacionesAntBack" class="form-control" cols="30" rows="5" style="resize: none;    " readonly><?php echo $filaR[12]; ?></textarea>
                            </div>
                        </div>
                    <?php } ?>    
                        <div class="form-group row col-6" style="justify-content: center;" id="cont-gestion">
                            <label for="observacionesBack" class="col-sm-3 col-form-label">Observaciones Back Office</label>
                            <div class="col-sm-9">
                                <textarea name="observacionesBack" id="observacionesBack" class="form-control" cols="30" rows="5" style="resize: none;"></textarea>
                            </div>
                        </div>
                       
                        <div class="col-sm-8">
                        <label for="ReversionEfectiva" class="col-sm-4 col-form-label">Reversi??n Efectiva</label>
                            <div class="form-check form-check-inline">

                                <label style="font-weight: 200; visibility:hidden;" class="form-check-label" for="ReversionEfectiva">------------------------------</label>
                                <input class="form-check-input" type="radio" name="ReversionEfectiva" id="ReversionEfectiva" value="Reversion Efectiva">
                                
                            </div>
                        </div>
                    </div>
                    
                    <center><input type="submit" class="btn btn-primary" id="btnEnviar_reversionesfono_gestor" name="btnEnviar_reversionesfono_gestor" value="Guardar"></center>
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
    <script src="sistema/js/ajax_formularios/form_reversiones_gestor.js"></script>
    <script src="sistema/js/libs/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>                