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
            if($permiso==2) {       //administrador PROFESOR
                $botones = $botones."<button name=\"gestionar-clase\" class=\"boton\">Gestionar clase</button>";
                $botones = $botones."<button name=\"gestionar-contacto\" class=\"boton\">Gestionar contacto</button>";
                $botones = $botones."<button name=\"gestionar-usuario\" class=\"boton\">Gestionar usuario</button>";
                $botones = $botones."<button name=\"salir\" class=\"boton\">Salir</button>";
            }
            else if($permiso==3) {
                $botones = $botones."<button name=\"gestionar-usuario\" class=\"boton\">Gestionar usuario</button>";
                $botones = $botones."<button name=\"salir\" class=\"boton\">Salir</button>";
            }
            else if($permiso==4) {  //administrador
                $botones = $botones."<button name=\"gestionar-persona\" class=\"boton\">Gestionar persona</button>";
                $botones = $botones."<button name=\"gestionar-contacto\" class=\"boton\">Gestionar contacto</button>";
                $botones = $botones."<button name=\"gestionar-pago\" class=\"boton\">Gestionar pago</button>";
                $botones = $botones."<button name=\"gestionar-deuda\" class=\"boton\">Gestionar deuda</button>";
                $botones = $botones."<button name=\"gestionar-estudiante\" class=\"boton\">Gestionar estudiante</button>";
                $botones = $botones."<button name=\"gestionar-profesor\" class=\"boton\">Gestionar profesor</button>";
                $botones = $botones."<button name=\"gestionar-usuario\" class=\"boton\">Gestionar usuario</button>";
                $botones = $botones."<button name=\"salir\" class=\"boton\">Salir</button>";
            }
            else {                  //representante         HACERLOS TODOS ASÍ
                $botones = $botones.crearBoton("inicio", "Inicio");
                $botones = $botones.crearBoton("gestionar-contacto", "Usuario");
                $botones = $botones.crearBoton("gestionar-pago", "Pagos");
                $botones = $botones.crearBoton("gestionar-deuda", "Deudas");
                $botones = $botones.crearBoton("gestionar-estudiante", "Estudiante");
                $botones = $botones.crearBoton("gestionar-salir", "Salir");
            }

            echo $botones;
        }
        catch(Exception $e) {
            echo $e;
        }
    }

    function crearBoton($name, $texto){
    echo 
        '<button class="boton" name="'.$name.'">
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