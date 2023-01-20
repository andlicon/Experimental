<?php
    include_once(__DIR__.'/../rutaAcciones.php');
    include_once(DAO_PATH.'BaseDeDatos.php');
    include_once(DAO_PATH.'PagoDAO.php');
    include_once(DAO_PATH.'DeudaDAO.php');

    class EliminarDeuda  {
        public function eliminar(array $id) {
            try {
                $daoPago = new PagoDAO(BaseDeDatos::getInstancia());
                $registros = $daoPago->getInstanciaDeuda($id);

                for($i=0; $i<count($registros); $i++) {
                    $pago = $registros[$i];
                    $idPago = $pago->getId();

                    $daoPago->eliminar($idPago);
                }

                $daoDeuda = new DeudaDAO(BaseDeDatos::getInstancia());
                $daoDeuda->eliminar($id);

                return true;
            }
            catch(Exception $e) {
                return "Ha ocurrido un error, no se puede eliminar la deuda.";
            }
        }
    }
?>