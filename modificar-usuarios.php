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
        // Declaracion de variables que se mostraran segun sus campos designados" //
        $alert='';
        if(empty($_POST['nombre']) || empty($_POST['usuario']) || empty($_POST['rol'])) {

            $alert='<p class="msg_error"> Los campos [Nombre, usuario y rol] son Obligatorios </p>';
        } else {
        
            $idUsuario = $_POST['idUsuario'];
            $nombre = $_POST['nombre'];
            $user = $_POST['usuario'];
            $clave = $_POST['contrasena'];
            $clave = md5($clave);
            $rol = $_POST['rol'];

            // Se ejecuta un Query que valide si el Usuario y la Cedula no se encuentran creados//
            $query = mysqli_query($con,"SELECT * FROM usuarios WHERE (username = '$user' AND id_usuario != $idUsuario) OR (nombre = '$nombre' AND id_usuario != $idUsuario)");

            $result = mysqli_fetch_array($query);

            // Si el resultado es mayor a 0 Arroja el error "el usuario ya existe" //

            if($result > 0){
                $alert='<div id="total"> <a class="msg_error animate__animated animate__fadeInDown"> 
                                <img src="media/img/error.gif" class="success">
                                <h1> El usuario ya existe </h1>
                                <button class="btn btn-danger" onclick="ocultar();"> OK</button>
                            </a>
                        </div>';
            }else{

                if (empty($_POST['contrasena'])) {

                    $sql_update = mysqli_query($con, "UPDATE usuarios SET nombre = '$nombre', username = '$user', rol = '$rol' WHERE id_usuario = '$idUsuario' ");

                }else{

                    $sql_update = mysqli_query($con, "UPDATE usuarios SET nombre = '$nombre', username = '$user', password = '$clave', rol = '$rol' WHERE id_usuario = '$idUsuario'");

                }
                if($sql_update){
                    $alert='<div id="total"> <a class="msg_save animate__animated animate__fadeInDown"> 
                                    <img src="media/img/success.gif" class="success">
                                    <h1> Usuario actualizado Correctamente </h1>
                                    <button class="btn btn-primary" onclick="ocultar();"> OK</button>
                                </a>
                            </div>'; 
                }else{
                    $alert='<div id="total"> <a class="msg_error animate__animated animate__fadeInDown"> 
                                    <img src="media/img/error.gif" class="success">
                                    <h1> Error al actualizar el usuario </h1>
                                    <button class="btn btn-danger" onclick="ocultar();"> OK</button>
                                  </a>
                            </div>';    
                }
            }
        }
    }

    //Mostrar Datos
    if (empty($_GET['id']))
    {
        header('location: listado-usuarios.php');
        
    }
    $iduser = $_GET['id'];
    $sql = mysqli_query($con, "SELECT u.id_usuario, u.nombre, u.username, (u.rol) as id_rol, (r.nombre_rol) as rol FROM usuarios u INNER JOIN roles r on u.rol = r.id_rol WHERE id_usuario = '$iduser'");
    $result_sql = mysqli_num_rows($sql);

    if($result_sql == 0){
        header ('Location: listado_usuarios.php');
    }else{
        $option = '';
        while ($data = mysqli_fetch_array($sql)){

            $iduser  = $data['id_usuario'];
            $nombre  = $data['nombre'];
            $usuario = $data['username'];
            $idrol   = $data['id_rol'];
            $rol     = $data['rol'];

            if($idrol == 1) {            
                $option = ' <option value="'.$idrol.'"select>'.$rol.'</option>';
            } else if ($idrol == 2) {
                $option = ' <option value="'.$idrol.'"select>'.$rol.'</option>';
            } else if ($idrol == 3) {
                $option = ' <option value="'.$idrol.'"select>'.$rol.'</option>';
            } else if ($idrol == 4) {
                $option = ' <option value="'.$idrol.'"select>'.$rol.'</option>';
            } else if ($idrol == 5) {
                $option = ' <option value="'.$idrol.'"select>'.$rol.'</option>';
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
    <link rel="stylesheet" href="media/css/modificar-usuario.css">    
    <link rel="stylesheet" href="media/css/libs/dataTables.bootstrap5.min.css"> <!-- estilo de la tabla -->
<!-- Estilos css -->
<link rel="shortcut icon" href="media/img/favicon.png" type="image/x-icon">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Scripts -->
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

    <section>
            
        <div class="formulario_registro"> 
            <h1> Modificar Usuario</h1>
            <hr>
            <div class="alerta"> <?php echo isset($alert)? $alert :''; ?></div>
            
            <form action="" method="post">
                <input type="hidden" name="idUsuario" value="<?php echo $iduser; ?>"> </input>
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre Completo"   value="<?php echo $nombre; ?>"> </input>
                <br>
                <label for="Numero">Usuario</label>
                <input type="text" name="usuario" id="usuario" placeholder="Nombre Usuario"  value="<?php echo $usuario; ?>"> </input>
                <br>
                <label for="Numero">Contraseña</label>
                <input type="password" name="contrasena" id="contrasena" placeholder="Contraseña de Acceso" > </input>
                <br>
                <label for="rol">Rol</label>
            <?php
                $query_rol = mysqli_query($con, "SELECT * FROM roles");
                $result_rol = mysqli_num_rows($query_rol);     
            ?>
            
                <select name="rol" id="rol" class="notItemOne"> 

                <?php
                    echo $option;
                    if ($result_rol > 0 )
                    {
                        while($rol = mysqli_fetch_array($query_rol)){
                ?>   

                <option value="<?php echo $rol["id_rol"]; ?>"><?php echo $rol ["nombre_rol"] ?> </option>

                <?php     
                        }
                    }
                ?>                       
                                        
                </select>
                <br>
                <button type="submit" value="Actualizar" class="btn btn-primary"> Actualizar</button>
                <a href="listado-usuarios.php" class="btn btn-danger">Cancelar</a>
            </form>
        </div>

    </section>

</body>
<script>
    function ocultar(){
        document.getElementById('total').style.display = 'none';
    }
</script>
<script src="sistema/js/libs/pushbar.js"></script>
<script type="text/javascript">
    const pushbar = new Pushbar({
          blur:true,
          overlay:true,
        });
</script>
</html>