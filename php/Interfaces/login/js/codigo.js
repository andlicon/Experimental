$(function() {
    $('#masEstudiantes').click(function() {
        //Crear los divs
        const div_principal = D.create('div');
        div_principal.classList.add('datos-estudiante');
        div_principal.classList.add('bloque');
        div_principal.classList.add('centrado');
        div_principal.classList.add('subBloquecito');
        div_principal.classList.add('bloque--sub');
        div_principal.classList.add('bloqueEstudiante');

        const div_nombre = D.create('div');
        const div_apellido = D.create('div');
        const div_lugar_nacimiento = D.create('div');
        const div_fecha_nacimiento = D.create('div');

        //Crear los span
        const span_nombre = D.create('span', {innerHTML: 'Nombre'});
        const span_apellido = D.create('span', {innerHTML: 'Apellido'});
        const span_lugar_nacimiento = D.create('span', {innerHTML: 'Lugar nacimiento'});
        span_lugar_nacimiento.classList.add('input__label');
        const span_fecha_nacimiento = D.create('span', {innerHTML: 'Fecha nacimiento'});
        
        //crear titulo
        const titulo_estudiante = D.create('h3');
        titulo_estudiante.innerHTML = 'Datos del estudiante adicional';
        titulo_estudiante.classList.add('titulito');
        titulo_estudiante.classList.add('contenido__titulo');
        titulo_estudiante.classList.add('subBloqueTitulito');

        //boton eliminar 
        const borrar = D.create('a', 
                               {href:'javascript:void(0)',
                               innerHTML: 'Eliminar estudiante adicional',
                               onclick: function() { D.remove(div_principal) }
                               });
        borrar.classList.add('borrar');
        borrar.classList.add('contenido__titulo');
        borrar.classList.add('c');

        //crear los inputs
        const input_nombre = D.create('input', {
                                            type: 'text',
                                            name: 'nombreEstudiante',
                                            autocomplete: 'off',
                                            placeholder: 'Nombre estudiante adicional',
                                            id: 'nombreInputEstudiante[]'});
        input_nombre.classList.add('input__input');
        const input_apellido = D.create('input', {
                                            type: 'text',
                                            name: 'apellidoEstudiante',
                                            autocomplete: 'off',
                                            placeholder: 'Apellido estudiante adicional',
                                            id: 'apellidoInputEstudiante[]'});
       input_apellido.classList.add('input__input');
        const input_lugar_nacimiento = D.create('textarea', {
                                            name: 'lugarNacimientoEstudiante',
                                            id: 'lugarNacimientoInputEstudiante[]',
                                            placeholder: 'Lugar nacimiento estudiante adicional',});
        input_lugar_nacimiento.addEventListener("keypress", function()
        {
           return soloAlfaNumerico(50, null) 
        }, false);
        input_lugar_nacimiento.setAttribute('maxLength', 50);
        input_lugar_nacimiento.setAttribute('cols', 20);
        input_lugar_nacimiento.setAttribute('rows', 3);
        input_lugar_nacimiento.classList.add('textarea');
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

        D.append(div_principal, D.id('registro'));
    });
});