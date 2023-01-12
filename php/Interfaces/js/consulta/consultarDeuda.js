$(document).on('click', '#consultar', function(){
    let pagina = window.location.pathname;
    let usuario = JSON.parse(localStorage.getItem('usuario'));
    let cedula = usuario.cedula;
    let texto = $(this).val();
    let infoAdd = $('#consultar+label+select').val();

    $.ajax ( {
            url : '../../accion/consultar/Consultar.php',
            type : 'POST',
            data : {pagina: pagina, cedula: cedula, texto: texto, infoAdd: infoAdd},
            async: false,
            success : function(response) {
                    var renglones = response.split('TERMINAACA');
                    var html = "";

                    for(var i=0; i<renglones.length-1; i++) {
                            html += "<tr>"+renglones[i]+"</tr>";
                    }

                    $('tbody').html(html);
                    console.log(renglones[renglones.length-1]);
                    $('.deuda__span').html(renglones[renglones.length-1]);
            }
    })
});