<?php 
    include('config/session.php');
    include('config/conexion.php');

    // valida si el usuario tiene permisos concedidos
	$permisoQsql = $con->query("SELECT ConsultorFono
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
    $traerDatos = "SELECT max(id_registro) FROM mantenimiento_posventa";
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
    <title>Mantenimiento Posventa</title>
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
        <h1>Mantenimiento Posventa<b> FONOPLUS </b> </h1>
        <hr>
            <form method="post" name="form_mantenimientoPos" id="form_mantenimientoPos">
                <div class="form-group" id="cont-registro" style="text-align: center;">
                <label for="registro" style="font-weight: 700;">Registro N°</label>
                <input type="text" class="form-control" name="registro" id="registro" readonly value="<?php echo $id + 1; ?>"> <!-- Muestra el numero del registro a crear -->
                </div>
                <br>
                <div id="encabezado" class="form-group">
                    <input type="text" name="dia" id="dia" value="" readonly> <!-- Muestra el dia actual -->
                    <img src="media/img/archivo.png" class="mover" alt="anadir" width="80px">
                    <input type="text" name="hora" id="hora" value="" readonly> <!-- Muestra la hora actual en tiempo real -->
                    <input type="hidden" name="user" id="user" value="<?php echo $_SESSION['idUsers']; ?>">
                </div>

                <div class="form-group row" id="cont-documento">
                    <label for="documento" class="col-sm-4 col-form-label">N° Documento</label>
                    <div class="col-sm-8">
                        <input type="text" name="documento" class="form-control" autocomplete="off" placeholder="Ingrese el numero de documento" id="documento">
                    </div>
                </div>
            
                <div class="form-group row" id="cont-contrato">
                    <label for="contrato" class="col-sm-4 col-form-label">N° Contrato</label>
                    <div class="col-sm-8">
                        <input type="text" name="contrato" class="form-control" autocomplete="off" placeholder="Numero de contrato" id="contrato">
                    </div>
                </div>

                <div class="form-group row" id="cont-NomUsuario">
                    <label for="NomUsuario" class="col-sm-4 col-form-label">Nombre Usuario</label>
                    <div class="col-sm-8">
                        <input type="text" name="NomUsuario" class="form-control" autocomplete="off" placeholder="Ingrese el Nombre del usuario" id="NomUsuario">
                    </div>
                </div>
            
                <div class="form-group row" id="cont-telefono">
                    <label for="telefono" class="col-sm-4 col-form-label">Telefono</label>
                    <div class="col-sm-8">
                        <input type="tel" name="telefono" class="form-control" autocomplete="off" placeholder="ingrese el telefono del usuario" id="telefono">
                    </div>
                </div>
                

                <div class="form-group row" id="cont-correo">
                    <label for="correo" class="col-sm-4 col-form-label">Correo electronico</label>
                    <div class="col-sm-8">
                        <input type="text" name="correo" id="correo" class="form-control" autocomplete="off" placeholder="Correo Usuario">
                    </div>
                </div>
                
                <div class="form-group row" id="cont-ciudad">
                    <label for="ciudad" class="col-sm-4 col-form-label">Ciudad</label>
                    <div class="col-sm-8">
                        <input type="text" name="ciudad" class="form-control" autocomplete="off" placeholder="ingrese la ciudad" id="ciudad">
                    </div>
                </div>

                <div class="form-group row" id="cont-AsesorMan">
                    <label for="AsesorMan" class="col-sm-4 col-form-label">Asesor Mantenimiento</label>
                    <div class="col-sm-8">
                        <input type="text" name="AsesorMan" class="form-control" autocomplete="off" placeholder="ingrese el nombre de asesor de mantenimiento" id="AsesorMan">
                    </div>
                </div>

                <div class="form-group row" id="cont-observaciones">
                    <label for="observaciones" class="col-sm-4 col-form-label">Observaciones</label>
                    <div class="col-sm-8">
                        <textarea name="observaciones" id="observaciones" class="form-control" style="resize:none; text-align: center;" placeholder="Observaciones"></textarea>
                    </div>
                </div>

               
                <center><input type="submit" class="btn btn-primary" id="btnEnviar_mantenimientoPos" name="btnEnviar_mantenimientoPos" value="Guardar"></center>
            </form>
        </div>    

    </section>
</body>
    <script src="sistema/js/ajax_formularios/form_mantenimientoPos_consultor.js"></script>
    <script src="sistema/js/libs/pushbar.js"></script>
<script type="text/javascript">
    const pushbar = new Pushbar({
          blur:true,
          overlay:true,
        });
</script>
</html>-