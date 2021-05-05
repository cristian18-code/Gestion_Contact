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
    $traerDatos = "SELECT max(id_registro) FROM reversiones_fono";
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
    <title>Reversiones Consultor - Fono</title>
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
        <h1>Reversiones Consultor <b> Fono </b> </h1>
        <hr>
            <form method="post" name="form_reversiones_consultor" id="form_reversiones_consultor">
                <div class="form-group" id="cont-registro" style="text-align: center;">
                <label for="registro" style="font-weight: 700;">Registro N°</label>
                <input type="text" class="form-control" name="registro" id="registro" readonly value="<?php echo $id + 1; ?>"> <!-- Muestra el numero del registro a crear -->
                </div>
                <br>
                <div id="encabezado" class="form-group">
                    <input type="text" name="dia" id="dia" value="" readonly> <!-- Muestra el dia actual -->
                    <img src="media/img/reversiones.png" class="mover" alt="anadir" width="80px">
                    <input type="text" name="hora" id="hora" value="" readonly> <!-- Muestra la hora actual en tiempo real -->
                    <input type="hidden" name="user" id="user" value="<?php echo $_SESSION['idUsers']; ?>">
                </div>

            

                <div class="form-group row" id="cont-usuario">
                    <label for="usuario" class="col-sm-4 col-form-label">Usuario</label>
                    <div class="col-sm-8">
                        <input type="text" name="usuario" class="form-control" autocomplete="off" placeholder="Ingrese el Nombre de Usuario" id="usuario" autofocus="autofocus">
                    </div>
                </div>
            
                <div class="form-group row" id="cont-documento">
                    <label for="documento" class="col-sm-4 col-form-label">Documento</label>
                    <div class="col-sm-8">
                        <input type="text" name="documento" class="form-control" autocomplete="off" placeholder="Numero de Documento" id="documento">
                    </div>
                </div>

                <div class="form-group row" id="cont-contrato">
                    <label for="contrato" class="col-sm-4 col-form-label">Contrato</label>
                    <div class="col-sm-8">
                        <input type="text" name="contrato" id="contrato" class="form-control" autocomplete="off" placeholder="Numero de Contrato">
                    </div>
                </div>

                <div class="form-group row" id="cont-napReversar">
                    <label for="napReversar" class="col-sm-4 col-form-label">Nap a Reversar</label>
                    <div class="col-sm-8">
                        <input type="text" name="napReversar" id="napReversar" class="form-control" autocomplete="off" placeholder="Ingrese el Nap">
                    </div>
                </div>

                <div class="form-group row" id="cont-auxiliarIPS">
                    <label for="auxiliarIPS" class="col-sm-4 col-form-label">Auxiliar IPS</label>
                    <div class="col-sm-8">
                        <input type="text" name="auxiliarIPS" id="auxiliarIPS" class="form-control" autocomplete="off" placeholder="Ingrese el Auxiliar IPS">
                    </div>
                </div>

                <div class="form-group row" id="cont-motReversion">
                    <label for="motReversion" class="col-sm-4 col-form-label">Motivo Reversión</label>
                    <div class="col-sm-8">
                        <select name="motReversion" id="motReversion" class="form-control">
                            <option value="" hidden>Selecciona una opcion</option>
                            <!-- consulta traer datos de la base -->
                            <?php $cmdSsql = "SELECT id_tipificacion, nombre_tipificacion FROM tipificaciones WHERE grupo_tipificacion = 'Reversiones Consultor' AND grupo_tipificacion2 = 'fono' ORDER BY nombre_tipificacion ASC";
                                $cmdQsql = $con -> query($cmdSsql);
                            ?>
                            <!-- ciclo para mostrar las areas -->
                            <?php foreach ($cmdQsql as $row) { ?>
                            
                                <option value="<?php echo $row['id_tipificacion']; ?>"> <?php echo $row['nombre_tipificacion']; ?></option>
                            
                            <?php } ?>                        
                        </select>
                    </div>
                </div>


                <div class="form-group row" id="cont-observaciones">
                    <label for="observaciones" class="col-sm-4 col-form-label">Observaciones</label>
                    <div class="col-sm-8">
                        <textarea name="observaciones" id="observaciones" class="form-control" style="resize:none; text-align: center;" placeholder="Servicio solicitado"></textarea>
                    </div>
                </div>
                
                <div class="form-group row">
                    <label for="inputErrorLinFre" class="col-sm-4 col-form-label">Error en linea de frente</label>
                    <div class="col-sm-8">
                        <div class="form-check form-check-inline">

                            <label style="font-weight: 200; visibility:hidden;" class="form-check-label" for="inputErrorLinFre">------------------------------------</label>
                            <input class="form-check-input" type="radio" name="inputErrorLinFre" id="inputErrorLinFre" value="Error en linea de frente">
                            
                        </div>
                    </div>
                </div>
                <center><input type="submit" class="btn btn-primary" id="btnEnviar_reversiones_consultor" name="btnEnviar_reversiones_consultor" value="Guardar"></center>
            </form>
        </div>    

    </section>
</body>
    <script src="sistema/js/libs/pushbar.js"></script>
    <script src="sistema/js/ajax_formularios/form_reversiones_consultor.js"></script>
<script type="text/javascript">
    const pushbar = new Pushbar({
          blur:true,
          overlay:true,
        });
</script>
</html>