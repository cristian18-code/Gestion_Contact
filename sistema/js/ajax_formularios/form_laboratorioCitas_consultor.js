
    // funcion para hacer campos obligatorios
    function agregarFecha(valor) {
        var valorFecha = valor.value;
        console.log(valorFecha);

        if (valorFecha == "Si") {
            $('#cont-fechaServicio').empty();
            $('#cont-fechaServicio').css("display", "flex");

            // campo fecha de servicio obligatorio
            $('#cont-fechaServicio').append(
                '<label for="fechaServicio" class="col-sm-4 col-form-label">Fecha de servicio</label>'+
                '<div class="col-sm-8">'+
                    '<input type="date" name="fechaServicio" class="form-control" autocomplete="off" id="fechaServicio" required>'+
                '</div>');
        } else {
            $('#cont-fechaServicio').empty();
            $('#cont-fechaServicio').css("display", "flex");

            // campo fecha de servicio obligatorio
            $('#cont-fechaServicio').append(
                '<label for="fechaServicio" class="col-sm-4 col-form-label">Fecha de servicio</label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" name="fechaServicio" class="form-control" id="fechaServicio" value="00/00/0000" readonly>'+
                '</div>');
        }

    }

    // funcion para hacer campos obligatorios
    function camposValidar(valor) {

        var valor = valor.value;
        console.log(valor);

        // reset de otras opciones
        $('#cont-direccion').empty();
        $('#cont-barrio').empty();
        $('#cont-localidad').empty();
        $('#cont-celular').empty();
        $('#cont-telefono').empty();
        $('#cont-correo').empty();
        $('#cont-modoPago').empty();
        $('#cont-tipoPaciente').empty();
        $('#cont-plan').empty();
        $('#cont-posibleCovid').empty();
        $('#cont-fechaServicio').empty();
        $('#cont-cmd').empty();

        // aparicion de campos
        $('#cont-direccion').css("display", "flex");
        $('#cont-barrio').css("display", "flex");
        $('#cont-localidad').css("display", "flex");
        $('#cont-celular').css("display", "flex");
        $('#cont-telefono').css("display", "flex");
        $('#cont-correo').css("display", "flex");
        $('#cont-modoPago').css("display", "flex");
        $('#cont-tipoPaciente').css("display", "flex");
        $('#cont-plan').css("display", "flex");
        $('#cont-posibleCovid').css("display", "flex");
        $('#cont-fechaServicio').css("display", "flex");
        $('#cont-cmd').css("display", "flex");

        if (valor == "Programacion") {
            // todos los campos se hacen obligatorios

            // canpo direccion obligatorio
            $('#cont-direccion').append(
                '<label for="direccion" class="col-sm-4 col-form-label">Direccion</label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" name="direccion" id="direccion" class="form-control" autocomplete="off" placeholder="Direccion paciente" required>'+
                '</div>'
            );
            
            // canpo barrio obligatorio
            $('#cont-barrio').append(
                '<label for="barrio" class="col-sm-4 col-form-label">Barrio</label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" name="barrio" id="barrio" class="form-control" autocomplete="off" placeholder="Barrio paciente" required>'+
                '</div>'
            );

            // campo localidad obligatorio
            $('#cont-localidad').append(
                '<label for="localidad" class="col-sm-4 col-form-label">Localidad</label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" name="localidad" id="localidad" class="form-control" autocomplete="off" placeholder="localidad paciente" required>'+
                '</div>'
            );

            // campo celular obligatorio
            $('#cont-celular').append(
                '<label for="celular" class="col-sm-4 col-form-label">Número celular</label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" name="celular" id="celular" class="form-control" autocomplete="off" placeholder="1234567890" required>'+
                '</div>'
            );

            // campo telefono obligatorio
            $('#cont-telefono').append(
                '<label for="telefono" class="col-sm-4 col-form-label">Número fijo</label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" name="telefono" id="telefono" class="form-control" autocomplete="off" placeholder="1234567" required>'+
                '</div>'
            );
            
            // campo correo obligatorio
            $('#cont-correo').append(
                '<label for="correo" class="col-sm-4 col-form-label">Correo electronico</label>'+
                '<div class="col-sm-8">'+
                    '<input type="email" name="correo" id="correo" class="form-control" autocomplete="off" placeholder="Correo Usuario" required>'+
                '</div>'
            );

            // campo modoPago obligatorio
            $('#cont-modoPago').append(
                '<label for="modoPago" class="col-sm-4 col-form-label">Modalidad de pago</label>'+
                '<div class="col-sm-8">'+
                    '<select name="modoPago" id="modoPago" class="form-control" required>'+
                        '<option value="" hidden>Selecciona una opcion</option>'+
                        '<option value="EFECTIVO">EFECTIVO</option>'+
                        '<option value="DATAFONO">DATAFONO</option>'+
                        '<option value="PAGO PAYU">PAGO PAYU</option>'+
                    '</select>'+
                '</div>'
            );

            // campo tipoPaciente obligatorio
            $('#cont-tipoPaciente').append(
                '<label for="tipoPaciente" class="col-sm-4 col-form-label">Tipo de paciente</label>'+
                '<div class="col-sm-8">'+
                    '<select name="tipoPaciente" id="tipoPaciente" class="form-control" required>'+
                        '<option value="" hidden>Selecciona una opcion</option>'+
                        '<option value="AFILIADO MP">AFILIADO MP</option>'+
                        '<option value="PARTICULAR">PARTICULAR</option>'+
                    '</select>'+
                '</div>'
            );

            // campo plan obligatorio
            $('#cont-plan').append(
                '<label for="plan" class="col-sm-4 col-form-label">Plan</label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" name="plan" id="plan" class="form-control" autocomplete="off" placeholder="Plan solicitado" required>'+
                '</div>'
            );

            // campo posibleCovid obligatorio
            $('#cont-posibleCovid').append(
                '<label for="posibleCovid" class="col-sm-4 col-form-label">Posible caso COVID </label>'+
                '<div class="col-sm-8">'+
                    '<select name="posibleCovid" id="posibleCovid" class="form-control" required>'+
                        '<option value="" hidden>Selecciona una opcion</option>'+
                        '<option value="Si">Si</option>'+
                        '<option value="No">No</option>'+
                    '</select>'+
                '</div>'
            );

            // campo fecha de servicio no aplica
            $('#cont-fechaServicio').append(
                '<label for="fechaServicio" class="col-sm-4 col-form-label">Fecha de servicio</label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" name="fechaServicio" class="form-control" id="fechaServicio" value="00/00/0000" readonly>'+
                '</div>');            
                
            // se activa campo de centro medico
            $('#cont-cmd').append(
                '<label for="cmd" class="col-sm-4 col-form-label">Centro Medico</label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" id="cmd" name="cmd" value="N/A" class="form-control" readonly/>'+
                '</div>');

        } else if (valor == "Demora programacion") {

            // campo direccion no aplica
            $('#cont-direccion').append(
                '<label for="direccion" class="col-sm-4 col-form-label">Direccion</label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" name="direccion" id="direccion" value="N/A" class="form-control" readonly>'+
                '</div>'
            );

            // campo barrio no aplica
            $('#cont-barrio').append(
                '<label for="barrio" class="col-sm-4 col-form-label">Barrio</label>'+
                '<div class="col-sm-8">'+
                '<input type="text" name="barrio" id="barrio" class="form-control" value="N/A" readonly>'+
                '</div>'
            );

            // campo localidad no aplica
            $('#cont-localidad').append(
                '<label for="localidad" class="col-sm-4 col-form-label">Localidad</label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" name="localidad" id="localidad" class="form-control" value="N/A" readonly>'+
                '</div>'
            );

            // campo celular obligatorio
            $('#cont-celular').append(
                '<label for="celular" class="col-sm-4 col-form-label">Número celular</label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" name="celular" id="celular" class="form-control" autocomplete="off" placeholder="1234567890" required>'+
                '</div>'
            );

            // campo telefono no aplica
            $('#cont-telefono').append(
                '<label for="telefono" class="col-sm-4 col-form-label">Número fijo</label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" name="telefono" id="telefono" class="form-control" value="N/A" readonly>'+
                '</div>'
            );

            // campo correo no aplica
            $('#cont-correo').append(
                '<label for="correo" class="col-sm-4 col-form-label">Correo electronico</label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" name="correo" id="correo" class="form-control" value="N/A" readonly>'+
                '</div>'
            );

            // campo modoPago no aplica
            $('#cont-modoPago').append(
                '<label for="modoPago" class="col-sm-4 col-form-label">Modalidad de pago</label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" name="modoPago" id="modoPago" class="form-control" value="N/A" readonly>'+
                '</div>'
            );

            // campo tipoPaciente no aplica
            $('#cont-tipoPaciente').append(
                '<label for="tipoPaciente" class="col-sm-4 col-form-label">Tipo de paciente</label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" name="tipoPaciente" id="tipoPaciente" class="form-control" value="N/A" readonly>'+
                '</div>'
            );

            // campo plan no aplica
            $('#cont-plan').append(
                '<label for="plan" class="col-sm-4 col-form-label">Plan</label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" name="plan" id="plan" class="form-control" value="N/A" readonly>'+
                '</div>'
            );

            // campo posibleCovid no aplica
            $('#cont-posibleCovid').append(
                '<label for="posibleCovid" class="col-sm-4 col-form-label">Posible caso COVID </label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" name="posibleCovid" id="posibleCovid" class="form-control" value="N/A" readonly>'+
                '</div>'
            );

            // campo fecha de servicio no aplica
            $('#cont-fechaServicio').append(
                '<label for="fechaServicio" class="col-sm-4 col-form-label">Fecha de servicio</label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" name="fechaServicio" class="form-control" id="fechaServicio" value="00/00/0000" readonly>'+
                '</div>');                

            // se activa campo de centro medico
            $('#cont-cmd').append(
                '<label for="cmd" class="col-sm-4 col-form-label">Centro Medico</label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" id="cmd" name="cmd" value="N/A" class="form-control" readonly/>'+
                '</div>');

        } else if (valor == "Demora resultados") {

            // campo direccion no aplica
            $('#cont-direccion').append(
                '<label for="direccion" class="col-sm-4 col-form-label">Direccion</label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" name="direccion" id="direccion" value="N/A" class="form-control" readonly>'+
                '</div>'
            );

            // campo barrio no aplica
            $('#cont-barrio').append(
                '<label for="barrio" class="col-sm-4 col-form-label">Barrio</label>'+
                '<div class="col-sm-8">'+
                '<input type="text" name="barrio" id="barrio" class="form-control" value="N/A" readonly>'+
                '</div>'
            );

            // campo localidad no aplica
            $('#cont-localidad').append(
                '<label for="localidad" class="col-sm-4 col-form-label">Localidad</label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" name="localidad" id="localidad" class="form-control" value="N/A" readonly>'+
                '</div>'
            );

            // campo celular obligatorio
            $('#cont-celular').append(
                '<label for="celular" class="col-sm-4 col-form-label">Número celular</label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" name="celular" id="celular" class="form-control" autocomplete="off" placeholder="1234567890" required>'+
                '</div>'
            );

            // campo telefono no aplica
            $('#cont-telefono').append(
                '<label for="telefono" class="col-sm-4 col-form-label">Número fijo</label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" name="telefono" id="telefono" class="form-control" value="N/A" readonly>'+
                '</div>'
            );            

            // campo correo obligatorio
            $('#cont-correo').append(
                '<label for="correo" class="col-sm-4 col-form-label">Correo electronico</label>'+
                '<div class="col-sm-8">'+
                    '<input type="email" name="correo" id="correo" class="form-control" autocomplete="off" placeholder="Correo Usuario" required>'+
                '</div>'
            );

            // campo modoPago no aplica
            $('#cont-modoPago').append(
                '<label for="modoPago" class="col-sm-4 col-form-label">Modalidad de pago</label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" name="modoPago" id="modoPago" class="form-control" value="N/A" readonly>'+
                '</div>'
            );

            // campo tipoPaciente no aplica
            $('#cont-tipoPaciente').append(
                '<label for="tipoPaciente" class="col-sm-4 col-form-label">Tipo de paciente</label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" name="tipoPaciente" id="tipoPaciente" class="form-control" value="N/A" readonly>'+
                '</div>'
            );

            // campo plan no aplica
            $('#cont-plan').append(
                '<label for="plan" class="col-sm-4 col-form-label">Plan</label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" name="plan" id="plan" class="form-control" value="N/A" readonly>'+
                '</div>'
            );

            // campo posibleCovid no aplica
            $('#cont-posibleCovid').append(
                '<label for="posibleCovid" class="col-sm-4 col-form-label">Posible caso COVID </label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" name="posibleCovid" id="posibleCovid" class="form-control" value="N/A" readonly>'+
                '</div>'
            );

            // campo fecha de servicio obligatorio
            $('#cont-fechaServicio').append(
                '<label for="fechaServicio" class="col-sm-4 col-form-label">Fecha de servicio</label>'+
                '<div class="col-sm-8">'+
                    '<input type="date" name="fechaServicio" class="form-control" autocomplete="off" id="fechaServicio" required>'+
                '</div>');

            // se activa campo de centro medico 
            $('#cont-cmd').append(
                '<label for="cmd" class="col-sm-4 col-form-label">Centro Medico</label>'+
                '<div class="col-sm-8">'+
                    '<select name="cmd" id="cmd" class="form-control">'+
                        '<option value="" hidden>Selecciona una opcion</option>'+
                        '<option value="CHICO">CHICO</option>'+
                        '<option value="PALERMO">PALERMO</option>'+
                        '<option value="SANTA MONICA">SANTA MONICA</option>'+
                        '<option value="SANTA BARBARA">SANTA BARBARA</option>'+
                        '<option value="BLUECARE MEDELLIN">BLUECARE MEDELLIN</option>'+
                        '<option value="MEDCENTER">MEDCENTER</option>'+
                        '<option value="DOMICILIO">DOMICILIO</option>'+
                    '</select>'+
                '</div>');
            

        } else if (valor == "Cancelacion del servicio") {
            
            // campo direccion no aplica
            $('#cont-direccion').append(
                '<label for="direccion" class="col-sm-4 col-form-label">Direccion</label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" name="direccion" id="direccion" value="N/A" class="form-control" readonly>'+
                '</div>'
            );

            // campo barrio no aplica
            $('#cont-barrio').append(
                '<label for="barrio" class="col-sm-4 col-form-label">Barrio</label>'+
                '<div class="col-sm-8">'+
                '<input type="text" name="barrio" id="barrio" class="form-control" value="N/A" readonly>'+
                '</div>'
            );

            // campo localidad no aplica
            $('#cont-localidad').append(
                '<label for="localidad" class="col-sm-4 col-form-label">Localidad</label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" name="localidad" id="localidad" class="form-control" value="N/A" readonly>'+
                '</div>'
            );

            // campo celular no aplica
            $('#cont-celular').append(
                '<label for="celular" class="col-sm-4 col-form-label">Número celular</label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" name="celular" id="celular" class="form-control" value="N/A" readonly>'+
                '</div>'
            );

            // campo telefono no aplica
            $('#cont-telefono').append(
                '<label for="telefono" class="col-sm-4 col-form-label">Número fijo</label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" name="telefono" id="telefono" class="form-control" value="N/A" readonly>'+
                '</div>'
            );

            // campo correo no aplica
            $('#cont-correo').append(
                '<label for="correo" class="col-sm-4 col-form-label">Correo electronico</label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" name="correo" id="correo" class="form-control" value="N/A" readonly>'+
                '</div>'
            );

            // campo modoPago no aplica
            $('#cont-modoPago').append(
                '<label for="modoPago" class="col-sm-4 col-form-label">Modalidad de pago</label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" name="modoPago" id="modoPago" class="form-control" value="N/A" readonly>'+
                '</div>'
            );

            // campo tipoPaciente no aplica
            $('#cont-tipoPaciente').append(
                '<label for="tipoPaciente" class="col-sm-4 col-form-label">Tipo de paciente</label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" name="tipoPaciente" id="tipoPaciente" class="form-control" value="N/A" readonly>'+
                '</div>'
            );

            // campo plan no aplica
            $('#cont-plan').append(
                '<label for="plan" class="col-sm-4 col-form-label">Plan</label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" name="plan" id="plan" class="form-control" value="N/A" readonly>'+
                '</div>'
            );

            // campo posibleCovid no aplica
            $('#cont-posibleCovid').append(
                '<label for="posibleCovid" class="col-sm-4 col-form-label">Posible caso COVID </label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" name="posibleCovid" id="posibleCovid" class="form-control" value="N/A" readonly>'+
                '</div>'
            );

            // campo fecha de servicio no aplica
            $('#cont-fechaServicio').append(
                '<label for="fechaServicio" class="col-sm-4 col-form-label">Fecha de servicio</label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" name="fechaServicio" class="form-control" id="fechaServicio" value="00/00/0000" readonly>'+
                '</div>');

            // se activa campo de centro medico
            $('#cont-cmd').append(
                '<label for="cmd" class="col-sm-4 col-form-label">Centro Medico</label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" id="cmd" name="cmd" value="N/A" class="form-control" readonly/>'+
                '</div>');

        } else if (valor == "Otros") {

            // campo direccion no aplica
            $('#cont-direccion').append(
                '<label for="direccion" class="col-sm-4 col-form-label">Direccion</label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" name="direccion" id="direccion" value="N/A" class="form-control" readonly>'+
                '</div>'
            );

            // campo barrio no aplica
            $('#cont-barrio').append(
                '<label for="barrio" class="col-sm-4 col-form-label">Barrio</label>'+
                '<div class="col-sm-8">'+
                '<input type="text" name="barrio" id="barrio" class="form-control" value="N/A" readonly>'+
                '</div>'
            );

            // campo localidad no aplica
            $('#cont-localidad').append(
                '<label for="localidad" class="col-sm-4 col-form-label">Localidad</label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" name="localidad" id="localidad" class="form-control" value="N/A" readonly>'+
                '</div>'
            );

            // campo celular obligatorio
            $('#cont-celular').append(
                '<label for="celular" class="col-sm-4 col-form-label">Número celular</label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" name="celular" id="celular" class="form-control" autocomplete="off" placeholder="1234567890" required>'+
                '</div>'
            );

            // campo telefono no aplica
            $('#cont-telefono').append(
                '<label for="telefono" class="col-sm-4 col-form-label">Número fijo</label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" name="telefono" id="telefono" class="form-control" value="N/A" readonly>'+
                '</div>'
            );
            
            // campo correo obligatorio
            $('#cont-correo').append(
                '<label for="correo" class="col-sm-4 col-form-label">Correo electronico</label>'+
                '<div class="col-sm-8">'+
                    '<input type="email" name="correo" id="correo" class="form-control" autocomplete="off" placeholder="Correo Usuario" required>'+
                '</div>'
            );

            // campo modoPago no aplica
            $('#cont-modoPago').append(
                '<label for="modoPago" class="col-sm-4 col-form-label">Modalidad de pago</label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" name="modoPago" id="modoPago" class="form-control" value="N/A" readonly>'+
                '</div>'
            );

            // campo tipoPaciente no aplica
            $('#cont-tipoPaciente').append(
                '<label for="tipoPaciente" class="col-sm-4 col-form-label">Tipo de paciente</label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" name="tipoPaciente" id="tipoPaciente" class="form-control" value="N/A" readonly>'+
                '</div>'
            );

            // campo plan no aplica
            $('#cont-plan').append(
                '<label for="plan" class="col-sm-4 col-form-label">Plan</label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" name="plan" id="plan" class="form-control" value="N/A" readonly>'+
                '</div>'
            );

            // campo posibleCovid no aplica
            $('#cont-posibleCovid').append(
                '<label for="posibleCovid" class="col-sm-4 col-form-label">Posible caso COVID </label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" name="posibleCovid" id="posibleCovid" class="form-control" value="N/A" readonly>'+
                '</div>'
            );

            // campo fecha de servicio no aplica
            $('#cont-fechaServicio').append(
                '<label for="fechaServicio" class="col-sm-4 col-form-label">Fecha de servicio</label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" name="fechaServicio" class="form-control" id="fechaServicio" value="00/00/0000" readonly>'+
                '</div>');

            // se activa campo de centro medico
            $('#cont-cmd').append(
                '<label for="cmd" class="col-sm-4 col-form-label">Centro Medico</label>'+
                '<div class="col-sm-8">'+
                    '<input type="text" id="cmd" name="cmd" value="N/A" class="form-control" readonly/>'+
                '</div>');
        }

    }

$(document).ready(function(){

    /* Envio de formulario para crear ticket*/
    $("#form_laboratorioCitas").on("submit",function(e){
        e.preventDefault();


        var parametros = new FormData($("#form_laboratorioCitas")[0]);
        var btnEnviar = $("#btnEnviar_laboratorioCitas_consultor");
        var expresionEmail = /^(([^<>()[\]\.,;:\s@\"]+(\.[^<>()[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
        
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
                url:"././sistema/logica/ajax_formularios/form_laboratoriosCitas_consultor.php",
                type:"POST",
                contentType:false,
                processData:false,
                success: function(data){
                    btnEnviar.val("Guardando.."); // Para input de tipo button
                    btnEnviar.attr("disabled","disabled");
                    btnEnviar.val("Enviado"); // Para input de tipo button
                    $("body").append(data);
                    setTimeout(function () {
                      location.reload("../../../laboratorioCitas_consultor.php");
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