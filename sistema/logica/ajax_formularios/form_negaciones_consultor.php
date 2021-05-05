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
    else if (empty($_POST['nombres']) || empty($_POST['documento']) || empty($_POST['contrato'])
                || empty($_POST['ips']) || empty($_POST['area']) || empty($_POST['motNegacion'])
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
        $nombres = $_POST['nombres'];
        $documento = $_POST['documento'];
        $contrato = $_POST['contrato'];
        $ips = $_POST['ips'];
        $area = $_POST['area'];
        $motNegacion = $_POST['motNegacion'];
        $observaciones = $_POST['observaciones'];

        $insertSsql = "INSERT INTO negaciones_fono (fechaRegistro,
                                    horaRegistro,
                                    documento,
                                    contrato,
                                    nombre_usuario,
                                    ips,
                                    id_area,
                                    id_motivoNegacion,
                                    observaciones,
                                    id_userCrea)
                            VALUES (STR_TO_DATE('$fechaRegistro', '%d/%m/%Y'),
                                    '$horaRegistro',
                                    '$documento',
                                    '$contrato',
                                    '$nombres',
                                    '$ips',
                                    '$area',
                                    '$motNegacion',
                                    '$observaciones',
                                    '$userRegistra')";

        $insertQslq = $con -> query($insertSsql);
            
        if($insertQslq){
            $alert="<script>
                    var id = $registro;
                    Swal.fire(
                        'Registro Creado',
                        'Se ha guardado el registro No: '+ id +'',
                        'success'
                    ) 
                    </script>";
        }else{
            $alert="<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Ocurrio un error!'

                    })
                    </script>";
        }
           
        mysqli_close($con);
    }

    echo $alert;

?>