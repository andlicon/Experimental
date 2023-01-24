$(document).on('click', '.aceptar', function(){
    //datos
    var id = $(this).val();
    var nombre = $('#nombreInput'+id).val();
    var apellido = $('#apellidoInput'+id).val();
    var fecha = $('#fechaInput'+id).val();
    var clase = $('#claseInput'+id).val();
    var valido = $('#validoInput'+id).val();

    let usuario = JSON.parse(localStorage.getItem('usuario'));
    let permiso = usuario.permiso;

    alert(nombre + " " + apellido + " " + fecha + " " + clase + " " + valido);

    if(permiso==4) {
        $.ajax ( {
            url : '../../accion/modificar/ModificarEstudianteAdmin.php',
            type : 'POST',
            data : {id: id, nombre: nombre, apellido: apellido, 
                    fecha: fecha, clase: clase, valido: valido},
            success : function(response) {
                alert(response);
                if(response) {
                    alert("Se ha validado el pago con éxito");
                }
                else {
                    alert("No se ha podido validar el pago.");
                }

                location.reload();
            }
        });
    }
    else {
        valido = 0;
        
        $.ajax ( {
            url : '../../accion/modificar/ModificarPago.php',
            type : 'POST',
            data : {id: id, idDeuda: idDeuda, fecha: fecha, 
                    monto: monto, referencia: referencia, cuenta: cuenta,
                    tipoPago: tipoPago, valido: valido},
            success : function(response) {
                    if(response) {
                        alert("Se ha modficiado el registro con éxito");
                    }
                    else {
                        alert("No se ha podido modificar el registro");
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