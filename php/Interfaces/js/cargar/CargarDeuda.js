$(document).on('click', '.boton[id*="cargar"]', function(){
    //datos
    var estudiante = $('#estudianteInput').val();
    var motivo = $('#motivoInput').val();
    var descripcion = $('#descripcionInput').val();
    var fecha = $('#fechaInput').val();
    var monto = $('#montoInicialInput').val();
    var select = document.querySelector('select[id="estudianteInput"] option:checked').text;

    var pagina = window.location.pathname;


    //Enviar la informacion a php
    $.ajax ( {
        url : '../../accion/cargar/CargarJs.php',
        type : 'POST',
        data : {estudiante: estudiante, motivo: motivo, fecha: fecha, 
            descripcion: descripcion, monto: monto, select: select, 
            pagina: pagina},
        success : function(response) {
            alert(response);
            location.reload();
        }
    });
});