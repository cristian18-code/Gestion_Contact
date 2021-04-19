$(document).ready(function(){

    /* Envio de formulario para crear ticket*/
    $("#form_infInvestigar_gestor").on("submit",function(e){
        e.preventDefault();


        var parametros = new FormData($("#form_infInvestigar_gestor")[0]);
        var btnEnviar = $("#btnEnviar_infInvestigarGestor");
        
        // valida que el campo documento no este vacio ni contenga letras
        var estado = $("#estado").val();
        if (estado == null || estado == 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Debes seleccionar una opción en el campo ESTADO'
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
                text: 'El campo OBSERVACIONES no puede estar vacio'
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

                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Not connect: Verify Network.'
                })

                } else if (jqXHR.status == 404) {

                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Requested page not found [404]'
                })

                } else if (jqXHR.status == 500) {

                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Internal Server Error [500].'
                })

                } else if (textStatus === 'parsererror') {

                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Error de análisis JSON solicitado.'
                })

                } else if (textStatus === 'timeout') {

                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Time out error.'
                })

                } else if (textStatus === 'abort') {

                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Ajax request aborted.'
                })

                } else {

                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: 'Uncaught Error: ' + jqXHR.responseText
                })

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