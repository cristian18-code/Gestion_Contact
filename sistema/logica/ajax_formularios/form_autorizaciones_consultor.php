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
    else if (empty($_POST['documento']) || empty($_POST['contrato']) || empty($_POST['usuario'])
                || empty($_POST['codigoIps']) || empty($_POST['nombresPrestador']) || empty($_POST['correo']) || empty($_POST['telefono'])
                || empty($_POST['ciudad']) || empty($_POST['servicioRequerido']) || empty($_POST['observaciones'])) {                
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
        $documento = $_POST['documento'];
        $contrato = $_POST['contrato'];
        $usuario = $_POST['usuario'];
        $codigoIps = $_POST['codigoIps'];
        $nombresPrestador = $_POST['nombresPrestador'];
        $correo = $_POST['correo'];
        $telefono = $_POST['telefono'];
        $ciudad = $_POST['ciudad'];
        $servicioRequerido = $_POST['servicioRequerido'];
        $diagnostico = $_POST['diagnostico'];
        $observaciones = $_POST['observaciones'];

        $insertSsql = "INSERT INTO  autorizaciones_fono (
                                    fechaRegistro,
                                    horaRegistro,
                                    documento,
                                    contrato,
                                    nombres_usuario,
                                    codigo_ips,
                                    nombre_prestador,
                                    correo,
                                    telefono,
                                    ciudad,
                                    id_servicioRequerido,
                                    diagnostico,
                                    observaciones,
                                    id_userCrea)
                            VALUES (
                                    STR_TO_DATE('$fechaRegistro', '%d/%m/%Y'),
                                    '$horaRegistro',
                                    '$documento',
                                    '$contrato',
                                    '$usuario',
                                    '$codigoIps',
                                    '$nombresPrestador',
                                    '$correo',
                                    '$telefono',
                                    '$ciudad',
                                    '$servicioRequerido',
                                    '$diagnostico',
                                    '$observaciones',
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