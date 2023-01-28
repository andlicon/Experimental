$(function() {
    var reestablecer = reestablecerPerfil();

    $(document).on('click', '.boton[id*="reestablecer"]', function(){
        var reestablecer = reestablecerPerfil();
    });

});

//AÑadir que cuando se presione al boton reestablecer tambiémn se llame esa función