$(document).ready(function(){

    /* Envio de formulario para crear ticket*/
    $("#form_infInvestigar_gestor").on("submit",function(e){
        e.preventDefault();


        var parametros = new FormData($("#form_infInvestigar_gestor")[0]);
        var btnEnviar = $("#btnEnviar_infInvestigarGestor");
        
        // valida que el campo documento no este vacio ni contenga letras
        var estado = $("#estado").val();
        if (estado == 0 || estado == null) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Debes seleccionar una opción estado'
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
        var respuesta = $("#respuesta").val();
        if (respuesta.length == 0 || respuesta == null || /^\s+$/.test(respuesta)) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'El campo RESPUESTA no puede estar vacio'
              });
            return
        }

        // valida si esta vacio, si lo esta envia una alerta y retorna a la pagina del formulario
        var gestion = $("#observaciones").val();
        if (gestion.length == 0 || gestion == null || /^\s+$/.test(gestion)) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'El campo GESTIÓN llAMADA no puede estar vacio'
              });
            return
        }

        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: 'btn btn-success',
              cancelButton: 'btn btn-danger'
            },
            buttonsStyling: true
          })
          
          swalWithBootstrapButtons.fire({
            title: '¿Estas seguro?',
            text: "Despues de guardar no se podra reversar",
            icon: 'warning',
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Guardar',
            showCancelButton: true,
            cancelButtonText: 'Cancelar'
          }).then((result) => {
            if (result.isConfirmed) {

            $.ajax({
                data:parametros,
                url:"././sistema/logica/ajax_formularios/form_infInvestigar_gestor.php",
                type:"POST",
                contentType:false,
                processData:false,
                beforeSend: function(){
                    btnEnviar.val("Guardando.."); // Para input de tipo button
                    btnEnviar.attr("disabled","disabled");
                },
                success: function(data){
                    btnEnviar.val("Enviado"); // Para input de tipo button
                    $("body").append(data);
                    setTimeout(function () {
                      window.location = "./././tabla_infInvestigar.php";
                    }, 5000); //hace redireccion despues de 3 segundos
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
        } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
          ) {
            swalWithBootstrapButtons.fire(
              'Registro Cancelado',
              'Has Cancelado el envio',
              'error'
            )
          }
        });
    });
});