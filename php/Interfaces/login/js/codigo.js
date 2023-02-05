$(function() {
    $('#masEstudiantes').click(function() {
        //Crear los divs
        const div_principal = D.create('div');
        const div_nombre = D.create('div');
        const div_apellido = D.create('div');
        const div_lugar_nacimiento = D.create('div');
        const div_fecha_nacimiento = D.create('div')

        //Crear los span
        const span_nombre = D.create('span', {innerHTML: 'nombre'});
        const span_apellido = D.create('span', {innerHTML: 'apellido'});
        const span_lugar_nacimiento = D.create('span', {innerHTML: 'Lugar nacimiento'});
        const span_fecha_nacimiento = D.create('span', {innerHTML: 'Fecha nacimiento'});
        
        //crear titulo
        const titulo_estudiante = D.create('h3');
        titulo_estudiante.innerHTML = 'Info Estudiante';

        //boton eliminar 
        const borrar = D.create('a', 
                               {href:'javascript:void(0)',
                               innerHTML: 'x',
                               onclick: function() { D.remove(div_principal) }
                               });
        borrar.classList.add('borrar');

        //crear los inputs
        const input_nombre = D.create('input', {
                                            type: 'text',
                                            name: 'nombreEstudiante',
                                            autocomplete: 'off',
                                            placeholder: 'Nombre estudiante',
                                            id: 'nombreInputEstudiante[]'});
        input_nombre.classList.add('input__input');
        const input_apellido = D.create('input', {
                                            type: 'text',
                                            name: 'apellidoEstudiante',
                                            autocomplete: 'off',
                                            placeholder: 'Apellido estudiante',
                                            id: 'apellidoInputEstudiante[]'});
       input_apellido.classList.add('input__input');
        const input_lugar_nacimiento = D.create('input', {
                                            type: 'text',
                                            name: 'lugarNacimientoEstudiante',
                                            id: 'lugarNacimientoInputEstudiante[]'});
        input_lugar_nacimiento.classList.add('input__input');
        const input_fecha_nacimiento = D.create('input', {
                                        type: 'date',
                                        name: 'fechaNacimientoEstudiante',
                                        id: 'fechaNacimientoInputEstudiante[]'});
        input_fecha_nacimiento.classList.add('input__input');

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