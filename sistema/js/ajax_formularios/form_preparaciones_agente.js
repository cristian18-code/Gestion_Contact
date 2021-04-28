
$(document).ready(function(){

    /* Envio de formulario para crear ticket*/
    $("#form_preparaciones_agente").on("submit",function(e){
        e.preventDefault();


        var parametros = new FormData($("#form_preparaciones_agente")[0]);
        var btnEnviar = $("#btnEnviar_preparaciones_agente");
        
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
        var nombres = $("#nombres").val();
        if (nombres.length == 0 || nombres == null || /^\s+$/.test(nombres)) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'El campo NOMBRE USUARIO no puede estar vacio'
              });
            return
        }

            // valida que el campo no este vacio ni contenga letras
            var celular = $("#celular").val();
            if (isNaN(celular) || /^\s+$/.test(celular) || celular == null || celular == 0) {
                     Swal.fire({
                         icon: 'warning',
                         title: 'Oops...',
                         text: 'El campo CELULAR no puede estar vacio ni contener letras'
                      });
                  return
              }

        // valida si esta vacio, si lo esta envia una alerta y retorna a la pagina del formulario
        var examen = $("#examen").val();
        if (examen.length == 0 || examen == null || /^\s+$/.test(examen)) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'El campo EXAMEN no puede estar vacio'
                });
            return
        }

        var expresionEmail = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
        // valida si el correo esta bien escrito, si lo esta envia una alerta y retorna a la pagina del formulario
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
            var solicitud = $("#solicitud").val();
            if (solicitud == null || solicitud == 0) {
                    Swal.fire({
                    icon: 'warning',
                    title: 'Oops...',
                    text: 'Debes selecciona una opción en el campo de Tipo de Solicitud'
                });
                return
            }
           
             // valida si esta vacio, si lo esta envia una alerta y retorna a la pagina del formulario
             var cmd = $("#cmd").val();
             if (cmd == null || cmd == 0) {
                      Swal.fire({
                      icon: 'warning',
                      title: 'Oops...',
                      text: 'Debes selecciona una opción en el campo de Centro Médico'
                   });
                return
             }
               // valida si esta vacio, si lo esta envia una alerta y retorna a la pagina del formulario
               var tipo = $("#tipo").val();
               if (tipo == null || tipo== 0) {
                        Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Debes selecciona una opción en el campo de Tipo'
                     });
                  return
               }
             
            // valida si esta vacio, si lo esta envia una alerta y retorna a la pagina del formulario
             var tipoPaciente = $("#tipoPaciente").val();
             if (tipoPaciente == null || tipoPaciente == 0) {
                      Swal.fire({
                      icon: 'warning',
                      title: 'Oops...',
                      text: 'Debes selecciona una opción en el campo de Tipo Paciente'
                   });
                return
             }
                   // valida si esta vacio, si lo esta envia una alerta y retorna a la pagina del formulario
        var observacion = $("#observacion").val();
        if (observacion.length == 0 || observacion == null || /^\s+$/.test(observacion)) {
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
                url:"././sistema/logica/ajax_formularios/form_preparaciones_agente.php",
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
                    // setTimeout(function () {
                    //   location.reload("./././infInvestigar_Consultor.php");
                    // }, 5000); //hace redireccion despues de 3 segundos
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