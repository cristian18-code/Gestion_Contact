<?php
include('../../config/session.php');
header("Content-Type: text/html;charset=utf-8"); /* Cotejamiento de PHP */
mb_internal_encoding("UTF-8"); /*Cotejamiento interno para consultas SQL */

$fecha1=$_POST['fecha1'];
$fecha2=$_POST['fecha2'];

if(isset($_POST['generar_reportes_preparaciones']))
{
    // NOMBRE DEL ARCHIVO Y CHARSET
    
	header('Content-Type:text/csv; charset=UTF-8');
	header('Content-Disposition: attachment; filename="Reporte_Consolidado_Preparaciones.csv"');

	// SALIDA DEL ARCHIVO
	$salida=fopen('php://output', 'b');
	// ENCABEZADOS
	fputcsv($salida, array('ID Registro', 'Tipificacion Estado', 'Fecha Registro', 'Hora Creacion Registro', 'Documento', ' Contrato', 
						   'Nombre Usuario','Tipificacion Cmd', 'Examenes', 'Correo', 'Celular','Creador Registro', 'Fecha de Envio','Hora de Envio','Tipificacion Solicitud',
                           'Observaciones', 'Tipificacion Tipo', 'Tipificacion Tipo Paciente',  'Backoffice', 'Tipificacion Cmd Backoffice'));
	// QUERY PARA CREAR EL REPORTE PREPARACIONES
	$traerDatos=$con->query("SELECT     preparaciones.id_registro,
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
                                        t4.nombre_tipificacion AS paciente,
                                        t5.nombre_tipificacion AS cmdBackoffice,
                                        u.username AS user_crea,
                                        u1.username AS user_cierre
                                        FROM ((((((( envio_preparaciones preparaciones
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
                                        LEFT JOIN tipificaciones t5
                                            ON preparaciones.id_tipificacionCmdBack = t5.id_tipificacion)
                                        INNER JOIN usuarios u
                                            ON preparaciones.id_userCrea = u.id_usuario)
                                        LEFT JOIN usuarios u1
                                            ON preparaciones.id_userCierre = u1.id_usuario
                                        where fecha_registro BETWEEN '$fecha1' AND '$fecha2' ORDER BY id_registro");

	foreach ($traerDatos as $filaR) {
				
		$cadena = $filaR['observaciones'];

		$filaR['observaciones'] = preg_replace("[\n|\r|\n\r]", "", $cadena);
	
		
		fputcsv($salida, array($filaR['id_registro'], 
								$filaR['estado'],
								$filaR['fecha_registro'],
								$filaR['hora_registro'],
								$filaR['documento'],
								$filaR['contrato'],
								$filaR['nombres_usuario'],
                                $filaR['cmd'],
								$filaR['examen'],
								$filaR['correo'],
								$filaR['celular'],
                                $filaR['user_crea'], 
                                $filaR['fecha_envio'],
                                $filaR['hora_envio'],
                                $filaR['solicitud'],
                                $filaR['observaciones'],
                                $filaR['tipo'],
                                $filaR['paciente'],
                                $filaR['user_cierre'],
								$filaR['cmdBackoffice']));
							
    }
}

if(isset($_POST['generar_reportes_fonoplus']))
{
    // NOMBRE DEL ARCHIVO Y CHARSET
    
	header('Content-Type:text/csv; charset=UTF-8');
	header('Content-Disposition: attachment; filename="Reporte_Consolidado_Preparaciones.csv"');

	// SALIDA DEL ARCHIVO
	$salida=fopen('php://output', 'b');
	// ENCABEZADOS
	fputcsv($salida, array('ID Registro', 'Id Tipificacion Estado', 'Fecha Registro', 'Hora Registro', 'Documento', ' Contrato', 
						   'Nombre Usuario', 'Detalle Servicio', 'Email', 'Id Tipificacion Causal', 'Persona Preguntar', 'Telefono','Celular', 'Usuario Que Crea', 
						   'Ciudad', 'Respuesta Cierre','Observaciones', 'Backoffice', 'Fecha Cierre', 'Hora Cierre'));
	// QUERY PARA CREAR EL REPORTE INFORMACIÓN INVESTIGAR
	$traerDatos=$con->query("SELECT     tFono.id_registro,
                                        t.nombre_tipificacion AS estado,
                                        DATE_FORMAT(tFono.fechaRegistro, '%d/%m/%Y') AS fecha_registro,
                                        tFono.horaRegistro,
                                        tFono.documento,
                                        tFono.contrato,
                                        tFono.nombresUsuario,
                                        tFono.detalle_servicio,
                                        tFono.email,
                                        t1.nombre_tipificacion AS causal,
                                        tFono.persona_preguntar,
                                        tFono.telefono,
                                        tFono.celular,
                                        u1.username AS userCrea,
                                        tFono.ciudad,
                                        tFono.respuestaCierre,
                                        tFono.Observaciones,
                                        u.username AS user_cierre,
                                        tFono.fechaCierre,
                                        tFono.horaCierre
                                        FROM ((( inf_investigar_fono tFono
                                        INNER JOIN tipificaciones t 
                                            ON tFono.id_tipificacionEstado = t.id_tipificacion)
                                        INNER JOIN tipificaciones t1 
                                            ON tFono.id_tipificacionCausal = t1.id_tipificacion)
                                        INNER JOIN usuarios u1
                                            ON tFono.id_usercrea = u1.id_usuario)
                                        LEFT JOIN usuarios u
                                            ON tFono.id_userCierre = u.id_usuario
                                        where tFono.fechaRegistro BETWEEN '$fecha1' AND '$fecha2' ORDER BY id_registro");

	foreach ($traerDatos as $filaR) {
				
		$cadena = $filaR['Observaciones'];

		$filaR['Observaciones'] = preg_replace("[\n|\r|\n\r]", "", $cadena);
        $filaR['respuestaCierre'] = preg_replace("[\n|\r|\n\r]", "",  $filaR['respuestaCierre']);
        $filaR['detalle_servicio'] = preg_replace("[\n|\r|\n\r]", "",  $filaR['detalle_servicio']);
	
		
		fputcsv($salida, array($filaR['id_registro'], 
								$filaR['estado'],
								$filaR['fecha_registro'],
								$filaR['horaRegistro'],
								$filaR['documento'],
								$filaR['contrato'],
								$filaR['nombresUsuario'],
								$filaR['detalle_servicio'],
								$filaR['email'],
								$filaR['causal'],
								$filaR['persona_preguntar'],
								$filaR['telefono'],
								$filaR['celular'],
                                $filaR['userCrea'],
                                $filaR['ciudad'],
                                $filaR['respuestaCierre'],
                                $filaR['Observaciones'],
                                $filaR['user_cierre'],
                                $filaR['fechaCierre'],
								$filaR['horaCierre']));
							
    }

    
}
if(isset($_POST['generar_reportes_documentos']))
    {
    // NOMBRE DEL ARCHIVO Y CHARSET
    
	header('Content-Type:text/csv; charset=UTF-8');
	header('Content-Disposition: attachment; filename="Reporte_Consolidado_Preparaciones.csv"');

	// SALIDA DEL ARCHIVO
	$salida=fopen('php://output', 'b');
	// ENCABEZADOS
	fputcsv($salida, array('ID Registro', 'Id Tipificacion Estado', 'Fecha Registro', 'Hora Registro', 'Documento', ' Contrato', 
						    'Servicio Solicitado', 'Correo', 'Ciudad', 'Observaciones', 'Observaciones Backoffice','Consultor', 'Backoffice', 
						   'Fecha Cierre', 'Hora Cierre'));
	// QUERY PARA CREAR EL REPORTE INFORMACIÓN INVESTIGAR
	$traerDatos=$con->query("SELECT     tDoc.id_registro,
                                        t.nombre_tipificacion AS estado,
                                        DATE_FORMAT(tDoc.fechaRegistro, '%d/%m/%Y') AS fecha_registro,
                                        tDoc.horaRegistro,
                                        tDoc.documento,
                                        tDoc.contrato,
                                        tDoc.correo,
                                        t1.nombre_tipificacion AS Servicio_Solicitado,
                                        u1.username AS userCrea,
                                        tDoc.observacionesBack,
                                        tDoc.observaciones,
                                        u.username AS user_cierre,
                                        tDoc.fechaCierre,
                                        tDoc.horaCierre
                                        FROM ((( envio_documentos tDoc
                                        INNER JOIN tipificaciones t 
                                            ON tDoc.id_tipificacionEstado = t.id_tipificacion)
                                        INNER JOIN tipificaciones t1 
                                            ON tDoc.id_tipificacionServicioSo = t1.id_tipificacion)
                                        INNER JOIN usuarios u1
                                            ON tDoc.id_usercrea = u1.id_usuario)
                                        LEFT JOIN usuarios u
                                            ON tDoc.id_userCierre = u.id_usuario
                                        where tDoc.fechaRegistro BETWEEN '$fecha1' AND '$fecha2' ORDER BY id_registro");

	foreach ($traerDatos as $filaR) {
				
		$cadena = $filaR['observacionesBack'];

		$filaR['observacionesBack'] = preg_replace("[\n|\r|\n\r]", "", $cadena);
        $filaR['observaciones'] = preg_replace("[\n|\r|\n\r]", "",  $filaR['observaciones']);
	
		
		fputcsv($salida, array($filaR['id_registro'], 
								$filaR['estado'],
								$filaR['fecha_registro'],
								$filaR['horaRegistro'],
								$filaR['documento'],
								$filaR['contrato'],
                                $filaR['Servicio_Solicitado'],
                                $filaR['correo'],
                                $filaR['ciudad'],
                                $filaR['observaciones'],
                                $filaR['observacionesBack'],
                                $filaR['userCrea'],
                                $filaR['user_cierre'],
                                $filaR['fechaCierre'],
								$filaR['horaCierre']));
							
    }
?>