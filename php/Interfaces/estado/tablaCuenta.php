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
            <div>
                <h2>Cuenta virtual</h2>
                <table class=\"\">
                    <tr>
                        <td>Cedula</td>
                        <td>Nombre</td>
                        <td>Apellido</td>
                    </tr>
                    <tr>
                        <td>$cedula</td>
                        <td>$nombre</td>
                        <td>$apellido</td>
                    </tr>
                    <tr>
                        <td>Usuario</td>
                        <td>Correo</td>
                        <td>Telefono</td>
                    </tr>
                    <tr>
                        <td>$usuario</td>
                        <td>$correo</td>
                        <td>$telefono</td>
                    </tr>
                </table>
            </div>";
    }

?>