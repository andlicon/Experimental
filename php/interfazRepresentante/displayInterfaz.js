function displayInterfaz(indexVisible) {
    //obtiene a todos los elementos interfaces
    const interfaces = document.getElementsByClassName("interfaz");

    //ESTA ES UNA ACCIÓN QUE HARÁN TODOS LOS BOTONES DE TODAS LAS INTERFAZ, ASÍ QUE DESPUÉS DEBE SER MOVIDO A GENERAL.

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