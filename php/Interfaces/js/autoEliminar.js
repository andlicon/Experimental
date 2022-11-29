function autoEliminar($id) {
    elementoOcultar = document.getElementById("mensaje");
    elementoOcultar.classList.add("display--oculto");
}
setTimeout(autoEliminar, 3000, "mensaje")