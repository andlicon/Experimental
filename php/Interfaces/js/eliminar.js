$(document).on('click', '.eliminar', function() {
        let id = $(this).val();
        let pagina = window.location.pathname;
        let usuario = JSON.parse(localStorage.getItem('usuario'));
        let cedula = usuario.cedula;

        let seguir = confirm("¿Seguro que desea eliminar el registro?\n");

        if(seguir) {
                $.ajax ( {
                        url : '../../accion/eliminar/Eliminar.php',
                        type : 'POST',
                        data : {id: id, pagina: pagina, cedula: cedula},
                        success : function(response) {
                                if(response) {
                                        alert('Se ha eliminado el registro con éxito!');
                                }
                                location.reload();
                        }
                })
        } 
});