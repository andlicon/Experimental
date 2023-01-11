<?php
    include_once(FUNCIONES_IG_PATH.'popOver/DeudaPop.php');
    include_once(DAO_PATH.'BaseDeDatos.php');
    include_once(DAO_PATH.'MovimientoConsul.php');
    include_once(DAO_PATH.'DeudaDAO.php');
    include_once(DAO_PATH.'PagoDAO.php');

    //Acá debo hacer que imprima tanto deudas como pago
        //Cambiar el formato de la tabla para que acepte a ambos.

    function tablaMovimiento() {
        $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');

        $usuario = deserializarUsuario();
        $cedula = $usuario->getCedula();

        $movimientoConsul = new MovimientoConsul($bd);
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

                            //C O N S U L T A S
        // //Informacion de usuario
        // $pagoDAO = new PagoDAO($bd);
        // $resultado = $pagoDAO->getTodos(array($cedula));

        // //creara popOvers para estudiantes en cada iteracion
        // $deudaDAO = new DeudaDAO($bd);
        // $deudaPop = new DeudaPop($deudaDAO);

        // for($i=0; $i<count($resultado); $i++) {
        //     //Info Deuda
        //     $pago = $resultado[0];
        //     $idPago = $pago->getId();
        //     $idDeuda = $pago->getIdDeuda();
        //     $descripcion = "";
        //     $fecha = $pago->getFecha();
        //     $monto = $pago->getMonto();
        //     $valido = $pago->getValido();
        //     $estado = $valido ? "Confirmado" : "Por confirmar";

        //     //Descripcion
        //     $resultado = $deudaDAO->getInstancia(array($idDeuda));
        //     $deuda = $resultado[$i];

        //     $descripcionDeuda = $deuda->getDescripcion();
        //     $motivoId = $deuda->getidMotivo();

        //     $motivoConsul = new MotivoConsul($bd);
        //     $mot = $motivoConsul->getInstancia(array($motivoId));
        //     $motivoDeuda = $mot[0]->getDescripcion();

        //     $descripcion = $descripcionDeuda==null ? $motivoDeuda : $motivoDeuda.': '.$descripcionDeuda;

        //     $pop = $deudaPop->generarPop($idDeuda);

        //     //InfoEstudiante

        //     $fila = "
        //             <tr class=\"tabla__tr\">
        //                 <td class=\"tabla__td\">$idPago </td>
        //                 <td class=\"tabla__td\">$pop</td>
        //                 <td class=\"tabla__td\">$descripcion</td>
        //                 <td class=\"tabla__td\">$fecha</td>
        //                 <td class=\"tabla__td\">$monto</td>
        //                 <td class=\"tabla__td\">$estado</td>
        //             </tr>";

        //     $tabla = $tabla.$fila;
        // }

        $tabla = $tabla."
                </tbody>
            </table>
        </div>
        ";

        echo $tabla;
    }

?>