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
    <title>Consulta - Examenes</title>
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
    <form action="consulta-inf-investigar.php"  method="post">

            <h1>Consulta de Información a Investigar</h1>
            
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
                    <th style='color:#fff;'> Estado</th>
                    <th style='color:#fff;'> Usuario</th>
                    <th style='color:#fff;'> Correo </th>
                    <th style='color:#fff;'> Celular </th>
                    <th style='color:#fff;'> Usuario Crea</th>
                    <th style='color:#fff;'> Usuario Cierra</th>
                    <th style='color:#fff;'> Observaciones</th>
                </tr>
         </thead>
        ";
       
        
$consulta = mysqli_query($con, "SELECT tFono.id_registro,
                                t.nombre_tipificacion AS estado,
                                DATE_FORMAT(tFono.fechaRegistro, '%d/%m/%Y') AS fecha_registro,
                                tFono.horaRegistro,
                                tFono.documento,
                                tFono.contrato,
                                tFono.nombresUsuario,
                                tFono.detalle_servicio,
                                tFono.email,
                                t1.nombre_tipificacion AS causal,
                                tFono.persona_preguntar,
                                tFono.telefono,
                                tFono.celular,
                                tFono.ciudad,
                                tFono.respuestaCierre,
                                tFono.Observaciones,
                                u.username AS user_crea,
                                u1.username AS user_cierra
                                FROM ((( inf_investigar_fono tFono
                                INNER JOIN tipificaciones t 
                                    ON tFono.id_tipificacionEstado = t.id_tipificacion)
                                INNER JOIN tipificaciones t1 
                                    ON tFono.id_tipificacionCausal = t1.id_tipificacion)
                                INNER JOIN usuarios u
                                    ON tFono.id_userCrea = u.id_usuario)
                                LEFT JOIN usuarios u1
                                    ON tFono.id_userCierre= u1.id_usuario
                                WHERE tFono.documento = '$id' OR tFono.contrato = '$id'");

while($registro = mysqli_fetch_array($consulta)){

      echo "

      <tr>
            <td>".$registro['fecha_registro']."</td>
            <td>".$registro['horaRegistro']."</td>
            <td>".$registro['documento']."</td>
            <td>".$registro['estado']."</td>
            <td>".$registro['nombresUsuario']."</td>
            <td>".$registro['email']."</td>
            <td>".$registro['ciudad']."</td>
            <td>".$registro['user_crea']."</td>
            <td>".$registro['user_cierra']."</td>
            <td> <button class='btn btn-success'data-pushbar-target='pushbar-menu-fonoplus".$registro['id_registro']."'> <span class='icon-eye'></span> Ver</button></td>

      </tr>
      <div data-pushbar-id='pushbar-menu-fonoplus".$registro['id_registro']."' data-pushbar-direction='bottom' class='pusbar-fono-consultar1'>
      <div class='respuestas'>
      <h1> Detalle Servicio </h1> <h1> Respuesta de Cierre </h1> <h1> Observaciones </h1>
      </div>
      <div class='respuestas'>
      <textarea class='form-control' style='resize:none; text-align:center; margin:auto;' readonly>".$registro['detalle_servicio']."</textarea>
      <textarea class='form-control' style='resize:none; text-align:center; margin:auto;' readonly>".$registro['respuestaCierre']."</textarea>
      <textarea class='form-control' style='resize:none; text-align:center; margin:auto;' readonly>".$registro['Observaciones']."</textarea>
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
                <th> Usuario</th>
                <th> Correo </th>
                <th> Celular </th>
                <th> Usuario Crea</th>
                <th> Usuario Cierra</th>
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