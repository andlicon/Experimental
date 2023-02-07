function soloTelefono(e) {
    var respuesta = soloNumeros(12, e);

    if($('#'+e).val().length===4) {
        var contenido = $('#'+e).val();
        $('#'+e).val(contenido + '-');
    }

    return respuesta;
}