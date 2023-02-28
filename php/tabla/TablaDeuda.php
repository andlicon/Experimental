<?php
$permiso = $_POST['permiso'];
$accionCol = "";
$accionTh = "";

if($permiso!=1) {
    $accionCol = "<col class=\"output__col output__col--acciones\">";
    $accionTh = "<th class=\"output__celda output__celda--header\">
                    Acciones
                </th>";
}

$tabla = "
    <table class=\"output__table\">
        <colgroup> 
            <col class=\"output__col output__col--cedula\">
            <col class=\"output__col output__col--estudiante\">
            <col class=\"output__col output__col--motivo\">
            <col class=\"output__col output__col--descripcion\">
            <col class=\"output__col output__col--fecha\">
            <col class=\"output__col output__col--montoInicial\">
            <col class=\"output__col output__col--pagado\">
            <col class=\"output__col output__col--debe\">
            $accionCol
        </colgroup>
        <thead class=\"output__header\">
            <tr class=\"output__renglon\">
                <th class=\"output__celda output__celda--header\">
                    Cedula representante
                </th>
                <th class=\"output__celda output__celda--header\">
                    Estudiante
                </th>
                <th class=\"output__celda output__celda--header\">
                    Motivo
                </th>
                <th class=\"output__celda output__celda--header\">
                    Descripcion
                </th>
                <th class=\"output__celda output__celda--header\">
                    Fecha
                </th>
                <th class=\"output__celda output__celda--header\">
                    Monto Inicial
                </th>
                <th class=\"output__celda output__celda--header\">
                    Pagado
                </th>
                <th class=\"output__celda output__celda--header\">
                    Debe
                </th>
                $accionTh
            </tr>
        </thead>
        <tbody></tbody>
        <tfoot>
            <tr class=\"tr--total\">
                <td colspan=\"7\"></td>
                    <td>
                        Deuda total: <span class=\"deuda__span\"></span>
                    </td>
                </tr>
            </tfoot>
        </table>";

            echo $tabla;

    // class TablaDeuda extends Tabla {

    //     public function crearTabla() {
    //         $tabla = "
    //         <table class=\"output__table\">
    //         <colgroup> 
    //             <col class=\"output__col output__col--cedula\">
    //             <col class=\"output__col output__col--estudiante\">
    //             <col class=\"output__col output__col--motivo\">
    //             <col class=\"output__col output__col--descripcion\">
    //             <col class=\"output__col output__col--fecha\">
    //             <col class=\"output__col output__col--montoInicial\">
    //             <col class=\"output__col output__col--pagado\">
    //             <col class=\"output__col output__col--debe\">
    //             <col class=\"output__col output__col--acciones\">
    //         </colgroup>
    //         <thead class=\"output__header\">
    //             <tr class=\"output__renglon\">
    //                 <th class=\"output__celda output__celda--header\">
    //                    Cedula representante
    //                 </th>
    //                 <th class=\"output__celda output__celda--header\">
    //                    Estudiante
    //                 </th>
    //                 <th class=\"output__celda output__celda--header\">
    //                    Motivo
    //                 </th>
    //                 <th class=\"output__celda output__celda--header\">
    //                    Descripcion
    //                 </th>
    //                 <th class=\"output__celda output__celda--header\">
    //                    Fecha
    //                 </th>
    //                 <th class=\"output__celda output__celda--header\">
    //                     Monto Inicial
    //                 </th>
    //                 <th class=\"output__celda output__celda--header\">
    //                     Pagado
    //                 </th>
    //                 <th class=\"output__celda output__celda--header\">
    //                     Debe
    //                 </th>
    //                 <th class=\"output__celda output__celda--header\">
    //                     Acciones
    //                 </th>
    //             </tr>
    //         </thead>
    //         <tbody></tbody>
    //         <tfoot>
    //                 <tr class=\"tr--total\">
    //                     <td colspan=\"7\"></td>
    //                     <td>
    //                         Deuda total: <span class=\"deuda__span\"></span>
    //                     </td>
    //                 </tr>
    //             </tfoot>
    //         </table>
    //         ";

    //         echo $tabla;
    //     }
    // }
?>

