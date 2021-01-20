<?php 
    include('config/session.php');
    include('config/conexion.php');

    if ($_SESSION['rols'] != 'Administrador' && $_SESSION['rols'] != 'Supervisor') {
        header("location: principal.php");
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
<!-- Estilos css -->
    <link rel="stylesheet" href="css/libs/bootstrap.min.css">
    <link rel="stylesheet" href="css/reportar_incidencia.css">
<!-- Estilos css -->
    <link rel="shortcut icon" href="media/images/favicon.png" type="image/x-icon">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Scripts -->
    <script src="sistema/js/getTime.js"></script>
    <script src="sistema/js/libs/jquery-3.5.1.min.js"></script>
<!-- Scripts -->    
    <title>Reportar incidencia - Bitacora</title>
</head>
<body>
    <header>
          <nav>
 
        </nav>
    </header>

    <section>
    
    <div id="formulario_reportar">        
        <h1>Solicitudes Soporte Contact</h1>
        <hr>
        <div class="alerta"></div>
            <form enctype="multipart/form-data" method="post" name="formTicket" id="formTicket">
                <div class="form-group" style="text-align: center;">
                <label for="id" style="font-weight: 700;">Ticket N°</label>
                <input type="text" class="form-control" name="id" id="id" readonly value="<?php echo ($id+1); ?>"> <!-- Muestra el numero del registro a crear -->
                </div>
                <br>
                <div id="encabezado" class="form-group">
                    <input type="text" name="dia" id="dia" value="" readonly> <!-- Muestra el dia actual -->
                    <img src="media/images/mantenimiento.png" alt="anadir" width="80px">
                    <input type="text" name="hora" id="hora" value="" readonly> <!-- Muestra la hora actual en tiempo real -->
                    <input type="hidden" name="user" id="user" value="<?php echo $_SESSION['idUser']; ?>">
                </div>

                <div id="cont-area" class="form-group row">
                    <label for="area" class="col-sm-4 col-form-label">Area solicitante</label>
                    <div class="col-sm-8">
                        <select name="area" id="area" class="form-control" required>
                            <option value="" hidden>Selecciona una opcion</option>                       
                        </select>
                    </div>
                </div>

                <div class="form-group row" id="cont-tipo_reporte">
                    <label for="tipo_reporte" class="col-sm-4 col-form-label">Tipo de reporte</label>
                    <div class="col-sm-8">
                        <select name="tipo_reporte" id="tipo_reporte" class="form-control" onchange="mostrarIncidencia(this)" required>
                            <option value="" hidden>Selecciona una opcion</option>
                        <!-- consulta traer datos de la base -->
                        </select>
                    </div>
                </div>
            
                <div class="form-group row" id="cont-tipo_incidencia">
                    <label for="tipo_incidencia" class="col-sm-4 col-form-label">Tipo de incidencia</label>
                    <div class="col-sm-8">
                        <select name="tipo_incidencia" id="tipo_incidencia" class="form-control" required>
                            <option value="" hidden>Selecciona una opcion</option>

                        </select>
                    </div>
                </div>

                <div class="form-group row" id="cont-detalle">
                    <label for="detalle" class="col-sm-4 col-form-label">Descripción</label>
                    <div class="col-sm-8">
                        <textarea name="detalle" id="detalle" class="form-control" style="resize:none;" required></textarea>
                    </div>
                </div>

                <div class="form-group row" id="cont-archivo">
                    <label for="archivo" class="col-sm-4 col-form-label">Adjuntar</label>
                    <div class="col-sm-8">
                        <input type="file" name="archivo" class="form-control" id="archivo" multiple>
                    </div>
                </div>

                <div class="form-group row" id="cont-prioridad">
                    <label for="nivel" class="col-sm-4 col-form-label">Prioridad de respuesta</label>
                    <div class="col-sm-8">
                        <select name="prioridad" id="prioridad" class="form-control" required>
                            <option value="" hidden>Seleccionar</option>
                            <option value="Alta">Alta</option>
                            <option value="Media">Media</option>
                            <option value="Baja">Baja</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputZip" class="col-sm-4 col-form-label">Incidencia a nivel</label>
                    <div class="col-sm-8">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="nivel" id="inlineRadio1" value="Individual" required>
                            <label style="font-weight: 200;" class="form-check-label" for="inlineRadio1">Invidual</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="nivel" id="inlineRadio2" value="General">
                            <label style="font-weight: 200;" class="form-check-label" for="inlineRadio2">General</label>
                        </div>
                    </div>
                </div>
                <center><input type="submit" class="btn btn-primary" id="btnEnviar" name="btnEnviar" value="Reportar"></center>
            </form>
        </div>            

    </section>


</body>
</html>