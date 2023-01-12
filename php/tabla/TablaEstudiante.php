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
                    <col class=\"output__col output__col--nombre\">
                    <col class=\"output__col output__col--apellido\">
                    <col class=\"output__col output__col--fechaNacimiento\">
                    <col class=\"output__col output__col--clase\">
                    <col class=\"output__col output__col--estado\">
                </colgroup>
                <thead class=\"output__header\">
                    <tr class=\"output__renglon\">
                        <th class=\"output__celda output__celda--header\">
                           Nombre
                        </th>
                        <th class=\"output__celda output__celda--header\">
                           Apellido 
                        </th>
                        <th class=\"output__celda output__celda--header\">
                           Fecha nacimiento
                        </th>
                        <th class=\"output__celda output__celda--header\">
                           Clase
                        </th>
                        <th class=\"output__celda output__celda--header\">
                           Estado
                        </th>
                    </tr>
                </thead>
                <tbody class=\"output__body\">
                </tbody>
            </table>";

            echo $tabla;
        }
    }
?>