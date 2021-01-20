<!--Navbar -->
<ul class="nav justify-content-center">
  <li><a href="./principal.php"> <span class="icon-home3"></span> Inicio</a></li>

    <?php if ($_SESSION['roles'] == 'Administrador') {?>
      <li class="principal"> <a href="#"> <span class="icon-user-tie"></span> Administrador </a>
        <ul>
          <li><a href="./reportar_incidencia.php"> <span class="icon-wrench"> </span> Reportar </a></li>
          <li><a href="./seguimiento_ticket.php">  <span class="icon-eye"> </span> Seguimiento </a></li>
          <li><a href="#">  <span class="icon-paste"> </span> Informes </a></li>
          <li><a href="#">  <span class="icon-users"> </span> Usuarios &nbsp;&nbsp; <span style="font-size: 14px;" class="icon-circle-right"></span> </a>
            <ul>
              <li><a href=".\crear_usuario.php">  <span class="icon-user-plus"> </span> Crear usuario </a>
              <li><a href="listado_usuarios.php">  <span class="icon-clipboard"> </span> Lista de usuarios </a>
            </ul>
          </li>
        </ul>
      </li>
   <?php } ?>

    <li><a href="#"> <span class="icon-opsgenie"> </span> Supervisor </a>
      <ul>
        <li><a href="./reportar_incidencia.php"> <span class="icon-wrench"> </span> Reportar </a></li>
        <li><a href="./seguimiento_ticket.php">  <span class="icon-eye"> </span> Seguimiento </a></li>
      </ul>
    </li>
  </ul>
<!--/.Navbar -->