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
        <li><a href="#"> Preparaciones <span style="font-size: 14px;" class="icon-circle-right"></span> </a>
            <ul>
              <li><a href="preparaciones_agente.php"> <span class="icon-user-plus"> </span> Crear Registro </a></li>
              <li><a href="consulta-examenes.php"> <span class="icon-user-plus"> </span> Consultar Registro</a></li>
              <li><a href="tabla_envioPreparaciones.php"><span class="icon-clipboard"> </span> Gestión Backoffice </a></li>
            </ul>
          </li>
        <li><a href="#"> Inf a Investigar C <span style="font-size: 14px;" class="icon-circle-right"></span> </a>
            <ul>
              <li><a href="infInvestigarCitas_consultor.php"> <span class="icon-user-plus"> </span> Crear Registro </a></li>
              <li><a href="consulta-inf-investigar_citas.php"> <span class="icon-user-plus"> </span> Consultar Registro</a></li>
              <li><a href="tabla_infInvestigar_Citas.php"><span class="icon-clipboard"> </span> Gestión Backoffice </a></li>
            </ul>
          </li>
        <li><a href="#"> Laboratorios <span style="font-size: 14px;" class="icon-circle-right"></span> </a>
            <ul>
              <li><a href="laboratorioCitas_consultor.php"> <span class="icon-user-plus"> </span> Crear Registro </a></li>
              <li><a href="consulta-laboratorios.php"> <span class="icon-user-plus"> </span> Consultar Registro</a></li>
              <li><a href="tabla_laboratorioCitas.php"><span class="icon-clipboard"> </span> Gestión Backoffice </a></li>
            </ul>
          </li>
      </ul>
    </li>
    <?php if ($_SESSION['roles'] == 'Administrador') { ?>
    <li class="principal"> <a href="#"> <span class="icon-aid-kit"></span> Administrador </a>
      <ul>
              <li><a href="listado-usuarios.php"> <span class="icon-user-plus"> </span> Lista de Usuarios </a></li>
              <li><a href="crear_usuario.php"> <span class="icon-user-plus"> </span> Crear Usuario</a></li>
 
        
      </ul>
    </li>
    <?php } ?>
    <li class="principal"> <a href="#" > <span class="icon-user-tie"></span> Fonoplus </a>
      <ul>
      <li><a href="#"> Inf a Investigar F <span style="font-size: 14px;" class="icon-circle-right"></span> </a>
            <ul>
              <li><a href="infInvestigar_Consultor.php"> <span class="icon-user-plus"> </span> Crear Registro </a></li>
              <li><a href="consulta-inf-investigar.php"> <span class="icon-user-plus"> </span> Consultar Registro</a></li>
              <li><a href="tabla_infInvestigar.php"><span class="icon-clipboard"> </span> Gestión Backoffice </a></li>
            </ul>
          </li>
          <li><a href="#">Envio Documentos <span style="font-size: 14px;" class="icon-circle-right"></span> </a>
            <ul>
              <li><a href="documentos_consultor.php"> <span class="icon-user-plus"> </span> Crear Registro </a></li>
              <li><a href="consulta-documentos.php"> <span class="icon-user-plus"> </span> Consultar Registro</a></li>
              <li><a href="tabla_envioDocumentos.php"><span class="icon-clipboard"> </span> Gestión Backoffice </a></li>
            </ul>
          </li>
          <li><a href="#">Mantenimiento Pos <span style="font-size: 14px;" class="icon-circle-right"></span> </a>
            <ul>
              <li><a href="mantenimientoPos_consultor.php"> <span class="icon-user-plus"> </span> Crear Registro </a></li>
              <li><a href="consulta-mantenimientoPos.php"> <span class="icon-user-plus"> </span> Consultar Registro</a></li>
              <li><a href="tabla_mantenimientoPosventa.php"><span class="icon-clipboard"> </span> Gestión Backoffice </a></li>
            </ul>
          </li>
          <li><a href="#">Reversiones <span style="font-size: 14px;" class="icon-circle-right"></span> </a>
            <ul>
              <li><a href="reversiones_consultor.php"> <span class="icon-user-plus"> </span> Crear Registro </a></li>
              <li><a href="consulta-reversiones.php"> <span class="icon-user-plus"> </span> Consultar Registro</a></li>
              <li><a href="tabla_reversiones.php"><span class="icon-clipboard"> </span> Gestión Backoffice </a></li>
            </ul>
          </li>
          <li><a href="#">Negaciones <span style="font-size: 14px;" class="icon-circle-right"></span> </a>
            <ul>
              <li><a href="negaciones_consultor.php"> <span class="icon-user-plus"> </span> Crear Registro </a></li>
              <li><a href="consulta-negaciones.php"> <span class="icon-user-plus"> </span> Consultar Registro</a></li>
            </ul>
          </li>
          <li><a href="#">Autorizaciones <span style="font-size: 14px;" class="icon-circle-right"></span> </a>
            <ul>
              <li><a href="autorizaciones_consultor.php"> <span class="icon-user-plus"> </span> Crear Registro </a></li>
              <li><a href="consulta-autorizaciones.php"> <span class="icon-user-plus"> </span> Consultar Registro</a></li>
              <li><a href="tabla_autorizaciones.php"><span class="icon-clipboard"> </span> Gestión Backoffice </a></li>
            </ul>
          </li>
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
                      <li><a><button name="generar_reportes_fonoplus"  class="btn btn-primary "  value="Descargar Reporte Inf Investigar Fono" onclick='alerta();'><span class="icon-download2"></span> Reporte Inf Investigar Fono</button></a></li>
                      <li><a><button name="generar_reportes_documentos"  class="btn btn-primary "  value="Descargar Reporte Documentos" onclick='alerta();'><span class="icon-download2"></span> Reporte Documentos</button></a></li>
                      <li><a><button name="generar_reportes_mantenimientoPos"  class="btn btn-primary "  value="Descargar Reporte Mantenimiento Pos" onclick='alerta();'><span class="icon-download2"></span> Reporte Mantenimiento Pos</button></a></li>
                      <li><a><button name="generar_reportes_Inf_Investigar_Citas"  class="btn btn-primary "  value="Descargar Reporte Inf Investigar Citas" onclick='alerta();'><span class="icon-download2"></span> Reporte Inf Investigar Citas</button></a></li>
                      <li><a><button name="generar_reportes_reversiones"  class="btn btn-primary "  value="Descargar Reporte Reversiones" onclick='alerta();'><span class="icon-download2"></span> Reporte Reversiones</button></a></li>
                      <li><a><button name="generar_reportes_negaciones"  class="btn btn-primary "  value="Descargar Reporte Negaciones" onclick='alerta();'><span class="icon-download2"></span> Reporte Negaciones</button></a></li>
                      <li><a><button name="generar_reportes_autorizaciones"  class="btn btn-primary " value="Descargar Reporte Autorizaciones" onclick='alerta();'><span class="icon-download2"></span> Reporte Autorizaciones</button></a></li>
                      <li><a><button name="generar_reportes_laboratorios"  class="btn btn-primary " value="Descargar Reporte Laboratorios" onclick='alerta();'><span class="icon-download2"></span> Reporte Laboratorios</button></a></li>

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
