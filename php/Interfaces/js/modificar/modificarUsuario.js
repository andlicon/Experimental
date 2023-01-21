$(document).on('click', '.aceptar', function(){
    //datos
    var id = $(this).val();
    var tipoUsuario = $('#tipoUsuarioInput'+id).val();
    var valido = $('#validoInput'+id).val();
    alert('a');
    $.ajax ( {
        url : '../../accion/modificar/ModificarUsuarioAdmin.php',
        type : 'POST',
        data : {id: id, tipoUsuario: tipoUsuario, valido: valido},
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