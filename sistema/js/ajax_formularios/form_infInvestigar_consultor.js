
$(document).ready(function(){

    /* Envio de formulario para crear ticket*/
    $("#form_infInvestigarConsultor").on("submit",function(e){
        e.preventDefault();


        var parametros = new FormData($("#form_infInvestigarConsultor")[0]);
        var btnEnviar = $("#btnEnviar_infInvestigarConsultor");
        
        // valida que el campo documento no este vacio ni contenga letras
        var documento = $("#documento").val();
        if (isNaN(documento) || /^\s+$/.test(documento)) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'El campo DOCUMENTO no puede estar vacio ni contener letras'
              });
            return
        }

        // valida que el campo contrato no este vacio ni contenga letras
        var contrato = $("#contrato").val();
        if (isNaN(contrato) || /^\s+$/.test(contrato)) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'El campo CONTRATO no puede estar vacio ni contener letras'
              });
            return
        }

        // valida si esta vacio, si lo esta envia una alerta y retorna a la pagina del formulario
        var nombres = $("#nombres").val();
        if (nombres.length == 0 || nombres == null || /^\s+$/.test(nombres)) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'El campo NOMBRE USUARIO no puede estar vacio'
              });
            return
        }

        // valida si esta vacio, si lo esta envia una alerta y retorna a la pagina del formulario
        var correo = $("#correo").val();
        if (correo.length == 0 || correo == null || /^\s+$/.test(correo)) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'El campo CORREO no puede estar vacio'
              });
            return
        }

        // valida si esta vacio, si lo esta envia una alerta y retorna a la pagina del formulario
        var persona = $("#persona").val();
        if (persona.length == 0 || persona == null || /^\s+$/.test(persona)) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'El campo PERSONA A PREGUNTAR no puede estar vacio'
              });
            return
        }


        // valida que el campo no este vacio ni contenga letras
        var celular = $("#celular").val();
        if (isNaN(celular) || /^\s+$/.test(celular)) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'El campo CELULAR no puede estar vacio ni contener letras'
              });
            return
        }

        // valida si esta vacio, si lo esta envia una alerta y retorna a la pagina del formulario
        var ciudad = $("#ciudad").val();
        if (ciudad.length == 0 || ciudad == null || /^\s+$/.test(ciudad)) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'El campo CIUDAD no puede estar vacio'
                });
            return
        }

        // valida si esta vacio, si lo esta envia una alerta y retorna a la pagina del formulario
        var detalle = $("#detalle").val();
        if (detalle.length == 0 || detalle == null || /^\s+$/.test(detalle)) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'El campo DETALLE no puede estar vacio'
                });
            return
        }

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
        setTimeout(function () {
            location.reload("./././infInvestigar_Consultor.php");
          }, 3000); //hace redireccion despues de 3 segundos
    });
});