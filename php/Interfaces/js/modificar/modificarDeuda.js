$(document).on('click', '.aceptar', function(){
    //datos
    var id = $(this).val();
    var motivo = $('#motivoInput'+id).val();
    var fecha = $('#fechaInput'+id).val();
    var descripcion = $('#descripcionInput'+id).val();
    var montoInicial = $('#montoInicialInput'+id).val();

    let usuario = JSON.parse(localStorage.getItem('usuario'));
    let permiso = usuario.permiso;

    if(permiso==4) {
        $.ajax ( {
            url : '../../accion/modificar/ModificarDeuda.php',
            type : 'POST',
            data : {id: id, motivo: motivo, fecha: fecha, 
                descripcion: descripcion, montoInicial: montoInicial},
            success : function(response) {
                alert(response);
                if(response) {
                    alert("Se ha modificado la deuda con éxito.");
                }
                else {
                    alert("No se ha podido modificar la deuda.");
                }

                location.reload();
            }
        });
    }
    
    //Ocultar modificables
    $('.cancelar'+id).addClass("ocultar");
    $('.aceptar'+id).addClass("ocultar");
    $('.modificable'+id).prop('disabled', true);
    $('.modificable'+id).addClass('ocultar');
    $('.modificable--estado'+id).removeClass('ocultar');
});