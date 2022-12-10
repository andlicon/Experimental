<?php
    include_once(FUNCIONES_IG_PATH.'popOver/DeudaPop.php');
    include_once(DAO_PATH.'BaseDeDatos.php');
    include_once(DAO_PATH.'DeudaDAO.php');
    include_once(DAO_PATH.'PagoDAO.php');

    function tablaMovimiento() {
        $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');

        $usuario = deserializarUsuario();
        $cedula = $usuario->getCedula();

                            //C O N S U L T A S
        //Informacion de usuario
        $pagoDAO = new PagoDAO($bd);
        $resultado = $pagoDAO->getTodos(array($cedula));

        //creara popOvers para estudiantes en cada iteracion
        $deudaDAO = new DeudaDAO($bd);
        $deudaPop = new DeudaPop($deudaDAO);

        $tabla = "
        <div class=\"tabla\">
            <h2 class=\"tabla__titulo\">Movimientos</h2>
            <table class=\"tabla__table\">
                <thead>
                    <tr class=\"tabla__tr\">
                        <th class=\"tabla__td tabla__th\">Referencia pago</th>
                        <th class=\"tabla__td tabla__th\">Referencia deuda</th>
                        <th class=\"tabla__td tabla__th\">Descripcion</th>
                        <th class=\"tabla__td tabla__th\">Fecha</th>
                        <th class=\"tabla__td tabla__th\">Monto</th>
                        <th class=\"tabla__td tabla__th\">Estado</th>
                    </tr>
                </thead>
                <tbody>";
        for($i=0; $i<count($resultado); $i++) {
            //Info Deuda
            $pago = $resultado[0];
            $idPago = $pago->getId();
            $idDeuda = $pago->getIdDeuda();
            $descripcion = "";
            $fecha = $pago->getFecha();
            $monto = $pago->getMonto();
            $valido = $pago->getValido();
            $estado = $valido ? "Confirmado" : "Por confirmar";

            //Descripcion
            $resultado = $deudaDAO->getInstancia(array($idDeuda));
            $deuda = $resultado[$i];

            $descripcionDeuda = $deuda->getDescripcion();
            $motivoId = $deuda->getidMotivo();

            $motivoConsul = new MotivoConsul($bd);
            $mot = $motivoConsul->getInstancia(array($motivoId));
            $motivoDeuda = $mot[0]->getDescripcion();

            $descripcion = $descripcionDeuda==null ? $motivoDeuda : $motivoDeuda.': '.$descripcionDeuda;

            $pop = $deudaPop->generarPop($idDeuda);

            //InfoEstudiante

            $fila = "
                    <tr class=\"tabla__tr\">
                        <td class=\"tabla__td\">$idPago </td>
                        <td class=\"tabla__td\">$pop</td>
                        <td class=\"tabla__td\">$descripcion</td>
                        <td class=\"tabla__td\">$fecha</td>
                        <td class=\"tabla__td\">$monto</td>
                        <td class=\"tabla__td\">$estado</td>
                    </tr>";

            $tabla = $tabla.$fila;
        }

        $tabla = $tabla."
                </tbody>
            </table>
        </div>
        ";

        echo $tabla;
    }

?>