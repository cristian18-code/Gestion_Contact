$(document).ready(function(){

    /* Envio de formulario para crear ticket*/
    $("#form_mantenimientoPos_gestor").on("submit",function(e){
        e.preventDefault();


        var parametros = new FormData($("#form_mantenimientoPos_gestor")[0]);
        var btnEnviar = $("#btnEnviar_mantenimientoPos_gestor");
        
        // valida que el campo documento no este vacio ni contenga letras
        var estado = $("#estado").val();
        if (estado == 0 || estado == null) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Debes seleccionar una opción ESTADO'
              });
            return
        }

          // valida que el campo documento no este vacio ni contenga letras
          var enviar= $("#enviar").val();
          if (enviar == 0 || enviar == null) {
              Swal.fire({
                  icon: 'warning',
                  title: 'Oops...',
                  text: 'Debes seleccionar una opción ENVIAR A'
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
                url:"././sistema/logica/ajax_formularios/form_mantenimientoPos_gestor.php",
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
                      window.location = "./././tabla_mantenimientoPosventa.php";
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