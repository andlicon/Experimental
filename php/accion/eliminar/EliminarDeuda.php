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

                    $daoPago->eliminar(array($idPago));
                }

                $daoDeuda = new DeudaDAO(BaseDeDatos::getInstancia());
                $daoDeuda->eliminar($id);

                return 'Se ha eliminado con éxito la deuda y sus pagos asociados.';
            }
            catch(DaoException $e) {
                $trigger = $e->getDao();
                $accion = $e->getAccion();

                if($trigger==DaoException::PAGO && $accion==DaoException::CONSULTAR) {
                    $daoDeuda = new DeudaDAO(BaseDeDatos::getInstancia());
                    $daoDeuda->eliminar($id);
                }
                else {
                    echo $e->getMessage();
                }
            }
            catch(Exception $e) {
                echo "Ha ocurrido un error, no se puede eliminar la deuda.";
            }
        }
    }
?>