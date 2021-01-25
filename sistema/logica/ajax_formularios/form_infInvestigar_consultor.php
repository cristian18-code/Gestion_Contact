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
    else if (empty($_POST['estado']) || empty($_POST['documento']) || empty($_POST['contrato']) || empty($_POST['nombres'])
                || empty($_POST['causal']) || empty($_POST['correo']) || empty($_POST['persona']) || empty($_POST['telefono'])
                || empty($_POST['celular']) || empty($_POST['ciudad']) || empty($_POST['detalle'])) {                
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
        $tabla = $_POST['tabla'];
        $fechaRegistro = $_POST['dia'];
        $horaRegistro = $_POST['hora'];
        $registro = $_POST['registro'];
        $estado = $_POST['estado'];
        $documento = $_POST['documento'];
        $contrato = $_POST['contrato'];
        $nombres = $_POST['nombres'];
        $causal = $_POST['causal'];
        $correo = $_POST['correo'];
        $persona = $_POST['persona'];
        $telefono = $_POST['telefono'];
        $celular = $_POST['celular'];
        $ciudad = $_POST['ciudad'];
        $detalle = $_POST['detalle'];

        $insertSsql = "INSERT INTO inf_investigar_fono (id_tipificacionEstado,
                                    fechaRegistro,
                                    horaRegistro,
                                    documento,
                                    contrato,
                                    nombresUsuario,
                                    detalle_servicio,
                                    email,
                                    id_tipificacionCausal,
                                    persona_preguntar,
                                    telefono,
                                    celular,
                                    ciudad,
                                    id_userCrea)
                            VALUES ('$estado',
                                    STR_TO_DATE('$fechaRegistro', '%d/%m/%Y'),
                                    '$horaRegistro',
                                    '$documento',
                                    '$contrato',
                                    '$nombres',
                                    '$detalle',
                                    '$correo',
                                    '$causal',
                                    '$persona',
                                    '$telefono',
                                    '$celular',
                                    '$ciudad',
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