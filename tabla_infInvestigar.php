<?php
    include('config/session.php');
    include('config/conexion.php');

    /* Traer los tickets pendientes */
    $ssql = "SELECT investigar.id_registro,
                    t.nombre_tipificacion AS estado,
                    DATE_FORMAT(investigar.fechaRegistro, '%d/%m/%Y') AS fecha_registro,
                    investigar.horaRegistro,
                    investigar.documento,
                    investigar.contrato,
                    investigar.nombresUsuario
                    FROM (inf_investigar_fono investigar
                        INNER JOIN tipificaciones t
                            ON investigar.id_tipificacionEstado = t.id_tipificacion)
                    WHERE id_tipificacionEstado != '14'";
    $qsqlDatos = $con->query($ssql);
    
    // valida si el usuario tiene permisos concedidos
	$permisoQsql = $con->query("SELECT inf_investigarGestor
                                    FROM permisos WHERE id_usuario = '".$_SESSION['idUsers']."'") or die ($permiso = 0);

    if ($filaP = mysqli_fetch_row($permisoQsql)) {
        $permiso = $filaP[0];
    } else {
        $permiso = 0;
    }

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
    <script src="sistema/js/getTime.js"></script>
    <script src="sistema/js/libs/jquery-3.5.1.min.js"></script>
<!-- Scripts -->       
    <title>Informacion a investigar fonoplus - Gestion Contact</title>
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
        <span class=""><h2>Registros Informacion a investigar <b>FONOPLUSS</b></h2></span>
        <input type="text" name="dia" id="dia" value="" readonly> <!-- Muestra el dia actual -->
        <img src="media/img/investigar.png" class="mover" width="70px" alt="<?php echo $tabla?>" width="120px">
        <input type="text" name="hora" id="hora" value="" readonly>  <!-- Muestra la hora actual en tiempo real -->
        </div>

        <br>

        <table id="registros" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>Registro</th>
                    <th>Estado</th>
                    <th>fecha Registro</th>
                    <th>Hora registro</th>
                    <th>Documento</th>
                    <th>Contrato</th>
                    <th>Nombres usuario</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($qsqlDatos as $dato) { ?>
                    <tr>
                        <form action="infInvestigar_gestor.php" method="post">
                            <td><?php echo $dato['id_registro']; ?></td>
                            <td><?php echo $dato['estado']?></td>
                            <td><?php echo $dato["fecha_registro"]; ?></td>
                            <td><?php echo $dato["horaRegistro"]; ?></td>
                            <td><?php echo $dato['documento']?></td>
                            <td><?php echo $dato['contrato']?></td>
                            <td><?php echo $dato['nombresUsuario']?></td>
                            <input type="hidden" id="estado" value="<?php echo $dato['estado']; ?>"> <!-- para dar color a la fila-->
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
                    <th>Estado</th>
                    <th>fecha Registro</th>
                    <th>Hora registro</th>
                    <th>Documento</th>
                    <th>Contrato</th>
                    <th>Nombres usuario</th>
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