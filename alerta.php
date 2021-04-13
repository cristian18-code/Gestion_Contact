<?php 
    include('config/session.php');
    include('config/conexion.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Permisos</title>
        <link rel="stylesheet" href="media/css/libs/bootstrap.min.css">
        <script src="sistema/js/libs/sweetalert2.js"></script>

</head>
<body>
        
<script>
        Swal.fire({
                icon: 'warning',
                title: 'No tienes permisos para ingresar a este modulo <?php echo $_SESSION['nombres'] ?>',
                html: '<a href="principal.php"> <button class="btn btn-primary"> Aceptar </button></a>',
		showConfirmButton: false
              });
</script>
</body>

</html>
