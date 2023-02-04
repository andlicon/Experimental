$(function() {
    $('#masEstudiantes').click(function() {
        //Crear los divs
        const div_principal = D.create('div');
        const div_nombre = D.create('div');
        const div_apellido = D.create('div');
        const div_lugar_nacimiento = D.create('div');
        const div_fecha_nacimiento = D.create('div')

        //Crear los span
        const span_nombre = D.create('span');
        span_nombre.innerHTML = 'nombre';
        const span_apellido = D.create('span');
        span_apellido.innerHTML = 'apellido';
        const span_lugar_nacimiento = D.create('span');
        span_lugar_nacimiento.innerHTML = 'Lugar Nacimiento';
        const span_fecha_nacimiento = D.create('span');
        span_fecha_nacimiento.innerHTML = 'Fecha Nacimiento';
        
        //crear titulo
        const titulo_estudiante = D.create('h3');
        titulo_estudiante.innerHTML = 'Info Estudiante';

        //boton eliminar 
        const borrar = D.create('a', 
                                {href:'javascript:void(0)',
                                innerHTML: 'x',
                                onclick: function() { D.remove(div_principal) }
                                });

        //crear los inputs
        const input_nombre = D.create('input', {
                                            type: 'text',
                                            name: 'nombreEstudiante',
                                            autocomplete: 'off',
                                            placeholder: 'Nombre estudiante',
                                            id: 'nombreInputEstudiante[]'});
        const input_apellido = D.create('input', {
                                            type: 'text',
                                            name: 'apellidoEstudiante',
                                            autocomplete: 'off',
                                            placeholder: 'Apellido estudiante',
                                            id: 'apelliidoInputEstudiante[]'});
        const input_lugar_nacimiento = D.create('input', {
                                            type: 'text',
                                            name: 'lugarNacimientoEstudiante',
                                            id: 'lugarNacimientoInputEstudiante[]'});
        const input_fecha_nacimiento = D.create('input', {
                                        type: 'date',
                                        name: 'fechaNacimientoEstudiante',
                                        id: 'fechaNacimientoInputEstudiante[]'});

        //Añadiendo a divs
        D.append([span_nombre, input_nombre], div_nombre);
        D.append([span_apellido, input_apellido], div_apellido)
        D.append([span_lugar_nacimiento, input_lugar_nacimiento], div_lugar_nacimiento)
        D.append([span_fecha_nacimiento, input_fecha_nacimiento], div_fecha_nacimiento)
        D.append([borrar, titulo_estudiante, div_nombre, div_apellido, div_lugar_nacimiento, div_fecha_nacimiento], div_principal);

        D.append(div_principal, D.id('estudiantes'));
        console.log(div_principal);
    });
});