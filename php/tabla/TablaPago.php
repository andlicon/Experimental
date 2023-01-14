<?php
    include_once(TABLA_PATH.'/Tabla.php');

    class TablaPago extends Tabla {

        public function crearTabla() {
            $tabla = "
            <table class=\"output__table\">
                <colgroup>
                    <col class=\"output__col output__col--deuda\">
                    <col class=\"output__col output__col--cedula\">
                    <col class=\"output__col output__col--fecha\">
                    <col class=\"output__col output__col--monto\">
                    <col class=\"output__col output__col--cuenta\">
                    <col class=\"output__col output__col--tipoPago\">
                    <col class=\"output__col output__col--referencia\">
                    <col class=\"output__col output__col--estado\">
                    <col class=\"output__col output__col--acciones\">
                </colgroup>
                <thead class=\"output__header\">
                    <tr class=\"output__renglon\">
                        <th class=\"output__celda output__celda--header\">
                           Referencia deuda
                        </th>
                        <th class=\"output__celda output__celda--header\">
                           Cedula
                        </th>
                        <th class=\"output__celda output__celda--header\">
                           Fecha
                        </th>
                        <th class=\"output__celda output__celda--header\">
                            Monto
                        </th>
                        <th class=\"output__celda output__celda--header\">
                            Cuenta
                        </th>
                        <th class=\"output__celda output__celda--header\">
                            Tipo pago
                        </th>
                        <th class=\"output__celda output__celda--header\">
                            Referencia
                        </th>
                        <th class=\"output__celda output__celda--header\">
                            Estado
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
?>