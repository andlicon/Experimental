<?php
    include_once(GENERADOR_PATH.'boton/GeneradorBoton.php');

    final class GeneradorBotonMenu extends GeneradorBoton {

        public function __construct($idTipoPermiso) {
            parent::__construct($idTipoPermiso);
        }

        public function generarItems() {
            $permiso = parent::getPermiso();
            $botones = "";
            $botones = $botones.$this->crearItem("inicio", "Inicio");
            if($permiso==2) {       //PROFESOR
                $botones = $botones.$this->crearItem("gestionar-clase", "Clase");
            }
            else if($permiso==3) {  //PROFESOR Y REPRESENTANTE
                $botones = $botones.$this->crearItem("gestionar-clase", "Clase");
                $botones = $botones.$this->crearItem("gestionar-pago", "Pagos");
                $botones = $botones.$this->crearItem("gestionar-deuda", "Deudas");
                $botones = $botones.$this->crearItem("gestionar-estudiante", "Estudiante");
                $botones = $botones.$this->crearItem("gestionar-estado", "Estado");
            }
            else if($permiso==4) {  //ADMINISTRADOR
                $botones = $botones.$this->crearItem("gestionar-usuarios", "Usuarios");
                $botones = $botones.$this->crearItem("gestionar-pago", "Pagos");
                $botones = $botones.$this->crearItem("gestionar-deuda", "Deudas");
                $botones = $botones.$this->crearItem("gestionar-estudiante", "Estudiante");
                $botones = $botones.$this->crearItem("gestionar-profesor", "Profesor");
            }
            else {                  //REPRESENTANTE
                $botones = $botones.$this->crearItem("gestionar-estado", "Estado");
                $botones = $botones.$this->crearItem("gestionar-deuda", "Deudas");
                $botones = $botones.$this->crearItem("gestionar-pago", "Pagos");
                $botones = $botones.$this->crearItem("gestionar-estudiante", "Estudiante");
            }
            $botones = $botones.$this->crearItem("gestionar-perfil", "Perfil");
            $botones = $botones.$this->crearItem("salir", "Salir");

            echo $botones;
        }

        protected function crearItem($name, $texto){
            return 
                '<button class="boton boton--menu" name="'.$name.'">
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