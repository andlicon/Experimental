function limitadorAlfabetico(maximo, id) {
    var html = $(id);

    if(html.value().length<maximo) {
        html.val('');
    }
}