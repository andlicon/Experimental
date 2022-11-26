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
            else {                  //representante
                $botones = $botones."<button name=\"gestionar-contacto\" class=\"boton boton--separacion\">Usuario</button>";
                $botones = $botones."<button name=\"gestionar-pago\" class=\"boton boton--separacion\">Pagos</button>";
                $botones = $botones."<button name=\"gestionar-deuda\" class=\"boton boton--separacion\">Deudas</button>";
                $botones = $botones."<button name=\"gestionar-estudiante\" class=\"boton boton--separacion\">Estudiantes</button>";
                $botones = $botones."<button name=\"salir\" class=\"boton boton--separacion\">Salir</button>";
            }

            echo $botones;
        }
        catch(Exception $e) {
            echo $e;
        }
    }
?>