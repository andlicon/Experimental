$(document).on('click', '#consultar', function(){
    let pagina = window.location.pathname;
    let usuario = JSON.parse(localStorage.getItem('usuario'));
    let permiso = usuario.permiso
    let cedula = usuario.cedula;
    let infoAdd = $('#consultar+label+select').val();

    $.ajax ( {
            url : '../../accion/consultar/Consultar.php',
            type : 'POST',
            data : {pagina: pagina, cedula: cedula, permiso: permiso, infoAdd: infoAdd},
            async: false,
            success : function(response) {
                if(response.search("XXvacioXX") == -1) {
                        var renglones = response.split('TERMINAACA');
                        var html = "";

                        for(var i=0; i<renglones.length-1; i++) {
                                html += "<tr>"+renglones[i]+"</tr>";
                        }

                        $('tbody').html(html);
                        console.log(renglones[renglones.length-1]);
                        $('.deuda__span').html(renglones[renglones.length-1]);
                }
                else {
                        $('tbody').html("");
                }
            }
    })
});