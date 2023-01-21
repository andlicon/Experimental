$(document).on('click', '.aceptar', function(){
    //datos
    var id = $(this).val();
    var salon = $('#salonInput'+id).val();
    var cedula = $('#cedulaInput'+id).val();
    
    $.ajax ( {
        url : '../../accion/modificar/ModificarProfesor.php',
        type : 'POST',
        data : {id: id, salon: salon, cedula: cedula},
        success : function(response) {
            if(response) {
                alert("Se ha modficiado el registro con éxito");
            }
            else {
                alert("No se ha podido modificar el registro");
            }

            location.reload();
        }
    });
    //Ocultar modificables
    $('.cancelar'+id).addClass("ocultar");
    $('.aceptar'+id).addClass("ocultar");
    $('.modificable'+id).prop('disabled', true);
    $('.modificable'+id).addClass('ocultar');
    $('.modificable--estado'+id).removeClass('ocultar');
});