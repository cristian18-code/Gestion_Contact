<?php 
    include('config/session.php');
    include('config/conexion.php');

    // valida si el usuario tiene permisos concedidos
	$permisoQsql = $con->query("SELECT AgenteCitas
                                    FROM permisos WHERE id_usuario = '".$_SESSION['idUsers']."'");

    if ($filaP = mysqli_fetch_row($permisoQsql)) {
        $permiso = $filaP[0];
    } else {
        header("location: alerta.php");
    }

    if($permiso != 1){ 
        header("location: alerta.php");
    }

    /* Trae el ultimo registro creado */
    $traerDatos = "SELECT max(id_registro) FROM inf_investigar_fono";
    $ver = $con->query($traerDatos) or die ("No se obtuvieron datos en la consulta");

    if ($row = mysqli_fetch_row($ver)) {
        $id = $row[0];
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
    <title>Laboratorio a domicilio - Citas</title>
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
        <h1>Datos Consultor <b> Citas </b> </h1>
        <hr>
            <form method="post" name="form_laboratorioCitas" id="form_laboratorioCitas">
                <div class="form-group" id="cont-registro" style="text-align: center;">
                <label for="registro" style="font-weight: 700;">Registro N°</label>
                <input type="text" class="form-control" name="registro" id="registro" readonly value="<?php echo $id + 1; ?>"> <!-- Muestra el numero del registro a crear -->
                </div>
                <br>
                <div id="encabezado" class="form-group">
                    <input type="text" name="dia" id="dia" value="" readonly> <!-- Muestra el dia actual -->
                    <img src="media/img/datos_citas.png" class="mover" alt="anadir" width="80px">
                    <input type="text" name="hora" id="hora" value="" readonly> <!-- Muestra la hora actual en tiempo real -->
                    <input type="hidden" name="user" id="user" value="<?php echo $_SESSION['idUsers']; ?>">
                </div>

                <div id="cont-tipoSolicitud" class="form-group row">
                    <label for="tipoSolicitud" class="col-sm-4 col-form-label">Tipo de Solicitud</label>
                    <div class="col-sm-8">
                        <select name="tipoSolicitud" id="tipoSolicitud" class="form-control" onchange="camposValidar(this)"  autofocus>
                            <option value="" hidden>Selecciona una opcion</option>
                            <!-- consulta traer datos de la base -->
                            <?php// $estadoSsql = "SELECT id_tipificacion, nombre_tipificacion FROM tipificaciones WHERE grupo_tipificacion = 'Estado consultor' AND grupo_tipificacion2 = 'fono' ORDER BY nombre_tipificacion ASC";
                                //$estadoQsql = $con -> query($estadoSsql);
                            ?>
                            <!-- ciclo para mostrar las areas -->
                            <?php //foreach ($estadoQsql as $row) { ?>
                            
                                <!-- <option value="<?php// echo $row['id_tipificacion']; ?>"> <?php// echo $row['nombre_tipificacion']; ?></option> -->
                            
                            <?php //} ?>    

                                <option value="Programacion">Programación</option>
                                <option value="Demora programacion">Demora programación</option>
                                <option value="Demora resultados">Demora resultados</option>
                                <option value="Cancelacion del servicio">Cancelación del servicio</option>
                                <option value="Otros">Otros</option>

                        </select>
                    </div>
                </div>

                <div class="form-group row" id="cont-fechaSolicitud">
                    <label for="fechaSolicitud" class="col-sm-4 col-form-label">Fecha de ingreso de la solicitud</label>
                    <div class="col-sm-8">
                        <input type="date" name="fechaSolicitud" class="form-control" autocomplete="off" id="fechaSolicitud" >
                    </div>
                </div>
            
                <div class="form-group row" id="cont-horaSolicitud">
                    <label for="horaSolicitud" class="col-sm-4 col-form-label">Hora de ingreso de la solicitud<i style="font-size: 10px; color:red;"> (Formato militar)</i></label>
                    <div class="col-sm-8">
                        <input type="text" placeholder="14:45" name="horaSolicitud" id="horaSolicitud" class="form-control" autocomplete="off">
                    </div>
                </div>

                <div class="form-group row" id="cont-nombres">
                    <label for="nombres" class="col-sm-4 col-form-label">Nombre Paciente</label>
                    <div class="col-sm-8">
                        <input type="text" name="nombres" id="nombres" class="form-control" autocomplete="off" placeholder="Nombre Completo" >
                    </div>
                </div>
                
                <div class="form-group row" id="cont-documento">
                    <label for="documento" class="col-sm-4 col-form-label">Documento</label>
                    <div class="col-sm-8">
                        <input type="text" name="documento" id="documento" class="form-control" autocomplete="off" placeholder="Documento paciente">
                    </div>
                </div>

                <div class="form-group row" id="cont-direccion">
                    <label for="direccion" class="col-sm-4 col-form-label">Direccion</label>
                    <div class="col-sm-8">
                        <input type="text" name="direccion" id="direccion" class="form-control" autocomplete="off" placeholder="Direccion paciente">
                    </div>
                </div>

                <div class="form-group row" id="cont-barrio">
                    <label for="barrio" class="col-sm-4 col-form-label">Barrio</label>
                    <div class="col-sm-8">
                        <input type="text" name="barrio" id="barrio" class="form-control" autocomplete="off" placeholder="Barrio paciente">
                    </div>
                </div>

                <div class="form-group row" id="cont-localidad">
                    <label for="localidad" class="col-sm-4 col-form-label">Localidad</label>
                    <div class="col-sm-8">
                        <input type="text" name="localidad" id="localidad" class="form-control" autocomplete="off" placeholder="localidad paciente">
                    </div>
                </div>

                <div class="form-group row" id="cont-celular">
                    <label for="celular" class="col-sm-4 col-form-label">Número celular</label>
                    <div class="col-sm-8">
                        <input type="text" name="celular" id="celular" class="form-control" autocomplete="off" placeholder="1234567890">
                    </div>
                </div>

                <div class="form-group row" id="cont-telefono">
                    <label for="telefono" class="col-sm-4 col-form-label">Número fijo</label>
                    <div class="col-sm-8">
                        <input type="text" name="telefono" id="telefono" class="form-control" autocomplete="off" placeholder="1234567">
                    </div>
                </div>

                <div class="form-group row" id="cont-correo">
                    <label for="correo" class="col-sm-4 col-form-label">Correo electronico</label>
                    <div class="col-sm-8">
                        <input type="email" name="correo" id="correo" class="form-control" autocomplete="off" placeholder="Correo Usuario">
                    </div>
                </div>

                <div class="form-group row" id="cont-modoPago">
                    <label for="modoPago" class="col-sm-4 col-form-label">Modalidad de pago</label>
                    <div class="col-sm-8">
                        <select name="modoPago" id="modoPago" class="form-control">
                            <option value="" hidden>Selecciona una opcion</option>
                            <!-- consulta traer datos de la base -->
                            <?php $causalSsql = "SELECT id_tipificacion, nombre_tipificacion FROM tipificaciones WHERE grupo_tipificacion = 'Causal' AND grupo_tipificacion2 = 'fono' ORDER BY nombre_tipificacion ASC";
                                $causalQsql = $con -> query($causalSsql);
                            ?>
                            <!-- ciclo para mostrar las areas -->
                            <?php foreach ($causalQsql as $row) { ?>
                            
                                <option value="<?php echo $row['id_tipificacion']; ?>"> <?php echo $row['nombre_tipificacion']; ?></option>
                            
                            <?php } ?>                        
                        </select>
                    </div>
                </div>

                <div class="form-group row" id="cont-tipoPaciente">
                    <label for="tipoPaciente" class="col-sm-4 col-form-label">Tipo de paciente</label>
                    <div class="col-sm-8">
                        <select name="tipoPaciente" id="tipoPaciente" class="form-control">
                            <option value="" hidden>Selecciona una opcion</option>
                            <!-- consulta traer datos de la base -->
                            <?php $causalSsql = "SELECT id_tipificacion, nombre_tipificacion FROM tipificaciones WHERE grupo_tipificacion = 'Causal' AND grupo_tipificacion2 = 'fono' ORDER BY nombre_tipificacion ASC";
                                $causalQsql = $con -> query($causalSsql);
                            ?>
                            <!-- ciclo para mostrar las areas -->
                            <?php foreach ($causalQsql as $row) { ?>
                            
                                <option value="<?php echo $row['id_tipificacion']; ?>"> <?php echo $row['nombre_tipificacion']; ?></option>
                            
                            <?php } ?>                        
                        </select>
                    </div>
                </div>

                <div class="form-group row" id="cont-plan">
                    <label for="plan" class="col-sm-4 col-form-label">Plan</label>
                    <div class="col-sm-8">
                        <input type="text" name="plan" id="plan" class="form-control" autocomplete="off" placeholder="Plan solicitado">
                    </div>
                </div>

                <div class="form-group row" id="cont-posibleCovid">
                    <label for="posibleCovid" class="col-sm-4 col-form-label">Posible caso COVID </label>
                    <div class="col-sm-8">
                        <select name="posibleCovid" id="posibleCovid" class="form-control">
                            <option value="" hidden>Selecciona una opcion</option>                                                        
                            <option value="Si">Si</option>
                            <option value="No">No</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row" id="cont-servicioProgramado">
                </div>  

                <div class="form-group row" id="cont-fechaServicio">
                    <label for="fechaServicio" class="col-sm-4 col-form-label">Fecha de servicio</label>
                    <div class="col-sm-8">
                        <input type="date" name="fechaServicio" class="form-control" autocomplete="off" id="fechaServicio">
                    </div>
                </div>

                <div class="form-group row" id="cont-cmd">
                </div>  

                <div class="form-group row" id="cont-observaciones">
                    <label for="observaciones" class="col-sm-4 col-form-label">Observaciones</label>
                    <div class="col-sm-8">
                        <textarea name="observaciones" id="observaciones" class="form-control" style="resize:none; text-align: center;" ></textarea>
                    </div>
                </div>
                <center><input type="submit" class="btn btn-primary" id="btnEnviar_laboratorioCitas_consultor" name="btnEnviar_laboratorioCitas_consultor" value="Guardar"></center>
            </form>
        </div>    

    </section>
</body>
    <script src="sistema/js/ajax_formularios/form_laboratorioCitas_consultor.js"></script>
    <script src="sistema/js/libs/pushbar.js"></script>
<script type="text/javascript">
    const pushbar = new Pushbar({
          blur:true,
          overlay:true,
        });
</script>
</html>