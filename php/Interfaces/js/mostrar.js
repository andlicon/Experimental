function mostrar(item) {
    elementoOcultar = document.getElementById(item);
    elementoOcultar.classList.add("desplegable__item--mostrar");
}

boton = document.getElementById('desplegar'); 
boton.addEventListener('click', () => mostrar('item-desplegable'));