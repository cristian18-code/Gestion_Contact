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
    else if (empty($_POST['solicitud']) || empty($_POST['tipoPaciente'])
                || empty($_POST['documento']) || empty($_POST['nombres']) || empty($_POST['correo'])
                || empty($_POST['persona']) || empty($_POST['celular']) || empty($_POST['ciudad']) 
                || empty($_POST['cmd']) || empty($_POST['ord']) || empty($_POST['nombreProfesional'])
                || empty($_POST['fechaServicio']) || empty($_POST['observaciones'])) {                
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
        $solicitud = $_POST['solicitud'];
        $tipoPaciente = $_POST['tipoPaciente'];
        $documento = $_POST['documento'];
        $contrato = $_POST['contrato'];
        $nombres_usuario = $_POST['nombres'];
        $correo = $_POST['correo'];
        $persona = $_POST['persona'];
        $telefono = $_POST['telefono'];
        $celular = $_POST['celular'];
        $ciudad = $_POST['ciudad'];
        $cmd = $_POST['cmd'];
        $ord = $_POST['ord'];
        $nombreProfesional = $_POST['nombreProfesional'];
        $fechaServicio = $_POST['fechaServicio'];
        $observaciones = $_POST['observaciones'];

        $insertSsql = "INSERT INTO inf_investigar_citas (fecha_registro,
                                    hora_registro,
                                    id_tipificacionTipoSol,
                                    id_tipificacionTipoUsu,
                                    documento,
                                    contrato,
                                    nombres_usuario,
                                    correo,
                                    nomPersona_preguntar,
                                    telefono,
                                    celular,
                                    ciudad,
                                    id_tipificacioncentroMedico,
                                    tipificacionOrdResPed,
                                    Nombre_Profesional,
                                    FechaServicio,
                                    ServicioSolicitado,
                                    id_userCrea)
                            VALUES (STR_TO_DATE('$fechaRegistro', '%d/%m/%Y'),
                                    '$horaRegistro',
                                    '$solicitud',
                                    '$tipoPaciente',
                                    '$documento',
                                    '$contrato',
                                    '$nombres_usuario ',
                                    '$correo',
                                    '$persona',
                                    '$telefono',
                                    '$celular',
                                    '$ciudad',
                                    '$cmd',
                                    '$ord',
                                    '$nombreProfesional',
                                    '$fechaServicio',
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