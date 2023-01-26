$(function() {
    setTimeout(() => {
        $('#fechaConsul').change(function(){
            let fecha = $("#fechaConsul").val();

            $.ajax ( {
                url : 'tablaDeficit.php',
                type : 'POST',
                data : {fecha: fecha},
                success : function(response) {
                    $('#deficit').html(response);
                }
            })
        });
    }, 300);
});

$(function() {
    setTimeout(() => {
         let fecha = $("#fechaConsul").val();

            $.ajax ( {
                url : 'tablaDeficit.php',
                type : 'POST',
                data : {fecha: fecha},
                success : function(response) {
                    $('#deficit').html(response);
                }
            })
    }, 400);
});