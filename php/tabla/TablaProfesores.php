<?php
    include_once(TABLA_PATH.'/Tabla.php');

    class TablaProfesores extends Tabla {

        public function crearTabla() {
            $tabla = "  
                <table class=\"output__table\">
                    <colgroup> 
                        <col class=\"output__col output__col--seleccion\">
                        <col class=\"output__col output__col--cedula\">
                        <col class=\"output__col output__col--nombre\">
                        <col class=\"output__col output__col--apellido\">
                        <col class=\"output__col output__col--tipo\">
                        <col class=\"output__col output__col--contacto\">
                        <col class=\"output__col output__col--acciones\">
                    </colgroup>
                    <thead class=\"output__header\">
                        <tr class=\"output__renglon\">
                            <th class=\"output__celda output__celda--header\">
                               Seleccionar 
                            </th>
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
                               clase
                            </th>
                            <th class=\"output__celda output__celda--header\">
                               Contacto 
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