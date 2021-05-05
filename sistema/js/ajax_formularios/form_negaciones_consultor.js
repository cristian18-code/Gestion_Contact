
$(document).ready(function(){

    /* Envio de formulario para crear ticket*/
    $("#form_negaciones_consultor").on("submit",function(e){
        e.preventDefault();


        var parametros = new FormData($("#form_negaciones_consultor")[0]);
        var btnEnviar = $("#btnEnviar_negaciones_consultor");

        // valida que el campo contrato no este vacio ni contenga letras
        var documento = $("#documento").val();
        if (isNaN(documento) || /^\s+$/.test(documento) || documento == null || documento == 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'El campo DOCUMENTO no puede estar vacio ni contener letras'
              });
            return
        }

        // valida que el campo contrato no este vacio ni contenga letras
        var contrato = $("#contrato").val();
        if (isNaN(contrato) || /^\s+$/.test(contrato) || contrato == null || contrato == 0) {
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
                text: 'El campo Nombre Usuario no puede estar vacio'
                });
            return
        }
        
        // valida si esta vacio, si lo esta envia una alerta y retorna a la pagina del formulario
        var ips = $("#ips").val();
        if (ips.length == 0 || ips == null || /^\s+$/.test(ips)) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'El campo IPS no puede estar vacio'
            });
            return
        }

        var area = $("#area").val();
        if (area == null || area == 0) {
                Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Debes seleccionar una opción en el campo AREA'
            });
            return
        }

        var motNegacion = $("#motNegacion").val();
        if (motNegacion == null || motNegacion == 0) {
                Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Debes seleccionar una opción en el campo MOTIVO NEGACIÓN'
            });
            return
        }
     

        // valida si esta vacio, si lo esta envia una alerta y retorna a la pagina del formulario
        var observaciones = $("#observaciones").val();
        if (observaciones.length == 0 || observaciones == null || /^\s+$/.test(observaciones)) {
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
                url:"././sistema/logica/ajax_formularios/form_negaciones_consultor.php",
                type:"POST",
                contentType:false,
                processData:false,
                success: function(data){
                    btnEnviar.val("Guardando.."); // Para input de tipo button
                    btnEnviar.attr("disabled","disabled");
                    btnEnviar.val("Enviado"); // Para input de tipo button
                    $("body").append(data);
                    setTimeout(function () {
                      location.reload("./././reversiones_consultor.php");
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

                alert('Uncaught Error: ' + jqXHR.responseText);
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