$(function() {
    setTimeout(() => {
        $('#fechaConsul').change(function(){
            let fecha = $("#fechaConsul").val();

            $.ajax ( {
                url : 'tablaDeficitDetalle.php',
                type : 'POST',
                data : {fecha: fecha},
                success : function(response) {
                    $('#deficitDetallado').html(response);
                }
            })
        });
    }, 300);
});

$(function() {
    setTimeout(() => {
         let fecha = $("#fechaConsul").val();

            $.ajax ( {
                url : 'tablaDeficitDetalle.php',
                type : 'POST',
                data : {fecha: fecha},
                success : function(response) {
                    $('#deficitDetallado').html(response);
                }
            })
    }, 400);
});