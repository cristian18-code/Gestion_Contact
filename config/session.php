<?php
// Estableciendo la conexion a la base de datos
include("db.php");//Contienen las variables, el servidor, usuario, contraseña y nombre  de la base de datos
include("conexion.php");//Contiene de conexion a la base de datos
 
session_start();// Iniciando Sesion
// Guardando la sesion
$user_check=$_SESSION['username'];
// SQL Query para completar la informacion del usuario
$ses_sql=mysqli_query($con, "SELECT id_usuario, nombre, rol, username FROM usuarios WHERE username='$user_check'");
$row = mysqli_fetch_assoc($ses_sql);

        $_SESSION['idUser'] = $row['id_usuario'];
        $_SESSION['nombre'] = $row['nombre'];
        $_SESSION['rols'] = $row['rol'];
        $login_session = $row['id_usuario'];
        
        $nombreRol = $con-> query("SELECT nombre_rol FROM roles WHERE id_rol = '".$_SESSION['rols']."'");

        if ($fila = mysqli_fetch_row($nombreRol)) {
                $rol = $fila[0];
                $_SESSION['rols'] = $rol; 
        }
                
if(!isset($login_session)){
        mysqli_close($con); // Cerrando la conexion
        header('Location: ./index.php'); // Redirecciona a la pagina de inicio
}
?>