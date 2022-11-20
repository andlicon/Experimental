<?php
    include_once('../general/comprobarChecks.php');
    include_once('../general/Pagina.php');
    include_once('../Excepciones/SelectException.php');
    include_once('../formulario/Mensaje.php');

    if( isset($_POST['modificar']) ) {

        $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');

        try {
            $pagina = new Pagina(Pagina::PERSONA);

            $cedulas = comprobarChecks(false, $pagina);
            $cedula = $cedulas[0];

            $personaDAO = new PersonaDAO($bd);
    
            //Inputs del usuario
            $nombreInput = $_POST['nombreInput'];
            $apellidoInput = $_POST['apellidoInput'];
            
            //Comprobando que exista algun cambio comparado con la bd.
            //Solo se modificaran los atributos que sean distintos a la bd.
            //!ESTO SE PUEDE REALIZAR EN OTRA CLASE PARA CUMPLIR "SRP", DESPUES CORREGIR.
            $resultado = $personaDAO->getInstancia(array($cedula));
            $persona = $resultado[0];
            $nombre = $nombreInput=="" ? $persona->getNombre() : $nombreInput;
            $apellido = $apellidoInput=="" ? $persona->getApellido() : $apellidoInput;

            $personaDAO->modificar(array($nombre, $apellido, $cedula));
            $bd->guardarCambios();
            $pagina->imprimirMensaje(null, Mensaje::EXITO, "Se ha modificado a la persona exitosamente.");
        }
        catch(SelectException $e) {
            $e->imprimirError();
        }
        catch(PDOException $e) {
            $codigo = $e->getCode();

            if($codigo==23000) {
                $bd->revertirCambios();
                $pagina->imprimirMensaje(null, Mensaje::ERROR, "Existe alguna dependencia que impide modificar a la persona.");

                die();
            }
            
            echo $e;
        }
        catch(Exception $e) {
            echo $e;
        }

    }
?>