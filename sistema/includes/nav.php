<?php 
    include('config/conexion.php');

    // valida si el usuario tiene permisos concedidos
	$permisoQsql = $con->query("SELECT reportes
                                    FROM permisos WHERE id_usuario = '".$_SESSION['idUsers']."'");

    if ($filaP = mysqli_fetch_row($permisoQsql)) {
        $reporte = $filaP[0];
    } else {
        header("location: alerta.php");
    }

?>

	
<!--Navbar -->
<ul class="nav justify-content-center">
  <li style="border-left:solid #fff 1px;"><a href="./principal.php"> <span class="icon-home3"></span> Inicio</a></li>

    <li class="principal"> <a href="#"> <span class="icon-aid-kit"></span> citas </a>
      <ul>
        <li><a href="./preparaciones_agente.php"> <span class="icon-folder-plus"> </span> Preparaciones</a></li>
        <li><a href="./tabla_envioPreparaciones.php">  <span class="icon-eye"> </span> Backoffice</a></li>
      </ul>
    </li>

    <li class="principal"> <a href="#" > <span class="icon-user-tie"></span> Fonoplus </a>
      <ul>
        <li><a href="./infInvestigar_Consultor.php" > <span class="icon-folder-plus"> </span> Inf a Investigar </a></li>
        <li><a href="./tabla_infInvestigar.php">  <span class="icon-eye"> </span> Backoffice </a></li>
      </ul>
    </li>
   <?php if($reporte == 1){?>
    <li><a href="#" data-pushbar-target="pushbar-menu-informe"> <span class="icon-stats-bars"></span> Informes</a></li>
   <?php } ?>
</ul>
                <!-- Contenedor de titulo ventana emergente-->  
         <div data-pushbar-id="pushbar-menu-informe" data-pushbar-direction="top" class="pushbar-informe">
     
                

                  <form method="POST" action="sistema/logica/reporteConsolidadoCompleto.php" id="form" name="form">
                    <h3> Reportes Gestión Contact Center</h3>
                      <label> Fecha Inicial </label>
                      <input type="date" name="fecha1" class="form-control">
                      <br>
                      <label> Fecha Final </label>
                      <input type="date" name="fecha2" class="form-control">
                      <br>
                      <label style="visibility:hidden;">---------</label>
                      <br>

                      <div id="ctn-icon-search">
                        <i class="icon-search" id="icon-search"></i>  <!--Funcion de Buscador-->
                      </div>

                      <div id="ctn-bars-search">
                      <input type="text" id="inputSearch" placeholder="¿Cual Reporte deseas Buscar?" autocomplete="off"></input>
                      </div>

                      <ul id="box-search">
                      <!-- Opciones de Reportes-->
                      <li><a> <button name="generar_reportes_preparaciones"  class="btn btn-primary"  value="Descargar Reporte Preparaciones" onclick='alerta();'><span class="icon-download2"></span> Reporte Preparaciones</button></a></li>
                      <li><a><button name="generar_reportes_fonoplus"  class="btn btn-primary"  value="Descargar Reporte Preparaciones" onclick='alerta();'><span class="icon-download2"></span> Reporte Fonoplus</button></a></li>

                      </ul>

                      <div id="cover-ctn-search">
                      <button><span class="icon-cancel-circle" id="close4"></span></button>
                      </div>
                      <button data-pushbar-close class="btn btn-primary" id="cerrar1"><span class="icon-switch"></span> Cerrar</button></a>
                  </form>


                  <button data-pushbar-close><span class="icon-cancel-circle" id="cerrar"></span></button>

        </div>
   
<script src="sistema/js/libs/buscador.js"></script>
<script src="sistema/js/libs/sweetalert2.js"></script>
<script src="sistema/js/ajax_formularios/alert.js"></script>

<!--/.Navbar -->
