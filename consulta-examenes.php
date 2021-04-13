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
    <form action="consulta-examenes.php"  method="post">

            <h1>Consulta de Examenes</h1>
            
            <input type="number" name="id" placeholder="Ingresa el Número de Documento o El Número de Contrato" class="form-control" required>
            <br>
            <br>
            <input type="submit" name="consultar" value="Consulta" class="btn btn-primary">

    </form>   

         <?php

if(isset($_POST['consultar'])){



         	$id = $_POST['id'];
         echo "

         <table id='registros' class='table table-striped table-bordered'>
         <thead style='background:rgb(0, 153, 255);'>
                <tr>
                    <th style='color:#fff;'> Fecha Registro</th>
                    <th style='color:#fff;'> Hora Registro</th>
                    <th style='color:#fff;'> Documento </th>
                    <th style='color:#fff;'> Estado</th>
                    <th style='color:#fff;'> Usuario</th>
                    <th style='color:#fff;'> Examen </th>
                    <th style='color:#fff;'> Correo </th>
                    <th style='color:#fff;'> Celular </th>
                    <th style='color:#fff;'> Usuario Crea</th>
                    <th style='color:#fff;'> Usuario Cierra</th>
                    <th style='color:#fff;'> Observaciones</th>
                </tr>
         </thead>
        ";
       
        
$consulta = mysqli_query($con, "SELECT   preparaciones.id_registro,
                                t.nombre_tipificacion AS estado,
                                DATE_FORMAT(preparaciones.fecha_registro, '%d/%m/%Y') AS fecha_registro,
                                preparaciones.hora_registro,
                                preparaciones.documento,
                                preparaciones.contrato,
                                preparaciones.nombres_usuario,
                                preparaciones.examen,
                                preparaciones.correo,
                                preparaciones.celular,
                                preparaciones.observaciones,
                                preparaciones.fecha_envio,
                                preparaciones.hora_envio,
                                t1.nombre_tipificacion AS cmd,
                                t2.nombre_tipificacion AS tipo,
                                t3.nombre_tipificacion AS solicitud,
                                t4.nombre_tipificacion AS tipoPaciente,
                                u.username AS user_crea,
                                u1.username AS user_cierra
                                FROM (((((( envio_preparaciones preparaciones
                                LEFT JOIN tipificaciones t 
                                    ON preparaciones.id_tipificacionEstado = t.id_tipificacion)
                                INNER JOIN tipificaciones t1 
                                    ON preparaciones.id_tipificacionCmd = t1.id_tipificacion)
                                INNER JOIN tipificaciones t2 
                                    ON preparaciones.id_tipificacionTipo = t2.id_tipificacion)
                                INNER JOIN tipificaciones t3
                                    ON preparaciones.id_tipificacionSolicitud = t3.id_tipificacion)
                                INNER JOIN tipificaciones t4
                                    ON preparaciones.id_tipificacionTipo_paciente = t4.id_tipificacion)
                                INNER JOIN usuarios u
                                    ON preparaciones.id_userCrea = u.id_usuario)
                                LEFT JOIN usuarios u1
                                    ON preparaciones.id_userCierre = u1.id_usuario
                                WHERE preparaciones.documento = '$id' OR preparaciones.contrato = '$id'");
while($registro = mysqli_fetch_array($consulta)){

      echo "

      <tr>
            <td>".$registro['fecha_registro']."</td>
            <td>".$registro['hora_registro']."</td>
            <td>".$registro['documento']."</td>
            <td>".$registro['estado']."</td>
            <td>".$registro['nombres_usuario']."</td>
            <td>".$registro['examen']."</td>
            <td>".$registro['correo']."</td>
            <td>".$registro['celular']."</td>
            <td>".$registro['user_crea']."</td>
            <td>".$registro['user_cierra']."</td>
            <td> <button class='btn btn-success'data-pushbar-target='pushbar-menu-fonoplus".$registro['id_registro']."'> <span class='icon-eye'></span> Ver</button></td>

      </tr>
      <div data-pushbar-id='pushbar-menu-fonoplus".$registro['id_registro']."' data-pushbar-direction='bottom' class='pusbar-fono-consultar'>
      <h1> Observaciones </h1>
      <textarea class='form-control' style='resize:none; text-align:center; width:50%; margin:auto;' readonly>".$registro['observaciones']."</textarea>
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
                <th> Examen </th>
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