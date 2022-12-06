function soloTelefono(e){
    var key = e.charCode;
    return (key >= 48 && key <= 57) || key==45;
}