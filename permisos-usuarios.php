
<?php

	include('config/session.php');
	include('config/conexion.php');

	// valida si el usuario tiene permisos concedidos
	$permisoQsql = $con->query("SELECT crud_usuarios
									FROM permisos WHERE id_usuario = '".$_SESSION['idUsers']."'");

	if ($filaP = mysqli_fetch_row($permisoQsql)) {
		$permiso = $filaP[0];
	} else {
		header("location: alerta.php");
	}

	if($permiso != 1){ 
		header("location: alerta.php");
	} 

    if(empty($_REQUEST['id']) || $_REQUEST['id'] == 1 || $_REQUEST['id'] == 2 || $_REQUEST['id'] == 3)
    {
        header('location: listado_usuarios.php');
    }else{
	
		$idusuario = $_REQUEST['id'];

		$query = mysqli_query($con, "SELECT u.nombre, u.username, r.nombre_rol 
												  FROM usuarios u
												  INNER JOIN 
												  roles r ON u.rol = r.id_rol 
												  WHERE u.id_usuario =$idusuario");
		$result = mysqli_num_rows($query);

		if($result > 0){
			while ($data = mysqli_fetch_array($query)){ 
				$nombre = $data['nombre'];
				$usuario = $data['username'];
				$rol = $data['nombre_rol'];
			}
		}else{
			header('location: listado_usuarios.php');
		}
	}
	$valitatessql = "SELECT id_usuario FROM permisos WHERE id_usuario = '$idusuario'"; // validar si ya existe el usuario
	$qsql = $con->query($valitatessql);
	if(mysqli_num_rows($qsql) == 0){
			$insert_id = "INSERT INTO permisos(id_usuario) VALUES ('$idusuario')";
			$insert = $con->query($insert_id);
	}
	$valitatessqls = "SELECT * FROM permisos WHERE id_usuario = '$idusuario'"; // validar si ya existe el usuario
	$qsqls = $con->query($valitatessqls);
	if (!empty($_POST)) {
        // Declaracion de variables que se mostraran segun sus campos designados" //
       		$alert='';
            $ConsultorFono = $_POST['ConsultorFono'];
            $GestorFono = $_POST['GestorFono'];
            $AgenteCitas = $_POST['AgenteCitas'];
            $GestorCitas = $_POST['GestorCitas'];
			$reportes = $_POST['reportes'];
			$usuarios = $_POST['usuarios'];
    

            // Se ejecuta un Query que valide si el Usuario y la Cedula no se encuentran creados//
            $query = mysqli_query($con,"UPDATE permisos SET ConsultorFono = '$ConsultorFono', GestorFono = '$GestorFono', AgenteCitas = '$AgenteCitas',
			GestorCitas = '$GestorCitas', reportes = '$reportes', crud_usuarios = '$usuarios'
			WHERE id_usuario = '$idusuario' ");
			
		if($query){
			$alert='<div id="total"> <a class="msg_save animate__animated animate__fadeInDown"> 
							<img src="media/img/success.gif" class="success">
							<h1> Permisos Brindados Correctamente</h1>
							<button style="visibility:hidden;" class="btn btn-primary" onclick="ocultar();"> OK</button>
						</a>
					</div>'; 
		}
		else {
			$alert='<div id="total"> <a class="msg_error animate__animated animate__fadeInDown"> 
							<img src="media/img/error.gif" class="success">
							<h1> Error al brindar los permisos </h1>
							<button style="visibility:hidden;" class="btn btn-danger" "> OK</button>
						</a>
					</div>';    
		}
    }


?>
<!DOCTYPE html>
<html lang="es">
<head>
<!-- Estilos css -->

	<link rel="stylesheet" href="media/css/libs/pushbar.css">	
    <link rel="stylesheet" href="media/css/libs/bootstrap.min.css">
    <link rel="stylesheet" href="media/css/header.css">
    <link rel="stylesheet" href="media/icons/style.css">
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
    <title>Permisos Usuarios - Bitacora</title>
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

	 <div class="data-delete">
	
	<?php foreach($qsqls as $dato) {?>
		 <form method="POST" class="" action=""> 

			<h2>Brindar Permisos A:</h2>
			<p>Nombre:<span><?php echo $nombre; ?></span></p>
			<p>ID Usuario:<span><?php echo $idusuario; ?></span></p>
			<p>Tipo Usuario:<span><?php echo $rol; ?></span></p>
			 <input type="hidden" name="idusuario" value="<?php echo $idusuario;?>"></input>
			 <button type="submit" value="Aceptar" class="btn btn-primary"> Actualizar</button>
                <a href="listado-usuarios.php" class="btn btn-danger">Cancelar</a>
				<div class="alerta"> <?php echo isset($alert)? $alert :''; ?></div>
			 <table id="usuario" class="table table-striped table-bordered">

				<thead style=" background:rgb(0, 153, 255);">
					<tr>
						<th style=" color:white;"> SI</th>
						<th style=" color:white;"> NO </th>
						<th style=" color:white;"> Nombre </th>
					</tr>
				</thead>
			
				<tbody>
			
					<tr>
			  			<td> <input class="form-check-input"  <?php if($dato['ConsultorFono'] == 1) { ?> checked="checked" <?php } ?>  type="radio" name="ConsultorFono" id="inlineRadio1" value="1"></td>
						<td> <input class="form-check-input"  <?php if($dato['ConsultorFono'] == 0) { ?> checked="checked" <?php } ?>  type="radio" name="ConsultorFono" id="inlineRadio2" value="0"></td>
						<td> Fonoplus Consultor </td>
					
					</tr>

			
					<tr>
						<td> <input class="form-check-input"  <?php if($dato['GestorFono'] == 1) { ?> checked="checked" <?php } ?>  type="radio" name="GestorFono" id="inlineRadio1" value="1"></td>
						<td> <input class="form-check-input"  <?php if($dato['GestorFono'] == 0) { ?> checked="checked" <?php } ?>  type="radio" name="GestorFono" id="inlineRadio2" value="0"></td>
						<td> Fonoplus Gestor</td>
					
					</tr>

				
					<tr>
						<td> <input class="form-check-input"  <?php if($dato['AgenteCitas'] == 1) { ?> checked="checked" <?php } ?>  type="radio" name="AgenteCitas" id="inlineRadio1" value="1"></td>
						<td> <input class="form-check-input"  <?php if($dato['AgenteCitas'] == 0) { ?> checked="checked" <?php } ?>  type="radio" name="AgenteCitas" id="inlineRadio2" value="0"></td>
						  <td> Citas Agente</td>
					
					</tr>

				
					<tr>
						<td> <input class="form-check-input"  <?php if($dato['GestorCitas'] == 1) { ?> checked="checked" <?php } ?>  type="radio" name="GestorCitas" id="inlineRadio1" value="1"></td>
						<td> <input class="form-check-input"  <?php if($dato['GestorCitas'] == 0) { ?> checked="checked" <?php } ?>  type="radio" name="GestorCitas" id="inlineRadio2" value="0"></td>
						<td> Citas Gestor</td>
					
					</tr>
					
					<tr>
						<td> <input class="form-check-input"  <?php if($dato['reportes'] == 1) { ?> checked="checked" <?php } ?>  type="radio" name="reportes" id="inlineRadio1" value="1"></td>
						<td> <input class="form-check-input"  <?php if($dato['reportes'] == 0) { ?> checked="checked" <?php } ?>  type="radio" name="reportes" id="inlineRadio2" value="0"></td>
						<td> Reportes</td>
					
					</tr>
					
					<tr>
						<td> <input class="form-check-input"  <?php if($dato['crud_usuarios'] == 1) { ?> checked="checked" <?php } ?>  type="radio" name="usuarios" id="inlineRadio1" value="1"></td>
						<td> <input class="form-check-input"  <?php if($dato['crud_usuarios'] == 0) { ?> checked="checked" <?php } ?>  type="radio" name="usuarios" id="inlineRadio2" value="0"></td>
						<td> Crud Usuarios</td>
					
					</tr>
			

			
						
				</tbody>

				<tfoot style="background:rgb(0, 153, 255);">
				<tr>
						<th style=" color:white;"> SI</th>
						<th style=" color:white;"> NO </th>
						<th style=" color:white;"> Nombre </th>
				</tr>
				</tfoot>

			</table>
				
		</form>	
    <?php }?>
	 </div>

    </section>
    
</body>
<script src="sistema/js/libs/pushbar.js"></script>
<script type="text/javascript">
    const pushbar = new Pushbar({
          blur:true,
          overlay:true,
        });
</script>
<script>
	setTimeout(function ocultar() {
		document.getElementById('total').style.display = 'none';
                    }, 2000); 
</script>
<script>
    $(document).ready(function() {
        $('#usuario').DataTable(); /* Script para la tabla */
    });
</script>	

    <script src="sistema/js/libs/jquery.dataTables.min.js"></script> <!-- Script de Datatable -->
    <script src="sistema/js/libs/bootstrap5.min.js"></script> <!-- Script de Datatable -->
	<script src="sistema/js/libs/sweetalert2.js"></script>
</html>