
    // funcion para hacer campos obligatorios
    function camposValidar(valor) {

        var valor = valor.value;
        // reset de otras opciones
        $('#cont-servicioProgramado').empty();
        $('#cont-cmd').empty();

        if (valor == "Programacion") {
            // En caso de que la opcion seleccionada sea Programacion
            // todos los campos se hacen obligatorios
            console.log("programacion");

            // campo servicio ya programado no aplica
            $('#cont-servicioProgramado').append(
                '<label for="servicioProgramado" class="col-sm-4 col-form-label">Servicio ya programado</label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" id="servicioProgramado" name="servicioProgramado" value="N/A" class="form-control" readonly/>'+
                '</div>');

        } else if (valor == "Demora programacion") {
            // En caso de que la opcion seleccionada sea Demora programacion
            console.log("Demora programacion");

            // campo servicio ya programado no aplica
            $('#cont-servicioProgramado').append(
                '<label for="servicioProgramado" class="col-sm-4 col-form-label">Servicio ya programado</label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" id="servicioProgramado" name="servicioProgramado" value="N/A" class="form-control" readonly/>'+
                '</div>');

        } else if (valor == "Demora resultados") {
            // En caso de que la opcion seleccionada sea Demora resultados
            console.log("Demora resultados");

            // campo servicio ya programado no aplica
            $('#cont-servicioProgramado').append(
                '<label for="servicioProgramado" class="col-sm-4 col-form-label">Servicio ya programado</label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" id="servicioProgramado" name="servicioProgramado" value="N/A" class="form-control" readonly/>'+
                '</div>');

            // se activa campo de centro medico    
            $('#cont-cmd').append(
                '<label for="cmd" class="col-sm-4 col-form-label">Centro Medico</label>'+
                '<div class="col-sm-8">'+
                    '<select name="cmd" id="cmd" class="form-control">'+
                        '<option value="" hidden>Selecciona una opcion</option>'+
                        '<option value="Si">Si</option>'+
                        '<option value="No">No</option>'+
                    '</select>'+
                '</div>');
            

        } else if (valor == "Cancelacion del servicio") {
            // En caso de que la opcion seleccionada sea Cancelacion del servicio
            console.log("Cancelacion del servicio");
            $('#cont-servicioProgramado').append(
                '<label for="servicioProgramado" class="col-sm-4 col-form-label">Servicio ya programado</label>'+
                '<div class="col-sm-8">'+
                    '<select name="servicioProgramado" id="servicioProgramado" class="form-control">'+
                        '<option value="" hidden>Selecciona una opcion</option>'+
                        '<option value="Si">Si</option>'+
                        '<option value="No">No</option>'+
                    '</select>'+
                '</div>');

        } else if (valor == "Otros") {
            // En caso de que la opcion seleccionada sea Otros
            console.log("Otros");

            // campo servicio ya programado no aplica
            $('#cont-servicioProgramado').append(
                '<label for="servicioProgramado" class="col-sm-4 col-form-label">Servicio ya programado</label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" id="servicioProgramado" name="servicioProgramado" value="N/A" class="form-control" readonly/>'+
                '</div>');
        }

    }

