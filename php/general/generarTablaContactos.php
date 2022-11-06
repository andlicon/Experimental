<?php
    include_once('../conexion/BaseDeDatos.php');
    include_once('../conexion/ContactoDAO.php');

    function generarTablaContactos($cedula) {
        try {
            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
            $contactoDAO = new ContactoDAO($bd);

            $contactos = $contactoDAO->getInstancia(array ($cedula));

            echo "<table>";
            for($i=0; $i<count($contactos); $i++) {
                $contacto = $contactos[$i];
                $cont = $contacto->getContacto();
                echo "<tr>
                        <td>
                            $cont
                        </td>
                     </tr>";
            }
            echo "</table>";
        }
        catch(Exception $e) {
            
        }
    }
?>