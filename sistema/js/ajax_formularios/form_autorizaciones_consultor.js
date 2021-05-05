$(document).ready(function(){

    /* Envio de formulario para crear ticket*/
    $("#form_autorizaciones_consultor").on("submit",function(e){
        e.preventDefault();


        var parametros = new FormData($("#form_autorizaciones_consultor")[0]);
        var btnEnviar = $("#btnEnviar_autorizaciones_consultor");
        
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
         if (isNaN(contrato) || /^\s+$/.test(contrato) ||contrato == null || contrato == 0) {
             Swal.fire({
                 icon: 'warning',
                 title: 'Oops...',
                 text: 'El campo CONTRATO no puede estar vacio ni contener letras'
               });
             return
         }
        // valida si esta vacio, si lo esta envia una alerta y retorna a la pagina del formulario
        var usuario = $("#usuario").val();
        if (usuario.length == 0 || usuario == null || /^\s+$/.test(usuario)) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'El campo USUARIO no puede estar vacio'
                });
            return
        }

        // valida si esta vacio, si lo esta envia una alerta y retorna a la pagina del formulario
        var codigoIps = $("#codigoIps").val();
        if (codigoIps.length == 0 || codigoIps == null || /^\s+$/.test(codigoIps)) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'El campo CODIGO IPS no puede estar vacio'
            });
        return
        }
         // valida si esta vacio, si lo esta envia una alerta y retorna a la pagina del formulario
        var nombresPrestador = $("#nombresPrestador").val();
        if (nombresPrestador.length == 0 || nombresPrestador == null || /^\s+$/.test(nombresPrestador)) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'El campo NOMBRE PRESTADOR no puede estar vacio'
            });
        return
        }
         // valida si esta vacio, si lo esta envia una alerta y retorna a la pagina del formulario(adicional si cumple con los requisitos de ser un correo)
        var expresionEmail = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
        // valida si esta vacio, si lo esta envia una alerta y retorna a la pagina del formulario
        var correo = $("#correo").val();
        if (correo.length == 0 || correo == null || !expresionEmail.test(correo)) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'El correo electrónico ingresado no es válido. Este campo puede tener letras, números, puntos, guiones, seguido de @ y el dominio correspondiente.'
              });
            return
        }
           // valida si esta vacio, si lo esta envia una alerta y retorna a la pagina del formulario
           var telefono= $("#telefono").val();
           if (isNaN(telefono) || /^\s+$/.test(telefono) |telefono == null || telefono == 0) {
               Swal.fire({
                   icon: 'warning',
                   title: 'Oops...',
                   text: 'El campo TELEFONO no puede estar vacio'
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
           var servicioRequerido = $("#servicioRequerido").val();
           if (servicioRequerido== null || servicioRequerido == 0) {
               Swal.fire({
                   icon: 'warning',
                   title: 'Oops...',
                   text: 'Debe seleccionar alguna opcion en SERVICIO REQUERIDO, no puede estar vacio'
                 });
               return
           }

        // valida si esta vacio, si lo esta envia una alerta y retorna a la pagina del formulario
        var observaciones = $("#observaciones").val();
        if (observaciones.length == 0 || observaciones == null || /^\s+$/.test(observaciones)) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'El campo Observaciones no puede estar vacio'
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
                url:"././sistema/logica/ajax_formularios/form_autorizaciones_consultor.php",
                type:"POST",
                contentType:false,
                processData:false,
                success: function(data){
                    btnEnviar.val("Guardando.."); // Para input de tipo button
                    btnEnviar.attr("disabled","disabled");
                    btnEnviar.val("Enviado"); // Para input de tipo button
                    $("body").append(data);
                    setTimeout(function () {
                      location.reload("./././autorizaciones_consultor.php");
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