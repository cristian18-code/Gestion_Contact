<?php 
    session_start(); // iniciando sesion

    $error=''; // Variable para almacenar el mensaje de error
    if (isset($_POST['submit'])) {
        if (empty($_POST['username']) || empty($_POST['password'])) {
            $error = "Por favor ingrese su usuario y contraseña";
        }
        else
        {
            // Define $username y $password
            $username=$_POST['username'];
            $password=$_POST['password'];
            // Estableciendo la conexion a la base de datos
            include("././config/db.php");//Contienen las variables, el servidor, usuario, contraseña y nombre  de la base de datos
            include("././config/conexion.php");//Contiene de conexion a la base de datos
            
            // Para proteger de Inyecciones SQL 
            $username = mysqli_real_escape_string($con,(strip_tags($username,ENT_QUOTES)));
            $password =  md5($password);//Algoritmo de encriptacion de la contraseña http://php.net/manual/es/function.sha1.php
            
            $sql = "SELECT username, password FROM usuarios WHERE username = '" . $username . "' and password='".$password."';";
            $query=mysqli_query($con,$sql);
            $counter=mysqli_num_rows($query);
            if ($counter==1){
                $_SESSION['activas'] = true;
                $_SESSION['usernames']=$username; // Iniciando la sesion
                header("location: ./principal.php"); // Redireccionando a la pagina pincipal.php
                
                
            } else {
                $error = "El usuario o la contraseña es inválida.";	
            }
        }
    }
?>