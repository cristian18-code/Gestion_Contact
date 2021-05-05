<?php 
    include('config/session.php');
    include('config/conexion.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <link rel="stylesheet" href="media/css/libs/pushbar.css">	
    <link rel="stylesheet" href="media/css/libs/bootstrap.min.css">
    <link rel="stylesheet" href="media/css/header.css">
    <link rel="stylesheet" href="media/icons/style.css">
    <link rel="stylesheet" href="media/css/libs/pushbar.css">
    <link rel="stylesheet" href="media/css/tabla_usuarios.css"> 
	<link rel="stylesheet" href="media/css/libs/animate.css">    
    <link rel="stylesheet" href="media/css/libs/dataTables.bootstrap5.min.css"> <!-- estilo de la tabla -->
<!-- Estilos css -->
<link rel="shortcut icon" href="media/img/favicon.png" type="image/x-icon">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">	
<!-- Scripts -->
    <script src="sistema/js/libs/jquery-3.5.1.min.js"></script>
<!-- Scripts -->    
    <title>Consulta - Autorizaciones</title>
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
<section id="container">
    <form action="consulta-autorizaciones.php"  method="post">

            <h1>Consulta de Autorizaciones</h1>
            
            <input type="number" name="id" placeholder="Ingresa el Número de Documento o El Número de Contrato" class="form-control" required>
            <br>
            <br>
            <input type="submit" name="consultar" value="Consulta" class="btn btn-primary">

    </form>   

         <?php

if(isset($_POST['consultar'])){



         	$id = $_POST['id'];
         echo "

         <table id='registros' class='table table-striped table-bordered animate__animated animate__fadeIn' style='width:100%' >
         <thead style='background:rgb(0, 153, 255);'>
                <tr>
                    <th style='color:#fff;'> Fecha Registro</th>
                    <th style='color:#fff;'> Hora Registro</th>
                    <th style='color:#fff;'> Documento </th>
                    <th style='color:#fff;'> Contrato</th>
                    <th style='color:#fff;'> Correo </th>
                    <th style='color:#fff;'> Servicio Solicitado</th>
                    <th style='color:#fff;'> Estado</th>
                    <th style='color:#fff;'> Agente</th>
                    <th style='color:#fff;'> Backoffice</th>
                    <th style='color:#fff;'> Observaciones</th>
                </tr>
         </thead>
        ";
       
        
$consulta = mysqli_query($con, "SELECT  autorizaciones.id_registro,
                                        t.nombre_tipificacion AS estado,
                                        t1.nombre_tipificacion AS Servicio_solicitado,
                                        DATE_FORMAT(autorizaciones.fechaRegistro, '%d/%m/%Y') AS fecha_registro,
                                        autorizaciones.horaRegistro,
                                        autorizaciones.documento,
                                        autorizaciones.contrato,
                                        autorizaciones.nombres_usuario,
                                        autorizaciones.telefono,
                                        autorizaciones.correo,
                                        autorizaciones.codigo_ips,
                                        autorizaciones.diagnostico,
                                        autorizaciones.ciudad,
                                        autorizaciones.nombre_prestador,
                                        autorizaciones.observaciones,
                                        autorizaciones.observacionesBack,
                                        u.username AS user_crea,
                                        u1.username AS user_cierre
                                        FROM ((((autorizaciones_fono autorizaciones
                                        LEFT JOIN usuarios u
                                            ON autorizaciones.id_userCrea = u.id_usuario)
                                        LEFT JOIN usuarios u1
                                            ON autorizaciones.id_userCierre = u1.id_usuario)
                                        LEFT JOIN tipificaciones t 
                                            ON autorizaciones.id_tipificacionEstado = t.id_tipificacion)
                                        LEFT JOIN tipificaciones t1 
                                            ON autorizaciones.id_servicioRequerido = t1.id_tipificacion)
                                        WHERE autorizaciones.documento = '$id' OR autorizaciones.contrato = '$id'");

while($registro = mysqli_fetch_array($consulta)){

      echo "

      <tr>
            <td>".$registro['fecha_registro']."</td>
            <td>".$registro['horaRegistro']."</td>
            <td>".$registro['documento']."</td>
            <td>".$registro['contrato']."</td>
            <td>".$registro['correo']."</td>
            <td>".$registro['Servicio_solicitado']."</td>
            <td>".$registro['estado']."</td>
            <td>".$registro['user_crea']."</td>
            <td>".$registro['user_cierre']."</td>
            <td> <button class='btn btn-success'data-pushbar-target='pushbar-menu-fonoplus".$registro['id_registro']."'> <span class='icon-eye'></span> Ver</button></td>

      </tr>
      <div data-pushbar-id='pushbar-menu-fonoplus".$registro['id_registro']."' data-pushbar-direction='bottom' class='pusbar-fono-consultar1'>
      <div class='respuestas'>
      <h1> Diagnostico </h1> <h1> Observaciones Agente</h1> <h1> Observaciones Backoffice </h1>
      </div>
      <div class='respuestas'>
      <textarea class='form-control' style='resize:none; text-align:center; margin:auto;' readonly>".$registro['diagnostico']."</textarea>
      <textarea class='form-control' style='resize:none; text-align:center; margin:auto;' readonly>".$registro['observaciones']."</textarea>
      <textarea class='form-control' style='resize:none; text-align:center; margin:auto;' readonly>".$registro['observacionesBack']."</textarea>
      <div>
      <button data-pushbar-close><span class='icon-cancel-circle' id='close'></span></button>
      </div>
         
            ";
      };
      echo "
      <tfoot style='background:rgb(0, 153, 255);'>
            <tr>
                <th> Fecha Registro</th>
                <th> Hora Registro</th>
                <th> Documento </th>
                <th> Contrato </th>
                <th> Correo </th>
                <th> Servicio Solicitado </th>
                <th> Estado</th>
                <th> Agente</th>
                <th> Backoffice</th>
                <th> Observaciones</th>
            </tr>
       </tfoot>
            </table>
            </section>
        ";

 }
?>

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
    <script src="sistema/js/libs/jquery.dataTables.min.js"></script> <!-- Script de Datatable -->
    <script src="sistema/js/libs/bootstrap5.min.js"></script> <!-- Script de Datatable -->
	<script src="sistema/js/libs/sweetalert2.js"></script>
</html>