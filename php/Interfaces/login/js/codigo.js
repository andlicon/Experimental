$(function() {
    $('#masEstudiantes').click(function() {
        //Crear los divs
        const div_principal = D.create('div');
        div_principal.classList.add('subBloque');
        div_principal.classList.add('datos-estudiante');
        div_principal.classList.add('bloque');
        div_principal.classList.add('centrado');
        div_principal.classList.add('subBloquecito');
        div_principal.classList.add('bloque--sub');
        div_principal.classList.add('bloqueEstudiante');

        const div_nombre = D.create('div');
        div_nombre.classList.add('formu');
        const div_apellido = D.create('div');
        div_apellido.classList.add('formu');
        const div_lugar_nacimiento = D.create('div');
        div_lugar_nacimiento.classList.add('formu');
        const div_fecha_nacimiento = D.create('div');
        div_fecha_nacimiento.classList.add('formu');

        //Crear los label
        const span_nombre = D.create('label', {innerHTML: 'Nombre'});
        const span_apellido = D.create('label', {innerHTML: 'Apellido'});
        const span_lugar_nacimiento = D.create('label', {innerHTML: 'Lugar nacimiento'});
        span_lugar_nacimiento.classList.add('input__label');
        const span_fecha_nacimiento = D.create('label', {innerHTML: 'Fecha nacimiento'});

        //span
        const span1 =  D.create('span');
        const span2 =  D.create('span');
        const span3 =  D.create('span');
        const span4 =  D.create('span');
        
        //crear titulo
        const titulo_estudiante = D.create('h4');
        titulo_estudiante.innerHTML = 'Datos del estudiante adicional';
        titulo_estudiante.classList.add('popOver__informacion');
        titulo_estudiante.classList.add('formu--titulo');
        titulo_estudiante.classList.add('corregir');

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
                                            id: 'nombreInputEstudiante[]'});
        input_nombre.setAttribute('maxLength', 15);
        input_nombre.addEventListener('keypress', function(e) {
            if(!soloAlfabeto(15, null)) {
                e.preventDefault();
            }
        }, false);
        input_nombre.classList.add('input__input');
        const input_apellido = D.create('input', {
                                            type: 'text',
                                            name: 'apellidoEstudiante',
                                            autocomplete: 'off',
                                            id: 'apellidoInputEstudiante[]'});
        input_apellido.setAttribute('maxLength', 15);
        input_apellido.addEventListener('keypress', function(e) {
            if(!soloAlfabeto(15, null)) {
                e.preventDefault();
            }
        }, false);
       input_apellido.classList.add('input__input');
        const input_lugar_nacimiento = D.create('textarea', {
                                            name: 'lugarNacimientoEstudiante',
                                            id: 'lugarNacimientoInputEstudiante[]'});
        input_lugar_nacimiento.addEventListener('keypress', function(e) {
            if(!soloAlfaNumerico(50, null)) {
                e.preventDefault();
            }
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
        D.append([input_nombre, span1, span_nombre], div_nombre);
        D.append([input_apellido, span2, span_apellido], div_apellido)
        D.append([input_lugar_nacimiento, span3, span_lugar_nacimiento ], div_lugar_nacimiento)
        D.append([input_fecha_nacimiento, span4, span_fecha_nacimiento], div_fecha_nacimiento)
        D.append([borrar, titulo_estudiante, div_nombre, div_apellido, div_lugar_nacimiento, div_fecha_nacimiento], div_principal);

        D.append(div_principal, D.id('registro'));
    });
});