function correo(max, id){
    max = max <=0 ? Number.MAX_SAFE_INTEGER : max;


    if(id!=null && ($('#'+id).val().length>=max || event.charCode==43)) {
        return false;
    }

    const pattern = new RegExp('/[A-Z]|[a-z]|[@]|[.\]/', 'i');
    let letra = String.fromCharCode(event.charCode);
    let match = letra.match(pattern);

    return match!=null || event.charCode==64 || event.charCode==46;
}