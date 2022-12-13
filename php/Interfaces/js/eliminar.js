$(".eliminar").click(function() {
        let id = $(this).attr("id");
        let pagina = window.location.pathname;

        $.ajax ( {
                url : '../../tabla/boton/eliminador/Eliminador.php',
                type : 'POST',
                data : {id: id, pagina: pagina},
                success : function(response) {
                        alert(response);
                }
        })
});