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
    
    if (!empty($_POST)) {

        $alert = '';        
        if (empty($_POST['nombre']) || empty($_POST['usuario']) || empty($_POST['usuario']) || empty($_POST['contrasena'])) {
            $alert='<p class="msg_error"> Todos los campos son Obligatorios </p>';
        } else {

            $nombre = $_POST['nombre'];
            $usuario = strtolower($_POST['usuario']);
            $clave = MD5($_POST['contrasena']);
            $rol = $_POST['rol'];

            $validarQsql = $con->query("SELECT * FROM usuarios WHERE username = '$usuario' ");
            $result = mysqli_fetch_array($validarQsql);

            if ($result > 0) {
                $alert='<div id="total"> <a class="msg_error animate__animated animate__fadeInDown"> 
                                <img src="media/img/error.gif" class="success">
                                <h1> El usuario ya existe </h1>
                                <button class="btn btn-danger" onclick="ocultar();"> OK</button>
                            </a>
                        </div>';
            } else {
                $insertQslq = $con -> query("INSERT INTO usuarios (username, nombre, password, rol) VALUES ('$usuario', '$nombre', '$clave', '$rol')");

                if($insertQslq){
                    $alert='<div id="total"> <a class="msg_save animate__animated animate__fadeInDown"> 
                                    <img src="media/img/success.gif" class="success">
                                    <h1> Usuario Creado Correctamente </h1>
                                    <button class="btn btn-primary" onclick="ocultar();"> OK</button>
                                </a>
                            </div>'; 
                }else{
                    $alert='<div id="total"> <a class="msg_error animate__animated animate__fadeInDown"> 
                                    <img src="media/img/error.gif" class="success">
                                    <h1> Error al crear el usuario </h1>
                                    <button class="btn btn-danger" onclick="ocultar();"> OK</button>
                                </a>
                            </div>';    
                }
            }
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
    <link rel="stylesheet" href="media/css/libs/animate.css">  
    <link rel="stylesheet" href="media/css/crear-usuario.css">
    <link rel="stylesheet" href="media/css/libs/dataTables.bootstrap5.min.css"> <!-- estilo de la tabla -->
    
<!-- Estilos css -->
<link rel="shortcut icon" href="media/img/favicon.png" type="image/x-icon">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario - Bitacora</title>
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
        <div id="formulario_usuario">
            <h1>Registrar Usuario</h1>
            <hr>
            <div class="alerta"> <?php echo isset($alert)? $alert :''; ?></div>

            <form action="" method="post">
                <div class="form-group" id="cont-nombre">
                    <label for="nombre"> <span class="icon-user-tie">&nbsp;</span> Nombre Completo</label>
                    <input type="text" class="form-control" name="nombre" id="nombre" autocomplete="off" placeholder="Ingrese su nombre" required>
                </div>

                <div class="form-group" id="cont-usuario">
                    <label for="usuario"> <span class="icon-user">&nbsp;</span> Usuario</label>
                    <input type="text" name="usuario" id="usuario" autocomplete="off" class="form-control" placeholder="Ingrese su usuario">
                </div>

                <div class="form-group" id="cont-contrasena">
                    <label for="contrasena"> <span class="icon-key">&nbsp;</span> Contraseña</label>
                    <input type="password" name="contrasena" id="contrasena" class="form-control" autocomplete="off" placeholder="Ingrese su contraseña">
                </div>

                <div class="form-group" id="cont-rol">
                    <label for="rol"> <span class="icon-users">&nbsp;</span> Rol</label>
                    <select name="rol" class="form-control" id="rol">
                        <option value="" hidden>Seleccione una opcion</option>
                        <?php $qsql = $con -> query( "SELECT nombre_rol, id_rol FROM roles") or die ("Fue imposible ejecutar la consulte(roles)");
                        foreach ($qsql as $row) { ?>

                        <option value="<?php echo $row['id_rol']; ?>"><?php echo $row['nombre_rol']; ?></option>
                            
                        <?php } ?>    
                    </select>
                </div>

                <input type="submit" value="Registrar" id="submit" class="btn btn-primary">
            </form>

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
    function ocultar(){
        document.getElementById('total').style.display = 'none';
    }
</script>

</html>