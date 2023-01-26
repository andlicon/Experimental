$(window).on('pageshow', function() {
    setTimeout(() => {
        let pagina = window.location.pathname;
        let usuario = JSON.parse(localStorage.getItem('usuario'));
        let cedula = usuario.cedula;
        let permiso = usuario.permiso;
        let validez = $('#validezPagoInput').val();
        let representante = $('#representanteInput').val();
        let fecha = $('#fechaConsul').val();
    
        $.ajax ( {
                url : '../../accion/consultar/Consultar.php',
            type : 'POST',
            data : {pagina: pagina, cedula: cedula, permiso: permiso, 
                validez: validez, representante: representante, fecha: fecha},
            success : function(response) {
                alert(response);
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
            let validez = $('#validezPagoInput').val();
            let representante = $('#representanteInput').val();
            let fecha = $('#fechaConsul').val();
        
            $.ajax ( {
                url : '../../accion/consultar/Consultar.php',
                type : 'POST',
                data : {pagina: pagina, cedula: cedula, permiso: permiso, 
                    validez: validez, representante: representante, fecha: fecha},
                success : function(response) {
                            alert(response);
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