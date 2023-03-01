<?php
    include_once('../../accion/rutaAcciones.php');
    include_once(DAO_PATH.'BaseDeDatos.php');
    include_once(DAO_PATH.'PersonaDAO.php');
    include_once(DAO_PATH.'ContactoDAO.php');

    if(isset($_POST['cedula']) && isset($_POST['nickname'])) {
        $cedula = $_POST['cedula'];
        $nickname = $_POST['nickname'];

        //Obteniendo datos de la tabla persona
        $personaDAO = new PersonaDAO(BaseDeDatos::getInstancia());
        $resultado = $personaDAO->getInstancia(array($cedula));
        $nombre = $resultado[0]->getNombre();
        $apellido = $resultado[0]->getApellido();

        //Obteniendo datos de contacto
        try {
            $contactoDAO = new ContactoDAO(BaseDeDatos::getInstancia());
            $resultado = $contactoDAO->getInstanciaCedula(array($cedula));
            $correo = $resultado[0]->getContacto();
            $telefono = count($resultado)>1 ? $resultado[1]->getContacto() : "";
        }
        catch(Exception $e) {
            $correo = "No asignado";
            $telefono = "No asignado";
        }

        echo "
            <div class=\"tabla div--seleccionado padding\">
                <h2 class=\"tabla__titulo titulo--bienvenida formu--titulo\">Cuenta virtual</h2>
                <table class=\"tabla__table tabla-bonita\">
                    <tr class=\"tabla__tr\">
                        <td class=\"tabla__td tabla__th\">Cedula</td>
                        <td class=\"tabla__td tabla__th\">Nombre</td>
                        <td class=\"tabla__td tabla__th\">Apellido</td>
                    </tr>
                    <tr class=\"tabla__tr\">
                        <td class=\"tabla__td\">$cedula</td>
                        <td class=\"tabla__td\">$nombre</td>
                        <td class=\"tabla__td\">$apellido</td>
                    </tr>
                    <tr class=\"tabla__tr\">
                        <td class=\"tabla__td tabla__th\">Usuario</td>
                        <td class=\"tabla__td tabla__th\">Correo</td>
                        <td class=\"tabla__td tabla__th\">Telefono</td>
                    </tr>
                    <tr class=\"tabla__tr\">
                        <td class=\"tabla__td\">$nickname</td>
                        <td class=\"tabla__td\">$correo</td>
                        <td class=\"tabla__td\">$telefono</td>
                    </tr>
                </table>
            </div>";
    }
?>