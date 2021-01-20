<?php 

    if (empty($_POST['user'])) {
        $alert='<p class="msg_error"> Error en la sesión </p>';
    }
    else if (empty($_POST['dia']) || empty($_POST['hora']) || empty($_POST['registro'])) {
            $alert='<p class="msg_error"> Error en la sesión </p>';
    }
    else if (empty($_POST['estado']) || empty($_POST['documento']) || empty($_POST['contrato']) || empty($_POST['nombres'])
                || empty($_POST['causal']) || empty($_POST['correo']) || empty($_POST['persona']) || empty($_POST['telefono'])
                || empty($_POST['celular']) || empty($_POST['ciudad']) || empty($_POST['detalle'])) {                
            $alert='<p class="msg_error"> Todos los campos son Obligatorios </p>';
    } else {
        
        require('../../../config/db.php');
        require('../../../config/conexion.php');

        $userRegistra = $_POST['user'];
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

        $insertSsql = "INSERT INTO inf_investigar (id_tipificacionEstado,
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
            $alert='<p class="msg_save"> Registro N°'. $registro .' creado Correctamente</p>';
        }else{
            $alert='<p class="msg_error"> error al crear el Registro</p>';    
        }
           
        mysqli_close($con);
    }

    echo $alert;

?>