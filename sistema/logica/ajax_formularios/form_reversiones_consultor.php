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
            text: 'Error en la sesion!'
        })
        </script>";
    }
    else if (empty($_POST['usuario']) || empty($_POST['documento']) || empty($_POST['contrato'])
                || empty($_POST['napReversar']) || empty($_POST['motReversion'])
                || empty($_POST['observaciones'])) {                
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

        $userRegistra = $_POST['user'];
        $fechaRegistro = $_POST['dia'];
        $horaRegistro = $_POST['hora'];
        $registro = $_POST['registro'];
        $usuario = $_POST['usuario'];
        $documento = $_POST['documento'];
        $contrato = $_POST['contrato'];
        $napReversar = $_POST['napReversar'];
        $auxiliarIPS = $_POST['auxiliarIPS'];
        $motReversion = $_POST['motReversion'];
        $observaciones = $_POST['observaciones'];
        $inputErrorLinFre = $_POST['inputErrorLinFre'];

        $insertSsql = "INSERT INTO reversiones_fono (fechaRegistro,
                                    horaRegistro,
                                    usuario,
                                    documento,
                                    contrato,
                                    nap_aReversar,
                                    auxiliar_ips,
                                    id_motivoReversion,
                                    observaciones,
                                    error_linea_fuente,
                                    id_userCrea)
                            VALUES (STR_TO_DATE('$fechaRegistro', '%d/%m/%Y'),
                                    '$horaRegistro',
                                    '$usuario',
                                    '$documento',
                                    '$contrato',
                                    '$napReversar',
                                    '$auxiliarIPS',
                                    '$motReversion',
                                    '$observaciones',
                                    '$inputErrorLinFre',
                                    '$userRegistra')";

        $insertQslq = $con -> query($insertSsql);
            
        if($insertQslq){
            $alert="<script>
                    var id = $registro;
                    Swal.fire(
                        'Registro Creado',
                        'Se ha a guardado el registro No: '+ id +'',
                        'success'
                    ) 
                    </script>";
        }else{
            $alert="<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!'

                    })
                    </script>";
        }
           
        mysqli_close($con);
    }

    echo $alert;

?>