const DOM = function () {
    this.id = str=>document.getElementById(str);
    this.query = (regla_css, one=false)=> one === true ? 
                                    ocument.querySelector(query) : 
                                    document.querySelectorAll(regla_css);
    this.create = (str, props={})=> {
            const etiqueta = document.createElement(str);
            Object.assign(etiqueta, props);
            return etiqueta;
        }
    this.append = (hijos, padre=document.body) => {
        if(hijos.length) {
            for(let hijo of hijos) padre.appendChild(hijo);
        }
        else {
            padre.appendChild(hijos);
        }
    }
    this.remove = e => e.remove();
}

const D = new DOM();