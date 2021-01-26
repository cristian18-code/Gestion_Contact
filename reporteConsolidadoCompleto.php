<?php
include('config/session.php');
header("Content-Type: text/html;charset=utf-8"); /* Cotejamiento de PHP */
mb_internal_encoding("UTF-8"); /*Cotejamiento interno para consultas SQL */

$fecha1=$_POST['fecha1'];
$fecha2=$_POST['fecha2'];

if(isset($_POST['generar_reportes']))
{
    // NOMBRE DEL ARCHIVO Y CHARSET
    
	header('Content-Type:text/csv; charset=UTF-8');
	header('Content-Disposition: attachment; filename="Reporte_Consolidado_Preparaciones.csv"');

	// SALIDA DEL ARCHIVO
	$salida=fopen('php://output', 'b');
	// ENCABEZADOS
	fputcsv($salida, array('ID Registro', 'Id Tipificacion Estado', 'Fecha Registro', 'Hora Reporte', 'Documento', ' Contrato', 
						   'Nombre Usuario', 'Detalle Servicio', 'Email', 'Id Tipificacion Causal', 'Persona Preguntar', 'Telefono','Celular', 'Id Tipificacion Cmd', 
						   'Id Tipificacion Tipo', 'Id Tipificacion Solicitud','Id tipificacion Tipo Paciente', 'Observaciones', 'Creador Registro', 'Fecha Envio', 'Hora Envio'));
	// QUERY PARA CREAR EL REPORTE
	$traerDatos=$con->query("SELECT   preparaciones.id_registro,
                                t.nombre_tipificacion AS estado,
                                DATE_FORMAT(preparaciones.fecha_registro, '%d/%m/%Y') AS fecha_registro,
                                preparaciones.hora_registro,
                                preparaciones.documento,
                                preparaciones.contrato,
                                preparaciones.nombres_usuario,
                                preparaciones.examen,
                                preparaciones.correo,
                                preparaciones.celular,
                                preparaciones.observaciones,
                                preparaciones.fecha_envio,
                                preparaciones.hora_envio,
                                t1.nombre_tipificacion AS cmd,
                                t2.nombre_tipificacion AS tipo,
                                t3.nombre_tipificacion AS solicitud,
                                t4.nombre_tipificacion AS tipoPaciente,
                                u.username AS user_crea
                                FROM ((((( envio_preparaciones preparaciones
                                LEFT JOIN tipificaciones t 
                                    ON preparaciones.id_tipificacionEstado = t.id_tipificacion)
                                INNER JOIN tipificaciones t1 
                                    ON preparaciones.id_tipificacionCmd = t1.id_tipificacion)
                                INNER JOIN tipificaciones t2 
                                    ON preparaciones.id_tipificacionTipo = t2.id_tipificacion)
                                INNER JOIN tipificaciones t3
                                    ON preparaciones.id_tipificacionSolicitud = t3.id_tipificacion)
                                INNER JOIN tipificaciones t4
                                    ON preparaciones.id_tipificacionTipo_paciente = t4.id_tipificacion)
                                INNER JOIN usuarios u
                                    ON preparaciones.id_userCrea = u.id_usuario
								where fecha_registro BETWEEN '$fecha1' AND '$fecha2' AND hora_registro ORDER BY id_registro");

	foreach ($traerDatos as $filaR) {
				
		$cadena = $filaR['observaciones'];

		$filaR['observaciones'] = preg_replace("[\n|\r|\n\r]", "", $mensaje);
	
		
		fputcsv($salida, array($filaR['id_registro'], 
								$filaR['id_tipificacionEstado'],
								$filaR['fecha_registro'],
								$filaR['hora_registro'],
								$filaR['documento'],
								$filaR['contrato'],
								$filaR['nombre_usuario'],
								$filaR['examen'],
								$filaR['correo'],
								$filaR['celular'],
								$filaR['id_tipificacionCmd'],
								$filaR['id_tipificacionTipo'],
								$filaR['id_tipificacionSolicitud'],
                                $filaR['id_tipificacionTipo_paciente'],
                                $filaR['observaciones'],
                                $filaR['id_userCrea'],
                                $filaR['fecha_envio'],
								$filaR['hora_envio']));
							
    }
}
?>