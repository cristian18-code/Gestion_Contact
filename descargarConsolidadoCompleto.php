<?php 
    include('config/session.php');
///// INCLUIR LA CONEXIÓN A LA BD /////////////////

?>
<html lang="es">
<head>
<!-- Estilos css -->
<!-- Estilos css -->
   <link rel="stylesheet" href="media/styles/libs/bootstrap5.min.css">
    <link rel="stylesheet" href="media/css/libs/bootstrap.min.css">
    <link rel="stylesheet" href="media/css/libs/reset.css">
    <link rel="stylesheet" href="media/icons/style.css">
    <link rel="stylesheet" href="media/css/header.css">
<!-- Estilos css -->
    <link rel="shortcut icon" href="media/img/favicon.png" type="image/x-icon">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Scripts -->
    <script src="sistema/js/libs/jquery-3.5.1.min.js"></script>
<!-- Scripts -->    
    <title>Reportar Gestion Contact</title>
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
 
 <a href="#ventana1" class="btn btn-primary" data-toggle="modal" id="cuenta" ><span class="icon-download"></span> Generar Reporte</a>
<div class="modal fade" id="ventana1" >

  <div class="modal-dialog" >

	   <div class="modal-content">

				  <!-- Contenedor de titulo ventana emergente-->  
				  <div class="modal-header">

						  <h4 class="modal-title"> Reporte Consolidado Gestion Contact</h4>
					
						  <button type="button" class="close" data-dismiss="modal" aria-hidden="true"> &times; </button>  

				  </div>
				  <!-- Contenedor de titulo ventana emergente-->
				  <!-- Contenedor de Formulario Descagar reporte-->
				  <div class="modal-body">
				  <section>
					<div id="formulario_usuario" style="z-index:30px;">
							<form method="POST" action="reporteConsolidadoCompleto.php">
							<label> Fecha Inicial </label>
							<input type="date" name="fecha1" class="form-control">
                            <br>
							<label> Fecha Final </label>
							<input type="date" name="fecha2" class="form-control">
                            <br>
							<label style="visibility:hidden;">---------</label>
							<br>
							<input type="submit" name="generar_reportes"  class="btn btn-primary" placeholder="Descargar Reporte" value="Descargar Reporte" id="reporte"></input>
					
							</form>
					</div>	
				</section>
				  </div>

				  <div class="modal-footer">

						  <button type="button" class="btn btn-primary" data-dismiss="modal" ><span class="icon-switch"></span> Cerrar</button> 

				  </div>

	   </div>

  </div>
  
</div>
		
</form>
		</section>
		<div class="adicional"></div>
		
	
		
</body>
        <script src="sistema/js/libs/jquery.dataTables.min.js"></script> <!-- Script de Datatable -->
		<script src="sistema/js/libs/bootstrap5.min.js"></script> <!-- Script de Datatable -->
		<script src="sistema/js/libs/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</html>


