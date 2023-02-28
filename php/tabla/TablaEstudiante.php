<?php
    $permiso = $_POST['permiso'];
    $colAdicional1 = "";
    $colAdicional2 = "";
    $colAdicional3 = "";
    $thAdicional1 = "";
    $thAdicional2 = "";

    if($permiso==5 || $permiso==4) {
        $colAdicional1 = "
            <col class=\"output__col output__col--estadoInscripcion\">";
        $colAdicional2 = "
            <col class=\"output__col output__col--registro\">";
        $colAdicional3 = "
            <col class=\"output__col output__col--estado\">
        ";

        $thAdicional1 = "
            <th class=\"output__celda output__celda--header\">
                Fecha Registro
            </th>";
        $thAdicional2 = "
            <th class=\"output__celda output__celda--header\">
                Estado registro
            </th>";
    }

    $tabla = "";
    $tabla = "
        <table class=\"output__table\">
            <colgroup> 
                $colAdicional2
                <col class=\"output__col output__col--nombre\">
                <col class=\"output__col output__col--apellido\">
                <col class=\"output__col output__col--fechaNacimiento\">
                <col class=\"output__col output__col--lugarNacimiento\">
                <col class=\"output__col output__col--clase\">
                $colAdicional1
                $colAdicional3 
                <col class=\"output__col output__col--acciones\">
            </colgroup>
            <thead class=\"output__header\">
                <tr class=\"output__renglon\">
                    $thAdicional1
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
                        Lugar Nacimiento
                    </th>
                    <th class=\"output__celda output__celda--header\">
                        Clase
                    </th>
                    <th class=\"output__celda output__celda--header\">
                        Estado inscripcion
                    </th>
                    $thAdicional2
                    <th class=\"output__celda output__celda--header\">
                        Acciones
                    </th>
                </tr>
            </thead>
            <tbody class=\"output__body\">
            </tbody>
        </table>";

            echo $tabla;

    // class TablaEstudiante extends Tabla {
    //     private $permiso;

    //     public function __construct() {
    //     }

    //     public function crearTabla() {
    //         $permiso = $_POST['permiso'];
    //         $tabla = "
    //         <table class=\"output__table\">
    //             <colgroup> 
    //                 <col class=\"output__col output__col--registro\">
    //                 <col class=\"output__col output__col--nombre\">
    //                 <col class=\"output__col output__col--apellido\">
    //                 <col class=\"output__col output__col--fechaNacimiento\">
    //                 <col class=\"output__col output__col--lugarNacimiento\">
    //                 <col class=\"output__col output__col--clase\">
    //                 <col class=\"output__col output__col--estadoInscripcion\">
    //                 <col class=\"output__col output__col--estado\">
    //                 <col class=\"output__col output__col--acciones\">
    //             </colgroup>
    //             <thead class=\"output__header\">
    //                 <tr class=\"output__renglon\">
    //                     <th class=\"output__celda output__celda--header\">
    //                        Fecha Registro
    //                     </th>
    //                     <th class=\"output__celda output__celda--header\">
    //                        Nombre
    //                     </th>
    //                     <th class=\"output__celda output__celda--header\">
    //                        Apellido 
    //                     </th>
    //                     <th class=\"output__celda output__celda--header\">
    //                        Fecha nacimiento
    //                     </th>
    //                     <th class=\"output__celda output__celda--header\">
    //                         Lugar Nacimiento
    //                     </th>
    //                     <th class=\"output__celda output__celda--header\">
    //                        Clase
    //                     </th>
    //                     <th class=\"output__celda output__celda--header\">
    //                        Estado inscripcion
    //                     </th>
    //                     <th class=\"output__celda output__celda--header\">
    //                        Estado
    //                     </th>
    //                     <th class=\"output__celda output__celda--header\">
    //                        Acciones
    //                     </th>
    //                 </tr>
    //             </thead>
    //             <tbody class=\"output__body\">
    //             </tbody>
    //         </table>";

    //         echo $tabla;
    //     }
    // }
?>