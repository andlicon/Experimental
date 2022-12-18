$(document).on('click', '.habilitarModif', function(){
    var id = $(this).val();
    $('.cancelar'+id).removeClass("ocultar");
    $('.aceptar'+id).removeClass("ocultar");
    //ACA METERÉ EL HABILITAR LOS INPUTS QUE SERÁN LOS MODIFICADORES
});