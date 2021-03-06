<?php
    include('config/session.php');
    include('config/conexion.php');

    /* Traer los tickets pendientes */
    $ssql = "SELECT preparaciones.id_registro,
                    t1.nombre_tipificacion AS estado,
                    DATE_FORMAT(preparaciones.fecha_registro, '%d/%m/%Y') AS fecha_registro,
                    preparaciones.hora_registro,
                    preparaciones.documento,
                    preparaciones.contrato,
                    preparaciones.nombres_usuario,
                    t.nombre_tipificacion AS solicitud
                    FROM ((envio_preparaciones preparaciones 
                    INNER JOIN tipificaciones t 
                                ON preparaciones.id_tipificacionSolicitud = t.id_tipificacion)
                    LEFT JOIN  tipificaciones t1 
                                ON preparaciones.id_tipificacionEstado = t1.id_tipificacion)
                    WHERE id_tipificacionEstado != '30' AND id_tipificacionEstado !='33' OR id_tipificacionEstado IS NULL";

    $qsqlDatos = $con->query($ssql);


?>
<!DOCTYPE html>
<html lang="es">
<head>
<!-- Estilos css -->
    <link rel="stylesheet" href="media/css/libs/pushbar.css">	
    <link rel="stylesheet" href="media/css/libs/bootstrap5.min.css">
    <link rel="stylesheet" href="media/css/header.css">
    <link rel="stylesheet" href="media/icons/style.css">
    <link rel="stylesheet" href="media/css/tabla_infInvestigar.css">
    <link rel="stylesheet" href="media/css/libs/dataTables.bootstrap5.min.css"> <!-- estilo de la tabla -->
<!-- Estilos css -->
    <link rel="shortcut icon" href="media/img/favicon.png" type="image/x-icon">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Scripts -->
    <script src="sistema/js/libs/jquery-3.5.1.min.js"></script>
    <script src="sistema/js/getTime.js"></script>
<!-- Scripts -->       
    <title>Envio Preparaciones - Gestion Contact</title>
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

    <div class="adicional"></div>

    <section>

        <div>   
        <span class=""><h2>Envio <b>Preparaciones</b></h2></span>
        <input type="text" name="dia" id="dia" value="" readonly> <!-- Muestra el dia actual -->
        <img src="media/img/enviar.png" class="mover" width="70px" alt="<?php echo $tabla?>" width="120px">
        <input type="text" name="hora" id="hora" value="" readonly>  <!-- Muestra la hora actual en tiempo real -->
        </div>

        <br>

        <table id="registros" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Registro</th>
                    <th>Fecha registro</th>
                    <th>Hora registro</th>
                    <th>Estado</th>
                    <th>documento</th>
                    <th>contrato</th>
                    <th>nombres usuario</th>
                    <th>Tipo solicitud</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($qsqlDatos as $dato) { ?>
                    <tr>
                        <form action="preparaciones_gestor.php" method="post">
                            <td><?php echo $dato['id_registro']; ?></td>
                            <td><?php echo $dato['fecha_registro']?></td>
                            <td><?php echo $dato["hora_registro"]; ?></td>
                            <td><?php echo $dato["estado"]; ?></td>
                            <td><?php echo $dato["documento"]; ?></td>
                            <td><?php echo $dato['contrato']?></td>
                            <td><?php echo $dato['nombres_usuario']?></td>
                            <td><?php echo $dato['solicitud']?></td>
                            <input type="hidden" id="estado" value="<?php echo $dato['solicitud']; ?>"> <!-- para dar color a la fila-->
                            <input type="hidden" name="registro" id="registro" value="<?php echo $dato['id_registro'];?>"> <!-- numero de registro -->
                            <input type="hidden" name="tabla" id="tabla" value="<?php echo $tabla;?>"> <!-- numero de registro -->
                       
                                <td><input type="submit" value="Editar" class="btn btn-light"></td> <!-- Envia los tres datos anteriores -->
                  
                        </form>
                    </tr>
                <?php } ?>
            </tbody>
            <tfoot>
            <tr>
                <th>Registro</th>
                <th>Fecha registro</th>
                <th>Hora registro</th>
                <th>Estado</th>
                <th>documento</th>
                <th>contrato</th>
                <th>nombres usuario</th>
                <th>Tipo solicitud</th>
                <th>Editar</th>
      
            </tr>
            </tfoot>
        </table>
    </section>

    <div class="adicional"></div>

</body>
<script src="sistema/js/libs/pushbar.js"></script>
<script type="text/javascript">
    const pushbar = new Pushbar({
          blur:true,
          overlay:true,
        });
</script>
<script>
    $(document).ready(function() {
        $('#registros').DataTable(); /* Script para la tabla */
    } );
</script>
    <script>
        $("table #estado").each(function() { /* recorrer el campo de cierreTicket de todas las filas */
            var value = this.value; /* Guarda el valor*/
            if (/INMEDIATA/.test(value)) {
                $(this).parent('tr').attr("id", "rojo"); /* le da un id a la fila*/
            }
            if (!/INMEDIATA/.test(value)) {
                $(this).parent('tr').attr("id", "naranja");
            }
        });
    </script>
    <script src="sistema/js/libs/sweetalert2.js"></script>
    <script src="sistema/js/libs/jquery.dataTables.min.js"></script> <!-- Script de Datatable -->
    <script src="sistema/js/libs/bootstrap5.min.js"></script> <!-- Script de Datatable -->
</html>