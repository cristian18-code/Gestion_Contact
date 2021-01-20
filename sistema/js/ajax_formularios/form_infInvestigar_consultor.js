
$(document).ready(function(){

    /* Envio de formulario para crear ticket*/
    $("#form_infInvestigarConsultor").bind("submit",function(){

        var parametros = new FormData($("#form_infInvestigarConsultor")[0]);
        var btnEnviar = $("#btnEnviar_infInvestigarConsultor");
        $.ajax({
            data:parametros,
            url:"././sistema/logica/ajax_formularios/form_infInvestigar_consultor.php",
            type:"POST",
            contentType:false,
            processData:false,
            beforeSend: function(){
                btnEnviar.val("Guardando.."); // Para input de tipo button
                btnEnviar.attr("disabled","disabled");
            },
            success: function(data){
                btnEnviar.val("Enviado"); // Para input de tipo button
                $(".alerta").append(data);
            },
            error: function( jqXHR, textStatus, errorThrown) { // Si el servidor no envia una respuesta se 
                                                    // ejecutara alguna de las siguientes alertas de acuerdo error
            if (jqXHR.status === 0) {

            alert('Not connect: Verify Network.');

            } else if (jqXHR.status == 404) {

            alert('Requested page not found [404]');

            } else if (jqXHR.status == 500) {

            alert('Internal Server Error [500].');

            } else if (textStatus === 'parsererror') {

            alert('Error de análisis JSON solicitado.');

            } else if (textStatus === 'timeout') {

            alert('Time out error.');

            } else if (textStatus === 'abort') {

            alert('Ajax request aborted.');

            } else {

            alert('Uncaught Error: ' + jqXHR.responseText);

            }
        }
        });
        // Nos permite cancelar el envio del formulario
        return false;
    });
});