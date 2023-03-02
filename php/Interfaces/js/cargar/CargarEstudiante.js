$(document).on('click', '.boton[id*="cargar"]', function(){
    //datos
    var nombre = $('#nombreInput').val();
    var apellido = $('#apellidoInput').val();
    var fecha = $('#fechaInput').val();
    var clase = $('#claseInput').val();
    var lugarNacimiento = $('#lugarInput').val();

    var pagina = window.location.pathname;

    var usuario = JSON.parse(localStorage.getItem('usuario'));
    var cedula = usuario.cedula;

    //Enviar la informacion a php
        $.ajax ( {
            url : '../../accion/cargar/CargarJs.php',
            type : 'POST',
            data : {nombre: nombre, apellido: apellido, fecha: fecha, 
                clase: clase, cedula: cedula, pagina: pagina, lugarNacimiento: lugarNacimiento},
            success : function(response) {
                alert(response);
                location.reload();
            }
        });
    
});