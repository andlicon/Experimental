function soloNumeros(max, id){
    max = max <=0 ? Number.MAX_SAFE_INTEGER : max;

    if($('#'+id).val().length>=max) {
        return false;
    }

   return (event.charCode >= 48 && event.charCode <= 57);
}