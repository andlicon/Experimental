<?php
    include_once('../../accion/rutaAcciones.php');
    include_once(POP_PATH.'DeudaPop.php');
    include_once(DAO_PATH.'BaseDeDatos.php');
    include_once(DAO_PATH.'MovimientoConsul.php');
    include_once(DAO_PATH.'DeudaDAO.php');
    include_once(DAO_PATH.'PagoDAO.php');

    if(isset($_POST['cedula'])) {
        $cedula = $_POST['cedula'];

        $movimientoConsul = new MovimientoConsul(BaseDeDatos::getInstancia());
        $resultados = $movimientoConsul->getInstancia(array($cedula));

        $tabla = "
        <div class=\"tabla\">
            <h2 class=\"tabla__titulo\">Movimientos</h2>
            <table class=\"tabla__table\">
                <thead>
                    <tr class=\"tabla__tr\">
                        <th class=\"tabla__td tabla__th\">Referencia</th>
                        <th class=\"tabla__td tabla__th\">Fecha</th>
                        <th class=\"tabla__td tabla__th\">Descripcion</th>
                        <th class=\"tabla__td tabla__th\">Monto</th>
                    </tr>
                </thead>
                <tbody>";
        for($i=0; $i<count($resultados); $i++) {
            $movimiento = $resultados[$i];
            $referencia = $movimiento->getReferencia();
            $fecha = $movimiento->getFecha();
            $descripcion = $movimiento->getDescripcion();
            $monto = $movimiento->getMonto();

            $fila = "
                 <tr class=\"tabla__tr\">
                     <td class=\"tabla__td\">$referencia</td>
                     <td class=\"tabla__td\">$fecha</td>
                     <td class=\"tabla__td\">$descripcion</td>
                     <td class=\"tabla__td\">$monto</td>
                 </tr>";
    
            $tabla = $tabla.$fila;

        }

        echo $tabla;
    }

?>