<?php
    include_once(DAO_PATH.'BaseDeDatos.php');
    include_once(DAO_PATH.'PersonaDAO.php');
    include_once(DAO_PATH.'ContactoDAO.php');
    include_once(DAO_PATH.'UsuarioDAO.php');

    function tablaCuenta() {
        $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');

        $usuario = deserializarUsuario();
        $cedula = $usuario->getCedula();

                            //C O N S U L T A S
        //informacion de persona
        $personaDAO = new PersonaDAO($bd);
        $resultado = $personaDAO->getInstancia(array($cedula));
        $nombre = $resultado[0]->getNombre();
        $apellido = $resultado[0]->getApellido();

        //Informacion de usuario
        $usuarioDAO = new UsuarioDAO($bd);
        $resultado = $usuarioDAO->getInstancia(array($cedula));
        $usuario = $resultado[0]->getNickname();
         
        //informacion contacto
        $contactoDAO = new ContactoDAO($bd);
        $resultado = $contactoDAO->getInstanciaCedula(array($cedula));

        $correo = $resultado[0]->getContacto();
        $telefono = count($resultado)>1 ? $resultado[1]->getContacto() : "";

        echo "
            <div class=\"tabla\">
                <h2 class=\"tabla__titulo\">Cuenta virtual</h2>
                <table class=\"tabla__table\">
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
                        <td class=\"tabla__td\">$usuario</td>
                        <td class=\"tabla__td\">$correo</td>
                        <td class=\"tabla__td\">$telefono</td>
                    </tr>
                </table>
            </div>";
    }

?>