<?php 

    if ( empty($_POST['user'])) {
        $alert="<script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Error en la sesion!'
        })
        </script>";
    }

    else if (empty($_POST['dia']) || empty($_POST['hora']) || empty($_POST['registro'])) {
        $alert="<script>
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Error en los parametros!'
        })
        </script>";
    }

    else if (empty($_POST['estado']) || empty($_POST['observacionesBack'])) {                
                    $alert="<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Todos los campos son obligatorios!'
                    })
                    </script>";
    } else {
        
        require('../../../config/db.php');
        require('../../../config/conexion.php');

        $userGestion = $_POST['user'];
        $fechaGestion = $_POST['dia'];
        $horaGestion = $_POST['hora'];
        $registro = $_POST['registro'];
        $estado = $_POST['estado'];
        $observacionesBack = $_POST['observacionesBack'];

        $insertSsql = "UPDATE laboratorios_adomicilio   SET fechaCierre = STR_TO_DATE('$fechaGestion', '%d/%m/%Y'),
                                                        horaCierre = '$horaGestion',
                                                        observacionesBack = CONCAT(observacionesBack, '$observacionesBack //'),
                                                        id_tipificacionEstado = '$estado',
                                                        id_UserCierre = '$userGestion'
                                                        WHERE id_registro = '$registro'";

        $insertQslq = $con -> query($insertSsql);
            
        if($insertQslq){
            $alert="<script>
                    var id = $registro;
                    Swal.fire(
                        'Registro Guardado',
                        'Se ha a guardado el registro No: '+ id +'',
                        'success'
                    ) 
                    </script>";
        }else{
            $alert="<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'no se ha podido guardar el registro!'
                    })
                    </script>";
        }
           
        mysqli_close($con);
    }

    echo $alert;

?>