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
    <title>Consulta - Laboratorios</title>
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
    <form action="consulta-laboratorios.php"  method="post">

            <h1>Consulta de Laboratorios</h1>
            
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
                    <th style='color:#fff;'> Nombre Usuario</th>
                    <th style='color:#fff;'> Correo </th>
                    <th style='color:#fff;'> Usuario Crea</th>
                    <th style='color:#fff;'> Usuario Cierra</th>
                    <th style='color:#fff;'> Observaciones</th>
                </tr>
         </thead>
        ";
       
        
$consulta = mysqli_query($con, "SELECT tlaboratorios.id_registro,
                                t2.nombre_tipificacion AS estado,
                                DATE_FORMAT(tlaboratorios.fechaRegistro, '%d/%m/%Y') AS fecha_registro,
                                tlaboratorios.horaRegistro,
                                tlaboratorios.modalidadPago,
                                tlaboratorios.tipoPaciente,
                                tlaboratorios.tipoSolicitud,
                                tlaboratorios.nombrePaciente,
                                tlaboratorios.documento,
                                tlaboratorios.direccion,
                                tlaboratorios.barrio,
                                tlaboratorios.localidad,
                                tlaboratorios.celular,
                                tlaboratorios.telefono_fijo,
                                tlaboratorios.correo,
                                tlaboratorios.centroMedico,
                                tlaboratorios.posibleCovid,
                                tlaboratorios.plan,
                                tlaboratorios.servicio_programado,
                                tlaboratorios.observaciones,
                                tlaboratorios.observacionesBack,
                                tlaboratorios.fechaServicio,
                                u.username AS user_crea,
                                u.username AS user_cierre
                                FROM ((( laboratorios_adomicilio tlaboratorios
                                LEFT JOIN tipificaciones t2
                                    ON tlaboratorios.id_tipificacionEstado = t2.id_tipificacion)        
                                LEFT JOIN usuarios u
                                    ON tlaboratorios.id_UserCrea = u.id_usuario)
                                LEFT JOIN usuarios u1
                                    ON tlaboratorios.id_UserCierre = u1.id_usuario)
                                WHERE tlaboratorios.documento = '$id'");

while($registro = mysqli_fetch_array($consulta)){

      echo "

      <tr>
            <td>".$registro['fecha_registro']."</td>
            <td>".$registro['horaRegistro']."</td>
            <td>".$registro['documento']."</td>
            <td>".$registro['estado']."</td>
            <td>".$registro['nombrePaciente']."</td>
            <td>".$registro['correo']."</td>
            <td>".$registro['user_crea']."</td>
            <td>".$registro['user_cierre']."</td>
            <td> <button class='btn btn-success'data-pushbar-target='pushbar-menu-fonoplus".$registro['id_registro']."'> <span class='icon-eye'></span> Ver</button></td>

      </tr>
      <div data-pushbar-id='pushbar-menu-fonoplus".$registro['id_registro']."' data-pushbar-direction='bottom' class='pusbar-fono-consultar2'>
      <div class='adicional'></div>
      <div class='adicional'></div>
      <div class='adicional'></div>
      <section style='width:70%;'>
      
      <div id='formulario' style='margin-top:5vh;'>    
          <h1> Gestión Contact Consulta<b> - Laboratorios  </b> </h1>
          <hr>
              <form method='post'>
                  <div class='row' style='justify-content: center;'>
                          <div class='form-group row col-6' id='cont-fecha_activacionModulo'>
                              <label for='fecha_activacionModulo' class='col-sm-5 col-form-label'>Tip° de Solicitud</label>
                              <div class='col-sm-6'>
                                  <input type='text' name='fecha_activacionModulo' id='fecha_activacionModulo' class='form-control' value=".$registro['tipoSolicitud']." readonly>
                              </div>
                          </div>
                          <div class='form-group row col-5' id='cont-fecha_activacionModulo'>
                          <label for='fecha_activacionModulo' class='col-sm-6 col-form-label'>Nombre Paciente</label>
                          <div class='col-sm-6'>
                              <input type='text' name='fecha_activacionModulo' id='fecha_activacionModulo' class='form-control' value=".$registro['nombrePaciente']." readonly>
                          </div>
                      </div>
                          
                  </div>
              
                  <div class='row' style='justify-content: center;'>
                        <div class='form-group row col-6' id='cont-fecha_activacionModulo'>
                            <label for='fecha_activacionModulo' class='col-sm-5 col-form-label'>Dirección</label>
                            <div class='col-sm-6'>
                                <input type='text' name='fecha_activacionModulo' id='fecha_activacionModulo' class='form-control' value=".$registro['direccion']." readonly>
                            </div>
                       </div>
                        <div class='form-group row col-5' id='cont-fecha_activacionModulo'>
                            <label for='fecha_activacionModulo' class='col-sm-6 col-form-label'>Barrio</label>
                            <div class='col-sm-6'>
                                <input type='text' name='fecha_activacionModulo' id='fecha_activacionModulo' class='form-control' value=".$registro['barrio']." readonly>
                            </div>
                        </div>
                  
                  </div>
                      
                    <div class='row' style='justify-content: center;'>
                      <div class='form-group row col-6' id='cont-fecha_activacionModulo'>
                          <label for='fecha_activacionModulo' class='col-sm-5 col-form-label'>Localidad</label>
                          <div class='col-sm-6'>
                              <input type='text' name='fecha_activacionModulo' id='fecha_activacionModulo' class='form-control' value=".$registro['localidad']." readonly disabled>
                          </div>
                      </div>
                      <div class='form-group row col-5' id='cont-fecha_activacionModulo'>
                          <label for='fecha_activacionModulo' class='col-sm-6 col-form-label'>Número Celular</label>
                          <div class='col-sm-6'>
                              <input type='text' name='fecha_activacionModulo' id='fecha_activacionModulo' class='form-control' value=".$registro['celular']." readonly disabled>
                          </div>
                      </div>
                    </div>

                    <div class='row' style='justify-content: center;'>
                        <div class='form-group row col-6' id='cont-fecha_activacionModulo'>
                            <label for='fecha_activacionModulo' class='col-sm-5 col-form-label'>Número Fijo</label>
                            <div class='col-sm-6'>
                                <input type='text' name='fecha_activacionModulo' id='fecha_activacionModulo' class='form-control' value=".$registro['telefono_fijo']." readonly disabled>
                            </div>
                        </div>
                        <div class='form-group row col-5' id='cont-fecha_activacionModulo'>
                            <label for='fecha_activacionModulo' class='col-sm-6 col-form-label'>Correo Electronico</label>
                            <div class='col-sm-6'>
                                <input type='text' name='fecha_activacionModulo' id='fecha_activacionModulo' class='form-control' value=".$registro['correo']." readonly disabled>
                            </div>
                        </div>
                  </div>
                  <div class='row' style='justify-content: center;'>
                        <div class='form-group row col-6' id='cont-fecha_activacionModulo'>
                            <label for='fecha_activacionModulo' class='col-sm-5 col-form-label'>Modalidad de pago</label>
                            <div class='col-sm-6'>
                                <input type='text' name='fecha_activacionModulo' id='fecha_activacionModulo' class='form-control' value=".$registro['modalidadPago']." readonly disabled>
                            </div>
                        </div>
                        <div class='form-group row col-5' id='cont-fecha_activacionModulo'>
                            <label for='fecha_activacionModulo' class='col-sm-6 col-form-label'>Tipo de paciente</label>
                            <div class='col-sm-6'>
                                <input type='text' name='fecha_activacionModulo' id='fecha_activacionModulo' class='form-control' value=".$registro['tipoPaciente']." readonly disabled>
                            </div>
                        </div>
                            </div>
                        
                    <div class='row' style='justify-content: center;'>
                        <div class='form-group row col-6' id='cont-fecha_activacionModulo'>
                            <label for='fecha_activacionModulo' class='col-sm-5 col-form-label'>Plan</label>
                            <div class='col-sm-6'>
                                <input type='text' name='fecha_activacionModulo' id='fecha_activacionModulo' class='form-control' value=".$registro['plan']." readonly disabled>
                            </div>
                        </div>
                        <div class='form-group row col-5' id='cont-fecha_activacionModulo'>
                                <label for='fecha_activacionModulo' class='col-sm-6 col-form-label'>Posible Caso Covid</label>
                                <div class='col-sm-6'>
                                    <input type='text' name='fecha_activacionModulo' id='fecha_activacionModulo' class='form-control' value=".$registro['posibleCovid']." readonly disabled>
                                </div>
                        </div>
                    </div>

                    <div class='row' style='justify-content: center;'>
                            <label for='detalle' class='col-sm-3 col-form-label'>Fecha Servicio</label>
                                <div class='col-sm-8'>
                                    <input type='text' name='fecha_activacionModulo' id='fecha_activacionModulo' class='form-control' value=".$registro['fechaServicio']." readonly disabled>
                                </div>
                               
                    </div>  
            
                    <br> 
                        
                  <div class='row' style='justify-content: center;'>
                      <label for='detalle' class='col-sm-3 col-form-label'>Observaciones Agente</label>
                      <div class='col-sm-8'>
                          <textarea class='form-control' style='resize:none; text-align:center; margin:auto;' readonly>".$registro['observaciones']."</textarea>
                      </div>
                  </div>
                  <br>
                  <div class='row' style='justify-content: center;'>
                      <label for='detalle' class='col-sm-3 col-form-label'>Observaciones Backoffice</label>
                          <div class='col-sm-8'>
                              <textarea class='form-control' style='resize:none; text-align:center; margin:auto;' readonly>".$registro['observacionesBack']."</textarea>
                          </div>
                  </div>

                  
          </div>    

      </section>
      <button data-pushbar-close><span class='icon-cancel-circle' id='close' style='background:none;'></span></button>
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
                <th> Nombre Usuario</th>
                <th> Correo </th>
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