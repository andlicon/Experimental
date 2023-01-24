$(function(){
        setTimeout(() => {
                let pagina = window.location.pathname;
                let usuario = JSON.parse(localStorage.getItem('usuario'));
                let permiso = usuario.permiso
                let cedula = usuario.cedula;
                let infoAdd = $('#tipoUsuarioInput').val();
                let tipoPersona = $('#tipoPersonaInput').val();

                $.ajax ( {
                    url : '../../accion/consultar/Consultar.php',
                    type : 'POST',
                    data : {pagina: pagina, cedula: cedula, permiso: permiso, 
                            infoAdd: infoAdd, tipoPersona: tipoPersona},
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
        }, 300);
});


$(function() {
    setTimeout(() => {
            $('.consultor').change(function(){
                let pagina = window.location.pathname;
                let usuario = JSON.parse(localStorage.getItem('usuario'));
                let permiso = usuario.permiso
                let cedula = usuario.cedula;
                let infoAdd = $('#tipoUsuarioInput').val();
                let tipoPersona = $('#tipoPersonaInput').val();

                $.ajax ( {
                    url : '../../accion/consultar/Consultar.php',
                    type : 'POST',
                    data : {pagina: pagina, cedula: cedula, permiso: permiso, infoAdd: infoAdd, tipoPersona: tipoPersona},
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
    }, 300);
});