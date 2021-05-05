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
    else if (empty($_POST['nombres'])  
                || empty($_POST['documento']) 
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
        $tipoSolicitud = $_POST['tipoSolicitud'];
        $nombres = $_POST['nombres'];
        $documento = $_POST['documento'];
        $direccion = $_POST['direccion'];
        $barrio = $_POST['barrio'];
        $celular = $_POST['celular'];
        $localidad = $_POST['localidad'];
        $telefono = $_POST['telefono'];
        $correo = $_POST['correo'];
        $modoPago = $_POST['modoPago'];
        $tipoPaciente = $_POST['tipoPaciente'];
        $Plan = $_POST['plan'];
        $posibleCovid = $_POST['posibleCovid'];
        $servicioProgramado = $_POST['servicioProgramado'];
        $posibleCovid = $_POST['posibleCovid'];
        $fechaServicio = $_POST['fechaServicio'];
        $cmd = $_POST['cmd'];
        $observaciones = $_POST['observaciones'];

        $insertSsql = "INSERT INTO laboratorios_adomicilio (fechaRegistro,
                                    horaRegistro,
                                    tipoSolicitud,
                                    nombrePaciente,   
                                    documento,
                                    direccion,
                                    barrio,
                                    localidad,
                                    celular,
                                    telefono_fijo,
                                    correo,
                                    modalidadPago,
                                    tipoPaciente,
                                    Plan,
                                    posibleCovid,
                                    servicio_programado,
                                    fechaServicio,
                                    centroMedico,
                                    observaciones,
                                    id_userCrea)
                            VALUES (STR_TO_DATE('$fechaRegistro', '%d/%m/%Y'),
                                    '$horaRegistro',
                                    '$tipoSolicitud',
                                    '$nombres',
                                    '$documento',
                                    '$direccion',
                                    '$barrio',
                                    '$localidad',
                                    '$celular',
                                    '$telefono',
                                    '$correo',
                                    '$modoPago',
                                    '$tipoPaciente',
                                    '$Plan',
                                    '$posibleCovid',
                                    '$servicioProgramado',
                                    '$fechaServicio',
                                    '$cmd',
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