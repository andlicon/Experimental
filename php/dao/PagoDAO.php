<?php
    include_once ('IDAO.php');
    include_once(DTO_PATH.'/Pago.php');

    class PagoDAO implements IDAO {
        private $bd;

        public function __construct(BaseDeDatos $bd) {
            $this->bd = $bd;
        }

        public function getInstancia(array $id) {
            $consulta = "SELECT * 
                        FROM    pago
                        WHERE   id=?";
            $registros = $this->bd->sql($consulta, $id);

            if(empty($registros)) {
                throw new Exception('No existe pago asociado al id deuda');
            }

            $pagos = [];
            if(!empty($registros)) {
                $renglon = $registros[0];
                $id = $renglon['id'];
                $idDeuda = $renglon['id_deuda'];
                $fecha = $renglon['fecha'];
                $cedula = $renglon['cedula'];
                $monto = $renglon['monto'];
                $idCuenta = $renglon['id_cuenta'];
                $idTipoPago = $renglon['id_tipo_pago'];
                $ref = $renglon['ref'];
                $valido = $renglon['valido'];
                
                $pag= new Pago($id, $idDeuda, $fecha, $cedula, $monto, 
                                $idCuenta, $idTipoPago, $ref, $valido);
                $pagos[] = $pag;
            }

            return $pagos;
        }

        public function getInstanciaCedulaValidez(array $cedula) {
            $consulta = "SELECT * 
                        FROM    pago
                        WHERE   cedula=?
                            AND valido=false";
            $registros = $this->bd->sql($consulta, $cedula);

            if(empty($registros)) {
                throw new Exception('No existe pago asociado al id deuda');
            }

            $pagos = [];
            for($i=0; $i<count($registros); $i++) {
                $renglon = $registros[0];

                $id = $renglon['id'];
                $idDeuda = $renglon['id_deuda'];
                $fecha = $renglon['fecha'];
                $cedula = $renglon['cedula'];
                $monto = $renglon['monto'];
                $idCuenta = $renglon['id_cuenta'];
                $idTipoPago = $renglon['id_tipo_pago'];
                $ref = $renglon['ref'];
                $valido = $renglon['valido'];
                
                $pag= new Pago($id, $idDeuda, $fecha, $cedula, $monto, 
                                $idCuenta, $idTipoPago, $ref, $valido);
                $pagos[] = $pag;
            }

            return $pagos;
        }

        public function getInstanciaCedula(array $cedula) {
            $consulta = "SELECT * 
                        FROM    pago
                        WHERE   cedula=?
                        ORDER BY valido";
            $registros = $this->bd->sql($consulta, $cedula);

            if(empty($registros)) {
                throw new Exception('No existe pago asociado al id deuda');
            }

            $pagos = [];
            for($i=0; $i<count($registros); $i++) {
                $renglon = $registros[0];
                
                $id = $renglon['id'];
                $idDeuda = $renglon['id_deuda'];
                $fecha = $renglon['fecha'];
                $cedula = $renglon['cedula'];
                $monto = $renglon['monto'];
                $idCuenta = $renglon['id_cuenta'];
                $idTipoPago = $renglon['id_tipo_pago'];
                $ref = $renglon['ref'];
                $valido = $renglon['valido'];
                
                $pag= new Pago($id, $idDeuda, $fecha, $cedula, $monto, 
                                $idCuenta, $idTipoPago, $ref, $valido);
                $pagos[] = $pag;
            }

            return $pagos;
        }

        public function getInstanciaDeuda($idDeuda) {
            $consulta = "SELECT * 
                         FROM    pago
                         WHERE   id_deuda=?";
            $registros = $this->bd->sql($consulta, $idDeuda);
                
            if(empty($registros)) {
                throw new Exception('No existe pago asociado al id deuda');
            }

            $pagos = [];
            if(!empty($registros)) {
                $renglon = $registros[0];
                $id = $renglon['id'];
                $idDeuda = $renglon['id_deuda'];
                $fecha = $renglon['fecha'];
                $cedula = $renglon['cedula'];
                $monto = $renglon['monto'];
                $idCuenta = $renglon['id_cuenta'];
                $idTipoPago = $renglon['id_tipo_pago'];
                $ref = $renglon['ref'];
                $valido = $renglon['valido'];
                
                $pag= new Pago($id, $idDeuda, $fecha, $cedula, $monto, 
                                $idCuenta, $idTipoPago, $ref, $valido);
                $pagos[] = $pag;
            }

            return $pagos;
        }
        
        public function getTodos() {
            $consulta = "SELECT * 
                        FROM pago
                        ORDER BY cedula, valido";
            $registros = $this->bd->sql($consulta, null);

            if(empty($registros)) {
                throw new Exception('No existe pago asociado al id deuda');
            }

            $pagos = [];
            for($i=0; $i<count($registros); $i++) {
                $renglon = $registros[0];
                $id = $renglon['id'];
                $idDeuda = $renglon['id_deuda'];
                $fecha = $renglon['fecha'];
                $cedula = $renglon['cedula'];
                $monto = $renglon['monto'];
                $idCuenta = $renglon['id_cuenta'];
                $idTipoPago = $renglon['id_tipo_pago'];
                $ref = $renglon['ref'];
                $valido = $renglon['valido'];
                
                $pag= new Pago($id, $idDeuda, $fecha, $cedula, $monto, 
                                $idCuenta, $idTipoPago, $ref, $valido);
                $pagos[] = $pag;
            }

            return $pagos;
        }

        public function cargar($parametros) {
            //HACER UN LLAMADO A UN PROCEDURE
        }

        public function modificar($parametros) {
            $update =  "UPDATE pago
                        SET  fecha=?, 
                             monto=?,
                             id_cuenta=?,
                             id_tipo_pago=?,
                             ref=?
                        WHERE id=?";
            $this->bd->sql($update, $parametros);
        }

        public function validar($parametros) {
            $update =  "UPDATE pago
                        SET  valido=?
                        WHERE id=?";
            $this->bd->sql($update, $parametros);
        }

        public function eliminar($parametros) {
            try {
                $delete =  "DELETE FROM pago
                            WHERE id=?";
                $this->bd->sql($delete, $parametros);
            }
            catch(PDOException $e) {
                throw new DaoException(DaoException::PAGO, DaoException::ELIMINAR, "Existe alguna dependencia que impide borrar el pago.");
            }
        }

    }
?>