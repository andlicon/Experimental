function soloNumeros(max, id){
    if($('#'+id).val().length>=max) {
        return false;
    }

   return (event.charCode >= 48 && event.charCode <= 57);
}