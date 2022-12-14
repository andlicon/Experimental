<?php
    include_once(TABLA_PATH.'/Tabla.php');
    include_once(DTO_PATH.'/Deuda.php');
    include_once(DAO_PATH.'DeudaDAO.php');
    include_once(DAO_PATH.'EstudianteDAO.php');
    include_once(DTO_PATH.'Motivo.php');
    include_once(FUNCIONES_IG_PATH.'popOver/RepresentantePop.php');
    include_once(FUNCIONES_IG_PATH.'popOver/EstudiantePop.php');
    include_once(INTERFACES_PATH.'/deuda/getDescripcionMotivo.php');
    include_once(FUNCIONES_IG_PATH.'popOver/RepresentantePop.php');
    include_once(DAO_PATH.'/BaseDeDatos.php');
    include_once(DAO_PATH.'/PersonaDAO.php');
    include_once(DTO_PATH.'/Estudiante.php');
    include_once('getNombreClase.php');

    class TablaEstudiante extends Tabla {

        public function crearTabla() {
            $tabla = "
            <table class=\"output__table\">
                <colgroup> 
                    <col class=\"output__col output__col--seleccion\">
                    <col class=\"output__col output__col--nombre\">
                    <col class=\"output__col output__col--apellido\">
                    <col class=\"output__col output__col--fechaNacimiento\">
                    <col class=\"output__col output__col--clase\">
                </colgroup>
            <thead class=\"output__header\">
                <tr class=\"output__renglon\">
                    <th class=\"output__celda output__celda--header\">
                       Seleccionar 
                    </th>
                    <th class=\"output__celda output__celda--header\">
                       Nombre
                    </th>
                    <th class=\"output__celda output__celda--header\">
                       Apellido 
                    </th>
                    <th class=\"output__celda output__celda--header\">
                       Representante
                    </th>
                    <th class=\"output__celda output__celda--header\">
                       Fecha nacimiento
                    </th>
                    <th class=\"output__celda output__celda--header\">
                       Clase
                    </th>
                </tr>
            </thead>
            <tbody class=\"output__body\">";

            if( isset($_GET['estudiantes']) ) {
                $serialize = $_GET['estudiantes'];
            
                if($serialize) {
                    $estudiantes = unserialize($serialize);

                    //Generador popOver
                    $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
                    $personaDAO = new PersonaDAO($bd);
                    $popOverRep = new RepresentantePop($personaDAO);
                
                    for($i=0; $i<count($estudiantes); $i++) {
                        $estudiante = $estudiantes[$i];

                        //Informacion Estudiante
                        $idEstudiante = $estudiante->getId();
                        $nombre = $estudiante->getNombre();
                        $apellido = $estudiante->getApellido();
                        $fechaNacimiento = $estudiante->getFechaNacimiento();
                        $idClase = $estudiante->getIdClase();
                        $cedulaRepresentante = $estudiante->getCedulaRepresentante();
                        //Informacion clase
                        $nombreClase = getNombreClase($idClase);
                        //pop
                        $popRep = $popOverRep->generarPop($cedulaRepresentante, $cedulaRepresentante);
                    
                       $tabla = $tabla."  
                       <tr class=\"output__renglon\">
                            <td class=\"output__celda output__celda--centrado\">
                                <input type=\"checkbox\" name=\"check[]\" value=\"$idEstudiante\" id=\"check$i\">
                            </td>
                            <td class=\"output__celda\">
                                $nombre
                            </td>
                            <td class=\"output__celda\">
                                $apellido
                            </td>
                            <td class=\"output__celda\">
                                $popRep
                            </td>
                            <td class=\"output__celda\">
                                $fechaNacimiento
                            </td>
                            <td class=\"output__celda\">
                                $nombreClase
                            </td>
                        </tr>";
                    }
                }
            }

            $tabla = $tabla."
                </tbody>
            </table>";



            echo $tabla;
        }
    }
?>