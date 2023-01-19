$(function(){
    setTimeout(() => {
            let pagina = window.location.pathname;
            let usuario = JSON.parse(localStorage.getItem('usuario'));
            let permiso = usuario.permiso;
            let cedula = null;
                    
            $.ajax ( {
                    url : '../../accion/consultar/Consultar.php',
                    type : 'POST',
                    data : {pagina: pagina, permiso: permiso, cedula: cedula},
                    async: false,
                    success : function(response) {
                        alert(response);
                            var renglones = response.split('TERMINAACA');
                    
                            let htmlContenido = "";
                    
                            if(renglones.length > 1 ) {
                                    var html = "";
                            
                                    for(var i=0; i<renglones.length-1; i++) {
                                            html += "<tr>"+renglones[i]+"</tr>";
                                    }
                        
                                    htmlContenido = html;
                                    deudaTotal = renglones[renglones.length-1];
                            }
                        
                            $('tbody').html(htmlContenido);
                    }
            })
    }, 300);
});