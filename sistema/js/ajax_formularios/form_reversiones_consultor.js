
$(document).ready(function(){

    /* Envio de formulario para crear ticket*/
    $("#form_reversiones_consultor").on("submit",function(e){
        e.preventDefault();


        var parametros = new FormData($("#form_reversiones_consultor")[0]);
        var btnEnviar = $("#btnEnviar_reversiones_consultor");
           // valida si esta vacio, si lo esta envia una alerta y retorna a la pagina del formulario

           var usuario = $("#usuario").val();
           if (usuario.length == 0 || usuario == null || /^\s+$/.test(usuario)) {
               Swal.fire({
                   icon: 'warning',
                   title: 'Oops...',
                   text: 'El campo Usuario no puede estar vacio'
                 });
               return
           }

        // valida que el campo documento no este vacio ni contenga letras
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
          if (isNaN(contrato) || /^\s+$/.test(contrato) ||contrato == null) {
              Swal.fire({
                  icon: 'warning',
                  title: 'Oops...',
                  text: 'El campo CONTRATO no puede estar vacio ni contener letras'
                });
              return
          }
                 // valida si esta vacio, si lo esta envia una alerta y retorna a la pagina del formulario
          var napReversar = $("#napReversar").val();
          if (napReversar.length == 0 || napReversar == null || /^\s+$/.test(napReversar)) {
              Swal.fire({
                  icon: 'warning',
                  title: 'Oops...',
                  text: 'El campo NAP A REVERSAR no puede estar vacio'
                });
              return
          }

          var motReversion = $("#motReversion").val();
          if (motReversion == null || motReversion == 0) {
                   Swal.fire({
                   icon: 'warning',
                   title: 'Oops...',
                   text: 'Debes seleccionar una opci??n en el campo MOTIVO REVERSION'
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
            title: '??Estas seguro?',
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
                url:"././sistema/logica/ajax_formularios/form_reversiones_consultor.php",
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
                text: 'Error de an??lisis JSON solicitado.'
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