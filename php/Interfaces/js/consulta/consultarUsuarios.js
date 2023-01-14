$(document).on('click', '#consultar', function(){
        let pagina = window.location.pathname;
        let usuario = JSON.parse(localStorage.getItem('usuario'));
        let permiso = usuario.permiso
        let cedula = usuario.cedula;
        let infoAdd =  $('#tipoUsuarioInput').val();

    $.ajax ( {
            url : '../../accion/consultar/Consultar.php',
            type : 'POST',
            data : {pagina: pagina, cedula: cedula, permiso: permiso, infoAdd: infoAdd},
            async: false,
            success : function(response) {
                    var renglones = response.split('TERMINAACA');
                    var html = "";

                    for(var i=0; i<renglones.length-1; i++) {
                            html += "<tr>"+renglones[i]+"</tr>";
                    }

                    $('tbody').html(html);
            }
    })
});