<?php

    function usuarioMedplus($correo, $nombres, $examen) {
        $para = $correo;
        $copiaOculta = 'DianaSa@medcontactcenter.com.co;AuxiliarNovedadesCC@medcontactcenter.com.co;BackOfficeCitas@medcontactcenter.com.co';
        $asunto = 'PREPARACION%20Y/O%20RECOMENDACIÓN%20PROCEDIMIENTO%20MEDPLUS%20MEDICINA%20PREPAGADA';
        $cuerpo = 'Respetado Sr(a). '.$nombres.'.
        %0D%0DReciba un cordial saludo de MEDPLUS Medicina Prepagada con nuestros mejores deseos de bienestar para usted y su familia.
        %0DRespondiendo a su solicitud me permito adjuntar por este medio la preparación y/o recomendación correspondiente a su consulta por procedimiento de '.$examen.' programado en nuestro centro médico.
        %0DPara finalizar, le reitero en nombre de la compañía nuestra voluntad de servicio, estando a su entera disposición; Cualquier información adicional no dude en comunicarse con nuestra línea de atención al usuario 7420101 opción 1 en Bogotá, y a nivel nacional 01 8000 184 000.
                ';

        $envioCorreo = 'mailto:'.$correo.'&bcc='.$copiaOculta.'&subject='.$asunto.'&body='.$cuerpo;
        return $envioCorreo;
    }
    function usuarioParticular($correo, $nombres, $examen) {
        $para = $correo;
        $copiaOculta = 'DianaSa@medcontactcenter.com.co;AuxiliarNovedadesCC@medcontactcenter.com.co;BackOfficeCitas@medcontactcenter.com.co';
        $asunto = 'PREPARACION%20Y/O%20RECOMENDACIÓN%20PROCEDIMIENTO%20BLUECARE';
        $cuerpo = 'Respetado Sr(a). '.$nombres.'.
        %0D%0DPensando en tu salud y bienestar te recomendamos que sigas las siguientes indicaciones, para garantizar
        %0Dque tu examen de '.$examen.' se pueda realizar exitosamente.
        %0DSi presentas alguna inquietud referente a estas indicaciones, no dudes en comunicarte a través de nuestros canales www.bluecare.com.co, línea BlueCare 7420222 en Bogotá o Medellin al 6041445 opción 1.
        ';

        $envioCorreo = 'mailto:'.$correo.'&bcc='.$copiaOculta.'&subject='.$asunto.'&body='.$cuerpo;
        return $envioCorreo;
    }
    function usuarioMedcenter($correo, $nombres, $examen) {
        $para = $correo;
        $copiaOculta = 'DianaSa@medcontactcenter.com.co;AuxiliarNovedadesCC@medcontactcenter.com.co;BackOfficeCitas@medcontactcenter.com.co';
        $asunto = 'PREPARACION%20Y/O%20RECOMENDACIÓN%20PROCEDIMIENTO%20MEDPLUS%20MEDCENTER';
        $cuerpo = 'Respetado Sr(a). '.$nombres.'.
        %0D%0DRespondiendo a su solicitud me permito adjuntar por este medio la preparación y/o recomendación  
        %0Dcorrespondiente a su consulta por procedimiento de '.$examen.' programado en nuestro centro médico.
        %0DPara finalizar, le reitero en nombre de la compañía nuestra voluntad de servicio, estando a su entera disposición; Cualquier información adicional no dude en comunicarse con nuestra línea de atención al usuario 5087555 en Bogotá.
                ';

        $envioCorreo = 'mailto:'.$correo.'&bcc='.$copiaOculta.'&subject='.$asunto.'&body='.$cuerpo;
        return $envioCorreo;

    }

    function EnvioCorreo($nombres,$contrato,$documento,$correo,$detalle) {
        $asunto = 'Validar Información';
        $cuerpo = 'Buen día.
        %0D%0DSolicito de su amable colaboración con la siguiente información.
        %0D%0DDatos del Usuario:
        %0D%0D Nombre Usuario. '.$nombres.'
        %0D%0D No de Contrato. '.$contrato.'
        %0D%0D Documento. '.$documento.'
        %0D%0D Correo. '.$correo.'
        %0D%0D Observaciones. '.$detalle.'.';

        $envioCorreo = 'mailto:'.'&subject='.$asunto.'&body='.$cuerpo;
        return $envioCorreo;
    }

    function EnvioCorreoDocumentos($correo, $contrato) {
        $correo = $correo;
        $asunto = 'MEDPLUS MEDICINA PREPAGADA';
        $cuerpo = 'Respetado Usuario: 
        %0D%0DReciba un cordial saludo de MEDPLUS Medicina Prepagada con nuestros mejores deseos de bienestar para usted y su familia.
        %0D%0DRespondiendo a su solicitud, por este medio me permito enviar adjunto el documento solicitado correspondiente al contrato '.$contrato.'
        %0D%0DPara finalizar, le reitero  en nombre de la compañía  nuestra voluntad siempre de servicio, quedando a su entera disposición; Cualquier información adicional no dude en comunicarse con nuestra línea de atención al usuario 7420101 opción 4 en Bogotá, y a nivel nacional 01 8000 18 4000, o través de nuestro chat virtual al cual puede tener acceso por  nuestra página de internet www.medplus.com.co
        ';

        $envioCorreo = 'mailto:'.$correo.'&subject='.$asunto.'&body='.$cuerpo;
        return $envioCorreo;
    }

    function correo_infInvCitas($documento, $nombreUsuario, $correElectronico, $nombreProfesional, $fechaServicio, $servicioSolicitado) {

        $copia = 'dianasa@medcontactcenter.com.co; katherinerc@medcontactcenter.com.co';
        $cuerpo = 'Cordial Saludo, 
        %0D%0DDe la manera más atenta, solicitamos su colaboración con la siguiente solicitud:
        %0D%0D•	No de documento:'.$documento.
        '%0D•	Nombre usuario: '.$nombreUsuario.
        '%0D•	Correo electrónico: '.$correElectronico.
        '%0D•	Nombre profesional/servicio: '.$nombreProfesional.
        '%0D•	Fecha servicio: '.$fechaServicio.
        '%0D•	Servicio solicitado: '.$servicioSolicitado;


        $envioCorreo = 'mailto: ?cc='.$copia.'&subject=VALIDAR INFORMACION&body='.$cuerpo;
        return $envioCorreo;
    }

    function correo_laboratorioCitas_programacion($fechaSolcitud, $nombrePaciente, $documento, $direccion, $barrio,
        $localidad, $celular, $telefono, $correo, $modalidadPago, $tipoPaciente, $plan, $posibleCovid, $observaciones)
    {
        $para = "TomaMuestraDomicilio@medcri.com.co; MariaCM@medcri.com.co";
        $copia = "SupervisionCC@medcontactcenter.com.co; AgendaLabDomicilio@medcontactcenter.com.co";
        $asunto = "Programación Toma de Muestra de Laboratorio Domiciliaria";
        $cuerpo = 'Cordial Saludo,
        %0D%0DAdjunto información de paciente que requiere toma de muestra de laboratorio a domicilio:
        %0D%0Do	Fecha de ingreso de la solicitud: '.$fechaSolcitud.
        '%0Do	Nombre del paciente: '.$nombrePaciente.
        '%0Do	Documento: '.$documento.
        '%0Do	Dirección: '.$direccion.
        '%0Do	Barrio: '.$barrio.
        '%0Do	localidad: '.$localidad.
        '%0Do	Celular: '.$celular.
        '%0Do	Telefono: '.$telefono.
        '%0Do	Correo Electronico: '.$correo.
        '%0Do	Modalidad de pago: '.$modalidadPago.
        '%0Do	Tipo de paciente: '.$tipoPaciente.
        '%0Do	Plan: '.$plan.
        '%0Do	Posible caso COVID: '.$posibleCovid.
        '%0Do	Observaciones: '.$observaciones;

        $envioCorreo = 'mailto:'.$para.'?cc='.$copia.'&subject='.$asunto.'&body='.$cuerpo;
        return $envioCorreo;
    }

    function correo_laboratorioCitas_demoraProgramacion($fechaSolcitud, $nombrePaciente, $documento, $observaciones)
    {
        $para = "MariaCM@medcri.com.co";
        $copia = "TomaMuestraDomicilio@medcri.com.co; AgendaLabDomicilio@medcontactcenter.com.co; SupervisionCC@medcontactcenter.com.co";
        $asunto = "Demora en Toma de Muestras a Domicilio";
        $cuerpo = 'Cordial Saludo,
        %0D%0DAdjunto se encuentran datos de paciente que está a la espera del llamado por parte del laboratorio para programar el servicio domiciliario.
        %0D%0Do	Fecha de ingreso de la solicitud: '.$fechaSolcitud.
        '%0Do	Nombre del paciente: '.$nombrePaciente.
        '%0Do	Documento: '.$documento.
        '%0Do	Observaciones: '.$observaciones;

        $envioCorreo = 'mailto:'.$para.'?cc='.$copia.'&subject='.$asunto.'&body='.$cuerpo;
        return $envioCorreo;
    }

    function correo_laboratorioCitas_demoraResultados($fechaSolcitud, $nombrePaciente, $documento, $correo, $FechaServicio, $cmd, $observaciones)
    {
        $para = "MariaCM@medcri.com.co; laboratorioclinico@medplus.com.co";
        $copia = "AgendaLabDomicilio@medcontactcenter.com.co; SupervisionCC@medcontactcenter.com.co";
        $asunto = "Demora Entrega de Resultados";
        $cuerpo = 'Cordial Saludo,
        %0D%0DAdjunto datos de paciente que está a la espera de la entrega de resultados a su correo electrónico: 
        %0D%0Do	Fecha de ingreso de la solicitud: '.$fechaSolcitud.
        '%0Do	Nombre del paciente: '.$nombrePaciente.
        '%0Do	Documento: '.$documento.
        '%0Do	Correo electrónico: '.$correo.
        '%0Do	Fecha servicio: '.$FechaServicio.
        '%0Do	Centro medico: '.$cmd.
        '%0Do	Observaciones: '.$observaciones;

        $envioCorreo = 'mailto:'.$para.'?cc='.$copia.'&subject='.$asunto.'&body='.$cuerpo;
        return $envioCorreo;
    } 

    function correo_laboratorioCitas_cancelacionServicio($fechaSolcitud, $nombrePaciente, $documento, $correo, $FechaServicio, $observaciones)
    {
        $para = "TomaMuestraDomicilio@medcri.com.co; MariaCM@medcri.com.co";
        $copia = "AgendaLabDomicilio@medcontactcenter.com.co; SupervisionCC@medcontactcenter.com.co";
        $asunto = "Cancelación Servicio Toma de Muestras a Domicilio";
        $cuerpo = 'Cordial Saludo,
        %0D%0DAdjunto datos de paciente que está a la espera de la entrega de resultados a su correo electrónico:
        %0D%0Do	Fecha de ingreso de la solicitud: '.$fechaSolcitud.
        '%0Do	Nombre del paciente: '.$nombrePaciente.
        '%0Do	Documento: '.$documento.
        '%0Do	Correo electrónico: '.$correo.
        '%0Do	Fecha servicio: '.$FechaServicio.
        '%0Do	Observaciones: '.$observaciones;

        $envioCorreo = 'mailto:'.$para.'?cc='.$copia.'&subject='.$asunto.'&body='.$cuerpo;
        return $envioCorreo;
    } 

    function correo_laboratorioCitas_otros($fechaSolcitud, $nombrePaciente, $documento, $correo, $FechaServicio, $observaciones)
    {
        $para = "MariaCM@medcri.com.co; laboratorioclinico@medplus.com.co";
        $copia = "AgendaLabDomicilio@medcontactcenter.com.co; SupervisionCC@medcontactcenter.com.co";
        $asunto = "Validar informacion";
        $cuerpo = 'Cordial Saludo,
        %0D%0DAdjunto datos de paciente que está a la espera de la entrega de resultados a su correo electrónico:
        %0D%0Do	Fecha de ingreso de la solicitud: '.$fechaSolcitud.
        '%0Do	Nombre del paciente: '.$nombrePaciente.
        '%0Do	Documento: '.$documento.
        '%0Do	Correo electrónico: '.$correo.
        '%0Do	Observaciones: '.$observaciones;

        $envioCorreo = 'mailto:'.$para.'?cc='.$copia.'&subject='.$asunto.'&body='.$cuerpo;
        return $envioCorreo;
    } 
?>