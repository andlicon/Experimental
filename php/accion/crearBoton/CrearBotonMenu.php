<?php
    include_once('CreadorBoton.php');

    class CrearBotonMenu extends CreadorBoton {

        public function __construct($permiso) {
            parent::__construct($permiso);
        }

        public function crearBotones() {
            $botones = "";
            $botones = $botones.$this->crearItem("inicio", "Inicio");
            if($this->permiso==2) {       //PROFESOR
                $botones = $botones.$this->crearItem("clase", "Clase");
            }
            else if($this->permiso==3) {  //PROFESOR Y REPRESENTANTE
                $botones = $botones.$this->crearItem("estado", "Estado");
                $botones = $botones.$this->crearItem("deuda", "Deudas");
                $botones = $botones.$this->crearItem("pago", "Pagos");
                $botones = $botones.$this->crearItem("estudiante", "Estudiantes");
                $botones = $botones.$this->crearItem("clase", "Clase");
            }
            else if($this->permiso==4) {  //ADMINISTRADOR
                $botones = $botones.$this->crearItem("ingresos", "Déficit");
                $botones = $botones.$this->crearItem("deuda", "Deudas");
                $botones = $botones.$this->crearItem("pago", "Pagos");
                $botones = $botones.$this->crearItem("gestionar-usuarios", "Representantes");
                // $botones = $botones.$this->crearItem("profesor", "Clases");
                $botones = $botones.$this->crearItem("estudiante", "Estudiantes");
                $botones = $botones.$this->crearItem("respaldo", "Respaldar info");
            }
            else if($this->permiso==5) { //administrador
                $botones = $botones.$this->crearItem("estudiante", "Estudiantes");
                $botones = $botones.$this->crearItem("gestionar-usuarios", "Representantes");
            }
            else {                  //REPRESENTANTE
                $botones = $botones.$this->crearItem("estado", "Estado");
                $botones = $botones.$this->crearItem("deuda", "Deudas");
                $botones = $botones.$this->crearItem("pago", "Pagos");
                $botones = $botones.$this->crearItem("estudiante", "Estudiantes");
            }
            $botones = $botones.$this->crearItem("perfil", "Perfil");
            $botones = $botones.$this->crearItem("salir", "Salir");

            return $botones;
        }

        protected function crearItem($name, $texto){
            return 
                '<button class="boton boton--menu" name="'.$name.'" id="'.$name.'">
                            <div class="boton__imagen">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8z"/>
                                </svg>
                            </div>
                            <span class="boton__span">'.
                                $texto
                            .'</span>
                </button>';
        }

    }
?>