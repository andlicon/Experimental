$(function(){
            
    $.ajax ( {
            url : '../../accion/consultar/ConsultarTipoPersona.php',
            type : 'POST',
            data : {},
            datatype: "json",
            success : function(response) {
                let json = JSON.parse(response);
                let contenido = '<label for="tipoPersonaSelect" class="input__label">Tipo Persona</label>'+
                                '<select id="tipoPersonaSelect" name="tipoPersonaInput">';

                for(let i=0; i<json.length; i++) {
                    let id = json[i].id;
                    let descripcion = json[i].descripcion;

                    let opcion = '<option value="'+id+'">'+descripcion+'</option>';
                    contenido += opcion;
                }
                contenido += '</select>';
                
                $('#tipoPersonaInput').html(contenido);
            },

    })
});