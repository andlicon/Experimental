function ocultar(item) {
    elementoOcultar = document.getElementById(item);
    elementoOcultar.classList.remove("desplegable__item--mostrar");
}

boton = document.getElementById('cerrar'); 
boton.addEventListener('click', () => ocultar('item-desplegable'));