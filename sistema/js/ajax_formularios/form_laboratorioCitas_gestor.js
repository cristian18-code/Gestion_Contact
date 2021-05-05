


$(document).ready(function(){

    /* Envio de formulario para crear ticket*/
    $("#form_laboratorios_gestor").on("submit",function(e){
        e.preventDefault();


        var parametros = new FormData($("#form_laboratorios_gestor")[0]);
        var btnEnviar = $("#btnEnviar_laboratorios_gestor");

        // valida si esta vacio, si lo esta envia una alerta y retorna a la pagina del formulario
        var observacionesBack = $("#observacionesBack").val();
        if (/^\s+$/.test(observacionesBack) || observacionesBack == null) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Debe escribir algun texto en OBSERVACIONES, no puede estar vacio'
              });
            return
        }
        

   
        // valida si esta vacio, si lo esta envia una alerta y retorna a la pagina del formulario
        var estado = $("#estado").val();
        if (estado == null || estado == 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Oops...',
                text: 'Debe seleccionar alguna opcion en ESTADO, no puede estar vacio'
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
                url:"././sistema/logica/ajax_formularios/form_laboratoriosCitas_gestor.php",
                type:"POST",
                contentType:false,
                processData:false,
                success: function(data){
                    btnEnviar.val("Guardando.."); // Para input de tipo button
                    btnEnviar.attr("disabled","disabled");
                    btnEnviar.val("Enviado"); // Para input de tipo button
                    $("body").append(data);
                    setTimeout(function () {
                      window.location.href = "./././tabla_laboratorioCitas.php";
                    }, 4000); //hace redireccion despues de 3 segundos
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
function selectNuevo(valor) {

  var valor = valor.value;
  $('#cont-servicio').empty(); // Limpia las opciones anteriores
  $('#cont-servicio').removeClass("form-group row col-5");
  if (valor == 54) {
    // campo nombre profesional
      $('#cont-servicio').empty(); // Limpia las opciones anteriores
      $('#cont-servicio').addClass("form-group row col-5");
      $('#cont-servicio').append(
        "<label for='servicio' class='col-sm-3 col-form-label'>Servicio</label>"+
            "<div class='col-sm-9'>"+
            "<select name='servicio' id='servicio' class='form-control' required>"+
              "<option value='' hidden>Selecciona una opcion</option>"+
              "<option value='ODONTOLOGIA'>ODONTOLOGIA</option>"+
              "<option value='OPTOMETRIA'>OPTOMETRIA</option>"+
              "<option value='IMAGENOLOGIA'>IMAGENOLOGIA</option>"+
            "</select>"+
        "</div>");
  } else {
      $('#cont-servicio').append(
        "<input type='hidden' name='servicio' id='servicio' value='N/A'/>");
  }
} 