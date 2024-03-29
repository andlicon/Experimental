<?php
    include_once(__DIR__.'/../rutaAcciones.php');
    include_once(DAO_PATH.'BaseDeDatos.php');
    include_once(DAO_PATH.'PagoDAO.php');

    class EliminarPago  {
        public function eliminar(array $id) {
            try {
                $dao = new PagoDAO(BaseDeDatos::getInstancia());
                $dao->eliminar($id);
                return true;
            }
            catch(Exception $e) {
                return "Ha ocurrido un error, no se puede eliminar el pago.";
            }
        }
    }
?>