$(document).ready(function(){

    /* Envio de formulario para crear ticket*/
    $("#form_laboratorioCitas").on("submit",function(e){
        e.preventDefault();


        var parametros = new FormData($("#form_laboratorioCitas")[0]);
        var btnEnviar = $("#btnEnviar_infInvestigarCitas_consultor");
        var expresionEmail = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
        var expresionHora = /^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$/;
        
        // valida si esta vacio, si lo esta envia una alerta y retorna a la pagina del formulario
        var tipoSolicitud = $("#tipoSolicitud").val();
        if (tipoSolicitud == null || tipoSolicitud == 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Debe seleccionar alguna opcion en TIPO DE SOLICITUD, no puede estar vacio'
              });
              $("#tipoSolicitud").css("border-color", "red");
            return
        } else {
            $("#tipoSolicitud").css("border-color", "#ced4da");
        }

        /*  Validaciones de campos basicos */
        // valida si esta vacio, si lo esta envia una alerta y retorna a la pagina del formulario
        var fechaSolicitud = $("#fechaSolicitud").val();
        if (fechaSolicitud == null || fechaSolicitud == 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Debe seleccionar algun valor en FECHA DE INGRESO DE LA SOLICITUD, no puede estar vacio'
              });
              $("#fechaSolicitud").css("border-color", "red");
            return
        } else {
            $("#fechaSolicitud").css("border-color", "#ced4da");
        }

        /*  Validaciones de campos basicos */
        // valida si esta vacio, si lo esta envia una alerta y retorna a la pagina del formulario
        var horaSolicitud = $("#horaSolicitud").val();

        if (horaSolicitud == null || horaSolicitud == 0 || !expresionHora.test(horaSolicitud)) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'El campo HORA DE INGRESO DE LA SOLICITUD no puede estar vacio, adicionalmente la hora debe ser en formato militar'
              });
              $("#horaSolicitud").css("border-color", "red");
            return
        } else {
            $("#horaSolicitud").css("border-color", "#ced4da");
        }

        // valida si esta vacio, si lo esta envia una alerta y retorna a la pagina del formulario
        var nombres = $("#nombres").val();
        if (nombres.length == 0 || nombres == null || /^\s+$/.test(nombres)) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'El campo NOMBRE PACIENTE no puede estar vacio'
              });
              $("#nombres").css("border-color", "red");
            return
        } else {
            $("#nombres").css("border-color", "#ced4da");
        }

        // valida que el campo documento no este vacio ni contenga letras
        var documento = $("#documento").val();
        if (isNaN(documento) || /^\s+$/.test(documento) || documento == null || documento == 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'El campo DOCUMENTO no puede estar vacio ni contener letras'
              });
              $("#documento").css("border-color", "red")
            return
        } else {
            $("#documento").css("border-color", "#ced4da");
        }

        switch (tipoSolicitud) {
            case "Programacion":
                console.log("Validacion programacion");
                
                var direccion = $('#direccion').val();
                if (direccion.length == 0 || direccion == null || /^\s+$/.test(direccion)) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'El campo DIRECCION no puede estar vacio'
                        });
        
                        $("#direccion").css("border-color", "red");
                    return
                } else {
                    $("#direccion").css("border-color", "#ced4da");
                }

                var barrio = $('#barrio').val();
                if (barrio.length == 0 || barrio == null || /^\s+$/.test(barrio)) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'El campo BARRIO no puede estar vacio'
                        });
        
                        $("#barrio").css("border-color", "red");
                    return
                } else {
                    $("#barrio").css("border-color", "#ced4da");
                }

                var localidad = $('#localidad').val();
                if (localidad.length == 0 || localidad == null || /^\s+$/.test(localidad)) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'El campo LOCALIDAD no puede estar vacio'
                        });
        
                        $("#localidad").css("border-color", "red");
                    return
                } else {
                    $("#localidad").css("border-color", "#ced4da");
                }

                var celular = $("#celular").val();
                if (isNaN(celular) || /^\s+$/.test(celular) || celular == null || celular == 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'El campo CELULAR no puede estar vacio ni contener letras'
                      });
                      $("#celular").css("border-color", "red")
                    return
                } else {
                    $("#celular").css("border-color", "#ced4da");
                }

                var telefono = $("#telefono").val();
                if (isNaN(telefono) || /^\s+$/.test(telefono) || telefono == null) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'El campo TELEFONO no puede estar vacio ni contener letras'
                      });
                      $("#telefono").css("border-color", "red")
                    return
                } else {
                    $("#telefono").css("border-color", "#ced4da");
                }

                // valida si esta vacio, si lo esta envia una alerta y retorna a la pagina del formulario
                var correo = $("#correo").val();
                if (correo.length == 0 || correo == null || !expresionEmail.test(correo)) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'El correo electrónico ingresado no es válido. Este campo puede tener letras, números, puntos, guiones, seguido de @ y el dominio correspondiente.'
                      });
                      $("#correo").css("border-color", "red")
                    return
                } else {
                    $("#correo").css("border-color", "#ced4da");
                }

                var modoPago = $("#modoPago").val();
                if (modoPago == null || modoPago == 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Debe seleccionar alguna opcion en MODALIDAD DE PAGO, no puede estar vacio'
                      });
                      $("#modoPago").css("border-color", "red")
                    return
                } else {
                    $("#modoPago").css("border-color", "#ced4da");
                }

                var tipoPaciente = $("#tipoPaciente").val();
                if (tipoPaciente == null || tipoPaciente == 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Debe seleccionar alguna opcion en TIPO DE PACIENTE, no puede estar vacio'
                      });
                      $("#tipoPaciente").css("border-color", "red")
                    return
                } else {
                    $("#tipoPaciente").css("border-color", "#ced4da");
                }

                var plan = $('#plan').val();
                if (plan.length == 0 || plan == null || /^\s+$/.test(plan)) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'El campo PLAN no puede estar vacio'
                        });
        
                        $("#plan").css("border-color", "red");
                    return
                } else {
                    $("#plan").css("border-color", "#ced4da");
                }

                var posibleCovid = $("#posibleCovid").val();
                if (posibleCovid == null || posibleCovid == 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Debe seleccionar alguna opcion en POSIBLE CASO COVID, no puede estar vacio'
                      });
                      $("#posibleCovid").css("border-color", "red")
                    return
                } else {
                    $("#posibleCovid").css("border-color", "#ced4da");
                }

            break;

            case "Demora resultados":
                console.log("Validacion Demora resultados");
                // valida si esta vacio, si lo esta envia una alerta y retorna a la pagina del formulario
                var correo = $("#correo").val();
                if (correo.length == 0 || correo == null || !expresionEmail.test(correo)) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'El correo electrónico ingresado no es válido. Este campo puede tener letras, números, puntos, guiones, seguido de @ y el dominio correspondiente.'
                      });
                      $("#correo").css("border-color", "red")
                    return
                } else {
                    $("#correo").css("border-color", "#ced4da");
                }

                // PENDIENTE DE REVISION
                var fechaServicio = $("#fechaServicio").val();
                if (fechaServicio == null || fechaServicio == 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Debe seleccionar algun valor en FECHA DE SERVICIO, no puede estar vacio'
                      });
                      $("#fechaServicio").css("border-color", "red");
                    return
                } else {
                    $("#fechaServicio").css("border-color", "#ced4da");
                }

                var cmd = $("#cmd").val();
                if (cmd == null || cmd == 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Debe seleccionar alguna opcion en CENTRO MEDICO, no puede estar vacio'
                      });
                      $("#cmd").css("border-color", "red")
                    return
                } else {
                    $("#cmd").css("border-color", "#ced4da");
                }

            break;

            case "Cancelacion del servicio":
                console.log("Validacion cancelacion del servicio");

                // pendiente de revision
                var servicioProgramado = $("#servicioProgramado").val();
                if (servicioProgramado == null || servicioProgramado == 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Debe seleccionar algun valor en SERVICIO YA PROGRAMADO, no puede estar vacio'
                      });
                      $("#servicioProgramado").css("border-color", "red");
                    return
                } else {
                    $("#servicioProgramado").css("border-color", "#ced4da");
                }

                // pendiente de revision
                var fechaServicio = $("#fechaServicio").val();
                if (fechaServicio == null || fechaServicio == 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Oops...',
                        text: 'Debe seleccionar algun valor en FECHA DE SERVICIO, no puede estar vacio'
                      });
                      $("#fechaServicio").css("border-color", "red");
                    return
                } else {
                    $("#fechaServicio").css("border-color", "#ced4da");
                }
            break;
        }

        // valida si esta vacio, si lo esta envia una alerta y retorna a la pagina del formulario
        var observaciones = $("#observaciones").val();
        if (observaciones.length == 0 || observaciones == null || /^\s+$/.test(observaciones)) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'El campo OBSERVACIONES no puede estar vacio'
                });

                $("#observaciones").css("border-color", "red");
            return
        } else {
            $("#observaciones").css("border-color", "#ced4da");
        }

        // valida si esta vacio, si lo esta envia una alerta y retorna a la pagina del formulario

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