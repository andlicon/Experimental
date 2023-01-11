<?php
    include_once('../rutaAcciones.php');
    include_once(DAO_PATH.'pagoDAO.php');
    include_once(DAO_PATH.'BaseDeDatos.php');

    class CargarPago {
        public function cargar() {

            if( isset($_POST['cedula']) && 
                isset($_POST['idDeuda']) && isset($_POST['fecha']) && 
                isset($_POST['monto']) && isset($_POST['referencia']) && 
                isset($_POST['cuenta']) && isset($_POST['tipoPago']) && 
                isset($_POST['valido'])
            ) {
                $cedula = $_POST['cedula'];
                $idDeuda = $_POST['idDeuda'];
                $fecha = $_POST['fecha'];
                $monto = $_POST['monto'];
                $referencia = $_POST['referencia'];
                $cuenta = $_POST['cuenta'];
                $tipoPago = $_POST['tipoPago'];
                $valido = $_POST['valido'] == 1 ? true : false;

                //Falta algo para validar los datos
            
                $pagoDAO = new PagoDAO(BaseDeDatos::getInstancia());
                $pagoDAO->cargar(array($idDeuda, $cedula, $fecha, $monto, $cuenta, $tipoPago, $referencia, $valido));

                echo 'se ha cargado correctamente el pago.';
            }
        }
    }

?>