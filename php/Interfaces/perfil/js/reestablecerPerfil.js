function reestablecerPerfil() {
    let pagina = window.location.pathname;
    let usuario = JSON.parse(localStorage.getItem('usuario'));
    let cedula = usuario.cedula;
    let permiso = 0;

    //Consulta a la bd para recibir los valores que están cargados en la base de dato
    $.ajax ( {
        url : '../../accion/consultar/Consultar.php',
        type : 'POST',
        data : {pagina: pagina, cedula: cedula, permiso: permiso},
        success : function(response) {
            let info = JSON.parse(response);

            $('#nombre-input').val(info.nombre);
            $('#apellido-input').val(info.apellido);
            $('#correo-input').val(info.correo);
            $('#telefono-input').val(info.telefono);
            $('#nickname-input').val(info.nickname);
            $('#contrasena1-input').val("");
            $('#contrasena2-input').val("");
        }
    });
}