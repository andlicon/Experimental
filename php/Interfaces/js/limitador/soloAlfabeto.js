function soloAlfabeto(max, id){
    max = max <=0 ? Number.MAX_SAFE_INTEGER : max;

    if($('#'+id).val().length>=max) {
        return false;
    }

    let regex = '/[ABCDEFGHIJKLMNOPQRSTUVWXYZ]|[abcdefghijklmnopqrstuvwxyz|[áéíóú]|[ÁÉÍÓÚ]|[ñÑ]/';
    let letra = String.fromCharCode(event.charCode);
    let match = regex.match(letra);

    return match!=null;
}