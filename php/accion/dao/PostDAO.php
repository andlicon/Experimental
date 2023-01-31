<?php
    include_once('BaseDeDatos.php');
    include_once ('IDAO.php');
    include_once(DTO_PATH.'/Post.php');

    class PostDAO implements IDAO {
        private $bd;

        public function __construct(BaseDeDatos $bd) {
            $this->bd = $bd;
        }

        public function getInstancia(array $id) {
            $consulta = "SELECT * 
                        FROM    post
                        WHERE   id=?
                        ORDER BY fecha;";
            $registros = $this->bd->sql($consulta, $id);

            if(empty($registros)) {
                throw new Exception('No existe post asociado al id.');
            }

            $posts = [];
            for($i=0; $i<count($registros); $i++) {
                $renglon = $registros[$i];

                $id = $renglon['id'];
                $autor = $renglon['autor'];
                $fecha = $renglon['fecha'];
                $destinatario = $renglon['tipo_persona_destino'];
                $titulo = $renglon['titulo'];
                $contenido = $renglon['contenido'];
                
                $pag= new Pago($id, $idDeuda, $fecha, $cedula, $monto, 
                                $idCuenta, $idTipoPago, $ref, $valido);
                $posts[] = $pag;
            }

            return $posts;
        }

        public function getTodos() {
            $consulta = "SELECT * 
                        FROM    post
                        ORDER BY fecha;";
            $registros = $this->bd->sql($consulta, null);

            if(empty($registros)) {
                throw new Exception('No existe pago asociado al id deuda');
            }

            $pagos = [];
            for($i=0; $i<count($registros); $i++) {
                $renglon = $registros[$i];
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

        public function modificar() {}

        public function eliminar() {}

        public function cargar() {}

    }
?>