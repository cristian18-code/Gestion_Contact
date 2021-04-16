<?php 
    include('config/session.php');
    include('config/conexion.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
<!-- Estilos css -->
    <link rel="stylesheet" href="media/css/libs/bootstrap5.min.css">
    <link rel="stylesheet" href="media/css/libs/bootstrap.min.css">
    <link rel="stylesheet" href="media/css/libs/pushbar.css">	
    <link rel="stylesheet" href="media/css/libs/reset.css">
    <link rel="stylesheet" href="media/icons/style.css">
    <link rel="stylesheet" href="media/css/header.css">
    <link rel="stylesheet" href="media/css/contenedores_hover.css">

<!-- Estilos css -->
    <link rel="shortcut icon" href="media/img/favicon.png" type="image/x-icon">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Scripts -->
    <script src="sistema/js/libs/jquery-3.5.1.min.js"></script>
<!-- Scripts -->    
    <title> Gestión Contact Center</title>
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
<div class="circle"></div>
<section>


<!-- Opcion de Citas-->
<div class="container-all" id="menu">

    <div class="container-box">

        <a href="#" data-pushbar-target="pushbar-menu-citas">

            <div class="box box1">

                <img src="media/img/citas.png" alt="usuario-reportar" class="icon">

                <h4 class="title">Citas</h4>

                <p><strong>¡Modulo <?php echo strtoupper($_SESSION["roles"])?>!</strong></p>

            <div class="background-hover"></div>

        </a>
        
    </div>  

 <!-- Opcion de Fonoplus-->        
    <a href="#" data-pushbar-target="pushbar-menu-fonoplus">

        <div class="box box2">

            <img src="media/img/fonoplus.png" alt="seguimiento" class="icon">

            <h4 class="title">Fonoplus</h4>

            <p><strong>¡Modulo <?php echo strtoupper($_SESSION["roles"])?>!</strong></p>

        <div class="background-hover"></div>

    </a> 

    </div> 

<!-- Opcion de Descargar Reportes en General-->
    <?php if ($_SESSION['roles'] == 'Administrador') { ?>
    <a href="#" data-pushbar-target="pushbar-menu-informe">

        <div class="box box3">

        <img src="media/img/informes.png" alt="documento" class="icon">

        <h4 class="title">Informes</h4>

        <p><strong>Descargar informes</strong></p>

        <div class="background-hover"></div>

    </a> 
    <?php } ?>

    </div> 
<!-- Opcion de Crear Usuarios-->
    <?php if ($_SESSION['roles'] == 'Administrador') { ?>
    <a href="crear_usuario.php">

        <div class="box box4">

            <img src="media/img/agregar-usuario.png" class="icon">

            <h4 class="title">Crear usuario</h4>

            <p><strong>Añadir un nuevo usuario</strong></p>

        <div class="background-hover"></div>

    </a> 
    <?php } ?>

    </div> 
<!-- Opcion de Listado de Usuarios-->
    <?php if ($_SESSION['roles'] == 'Administrador') { ?>
    <a href="listado-usuarios.php">

        <div class="box box5">

            <img src="media/img/usuarios.png" class="icon">

            <h4 class="title">Lista de usuarios</h4>

            <p><strong>Usuarios registrados</strong></p>


        <div class="background-hover"></div>

    </a> 
    <?php } ?>

    </div> 

</div>
</section>

<!-- Opciones desplegables de Citas-->
<div data-pushbar-id="pushbar-menu-citas" data-pushbar-direction="bottom" class="pusbar-fono-consultar">
    <h1> Gestión Citas </h1>
    <div class="container-boxes">

            <a href="#" target="_top">

                <div class="boxes boxes1" data-swal-template="#my-template">

                    <img src="media/img/infoInvestigar.png" alt="usuario-reportar" class="icon" >

                    <h4 class="title">Investigar</h4>

                    <p><strong>Info Investigar</strong></p>

                    <div class="background-hover"></div>

                </div>  

            </a>
            <a href="#" target="_top" data-swal-template="#my-template">

                <div class="boxes boxes1">

                    <img src="media/img/adicionar.png" alt="usuario-reportar" class="icon">

                    <h4 class="title">Adicional</h4>

                    <p><strong><?php echo strtoupper($_SESSION["roles"])?></strong></p>

                    <div class="background-hover"></div>

                </div>  

            </a>
            <a href="preparaciones_agente.php" target="_top">

                <div class="boxes boxes1">

                    <img src="media/img/examenes.png" alt="usuario-reportar" class="icon" >

                    <h4 class="title">Examenes</h4>

                    <p><strong>Preparaciones</strong></p>

                    <div class="background-hover"></div>

                </div>  

            </a>
            <a href="#" target="_top" data-pushbar-target="pushbar-menu-citas-consulta">

                <div class="boxes boxes1">

                <img src="media/img/consultar.png" alt="usuario-reportar" class="icon">

                <h4 class="title">Consultar</h4>

                <p><strong> Consultas</strong></p>

                <div class="background-hover"></div>

                </div>  

            </a>
            <a href="tabla_envioPreparaciones.php" target="_top">

                <div class="boxes boxes1">

                    <img src="media/img/backoffice.png" alt="usuario-reportar" class="icon" >

                    <h4 class="title">Backoffice</h4>

                    <p><strong><?php echo strtoupper($_SESSION["roles"])?></strong></p>

                    <div class="background-hover"></div>

                </div>  

            </a>
            <a href="#" target="_top" data-swal-template="#my-template">

                <div class="boxes boxes1">

                <img src="media/img/bitacora.png" alt="usuario-reportar" class="icon">

                <h4 class="title">Bitacora</h4>

                <p><strong>Info Investigar</strong></p>

                <div class="background-hover"></div>

                </div>  

            </a>

</div>
        <button data-pushbar-close><span class="icon-cancel-circle" id="close"></span></button>
       
</div>
<!-- Opciones desplegables de Citas - Consultar-->
<div data-pushbar-id="pushbar-menu-citas-consulta" data-pushbar-direction="top" class="pusbar-fono-bitacora">
    <h1> Gestión Citas - Consulta</h1>
    <div class="container-boxes">
        <a href="#" target="_top" data-swal-template="#my-template">

            <div class="boxes boxes1">

                <img src="media/img/infoInvestigar.png" alt="usuario-reportar" class="icon" >

                <h4 class="title">Investigar</h4>

                <p><strong>Info Investigar</strong></p>

                <div class="background-hover"></div>

            </div>  

        </a>

            <a href="#" target="_top" data-swal-template="#my-template">

                <div class="boxes boxes1">

                    <img src="media/img/adicionar.png" alt="usuario-reportar" class="icon" >

                    <h4 class="title">Adicional</h4>

                    <p><strong><?php echo strtoupper($_SESSION["roles"])?></strong></p>

                    <div class="background-hover"></div>

                </div>  

            </a>
           
            <a href="consulta-examenes.php" target="_top" >

            <div class="boxes boxes1">

                <img src="media/img/examenes.png" alt="usuario-reportar" class="icon">

                <h4 class="title">Examenes</h4>

                <p><strong><?php echo strtoupper($_SESSION["roles"])?></strong></p>

                <div class="background-hover"></div>

            </div>  

            </a>

</div>
<button data-pushbar-close><span class="icon-cancel-circle" id="close"></span></button>
<span class="icon-circle-down"  data-pushbar-target="pushbar-menu-citas"></span>
</div>



<!-- Opciones desplegables de Fonoplus-->
<div data-pushbar-id="pushbar-menu-fonoplus" data-pushbar-direction="bottom" class="pusbar-fono">
    <h1> Gestión Fono Plus</h1>
    <div class="container-boxes">

            <a href="#" target="_top">

                <div class="boxes boxes1" data-swal-template="#my-template">

                    <img src="media/img/asesoria.png" alt="usuario-reportar" class="icon" >

                    <h4 class="title">Asesoria</h4>

                    <p><strong><?php echo strtoupper($_SESSION["roles"])?></strong></p>

                    <div class="background-hover"></div>

                </div>  

            </a>
            <a href="#" target="_top" data-swal-template="#my-template">

                <div class="boxes boxes1">

                    <img src="media/img/reversiones.png" alt="usuario-reportar" class="icon">

                    <h4 class="title">Reversión</h4>

                    <p><strong><?php echo strtoupper($_SESSION["roles"])?></strong></p>

                    <div class="background-hover"></div>

                </div>  

            </a>
            <a href="infInvestigar_Consultor.php" target="_top" >

                <div class="boxes boxes1">

                    <img src="media/img/infoInvestigar.png" alt="usuario-reportar" class="icon">

                    <h4 class="title">Investigar</h4>

                    <p><strong>Info Investigar</strong></p>

                    <div class="background-hover"></div>

                </div>  

            </a>
            <a href="documentos_consultor.php" target="_top">

                <div class="boxes boxes1" >

                    <img src="media/img/documentos.png" alt="usuario-reportar" class="icon">

                    <h4 class="title">Documentos</h4>

                    <p><strong><?php echo strtoupper($_SESSION["roles"])?></strong></p>

                    <div class="background-hover"></div>

                </div>  

            </a>
            <a href="#" target="_top" data-swal-template="#my-template">

                <div class="boxes boxes1">

                    <img src="media/img/otros.png" alt="usuario-reportar" class="icon">

                    <h4 class="title">Otros</h4>

                    <p><strong><?php echo strtoupper($_SESSION["roles"])?></strong></p>

                    <div class="background-hover"></div>

                </div>  

            </a>
            <a href="#" target="_top" data-swal-template="#my-template">

                <div class="boxes boxes1">

                    <img src="media/img/posventa.png" alt="usuario-reportar" class="icon">

                    <h4 class="title">Posventa</h4>

                    <p><strong><?php echo strtoupper($_SESSION["roles"])?></strong></p>

                    <div class="background-hover"></div>

                </div>  

            </a>
            <a href="#" target="_top" data-pushbar-target="pushbar-menu-fonoplus-backoffice" >

                        <div class="boxes boxes1"  >

                            <img src="media/img/backoffice.png" alt="usuario-reportar" class="icon">

                            <h4 class="title">Backoffice</h4>

                            <p><strong><?php echo strtoupper($_SESSION["roles"])?></strong></p>

                            <div class="background-hover"></div>

                        </div>  

            </a>
            <a href="#" target="_top" data-pushbar-target="pushbar-menu-fonoplus-consultar">

                        <div class="boxes boxes1" > 

                            <img src="media/img/consultar.png" alt="usuario-reportar" class="icon">

                            <h4 class="title">Consultar</h4>

                            <p><strong><?php echo strtoupper($_SESSION["roles"])?></strong></p>

                            <div class="background-hover"></div>

                        </div>  

            </a>
            <a href="#" target="_top" data-swal-template="#my-template">

                        <div class="boxes boxes1">

                            <img src="media/img/contingencia.png" alt="usuario-reportar" class="icon">

                            <h4 class="title">Contingencia</h4>

                            <p><strong>Info Investigar</strong></p>

                            <div class="background-hover"></div>

                        </div>  

             </a>
             <a href="#" target="_top" data-pushbar-target="pushbar-menu-fonoplus-bitacora">

                        <div class="boxes boxes1">

                            <img src="media/img/bitacora.png" alt="usuario-reportar" class="icon">

                            <h4 class="title">Bitacora</h4>

                            <p><strong><?php echo strtoupper($_SESSION["roles"])?></strong></p>

                            <div class="background-hover"></div>

                        </div>  

            </a>
            <a href="#" target="_top" data-swal-template="#my-template">

                        <div class="boxes boxes1">

                            <img src="media/img/negaciones.png" alt="usuario-reportar" class="icon">

                            <h4 class="title">Negaciones</h4>

                            <p><strong><?php echo strtoupper($_SESSION["roles"])?></strong></p>

                            <div class="background-hover"></div>

                            </div>  

            </a>
            <a href="#" target="_top" data-swal-template="#my-template">

                        <div class="boxes boxes1">

                            <img src="media/img/cobranzas.png" alt="usuario-reportar" class="icon">

                            <h4 class="title">Cobranzas</h4>

                            <p><strong><?php echo strtoupper($_SESSION["roles"])?></strong></p>

                            <div class="background-hover"></div>

                        </div>  

             </a>
                        
            </div>
            <button data-pushbar-close><span class="icon-cancel-circle" id="close"></span></button>
                           
</div>  
</div>

<div data-pushbar-id="pushbar-menu-fonoplus-backoffice" data-pushbar-direction="top" class="pusbar-fono-consultar">
    <h1> Gestión Fono Plus BackOffice</h1>

    <div class="container-boxes">
                        <a href="tabla_infInvestigar.php" target="_top">

                        <div class="boxes boxes1">

                            <img src="media/img/datos_citas.png" alt="usuario-reportar" class="icon" >

                            <h4 class="title">Inf a Investigar</h4>

                            <p><strong><?php echo strtoupper($_SESSION["roles"])?></strong></p>

                            <div class="background-hover"></div>

                        </div>  

                        </a>
                        <a href="tabla_envioDocumentos.php" target="_top">

                            <div class="boxes boxes1">

                                <img src="media/img/archivo.png" alt="usuario-reportar" class="icon" >

                                <h4 class="title">Documentos</h4>

                                <p><strong><?php echo strtoupper($_SESSION["roles"])?></strong></p>

                                <div class="background-hover"></div>

                            </div>  

                        </a>
    </div>
        <button data-pushbar-close><span class="icon-cancel-circle" id="close"></span></button>
</div>

<!-- Opciones desplegables de Fono - Consulta-->
<div data-pushbar-id="pushbar-menu-fonoplus-consultar" data-pushbar-direction="top" class="pusbar-fono-consultar">
    <h1> Gestión Fono Plus - Consulta Fono</h1>
<div class="container-boxes">

            <a href="#" target="_top">

                <div class="boxes boxes1" data-swal-template="#my-template">

                    <img src="media/img/reversiones.png" alt="usuario-reportar" class="icon" >

                    <h4 class="title">Reversión</h4>

                    <p><strong><?php echo strtoupper($_SESSION["roles"])?></strong></p>

                    <div class="background-hover"></div>

                </div>  

            </a>
            <a href="consulta-inf-investigar.php" target="_top">

            <div class="boxes boxes1">

                <img src="media/img/investigar.png" alt="usuario-reportar" class="icon">

                <h4 class="title">Investigar</h4>

                <p><strong>Info Investigar</strong></p>

                <div class="background-hover"></div>

            </div>  

            </a>
            <a href="#" target="_top" data-swal-template="#my-template">

            <div class="boxes boxes1">

                <img src="media/img/documentos.png" alt="usuario-reportar" class="icon">

                <h4 class="title">Documentos</h4>

                <p><strong><?php echo strtoupper($_SESSION["roles"])?></strong></p>

                <div class="background-hover"></div>

            </div>  

            </a>
            <a href="#" target="_top" data-swal-template="#my-template">

            <div class="boxes boxes1">

                <img src="media/img/posventa.png" alt="usuario-reportar" class="icon">

                <h4 class="title">Posventa</h4>

                <p><strong><?php echo strtoupper($_SESSION["roles"])?></strong></p>

                <div class="background-hover"></div>

            </div>  

            </a>
            
    </div>
    <button data-pushbar-close><span class="icon-cancel-circle" id="close"></span></button>
    <span class="icon-circle-down"  data-pushbar-target="pushbar-menu-fonoplus"></span>
    </div>

<!-- Opciones desplegables de Fono - Bitacora-->
<div data-pushbar-id="pushbar-menu-fonoplus-bitacora" data-pushbar-direction="top" class="pusbar-fono-bitacora">
    <h1> Gestión Fono Plus - Bitacora Contact Center</h1>
    <div class="container-boxes">

            <a href="#" target="_top">

                <div class="boxes boxes1" data-swal-template="#my-template">

                    <img src="media/img/adicionar.png" alt="usuario-reportar" class="icon" >

                    <h4 class="title">Adicionar</h4>

                    <p><strong><?php echo strtoupper($_SESSION["roles"])?></strong></p>

                    <div class="background-hover"></div>

                </div>  

            </a>
            <a href="#" target="_top" data-swal-template="#my-template">

            <div class="boxes boxes1">

                <img src="media/img/consultar.png" alt="usuario-reportar" class="icon">

                <h4 class="title">Consultar</h4>

                <p><strong>Info Investigar</strong></p>

                <div class="background-hover"></div>

            </div>  

            </a>

</div>
<button data-pushbar-close><span class="icon-cancel-circle" id="close"></span></button>
<span class="icon-circle-down"  data-pushbar-target="pushbar-menu-fonoplus"></span>
</div>

<!-- Alerta para indicar los modulos que no estan disponibles-->
            <template id="my-template">
                        <swal-title>
                        <span class="icon-wrench"></span>
                            Nos encontramos en construcción ;)
                        <span class="icon-wrench"></span>
                        </swal-title>
                        
                        <swal-icon type="warning" color="red"></swal-icon>
                        
                        <swal-button type="confirm">
                            Aceptar
                        </swal-button>
                        <swal-param name="allowEscapeKey" value="false" />
                        <swal-param
                            name="customClass"
                            value='{ "popup": "my-popup" }' />
             </template>

</div>

<script src="sistema/js/libs/pushbar.js"></script>


<script type="text/javascript">
    const pushbar = new Pushbar({
          blur:true,
          overlay:true,
        });
</script>
<script src="sistema/js/libs/sweetalert2.js"></script>

	<script>
        Swal.fire({
        title: "Bienvenido/a!",
        html:'<h2 class="user"><?php echo $_SESSION["roles"]?><?php echo ':'?> <?php echo $_SESSION["usernames"]?></h2>',
        timer:3000,
        timerProgressBar:true,
        confirmButtonText: 'Aceptar'
        });
    </script>

    <script>
     
        Swal.bindClickHandler()

        Swal.mixin({
        toast: true,
        }).bindClickHandler('data-swal-toast-template')
        
       
    </script>
</body>
</html>