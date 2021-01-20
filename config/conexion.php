<?php
    $con=mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    $con->query("SET NAMES 'utf8'");

    $con->set_charset("UTF-8");

    if(!$con){
        die("imposible conectarse: ".mysqli_error($con));
    }
    if (@mysqli_connect_errno()) {
        die("Conexión falló: ".mysqli_connect_errno()." : ". mysqli_connect_error());
    }
?>