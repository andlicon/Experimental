$(window).on('pageshow', function() {
    setTimeout(() => {
        let pagina = window.location.pathname;
        let usuario = JSON.parse(localStorage.getItem('usuario'));
        let cedula = usuario.cedula;
        let permiso = usuario.permiso;
        let clase = $('#claseInput').val();
        let representante = (permiso==4 || permiso==5) ? $('#representanteInput').val() : null;
        let validez = (permiso==4 || permiso==5) ? $('#validezInput').val() : null;

        $.ajax ( {
                url : '../../accion/consultar/Consultar.php',
            type : 'POST',
            data : {pagina: pagina, cedula: cedula, permiso: permiso, 
                validez: validez, representante: representante, clase: clase},
            success : function(response) {
                var renglones = response.split('TERMINAACA');
                var html = "";
    
                for(var i=0; i<renglones.length; i++) {
                        html += "<tr>"+renglones[i]+"</tr>";
                }
    
                $('tbody').html(html);
            }
        })
    }, 300);
});

$(function() {
    setTimeout(() => {
        $('.consultor').change(function(){
            let pagina = window.location.pathname;
            let usuario = JSON.parse(localStorage.getItem('usuario'));
            let cedula = usuario.cedula;
            let permiso = usuario.permiso;
            let clase = $('#claseInput').val();
            let representante = (permiso==4 || permiso==5) ? $('#representanteInput').val() : null;
            let validez = (permiso==4 || permiso==5) ? $('#validezInput').val() : null;
            
            $.ajax ( {
                    url : '../../accion/consultar/Consultar.php',
                type : 'POST',
                data : {pagina: pagina, cedula: cedula, permiso: permiso, 
                    validez: validez, representante: representante, clase: clase},
                    success : function(response) {
                        var renglones = response.split('TERMINAACA');
                        var html = "";
        
                        for(var i=0; i<renglones.length; i++) {
                                html += "<tr>"+renglones[i]+"</tr>";
                        }
        
                        $('tbody').html(html);
                }
            })
        });
    }, 300);
});