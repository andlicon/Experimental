$(function(){
        setTimeout(() => {
                let pagina = window.location.pathname;
                let usuario = JSON.parse(localStorage.getItem('usuario'));
                let permiso = usuario.permiso
                let cedula = permiso==4 ? $('#representanteInput').val() : usuario.cedula;
                let infoAdd = $('#consultar+label+select').val();
                        
                $.ajax ( {
                        url : '../../accion/consultar/Consultar.php',
                        type : 'POST',
                        data : {pagina: pagina, cedula: cedula, permiso: permiso, infoAdd: infoAdd},
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

$(document).change(function(){
        let pagina = window.location.pathname;
        let usuario = JSON.parse(localStorage.getItem('usuario'));
        let permiso = usuario.permiso
        let cedula = permiso==4 ? $('#representanteInput').val() : usuario.cedula;
        let infoAdd = $('#consultar+label+select').val();
    
        $.ajax ( {
                url : '../../accion/consultar/Consultar.php',
                type : 'POST',
                data : {pagina: pagina, cedula: cedula, permiso: permiso, infoAdd: infoAdd},
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