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
        <div>
            <h2>Movimientos</h2>
            <table>
                <thead>
                    <tr>
                        <th>Referencia pago</th>
                        <th>Referencia deuda</th>
                        <th>Descripcion</th>
                        <th>Fecha</th>
                        <th>Monto</th>
                        <th>Estado</th>
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
                    <tr>
                        <td>$idPago </td>
                        <td>$pop</td>
                        <td>$descripcion</td>
                        <td>$fecha</td>
                        <td>$monto</td>
                        <td>$estado</td>
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