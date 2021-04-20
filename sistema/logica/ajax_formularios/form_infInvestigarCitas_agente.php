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
    else if (empty($_POST['documento']) || empty($_POST['contrato'])
                || empty($_POST['ServicioSoli']) || empty($_POST['correo'])
                || empty($_POST['ciudad']) || empty($_POST['observaciones'])) {                
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
        $nombres_usuario = $_POST['nombres_usuario'];
        $correo = $_POST['correo'];
        $persona = $_POST['persona'];
        $telefono = $_POST['telefono'];
        $celular = $_POST['celular'];
        $ciudad = $_POST['ciudad'];
        $observaciones = $_POST['observaciones'];

        $insertSsql = "INSERT INTO inf_investigar_citas (fechaRegistro,
                                    horaRegistro,
                                    documento,
                                    contrato,
                                    nombres_usuario,
                                    correo,
                                    nomPersona_preguntar,
                                    telefono,
                                    celular,
                                    ciudad,
                                    observaciones,
                                    id_userCrea)
                            VALUES (STR_TO_DATE('$fechaRegistro', '%d/%m/%Y'),
                                    '$horaRegistro',
                                    '$documento',
                                    '$contrato',
                                    '$ServicioSoli',
                                    '$correo',
                                    '$ciudad',
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