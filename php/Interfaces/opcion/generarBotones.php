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
            if($permiso==2) {       //administrador
                $botones = $botones."<button name=\"gestionar-persona\" class=\"boton\">Gestionar persona</button>";
                $botones = $botones."<button name=\"gestionar-contacto\" class=\"boton\">Gestionar contacto</button>";
                $botones = $botones."<button name=\"gestionar-pago\" class=\"boton\">Gestionar pago</button>";
                $botones = $botones."<button name=\"gestionar-deuda\" class=\"boton\">Gestionar deuda</button>";
                $botones = $botones."<button name=\"gestionar-estudiante\" class=\"boton\">Gestionar estudiante</button>";
                $botones = $botones."<button name=\"gestionar-profesor\" class=\"boton\">Gestionar profesor</button>";
                $botones = $botones."<button name=\"salir\" class=\"boton\">Salir</button>";
            }
            else if($permiso==3) {  //director
                $botones = $botones."<button name=\"gestionar-persona\" class=\"boton\">Gestionar persona</button>";
                $botones = $botones."<button name=\"gestionar-contacto\" class=\"boton\">Gestionar contacto</button>";
                $botones = $botones."<button name=\"gestionar-pago\" class=\"boton\">Gestionar pago</button>";
                $botones = $botones."<button name=\"gestionar-deuda\" class=\"boton\">Gestionar deuda</button>";
                $botones = $botones."<button name=\"gestionar-estudiante\" class=\"boton\">Gestionar estudiante</button>";
                $botones = $botones."<button name=\"gestionar-profesor\" class=\"boton\">Gestionar profesor</button>";
                $botones = $botones."<button name=\"salir\" class=\"boton\">Salir</button>";
            }
            else {                  //profesor
                $botones = $botones."<button name=\"gestionar-clase\" class=\"boton\">Gestionar clase</button>";
                $botones = $botones."<button name=\"salir\" class=\"boton\">Salir</button>";
            }

            echo $botones;
        }
        catch(Exception $e) {
            echo $e;
        }
    }
?>