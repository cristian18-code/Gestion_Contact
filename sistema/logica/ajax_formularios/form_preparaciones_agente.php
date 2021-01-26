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
            text: 'Error en los parametros enviados!'
        })
        </script>";
    }
    else if (empty($_POST['documento']) || empty($_POST['contrato']) || empty($_POST['nombres']) || empty($_POST['celular'])
                || empty($_POST['examen']) || empty($_POST['correo']) || empty($_POST['solicitud']) || empty($_POST['cmd'])
                || empty($_POST['tipo']) || empty($_POST['tipoPaciente']) || empty($_POST['observacion'])) {                
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
        $nombres = $_POST['nombres'];
        $celular = $_POST['celular'];
        $examen = $_POST['examen'];
        $correo = $_POST['correo'];
        $solicitud = $_POST['solicitud'];
        $cmd = $_POST['cmd'];
        $tipo = $_POST['tipo'];
        $tipoPaciente = $_POST['tipoPaciente'];
        $observacion = $_POST['observacion'];

        $insertSsql = "INSERT INTO envio_preparaciones (fecha_registro,
                                    hora_registro,
                                    documento,
                                    contrato,
                                    nombres_usuario,
                                    examen,
                                    correo,
                                    celular,
                                    id_tipificacionCmd,
                                    id_tipificacionTipo,
                                    id_tipificacionTipo_paciente,
                                    id_tipificacionSolicitud,
                                    observaciones,
                                    id_userCrea)
                            VALUES (STR_TO_DATE('$fechaRegistro', '%d/%m/%Y'),
                                    '$horaRegistro',
                                    '$documento',
                                    '$contrato',
                                    '$nombres',
                                    '$examen',
                                    '$correo',
                                    '$celular',
                                    '$cmd',
                                    '$tipo',
                                    '$tipoPaciente',
                                    '$solicitud',
                                    '$observacion',
                                    '$userRegistra')";

        $insertQslq = $con -> query($insertSsql);
            
        if($insertQslq){
            $alert="<script>
                    var id = $registro;
                    Swal.fire(
                        'Registro Creado',
                        'Se ha guardado el registro No: '+ id +', por favor recargar la pagina',
                        'success'
                    ) 
                    </script>";
        }else{
            $alert="<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Error al crear registro!'

                    })
                    </script>";
        }
           
        mysqli_close($con);
    }

    echo $alert;

?>