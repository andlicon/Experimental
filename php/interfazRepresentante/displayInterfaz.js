function displayInterfaz(indexVisible) {
    //obtiene a todos los elementos interfaces
    const interfaces = document.getElementsByClassName("interfaz");

    for(var i=0; i<interfaces.length; i++) {
        if(i != indexVisible) {
            interfaces[i].classList.remove("interfaz--visible");
            interfaces[i].classList.add("interfaz--invisible");
        }
        else {
            interfaces[i].classList.remove("interfaz--invisible");
            interfaces[i].classList.add("interfaz--visible");
        }
    }
}