<?php
    include_once(DAO_PATH.'/BaseDeDatos.php');
    include_once(DAO_PATH.'/ContactoDAO.php');
    include_once(DAO_PATH.'/TipoContactoConsul.php');

    function generarTablaContactos($cedula) {
        try {
            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
            $contactoDAO = new ContactoDAO($bd);
            $tipoContactoConsul = new TipoContactoConsul($bd);

            $contactos = $contactoDAO->getInstanciaCedula(array ($cedula));

            echo "<table>";
            for($i=0; $i<count($contactos); $i++) {
                //Contacto
                $contacto = $contactos[$i];
                $cont = $contacto->getContacto();
                //Tipo Contacto
                $idTipo = $contacto->getIdTipo();
                $tipoContacto = $tipoContactoConsul->getInstancia(array($idTipo));
                $tipoDescripcion = $tipoContacto[0]->getDescripcion();

                echo "<tr>
                        <td>
                            <span class=\"output__tipo-contacto\">$tipoDescripcion:</span> <span class=\"output__contacto\">$cont</span>
                        </td>
                     </tr>";
            }
            echo "</table>";
        }
        catch(Exception $e) {
            
        }
    }
?>