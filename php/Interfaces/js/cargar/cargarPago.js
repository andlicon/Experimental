$(document).on('click', '.boton[id*="cargar"]', function(){
    //datos
    var idDeuda = $('#deudaInput').val();
    var fecha = $('#fechaInput').val();
    var monto = $('#montoInput').val();
    var cuenta = $('#cuentaInput').val();
    var tipoPago = $('#tipoPagoInput').val();
    var referencia = $('#referenciaInput').val();
    var pagina = window.location.pathname;
    var valido = $('#referenciaInput').val()==1 ? 1 : 0;

    var usuario = JSON.parse(localStorage.getItem('usuario'));
    var cedula = usuario.cedula;

    let seguir = confirm("Seguro que desea cargar el pago con los siguientes datos:\n" + 
            "Referencia deuda: D" + idDeuda + "\n" +
            "Fecha: " + fecha + "\n" +
            "Cuenta: " + cuenta + "\n" +
            "Tipo Pago: " + tipoPago + "\n" +
            "Referencia: " + referencia + "\n");

    //Enviar la informacion a php
    if(seguir) {
        $.ajax ( {
            url : '../../accion/cargar/CargarJs.php',
            type : 'POST',
            data : {idDeuda: idDeuda, fecha: fecha, cedula: cedula,
                    monto: monto, referencia: referencia, cuenta: cuenta,
                    tipoPago: tipoPago, valido: valido, pagina: pagina},
            success : function(response) {
                    alert(response);
    
                    location.reload();
            }
        });
    }
});