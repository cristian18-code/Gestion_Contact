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
?>