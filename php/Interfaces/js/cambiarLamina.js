function cambiarVisibilidiad(idOcultar, idMostrar) {
    elementoOcultar = document.getElementById(idOcultar);
    elementoMostrar = document.getElementById(idMostrar);
    
    elementoOcultar.classList.add("display--oculto");
    elementoMostrar.classList.remove("display--oculto");
}