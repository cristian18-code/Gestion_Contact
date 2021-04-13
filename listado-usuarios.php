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
    <link rel="stylesheet" href="media/css/libs/dataTables.bootstrap5.min.css"> <!-- estilo de la tabla -->
<!-- Estilos css -->
<link rel="shortcut icon" href="media/img/favicon.png" type="image/x-icon">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Scripts -->
    <script src="sistema/js/getTime.js"></script>
    <script src="sistema/js/libs/jquery-3.5.1.min.js"></script>
<!-- Scripts -->    
    <title>Listado Usuarios - Bitacora</title>
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

        <h1>Listado de Usuarios</h1>

        <a href="crear_usuario.php" class="btn-nuevo"> <span class="icon-user-plus"> </span> Crear Usuarios</a>

        <table id="usuario" class="table table-striped table-bordered">

            <thead style=" background:rgb(0, 153, 255);">
                 <tr>
                    <th style=" color:white;"> ID</th>
                    <th style=" color:white;"> Nombre </th>
                    <th style=" color:white;"> Usuario </th>
                    <th style=" color:white;"> Rol </th>
                    <th style=" color:white;"> Acciones </th>
                    </tr>
            </thead>
        
            <tbody>
                <?php 
                    $query = mysqli_query($con, "SELECT usuarios.id_usuario, usuarios.nombre, usuarios.username, roles.nombre_rol FROM usuarios INNER JOIN roles ON usuarios.rol = roles.id_rol");
                
                    $result = mysqli_num_rows($query);

                    if($result > 0){

                    while($data = mysqli_fetch_array($query)){
                ?>

                <tr>
                    <td> <?php echo $data['id_usuario'] ?> </td>
                    <td> <?php echo $data['nombre'] ?></td>
                    <td> <?php echo $data['username'] ?> </td>
                    <td> <?php echo $data['nombre_rol'] ?></td>
                    <td> 
                    <a href="modificar-usuarios.php?id=<?php echo $data["id_usuario"];?>" class="btn btn-primary"> <span class="icon-pencil"></span> Modificar</a>
                    <?php if($data['id_usuario'] != 1 && $data['id_usuario'] != 2 && $data['id_usuario'] != 3){ ?>
                        <a href="permisos-usuarios.php?id=<?php echo $data["id_usuario"];?>" class="btn btn-success">  <span class="icon-user-tie"></span>  Editar Permisos</a>
                    <a href="eliminar-usuario.php?id=<?php echo $data["id_usuario"];?>" class="btn btn-danger">  <span class="icon-bin"></span>  Eliminar</a>
                    
                    <?php }?>
                    </td>
                </tr>
        
                    <?php
                        }
                    }
                    ?>
            </tbody>

            <tfoot style="background:rgb(0, 153, 255);">
            <tr>
               <th> ID</th>
               <th> Nombre </th>
               <th> Usuario </th>
               <th> Rol </th>
               <th> Acciones </th>
            </tr>
            </tfoot>

        </table>

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
    $(document).ready(function() {
        $('#usuario').DataTable(); /* Script para la tabla */
    });
</script>	
    <script src="sistema/js/libs/jquery.dataTables.min.js"></script> <!-- Script de Datatable -->
    <script src="sistema/js/libs/bootstrap5.min.js"></script> <!-- Script de Datatable -->
</html>