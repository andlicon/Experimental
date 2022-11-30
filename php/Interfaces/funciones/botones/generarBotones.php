<?php
    include_once(DAO_PATH.'/BaseDeDatos.php');
    include_once(DAO_PATH.'/TipoPersonaConsul.php');

    function generarBotones($id) {
        try {
            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
            $tipoPersonaConsul = new TipoPersonaConsul($bd); 
            
            $resultados = $tipoPersonaConsul->getInstancia(array($id));
            $tipoPersona = $resultados[0];
            $permiso = $tipoPersona->getPermiso();

            $botones = "";
            $botones = $botones.crearBoton("inicio", "Inicio");
            $botones = $botones.crearBoton("gestionar-usuario", "Usuario");
            if($permiso==2) {       //PROFESOR
                $botones = $botones.crearBoton("gestionar-clase", "Clase");
            }
            else if($permiso==3) {  //PROFESOR Y REPRESENTANTE
                $botones = $botones.crearBoton("gestionar-clase", "Clase");
                $botones = $botones.crearBoton("gestionar-pago", "Pagos");
                $botones = $botones.crearBoton("gestionar-deuda", "Deudas");
                $botones = $botones.crearBoton("gestionar-estudiante", "Estudiante");
            }
            else if($permiso==4) {  //ADMINISTRADOR
                $botones = $botones.crearBoton("gestionar-clase", "Clase");
                $botones = $botones.crearBoton("gestionar-persona", "Personas");
                $botones = $botones.crearBoton("gestionar-pago", "Pagos");
                $botones = $botones.crearBoton("gestionar-deuda", "Deudas");
                $botones = $botones.crearBoton("gestionar-estudiante", "Estudiante");
                $botones = $botones.crearBoton("gestionar-profesor", "Profesor");
            }
            else {                  //REPRESENTANTE
                $botones = $botones.crearBoton("gestionar-pago", "Pagos");
                $botones = $botones.crearBoton("gestionar-deuda", "Deudas");
                $botones = $botones.crearBoton("gestionar-estudiante", "Estudiante");
            }
            $botones = $botones.crearBoton("salir", "Salir");

            echo $botones;
        }
        catch(Exception $e) {
            echo $e;
        }
    }

    function crearBoton($name, $texto){
    echo 
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
?>