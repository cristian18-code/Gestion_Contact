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

    else if (empty($_POST['estado']) || empty($_POST['gestion']) || empty($_POST['respuesta'])) {                
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
        $respuesta = $_POST['respuesta'];
        $gestion = $_POST['gestion'];
        $cmd = $_POST['cmd'];
        $centroCosto = $_POST['centroCosto'];
        $servicio = $_POST['servicio'];

        $insertSsql = "UPDATE inf_investigar_citas SET  fechaCierre = STR_TO_DATE('$fechaGestion', '%d/%m/%Y'),
                                                        horaCierre = '$horaGestion',
                                                        gestion_llamada = CONCAT(gestion_llamada, '$gestion //'),
                                                        id_tipificacionEstado = '$estado',
                                                        Id_tipificacioncentroMedicoBack = '$cmd',
                                                        id_tipificacionCentroCosto = '$centroCosto',
                                                        id_tipificacionServiciosCom = '$servicio',
                                                        respuesta = CONCAT(respuesta, '$respuesta //'),
                                                        id_userCierre = '$userGestion'
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