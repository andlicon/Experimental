$(function(){
        setTimeout(() => {
                let pagina = window.location.pathname;
                let usuario = JSON.parse(localStorage.getItem('usuario'));
                let permiso = usuario.permiso
                let cedula = null;
                let infoAdd = null;
                let fecha = $('fechaConsul').val();

                if(permiso==4) {
                        cedula = $('#representanteInput').val();
                        infoAdd = $('#tipoDeudaInput').val();
                } 
                else {
                        cedula = usuario.cedula;
                        infoAdd = $('#estudianteInput').val();
                }
                        
                $.ajax ( {
                        url : '../../accion/consultar/Consultar.php',
                        type : 'POST',
                        data : {pagina: pagina, cedula: cedula, permiso: permiso, infoAdd: infoAdd, fecha: fecha},
                        async: false,
                        success : function(response) {
                                var renglones = response.split('TERMINAACA');
                        
                                let htmlContenido = "";
                                let deudaTotal = "";
                        
                                if(renglones.length > 1 ) {
                                            var html = "";
                                
                                        for(var i=0; i<renglones.length-1; i++) {
                                                html += "<tr>"+renglones[i]+"</tr>";
                                        }
                            
                                        htmlContenido = html;
                                        deudaTotal = renglones[renglones.length-1];
                                }
                            
                                $('tbody').html(htmlContenido);
                                $('.deuda__span').html(deudaTotal);
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
                        let cedula = null;
                        let infoAdd = null;
                        let fecha = $('fechaConsul').val();

                        if(permiso==4) {
                                cedula = $('#representanteInput').val();
                                infoAdd = $('#tipoDeudaInput').val();
                        } 
                        else {
                                cedula = usuario.cedula;
                                infoAdd = $('#estudianteInput').val();
                        }
                $.ajax ( {
                        url : '../../accion/consultar/Consultar.php',
                        type : 'POST',
                        data : {pagina: pagina, cedula: cedula, permiso: permiso, infoAdd: infoAdd, fecha: fecha},
                        async: false,
                        success : function(response) {
                                var renglones = response.split('TERMINAACA');
    
                                let htmlContenido = "";
                                let deudaTotal = "";
                                
                                if(renglones.length > 1 ) {
                                        var html = "";
                                
                                        for(var i=0; i<renglones.length-1; i++) {
                                                html += "<tr>"+renglones[i]+"</tr>";
                                        }
                                    
                                        htmlContenido = html;
                                        deudaTotal = renglones[renglones.length-1];
                                }

                                $('tbody').html(htmlContenido);
                                $('.deuda__span').html(deudaTotal);
                        }
                })
            });
        }, 300);
    });