
    function camposNuevos(valor) {

        var valor = valor.value;
        $('#cont-nombreProfesional').css("display", "flex");
        $('#cont-fechaServicio').css("display", "flex");
        if (valor == "SI") {
          // campo nombre profesional
            $('#cont-nombreProfesional').empty(); // Limpia las opciones anteriores
            $('#cont-nombreProfesional').append(
              "<label for='nombreProfesional' class='col-sm-4 col-form-label'>Nombre profesional/servicio</label>"+
                  "<div class='col-sm-8'>"+
                  "<input type='text' class='form-control' name='nombreProfesional' id='nombreProfesional' placeholder='Nombre de profesional' required>"+
              "</div>");
            // campo fecha
            $('#cont-fechaServicio').empty(); // Limpia las opciones anteriores
            $('#cont-fechaServicio').append(
                "<label for='fechaServicio' class='col-sm-4 col-form-label'>Fecha servicio</label>"+
                    "<div class='col-sm-8'>"+
                    "<input type='date' class='form-control' name='fechaServicio' id='fechaServicio' required>"+
                "</div>");
        } else if (valor == "NO") {
          // campo nombre profesional
            $('#cont-nombreProfesional').empty(); // Limpia las opciones anteriores
            $('#cont-nombreProfesional').append(
              "<label for='nombreProfesional' class='col-sm-4 col-form-label'>Nombre profesional/servicio</label>"+
                    "<div class='col-sm-8'>"+
                        "<input type='text' class='form-control' name='nombreProfesional' id='nombreProfesional' value='N/A' readonly>"+
                    "</div>");
            // campo fecha
            $('#cont-fechaServicio').empty(); // Limpia las opciones anteriores
            $('#cont-fechaServicio').append(
              "<label for='nombreProfesional' class='col-sm-4 col-form-label'>Fecha servicio</label>"+
                    "<div class='col-sm-8'>"+
                        "<input type='text' class='form-control' name='fechaServicio' id='fechaServicio' value='00/00/0000' readonly>"+
                    "</div>");
        }
    } 

$(document).ready(function(){

    /* Envio de formulario para crear ticket*/
    $("#form_infInvestigarCitas").on("submit",function(e){
        e.preventDefault();


        var parametros = new FormData($("#form_infInvestigarCitas")[0]);
        var btnEnviar = $("#btnEnviar_infInvestigarCitas_consultor");

        // valida si esta vacio, si lo esta envia una alerta y retorna a la pagina del formulario
        var tipoSolicitud = $("#solicitud").val();
        if (tipoSolicitud == null || tipoSolicitud == 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Debe seleccionar alguna opcion en TIPO DE SOLICITUD, no puede estar vacio'
              });
            return
        }
        
        // valida si esta vacio, si lo esta envia una alerta y retorna a la pagina del formulario
        var tipoPaciente = $("#tipoPaciente").val();
        if (tipoPaciente == null || tipoPaciente == 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Debe seleccionar alguna opcion en TIPO PACIENTE, no puede estar vacio'
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

        var expresionEmail = /^[A-Za-z0-9._-]+@[A-Za-z]+\.[\w.-]*[A-Za-z][A-Za-z]+$/;
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
        if (isNaN(celular) || /^\s+$/.test(celular) || celular == null || celular == 0) {
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
        var cmd = $("#cmd").val();
        if (cmd == null || cmd == 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Debe seleccionar alguna opcion en CENTRO MEDICO, no puede estar vacio'
              });
            return
        }

        // valida si esta vacio, si lo esta envia una alerta y retorna a la pagina del formulario
        var observaciones = $("#observaciones").val();
        if (observaciones.length == 0 || observaciones == null || /^\s+$/.test(observaciones)) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'El campo OBSERVACION no puede estar vacio'
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
                url:"././sistema/logica/ajax_formularios/form_infInvestigarCitas_agente.php",
                type:"POST",
                contentType:false,
                processData:false,
                success: function(data){
                    btnEnviar.val("Guardando.."); // Para input de tipo button
                    btnEnviar.attr("disabled","disabled");
                    btnEnviar.val("Enviado"); // Para input de tipo button
                    $("body").append(data);
                    setTimeout(function () {
                      location.reload("./././infInvestigarCitas_consultor.php");
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