$(document).on('click', '.habilitarModif', function(){
    var id = $(this).val();
    $('.cancelar'+id).removeClass("ocultar");
    $('.aceptar'+id).removeClass("ocultar");
    $('.modificable'+id).prop('disabled', false);
    $('.modificable'+id).removeClass('ocultar');
    $('.modificable--estado'+id).addClass('ocultar');
});