<?php
    include_once ('IDAO.php');
    include_once('../instancias/Deuda.php');
    include_once('../instancias/Motivo.php');

    class DeudaDAO implements IDAO {
        private $bd;

        public function __construct(BaseDeDatos $bd) {
            $this->bd = $bd;
        }

        public function getInstancia(array $id) {
            $consulta = "SELECT * 
                        FROM v_deuda
                        WHERE id=?";
            $registros = $this->bd->sql($consulta, $id);

            if(empty($registros)) {
                throw new Exception('No existe el representante con dicha cedula');
            }

            $deudas = [];
            for($i=0; $i<count($registros); $i++) {
                $deuda = $registros[$i];

                $id = $deuda['id'];
                $cedula = $deuda['cedula_representante'];
                $fecha = $deuda['fecha'];
                $idMotivo = $deuda['id_motivo'];
                $descripMotivo = $deuda['motivo_descripcion'];
                $descripDeuda = $deuda['deuda_descripcion'];
                $montoInicial = $deuda['monto_inicial'];
                $montoEstado = $deuda['monto_estado'];
                $deuda = $deuda['deuda'];
                
                $motivo = new Motivo($idMotivo, $descripMotivo);
                $deb= new Deuda($id, $cedula, $motivo, $descripDeuda, 
                                $fecha, $montoInicial, $montoEstado, $deuda);
                $deudas[] = $deb;
            }
            
            return $deudas;
        }

        public function getInstanciaCedula($cedula) {
            $consulta = "SELECT * 
                        FROM v_deuda
                        WHERE cedula_representante=?";
            $registros = $this->bd->sql($consulta, $cedula);

            if(empty($registros)) {
                throw new Exception('No existe el representante con dicha cedula');
            }

            $deudas = [];
            for($i=0; $i<count($registros); $i++) {
                $deuda = $registros[$i];

                $id = $deuda['id'];
                $cedula = $deuda['cedula_representante'];
                $fecha = $deuda['fecha'];
                $idMotivo = $deuda['id_motivo'];
                $descripMotivo = $deuda['motivo_descripcion'];
                $descripDeuda = $deuda['deuda_descripcion'];
                $montoInicial = $deuda['monto_inicial'];
                $montoEstado = $deuda['monto_estado'];
                $deuda = $deuda['deuda'];
                
                $motivo = new Motivo($idMotivo, $descripMotivo);
                $deb= new Deuda($id, $cedula, $motivo, $descripDeuda, 
                                $fecha, $montoInicial, $montoEstado, $deuda);
                $deudas[] = $deb;
            }
            
            return $deudas;
        }
        
        public function getTodos() {
            $consulta = "SELECT * 
                        FROM v_deuda";
            $registros = $this->bd->sql($consulta, $cedula);

            if(empty($registros)) {
                throw new Exception('No existe el representante con dicha cedula');
            }

            $deudas = [];
            for($i=0; $i<count($registros); $i++) {
                $deuda = $registros[$i];

                $id = $deuda['id'];
                $cedula = $deuda['cedula_representante'];
                $idMotivo = $deuda['id_motivo'];
                $descripMotivo = $deuda['descripcion'];
                $fecha = $deuda['fecha'];
                $debe = $deuda['debe'];
                
                $motivo = new Motivo($idMotivo, $descripMotivo);
                $deb= new Deuda($id, $cedula, $motivo, $fecha, $debe);

                $deudas[] = $deb;
            }
            
            return $deudas;
        }

        public function getDeudores() {
            $consulta = "SELECT * 
                        FROM v_deudores";
            $registros = $this->bd->sql($consulta, $cedula);

            if(empty($registros)) {
                throw new Exception('No existen representantes deudores');
            }

            $deudas = [];
            for($i=0; $i<count($registros); $i++) {
                $deuda = $registros[$i];


                $cedula = $deuda['cedula_representante'];
                $montoInicial = $deuda['monto_inicial'];
                $montoEstado = $deuda['monto_estado'];
                $deuda = $deuda['deuda'];
                
                $motivo = new Motivo(null, null);
                $deb= new Deuda(null, $cedula, $motivo, null, 
                                null, $montoInicial, $montoEstado, $deuda);

                $deudas[] = $deb;
            }
            
            return $deudas;
        }

        public function cargar($parametros) {
            $insert = "INSERT INTO deuda    (cedula_representante,  id_motivo,  fecha,  descripcion,    monto_inicial) 
                        VALUES              (?,                     ?,          ?,      ?,              ?)";
            $this->bd->sql($insert, $parametros);
        }

        public function modificar($parametros) {
            $update =  "UPDATE deuda
                        SET cedula_representante=?, 
                            id_motivo=?,
                            fecha=?,
                            descripcion=?,
                            monto_inicial=?
                        WHERE id=?";
            $this->bd->sql($update, $parametros);
        }

        public function eliminar($parametros) {
            $delete =  "DELETE FROM deuda
                        WHERE id=?";
            $this->bd->sql($delete, $parametros);
        }

    }
?>