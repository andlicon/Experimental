<?php
include_once(TABLA_PATH.'/Tabla.php');

class TablaUsuarios extends Tabla {

    public function crearTabla() {
        $tabla = "
            <table class=\"output__table\">
                <colgroup> 
                    <col class=\"output__col output__col--cedula\">
                    <col class=\"output__col output__col--nombre\">
                    <col class=\"output__col output__col--apellido\">
                    <col class=\"output__col output__col--tipo\">
                    <col class=\"output__col output__col--contacto\">
                    <col class=\"output__col output__col--descripcion-Trabajo\">
                    <col class=\"output__col output__col--lugarTrabajo\">
                    <col class=\"output__col output__col--acciones\">
                </colgroup>
                <thead class=\"output__header\">
                    <tr class=\"output__renglon\">
                        <th class=\"output__celda output__celda--header\">
                           Cedula 
                        </th>
                        <th class=\"output__celda output__celda--header\">
                           Nombre 
                        </th>
                        <th class=\"output__celda output__celda--header\">
                           Apellido
                        </th>
                        <th class=\"output__celda output__celda--header\">
                           Trabajo
                        </th>
                        <th class=\"output__celda output__celda--header\">
                           Lugar trabajo
                        </th>
                        <th class=\"output__celda output__celda--header\">
                           Tipo
                        </th>
                        <th class=\"output__celda output__celda--header\">
                           Nickname
                        </th>
                        <th class=\"output__celda output__celda--header\">
                           Valido
                        </th>
                        <th class=\"output__celda output__celda--header\">
                           Acciones
                        </th>
                    </tr>
                </thead>
                <tbody class=\"tbody\">
                </tbody>
            </table>";

        echo $tabla;
    }

}

// <tbody class="output__body">
//         include_once(DTO_PATH.'/Usuario.php');
//         include_once(DTO_PATH.'/Persona.php');
//         include_once(DTO_PATH.'/TipoPersona.php');

//         if( isset($_GET['usuarios']) ) {
//             $serialize = $_GET['usuarios'];     //AHORA SE TIENE QUE PASAR POR HEADER PERSONA
        
//             if($serialize) {
//                 $usuarios = unserialize($serialize);
            
//                 for($i=0; $i<count($usuarios); $i++) {
//                     /*Obteniendo los datos de la persona*/
//                     $usuario = $usuarios[$i];
//                     $cedula = $usuario->getCedula();

//                     $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');

//                     //Info persona.
//                     $personaDAO = new PersonaDAO($bd);
//                     $resultados = $personaDAO->getInstancia(array($cedula));
//                     $persona = $resultados[0];
//                     $nombre = $persona->getNombre();
//                     $apellido = $persona->getApellido();
//                     $idTipoPersona = $persona->getIdTipoPersona();

//                     //Info usuario.
//                     $usuarioDAO = new UsuarioDAO($bd);
//                     $resultados = $usuarioDAO->getInstancia(array($cedula));
//                     $usuario = $resultados[0];
//                     $nickname = $usuario->getNickname();
//                     $valido = $usuario->getValido();
//                     $valido = $valido==true ? "valido" : "invalido";

//                     //Info TipoUsuario
//                     $tipoPersonaConsul = new TipoPersonaConsul($bd);
//                     $resultados = $tipoPersonaConsul->getInstancia(array($idTipoPersona));
//                     $tipoUsuario = $resultados[0]->getDescripcion();
                    
//                     echo "  <tr class=\"output__renglon\">
//                                 <td class=\"output__celda\ output__celda--centrado\">
//                                     <input type=\"checkbox\" name=\"check[]\" value=\"$cedula\" 
//                                             id=\"check$i\" class=\"output__check\">
//                                 </td>
//                                 <td class=\"output__celda\">
//                                     $cedula
//                                 </td>
//                                 <td class=\"output__celda\">
//                                     $nombre
//                                 </td>
//                                 <td class=\"output__celda\">
//                                     $apellido
//                                 </td>
//                                 <td class=\"output__celda\">  
//                                     $tipoUsuario
//                                </td>
//                                 <td class=\"output__celda\">
//                                   $nickname
//                                 </td> 
//                                 <td class=\"output__celda\">
//                                     $valido
//                                 </td>         
//                             </tr>";
//                 }
//             } 
//         }
// </tbody>
// </table>
?>