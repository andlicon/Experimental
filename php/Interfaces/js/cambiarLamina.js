function cambiarVisibilidiad(idMostrar) {
    // elementoOcultar = document.getElementById(idOcultar);
    // elementoMostrar = document.getElementById(idMostrar);
    
    // elementoOcultar.classList.add("display--oculto");
    // elementoMostrar.classList.remove("display--oculto");

    let laminas = $('.visibilidad');

    for(let i=0; i<laminas.length; i++) {
        laminas[i].classList.add("display--oculto");
    }

    document.getElementById(idMostrar).classList.remove("display--oculto");
}