function soloAlfaNumerico(max, id){
    return soloNumeros(max, id) || soloAlfabeto(max, id); 
}

// || event.charCode==44 || event.charCode==47 || event.charCode==46