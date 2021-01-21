<!--Navbar -->
<ul class="nav justify-content-center">
  <li><a href="./principal.php"> <span class="icon-home3"></span> Inicio</a></li>

    <?php if ($_SESSION['roles'] == 'Administrador') {?>
      <li class="principal"> <a href="#"> <span class="icon-user-tie"></span> citas </a>
        <ul>
          <li><a href="#"> <span class="icon-wrench"> </span> informaciona a investigar </a>
            <ul>
              <li><a href="./infInvestigar_Consultor.php"> <span class="icon-wrench"> </span> Datos consultor  </a></li>
            </ul>
          </li>
          <li><a href="./seguimiento_ticket.php">  <span class="icon-eye"> </span> Seguimiento </a></li>
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