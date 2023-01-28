/*
* Verifica que las columnas que son de tipo UNIQUE en la bd no se repitan, y de repetirse
* que sean pertenecientes a este usuario
*/
function validarPerfil() {
    let usuario = JSON.parse(localStorage.getItem('usuario'));
    let cedula = usuario.cedula;
    var correo = $('#correo-input').val();
    var telefono = $('#telefono-input').val();
    var nickname = $('#nickname-input').val();

    $.ajax ( {
        url : 'php/isDatosRepetidos.php',
        type : 'POST',
        data : {cedula: cedula, correo: correo, telefono: telefono, 
            nickname: nickname},
        success : function(response) {
            alert(response);
        }
    });

    //Hacer consulta a la bd de datos para
        //verificar correo
        //verificar telefono
        //verififcar nickname
}