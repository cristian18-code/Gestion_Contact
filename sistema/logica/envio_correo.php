<?php

    function usuarioMedplus($correo, $nombres, $examen) {
        $para = $correo;
        $copiaOculta = 'DianaSa@medcontactcenter.com.co;AuxiliarNovedadesCC@medcontactcenter.com.co';
        $asunto = 'PREPARACION%20Y/O%20RECOMENDACIÓN%20PROCEDIMIENTO%20MEDPLUS%20MEDICINA%20PREPAGADA';
        $cuerpo = 'Respetado Sr(a). '.$nombres.'.
%0D%0DReciba un cordial saludo de MEDPLUS Medicina Prepagada con nuestros mejores deseos de bienestar para usted y su familia.
%0DRespondiendo a su solicitud me permito adjuntar por este medio la preparación y/o recomendación correspondiente a su consulta por procedimiento de '.$examen.' programado en nuestro centro médico.
%0DPara finalizar, le reitero en nombre de la compañía nuestra voluntad de servicio, estando a su entera disposición; Cualquier información adicional no dude en comunicarse con nuestra línea de atención al usuario 7420101 opción 1 en Bogotá, y a nivel nacional 01 8000 184 000.
        ';

        $envioCorreo = 'mailto:'.$correo.'&bcc='.$copiaOculta.'&subject='.$asunto.'&body='.$cuerpo;
        return $envioCorreo;
    }
?>