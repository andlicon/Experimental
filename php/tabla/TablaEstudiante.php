<?php
    $permiso = $_POST['permiso'];
    $colAdicional1 = "";
    $colAdicional2 = "";
    $colAdicional3 = "";
    $colAdicional4 = "";
    $thAdicional1 = "";
    $thAdicional2 = "";
    $thAAdicional4 = "";

    if($permiso==5 || $permiso==4) {
        $colAdicional1 = "
            <col class=\"output__col output__col--estadoInscripcion\">";
        $colAdicional2 = "
            <col class=\"output__col output__col--registro\">";
        $colAdicional3 = "
            <col class=\"output__col output__col--estado\">
        ";
        $colAdicional4 = "<col class=\"output__col output__col--acciones\">";

        $thAdicional1 = "
            <th class=\"output__celda output__celda--header\">
                Fecha Registro
            </th>";
        $thAdicional2 = "
            <th class=\"output__celda output__celda--header\">
                Estado regular
            </th>";
        $thAAdicional4 = "
            <th class=\"output__celda output__celda--header\">
                Acciones
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
                $colAdicional4
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
                    $thAdicional2
                    <th class=\"output__celda output__celda--header\">
                        Estado 
                    </th>
                    $thAAdicional4
                </tr>
            </thead>
            <tbody class=\"output__body\">
            </tbody>
        </table>";

            echo $tabla;
?>