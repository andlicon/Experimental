function soloAlfabeto(max, id){
    max = max <=0 ? Number.MAX_SAFE_INTEGER : max;


    if(id!=null && ($('#'+id).val().length>=max || event.charCode==43)) {
        return false;
    }

    const pattern = new RegExp('/[A-Z]|[a-z]|[áéíóú]|[ÁÉÍÓÚ]|[ñÑ]/', 'i');
    let letra = String.fromCharCode(event.charCode);
    let match = letra.match(pattern);

    return match!=null || event.charCode==32;
}