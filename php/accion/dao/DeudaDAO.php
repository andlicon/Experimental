<?php
    include_once ('IDAO.php');
    include_once(DTO_PATH.'/Deuda.php');
    include_once(DTO_PATH.'/Motivo.php');
    include_once(EXCEPTION_PATH.'/DaoException.php');

    class DeudaDAO implements IDAO {
        private $bd;

        public function __construct(BaseDeDatos $bd) {
            $this->bd = $bd;
        }

        public function getInstancia(array $id) {
            $consulta = "SELECT * 
                        FROM deuda
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
                $idEstudiante = $deuda['id_estudiante'];
                $fecha = $deuda['fecha'];
                $idMotivo = $deuda['id_motivo'];
                $descripcion = $deuda['descripcion'];
                $montoInicial = $deuda['monto_inicial'];
                $montoEstado = $deuda['monto_estado'];
                $deuda = $deuda['deuda'];
                
                $deb= new Deuda($id, $cedula, $idEstudiante, $idMotivo, $descripcion, 
                                $fecha, $montoInicial, $montoEstado, $deuda);
                $deudas[] = $deb;
            }
            
            return $deudas;
        }

        public function getInstanciaCedula($cedula) {
            $consulta = "SELECT * 
                        FROM deuda
                        WHERE cedula_representante=?
                            AND deuda>0
                        ORDER BY fecha,  id_estudiante";
            $registros = $this->bd->sql($consulta, $cedula);

            if(empty($registros)) {
                throw new Exception('No existe deuda asociada con el representante señalado');
            }

            $deudas = [];
            for($i=0; $i<count($registros); $i++) {
                $deuda = $registros[$i];

                $id = $deuda['id'];
                $cedula = $deuda['cedula_representante'];
                $idEstudiante = $deuda['id_estudiante'];
                $fecha = $deuda['fecha'];
                $idMotivo = $deuda['id_motivo'];
                $descripcion = $deuda['descripcion'];
                $montoInicial = $deuda['monto_inicial'];
                $montoEstado = $deuda['monto_estado'];
                $deuda = $deuda['deuda'];
                
                $deb= new Deuda($id, $cedula, $idEstudiante, $idMotivo, $descripcion, 
                                $fecha, $montoInicial, $montoEstado, $deuda);
                $deudas[] = $deb;
            }
            
            return $deudas;
        }

        public function getInstanciaCedulaMotivo($cedula) {
            $consulta = "SELECT * 
                        FROM deuda
                        WHERE cedula_representante = ?
                            AND deuda>0
                            AND id_motivo = ?
                        ORDER BY fecha,  id_estudiante";
            $registros = $this->bd->sql($consulta, $cedula);

            if(empty($registros)) {
                throw new Exception('No existe deuda asociada con el representante señalado');
            }

            $deudas = [];
            for($i=0; $i<count($registros); $i++) {
                $deuda = $registros[$i];

                $id = $deuda['id'];
                $cedula = $deuda['cedula_representante'];
                $idEstudiante = $deuda['id_estudiante'];
                $fecha = $deuda['fecha'];
                $idMotivo = $deuda['id_motivo'];
                $descripcion = $deuda['descripcion'];
                $montoInicial = $deuda['monto_inicial'];
                $montoEstado = $deuda['monto_estado'];
                $deuda = $deuda['deuda'];
                
                $deb= new Deuda($id, $cedula, $idEstudiante, $idMotivo, $descripcion, 
                                $fecha, $montoInicial, $montoEstado, $deuda);
                $deudas[] = $deb;
            }
            
            return $deudas;
        }

        public function getInstanciaCedulaFecha($cedula) {
            $consulta = "SELECT * 
                        FROM deuda
                        WHERE cedula_representante=?
                            AND deuda>0
                            AND YEAR(fecha) = ?
                            AND MONTH(fecha) = ?
                        ORDER BY fecha, id_estudiante";
            $registros = $this->bd->sql($consulta, $cedula);

            if(empty($registros)) {
                throw new Exception('No existe deuda asociada con el representante señalado');
            }

            $deudas = [];
            for($i=0; $i<count($registros); $i++) {
                $deuda = $registros[$i];

                $id = $deuda['id'];
                $cedula = $deuda['cedula_representante'];
                $idEstudiante = $deuda['id_estudiante'];
                $fecha = $deuda['fecha'];
                $idMotivo = $deuda['id_motivo'];
                $descripcion = $deuda['descripcion'];
                $montoInicial = $deuda['monto_inicial'];
                $montoEstado = $deuda['monto_estado'];
                $deuda = $deuda['deuda'];
                
                $deb= new Deuda($id, $cedula, $idEstudiante, $idMotivo, $descripcion, 
                                $fecha, $montoInicial, $montoEstado, $deuda);
                $deudas[] = $deb;
            }
            
            return $deudas;
        }

        public function getInstanciaCedulaFechaMotivo($cedula) {
            $consulta = "SELECT * 
                        FROM deuda
                        WHERE cedula_representante=?
                            AND deuda>0
                            AND YEAR(fecha) = ?
                            AND MONTH(fecha) = ?
                            AND id_motivo = ?
                        ORDER BY fecha, id_estudiante";
            $registros = $this->bd->sql($consulta, $cedula);

            if(empty($registros)) {
                throw new Exception('No existe deuda asociada con el representante señalado');
            }

            $deudas = [];
            for($i=0; $i<count($registros); $i++) {
                $deuda = $registros[$i];

                $id = $deuda['id'];
                $cedula = $deuda['cedula_representante'];
                $idEstudiante = $deuda['id_estudiante'];
                $fecha = $deuda['fecha'];
                $idMotivo = $deuda['id_motivo'];
                $descripcion = $deuda['descripcion'];
                $montoInicial = $deuda['monto_inicial'];
                $montoEstado = $deuda['monto_estado'];
                $deuda = $deuda['deuda'];
                
                $deb= new Deuda($id, $cedula, $idEstudiante, $idMotivo, $descripcion, 
                                $fecha, $montoInicial, $montoEstado, $deuda);
                $deudas[] = $deb;
            }
            
            return $deudas;
        }

        public function getInstanciaEstudiante($idEstudiante) {
            $consulta = "SELECT * 
                        FROM deuda
                        WHERE id_estudiante=?
                                AND deuda>0";
            $registros = $this->bd->sql($consulta, $idEstudiante);

            if(empty($registros)) {
                throw new Exception('No existe deuda alguna a dicho estudiante');
            }

            $deudas = [];
            for($i=0; $i<count($registros); $i++) {
                $deuda = $registros[$i];

                $id = $deuda['id'];
                $cedula = $deuda['cedula_representante'];
                $idEstudiante = $deuda['id_estudiante'];
                $fecha = $deuda['fecha'];
                $idMotivo = $deuda['id_motivo'];
                $descripcion = $deuda['descripcion'];
                $montoInicial = $deuda['monto_inicial'];
                $montoEstado = $deuda['monto_estado'];
                $deuda = $deuda['deuda'];
                
                $deb= new Deuda($id, $cedula, $idEstudiante, $idMotivo, $descripcion, 
                                $fecha, $montoInicial, $montoEstado, $deuda);
                $deudas[] = $deb;
            }
            
            return $deudas;
        }

        public function getInstanciaEstudianteMotivo($idEstudiante) {
            $consulta = "SELECT * 
                        FROM deuda
                        WHERE id_estudiante = ?
                            AND id_motivo = ?
                            AND deuda>0";
            $registros = $this->bd->sql($consulta, $idEstudiante);

            if(empty($registros)) {
                throw new Exception('No existe deuda alguna a dicho estudiante');
            }

            $deudas = [];
            for($i=0; $i<count($registros); $i++) {
                $deuda = $registros[$i];

                $id = $deuda['id'];
                $cedula = $deuda['cedula_representante'];
                $idEstudiante = $deuda['id_estudiante'];
                $fecha = $deuda['fecha'];
                $idMotivo = $deuda['id_motivo'];
                $descripcion = $deuda['descripcion'];
                $montoInicial = $deuda['monto_inicial'];
                $montoEstado = $deuda['monto_estado'];
                $deuda = $deuda['deuda'];
                
                $deb= new Deuda($id, $cedula, $idEstudiante, $idMotivo, $descripcion, 
                                $fecha, $montoInicial, $montoEstado, $deuda);
                $deudas[] = $deb;
            }
            
            return $deudas;
        }

        public function getInstanciaEstudianteFecha($idEstudiante) {
            $consulta = "SELECT * 
                        FROM deuda
                        WHERE id_estudiante=?
                            AND YEAR(fecha) = ?
                            AND MONTH(fecha) = ?
                                AND deuda>0";
            $registros = $this->bd->sql($consulta, $idEstudiante);

            if(empty($registros)) {
                throw new Exception('No existe deuda alguna a dicho estudiante');
            }

            $deudas = [];
            for($i=0; $i<count($registros); $i++) {
                $deuda = $registros[$i];

                $id = $deuda['id'];
                $cedula = $deuda['cedula_representante'];
                $idEstudiante = $deuda['id_estudiante'];
                $fecha = $deuda['fecha'];
                $idMotivo = $deuda['id_motivo'];
                $descripcion = $deuda['descripcion'];
                $montoInicial = $deuda['monto_inicial'];
                $montoEstado = $deuda['monto_estado'];
                $deuda = $deuda['deuda'];
                
                $deb= new Deuda($id, $cedula, $idEstudiante, $idMotivo, $descripcion, 
                                $fecha, $montoInicial, $montoEstado, $deuda);
                $deudas[] = $deb;
            }
            
            return $deudas;
        }

        public function getInstanciaEstudianteFechaMotivo($idEstudiante) {
            $consulta = "SELECT * 
                        FROM deuda
                        WHERE id_estudiante=?
                            AND YEAR(fecha) = ?
                            AND MONTH(fecha) = ?
                            AND id_motivo = ?
                            AND deuda>0";
            $registros = $this->bd->sql($consulta, $idEstudiante);

            if(empty($registros)) {
                throw new Exception('No existe deuda alguna a dicho estudiante');
            }

            $deudas = [];
            for($i=0; $i<count($registros); $i++) {
                $deuda = $registros[$i];

                $id = $deuda['id'];
                $cedula = $deuda['cedula_representante'];
                $idEstudiante = $deuda['id_estudiante'];
                $fecha = $deuda['fecha'];
                $idMotivo = $deuda['id_motivo'];
                $descripcion = $deuda['descripcion'];
                $montoInicial = $deuda['monto_inicial'];
                $montoEstado = $deuda['monto_estado'];
                $deuda = $deuda['deuda'];
                
                $deb= new Deuda($id, $cedula, $idEstudiante, $idMotivo, $descripcion, 
                                $fecha, $montoInicial, $montoEstado, $deuda);
                $deudas[] = $deb;
            }
            
            return $deudas;
        }
        
        public function getTodos() {
            $consulta = "SELECT * 
                        FROM deuda
                        ORDER BY fecha DESC";
            $registros = $this->bd->sql($consulta, null);

            if(empty($registros)) {
                throw new Exception('No existe el representante con dicha cedula');
            }

            $deudas = [];
            for($i=0; $i<count($registros); $i++) {
                $deuda = $registros[$i];

                $id = $deuda['id'];
                $cedula = $deuda['cedula_representante'];
                $idEstudiante = $deuda['id_estudiante'];
                $fecha = $deuda['fecha'];
                $idMotivo = $deuda['id_motivo'];
                $descripcion = $deuda['descripcion'];
                $montoInicial = $deuda['monto_inicial'];
                $montoEstado = $deuda['monto_estado'];
                $deuda = $deuda['deuda'];
                
                $deb= new Deuda($id, $cedula, $idEstudiante, $idMotivo, $descripcion, 
                                $fecha, $montoInicial, $montoEstado, $deuda);
                $deudas[] = $deb;
            }
            
            return $deudas;
        }

        public function getDeudaGeneralCedula($cedula) {
            $consulta = "SELECT * 
                        FROM v_deuda_general
                        WHERE cedula_representante=?";
            $registros = $this->bd->sql($consulta, $cedula);

            if(empty($registros)) {
                throw new Exception('No existen deudas para el representante.');
            }

            $deudas = [];
            for($i=0; $i<count($registros); $i++) {
                $deuda = $registros[$i];

                // $id = $deuda['id'];  No está en la vista
                $cedula = $deuda['cedula_representante'];
                $idEstudiante = $deuda['id_estudiante'];
                $fecha = $deuda['fecha'];
                $idMotivo = $deuda['id_motivo'];
                $descripcion = $deuda['descripcion'];
                $montoInicial = $deuda['monto_inicial'];
                $montoEstado = $deuda['monto_estado'];
                $deuda = $deuda['deuda'];
                
                $deb= new Deuda(null,$cedula, $idEstudiante, $idMotivo, $descripcion, 
                                $fecha, $montoInicial, $montoEstado, $deuda);
                $deudas[] = $deb;
            }
            
            return $deudas;
        }

        public function getDeudaRepEstu($parametros) {
            $consulta = "SELECT * 
                        FROM deuda
                        WHERE cedula_representante=?
                            AND id_estudiante=?
                            AND deuda>0";
            $registros = $this->bd->sql($consulta, $parametros);

            if(empty($registros)) {
                throw new Exception('No existe el representante con dicha cedula');
            }

            $deudas = [];
            for($i=0; $i<count($registros); $i++) {
                $deuda = $registros[$i];

                $id = $deuda['id'];
                $cedula = $deuda['cedula_representante'];
                $idEstudiante = $deuda['id_estudiante'];
                $fecha = $deuda['fecha'];
                $idMotivo = $deuda['id_motivo'];
                $descripcion = $deuda['descripcion'];
                $montoInicial = $deuda['monto_inicial'];
                $montoEstado = $deuda['monto_estado'];
                $deuda = $deuda['deuda'];
                
                $deb= new Deuda($id, $cedula, $idEstudiante, $idMotivo, $descripcion, 
                                $fecha, $montoInicial, $montoEstado, $deuda);
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
                
                $deb= new Deuda(null, $cedula, null, null, 
                                null, $montoInicial, $montoEstado, $deuda);

                $deudas[] = $deb;
            }
            
            return $deudas;
        }

        public function cargar($parametros) {
            $insert = "CALL p_crear_deuda (?, ?, ?, ?, ?, ?);";
            $this->bd->sql($insert, $parametros);
        }

        public function modificar($parametros) {
            $update =  "UPDATE deuda
                        SET id_motivo=?,
                            fecha=?,
                            descripcion=?,
                            monto_inicial=?
                        WHERE id=?";
            $this->bd->sql($update, $parametros);
        }

        public function eliminar($parametros) {
            try {
                $delete =  "DELETE FROM deuda
                            WHERE id=?";
                $this->bd->sql($delete, $parametros);
            }
            catch(PDOException $e) {
                throw new DaoException(DaoException::DEUDA, DaoException::ELIMINAR, "Existe alguna dependencia que impide borrar a la deuda.");
            }
        }

        public function getInstanciaDeudaSaldada() {
            $consulta = "SELECT * 
                        FROM deuda
                        WHERE deuda<=0";
            $registros = $this->bd->sql($consulta, null);

            if(empty($registros)) {
                throw new Exception('No existe ninguna deuda saldada.');
            }

            $deudas = [];
            for($i=0; $i<count($registros); $i++) {
                $deuda = $registros[$i];

                $id = $deuda['id'];
                $cedula = $deuda['cedula_representante'];
                $idEstudiante = $deuda['id_estudiante'];
                $fecha = $deuda['fecha'];
                $idMotivo = $deuda['id_motivo'];
                $descripcion = $deuda['descripcion'];
                $montoInicial = $deuda['monto_inicial'];
                $montoEstado = $deuda['monto_estado'];
                $deuda = $deuda['deuda'];
                
                $deb= new Deuda($id, $cedula, $idEstudiante, $idMotivo, $descripcion, 
                                $fecha, $montoInicial, $montoEstado, $deuda);
                $deudas[] = $deb;
            }
            
            return $deudas;
        }

        public function getInstanciaDeudaSaldadaFecha($fecha) {
            $consulta = "SELECT * 
                        FROM deuda
                        WHERE deuda<=0
                            AND YEAR(fecha) = ?
                            AND MONTH(fecha) = ?";
            $registros = $this->bd->sql($consulta, $fecha);

            if(empty($registros)) {
                throw new Exception('No existe ninguna deuda saldada.');
            }

            $deudas = [];
            for($i=0; $i<count($registros); $i++) {
                $deuda = $registros[$i];

                $id = $deuda['id'];
                $cedula = $deuda['cedula_representante'];
                $idEstudiante = $deuda['id_estudiante'];
                $fecha = $deuda['fecha'];
                $idMotivo = $deuda['id_motivo'];
                $descripcion = $deuda['descripcion'];
                $montoInicial = $deuda['monto_inicial'];
                $montoEstado = $deuda['monto_estado'];
                $deuda = $deuda['deuda'];
                
                $deb= new Deuda($id, $cedula, $idEstudiante, $idMotivo, $descripcion, 
                                $fecha, $montoInicial, $montoEstado, $deuda);
                $deudas[] = $deb;
            }
            
            return $deudas;
        }

        public function getInstanciaDeudaSaldadaMotivo($motivo) {
            $consulta = "SELECT * 
                        FROM deuda
                        WHERE deuda<=0
                            AND id_motivo=?";
            $registros = $this->bd->sql($consulta, $motivo);

            if(empty($registros)) {
                throw new Exception('No existe ninguna deuda saldada.');
            }

            $deudas = [];
            for($i=0; $i<count($registros); $i++) {
                $deuda = $registros[$i];

                $id = $deuda['id'];
                $cedula = $deuda['cedula_representante'];
                $idEstudiante = $deuda['id_estudiante'];
                $fecha = $deuda['fecha'];
                $idMotivo = $deuda['id_motivo'];
                $descripcion = $deuda['descripcion'];
                $montoInicial = $deuda['monto_inicial'];
                $montoEstado = $deuda['monto_estado'];
                $deuda = $deuda['deuda'];
                
                $deb= new Deuda($id, $cedula, $idEstudiante, $idMotivo, $descripcion, 
                                $fecha, $montoInicial, $montoEstado, $deuda);
                $deudas[] = $deb;
            }
            
            return $deudas;
        }

        public function getInstanciaDeudaSaldadaMotivoFecha($motivo) {
            $consulta = "SELECT * 
                        FROM deuda
                        WHERE deuda<=0
                            AND id_motivo=?
                            AND YEAR(fecha) = ?
                            AND MONTH(fecha) = ?";
            $registros = $this->bd->sql($consulta, $motivo);

            if(empty($registros)) {
                throw new Exception('No existe ninguna deuda saldada.');
            }

            $deudas = [];
            for($i=0; $i<count($registros); $i++) {
                $deuda = $registros[$i];

                $id = $deuda['id'];
                $cedula = $deuda['cedula_representante'];
                $idEstudiante = $deuda['id_estudiante'];
                $fecha = $deuda['fecha'];
                $idMotivo = $deuda['id_motivo'];
                $descripcion = $deuda['descripcion'];
                $montoInicial = $deuda['monto_inicial'];
                $montoEstado = $deuda['monto_estado'];
                $deuda = $deuda['deuda'];
                
                $deb= new Deuda($id, $cedula, $idEstudiante, $idMotivo, $descripcion, 
                                $fecha, $montoInicial, $montoEstado, $deuda);
                $deudas[] = $deb;
            }
            
            return $deudas;
        }

        public function getInstanciaDeudaSaldadaCedula($cedula) {
            $consulta = "SELECT * 
                        FROM deuda
                        WHERE cedula_representante=?
                            AND deuda<=0";
            $registros = $this->bd->sql($consulta, $cedula);

            if(empty($registros)) {
                throw new Exception('No existe ninguna deuda saldada.');
            }

            $deudas = [];
            for($i=0; $i<count($registros); $i++) {
                $deuda = $registros[$i];

                $id = $deuda['id'];
                $cedula = $deuda['cedula_representante'];
                $idEstudiante = $deuda['id_estudiante'];
                $fecha = $deuda['fecha'];
                $idMotivo = $deuda['id_motivo'];
                $descripcion = $deuda['descripcion'];
                $montoInicial = $deuda['monto_inicial'];
                $montoEstado = $deuda['monto_estado'];
                $deuda = $deuda['deuda'];
                
                $deb= new Deuda($id, $cedula, $idEstudiante, $idMotivo, $descripcion, 
                                $fecha, $montoInicial, $montoEstado, $deuda);
                $deudas[] = $deb;
            }
            
            return $deudas;
        }

        public function getInstanciaDeudaSaldadaCedulaFecha($cedula) {
            $consulta = "SELECT * 
                        FROM deuda
                        WHERE cedula_representante=?
                            AND deuda<=0
                            AND YEAR(fecha) = ?
                            AND MONTH(fecha) = ?";
            $registros = $this->bd->sql($consulta, $cedula);

            if(empty($registros)) {
                throw new Exception('No existe ninguna deuda saldada.');
            }

            $deudas = [];
            for($i=0; $i<count($registros); $i++) {
                $deuda = $registros[$i];

                $id = $deuda['id'];
                $cedula = $deuda['cedula_representante'];
                $idEstudiante = $deuda['id_estudiante'];
                $fecha = $deuda['fecha'];
                $idMotivo = $deuda['id_motivo'];
                $descripcion = $deuda['descripcion'];
                $montoInicial = $deuda['monto_inicial'];
                $montoEstado = $deuda['monto_estado'];
                $deuda = $deuda['deuda'];
                
                $deb= new Deuda($id, $cedula, $idEstudiante, $idMotivo, $descripcion, 
                                $fecha, $montoInicial, $montoEstado, $deuda);
                $deudas[] = $deb;
            }
            
            return $deudas;
        }

        public function getInstanciaDeudaSaldadaCedulaMotivo($cedula) {
            $consulta = "SELECT * 
                        FROM deuda
                        WHERE cedula_representante=?
                            AND deuda<=0
                            AND id_motivo=?";
            $registros = $this->bd->sql($consulta, $cedula);

            if(empty($registros)) {
                throw new Exception('No existe ninguna deuda saldada.');
            }

            $deudas = [];
            for($i=0; $i<count($registros); $i++) {
                $deuda = $registros[$i];

                $id = $deuda['id'];
                $cedula = $deuda['cedula_representante'];
                $idEstudiante = $deuda['id_estudiante'];
                $fecha = $deuda['fecha'];
                $idMotivo = $deuda['id_motivo'];
                $descripcion = $deuda['descripcion'];
                $montoInicial = $deuda['monto_inicial'];
                $montoEstado = $deuda['monto_estado'];
                $deuda = $deuda['deuda'];
                
                $deb= new Deuda($id, $cedula, $idEstudiante, $idMotivo, $descripcion, 
                                $fecha, $montoInicial, $montoEstado, $deuda);
                $deudas[] = $deb;
            }
            
            return $deudas;
        }

        public function getInstanciaDeudaSaldadaCedulaMotivoFecha($cedula) {
            $consulta = "SELECT * 
                        FROM deuda
                        WHERE cedula_representante=?
                            AND deuda<=0
                            AND id_motivo=?
                            AND YEAR(fecha) = ?
                            AND MONTH(fecha) = ?";
            $registros = $this->bd->sql($consulta, $cedula);

            if(empty($registros)) {
                throw new Exception('No existe ninguna deuda saldada.');
            }

            $deudas = [];
            for($i=0; $i<count($registros); $i++) {
                $deuda = $registros[$i];

                $id = $deuda['id'];
                $cedula = $deuda['cedula_representante'];
                $idEstudiante = $deuda['id_estudiante'];
                $fecha = $deuda['fecha'];
                $idMotivo = $deuda['id_motivo'];
                $descripcion = $deuda['descripcion'];
                $montoInicial = $deuda['monto_inicial'];
                $montoEstado = $deuda['monto_estado'];
                $deuda = $deuda['deuda'];
                
                $deb= new Deuda($id, $cedula, $idEstudiante, $idMotivo, $descripcion, 
                                $fecha, $montoInicial, $montoEstado, $deuda);
                $deudas[] = $deb;
            }
            
            return $deudas;
        }

        public function getInstanciaDeudaVigente() {
            $consulta = "SELECT * 
                        FROM deuda
                        WHERE deuda>0";
            $registros = $this->bd->sql($consulta, null);
            
            if(empty($registros)) {
                throw new Exception('No existe el representante con dicha cedula');
            }

            $deudas = [];
            for($i=0; $i<count($registros); $i++) {
                $deuda = $registros[$i];

                $id = $deuda['id'];
                $cedula = $deuda['cedula_representante'];
                $idEstudiante = $deuda['id_estudiante'];
                $fecha = $deuda['fecha'];
                $idMotivo = $deuda['id_motivo'];
                $descripcion = $deuda['descripcion'];
                $montoInicial = $deuda['monto_inicial'];
                $montoEstado = $deuda['monto_estado'];
                $deuda = $deuda['deuda'];
                
                $deb= new Deuda($id, $cedula, $idEstudiante, $idMotivo, $descripcion, 
                                $fecha, $montoInicial, $montoEstado, $deuda);
                $deudas[] = $deb;
            }
            
            return $deudas;
        }

        public function getInstanciaDeudaVigenteFecha($fecha) {
            $consulta = "SELECT * 
                        FROM deuda
                        WHERE deuda>0
                            AND YEAR(fecha)=?
                            AND MONTH(fecha)=?";
            $registros = $this->bd->sql($consulta, $fecha);
            
            if(empty($registros)) {
                throw new Exception('No existe el representante con dicha cedula');
            }

            $deudas = [];
            for($i=0; $i<count($registros); $i++) {
                $deuda = $registros[$i];

                $id = $deuda['id'];
                $cedula = $deuda['cedula_representante'];
                $idEstudiante = $deuda['id_estudiante'];
                $fecha = $deuda['fecha'];
                $idMotivo = $deuda['id_motivo'];
                $descripcion = $deuda['descripcion'];
                $montoInicial = $deuda['monto_inicial'];
                $montoEstado = $deuda['monto_estado'];
                $deuda = $deuda['deuda'];
                
                $deb= new Deuda($id, $cedula, $idEstudiante, $idMotivo, $descripcion, 
                                $fecha, $montoInicial, $montoEstado, $deuda);
                $deudas[] = $deb;
            }
            
            return $deudas;
        }

        public function getInstanciaDeudaVigenteMotivo($motivo) {
            $consulta = "SELECT * 
                        FROM deuda
                        WHERE deuda>0
                            AND id_motivo=?";
            $registros = $this->bd->sql($consulta, $motivo);
            
            if(empty($registros)) {
                throw new Exception('No existe el representante con dicha cedula');
            }

            $deudas = [];
            for($i=0; $i<count($registros); $i++) {
                $deuda = $registros[$i];

                $id = $deuda['id'];
                $cedula = $deuda['cedula_representante'];
                $idEstudiante = $deuda['id_estudiante'];
                $fecha = $deuda['fecha'];
                $idMotivo = $deuda['id_motivo'];
                $descripcion = $deuda['descripcion'];
                $montoInicial = $deuda['monto_inicial'];
                $montoEstado = $deuda['monto_estado'];
                $deuda = $deuda['deuda'];
                
                $deb= new Deuda($id, $cedula, $idEstudiante, $idMotivo, $descripcion, 
                                $fecha, $montoInicial, $montoEstado, $deuda);
                $deudas[] = $deb;
            }
            
            return $deudas;
        }

        public function getInstanciaDeudaVigenteMotivoFecha($motivo) {
            $consulta = "SELECT * 
                        FROM deuda
                        WHERE deuda>0
                            AND id_motivo=?
                            AND YEAR(fecha) = ?
                            AND MONTH(fecha) = ?";
            $registros = $this->bd->sql($consulta, $motivo);
            
            if(empty($registros)) {
                throw new Exception('No existe el representante con dicha cedula');
            }

            $deudas = [];
            for($i=0; $i<count($registros); $i++) {
                $deuda = $registros[$i];

                $id = $deuda['id'];
                $cedula = $deuda['cedula_representante'];
                $idEstudiante = $deuda['id_estudiante'];
                $fecha = $deuda['fecha'];
                $idMotivo = $deuda['id_motivo'];
                $descripcion = $deuda['descripcion'];
                $montoInicial = $deuda['monto_inicial'];
                $montoEstado = $deuda['monto_estado'];
                $deuda = $deuda['deuda'];
                
                $deb= new Deuda($id, $cedula, $idEstudiante, $idMotivo, $descripcion, 
                                $fecha, $montoInicial, $montoEstado, $deuda);
                $deudas[] = $deb;
            }
            
            return $deudas;
        }

        public function getInstanciaDeudaVigenteCedula($cedula) {
            $consulta = "SELECT * 
                        FROM deuda
                        WHERE cedula_representante=?
                            AND deuda>0";
            $registros = $this->bd->sql($consulta, $cedula);
            
            if(empty($registros)) {
                throw new Exception('No existe el representante con dicha cedula');
            }

            $deudas = [];
            for($i=0; $i<count($registros); $i++) {
                $deuda = $registros[$i];

                $id = $deuda['id'];
                $cedula = $deuda['cedula_representante'];
                $idEstudiante = $deuda['id_estudiante'];
                $fecha = $deuda['fecha'];
                $idMotivo = $deuda['id_motivo'];
                $descripcion = $deuda['descripcion'];
                $montoInicial = $deuda['monto_inicial'];
                $montoEstado = $deuda['monto_estado'];
                $deuda = $deuda['deuda'];
                
                $deb= new Deuda($id, $cedula, $idEstudiante, $idMotivo, $descripcion, 
                                $fecha, $montoInicial, $montoEstado, $deuda);
                $deudas[] = $deb;
            }
            
            return $deudas;
        }

        public function getInstanciaDeudaVigenteCedulaFecha($cedula) {
            $consulta = "SELECT * 
                        FROM deuda
                        WHERE cedula_representante=?
                            AND deuda>0
                            AND YEAR(fecha) = ?
                            AND MONTH(fecha) = ?";
            $registros = $this->bd->sql($consulta, $cedula);
            
            if(empty($registros)) {
                throw new Exception('No existe el representante con dicha cedula');
            }

            $deudas = [];
            for($i=0; $i<count($registros); $i++) {
                $deuda = $registros[$i];

                $id = $deuda['id'];
                $cedula = $deuda['cedula_representante'];
                $idEstudiante = $deuda['id_estudiante'];
                $fecha = $deuda['fecha'];
                $idMotivo = $deuda['id_motivo'];
                $descripcion = $deuda['descripcion'];
                $montoInicial = $deuda['monto_inicial'];
                $montoEstado = $deuda['monto_estado'];
                $deuda = $deuda['deuda'];
                
                $deb= new Deuda($id, $cedula, $idEstudiante, $idMotivo, $descripcion, 
                                $fecha, $montoInicial, $montoEstado, $deuda);
                $deudas[] = $deb;
            }
            
            return $deudas;
        }

        public function getInstanciaDeudaVigenteCedulaMotivo($cedula) {
            $consulta = "SELECT * 
                        FROM deuda
                        WHERE cedula_representante=?
                            AND deuda>0
                            AND id_motivo=?";
            $registros = $this->bd->sql($consulta, $cedula);
            
            if(empty($registros)) {
                throw new Exception('No existe el representante con dicha cedula');
            }

            $deudas = [];
            for($i=0; $i<count($registros); $i++) {
                $deuda = $registros[$i];

                $id = $deuda['id'];
                $cedula = $deuda['cedula_representante'];
                $idEstudiante = $deuda['id_estudiante'];
                $fecha = $deuda['fecha'];
                $idMotivo = $deuda['id_motivo'];
                $descripcion = $deuda['descripcion'];
                $montoInicial = $deuda['monto_inicial'];
                $montoEstado = $deuda['monto_estado'];
                $deuda = $deuda['deuda'];
                
                $deb= new Deuda($id, $cedula, $idEstudiante, $idMotivo, $descripcion, 
                                $fecha, $montoInicial, $montoEstado, $deuda);
                $deudas[] = $deb;
            }
            
            return $deudas;
        }

        public function getInstanciaDeudaVigenteCedulaMotivoFecha($cedula) {
            $consulta = "SELECT * 
                        FROM deuda
                        WHERE cedula_representante=?
                            AND deuda>0
                            AND id_motivo=?
                            AND YEAR(fecha) = ?
                            AND MONTH(fecha) = ?";
            $registros = $this->bd->sql($consulta, $cedula);
            
            if(empty($registros)) {
                throw new Exception('No existe el representante con dicha cedula');
            }

            $deudas = [];
            for($i=0; $i<count($registros); $i++) {
                $deuda = $registros[$i];

                $id = $deuda['id'];
                $cedula = $deuda['cedula_representante'];
                $idEstudiante = $deuda['id_estudiante'];
                $fecha = $deuda['fecha'];
                $idMotivo = $deuda['id_motivo'];
                $descripcion = $deuda['descripcion'];
                $montoInicial = $deuda['monto_inicial'];
                $montoEstado = $deuda['monto_estado'];
                $deuda = $deuda['deuda'];
                
                $deb= new Deuda($id, $cedula, $idEstudiante, $idMotivo, $descripcion, 
                                $fecha, $montoInicial, $montoEstado, $deuda);
                $deudas[] = $deb;
            }
            
            return $deudas;
        }

        public function getInstanciaDeudaTodas() {
            $consulta = "SELECT * 
                        FROM deuda";
            $registros = $this->bd->sql($consulta, null);
            
            if(empty($registros)) {
                throw new Exception('No existe el representante con dicha cedula');
            }

            $deudas = [];
            for($i=0; $i<count($registros); $i++) {
                $deuda = $registros[$i];

                $id = $deuda['id'];
                $cedula = $deuda['cedula_representante'];
                $idEstudiante = $deuda['id_estudiante'];
                $fecha = $deuda['fecha'];
                $idMotivo = $deuda['id_motivo'];
                $descripcion = $deuda['descripcion'];
                $montoInicial = $deuda['monto_inicial'];
                $montoEstado = $deuda['monto_estado'];
                $deuda = $deuda['deuda'];
                
                $deb= new Deuda($id, $cedula, $idEstudiante, $idMotivo, $descripcion, 
                                $fecha, $montoInicial, $montoEstado, $deuda);
                $deudas[] = $deb;
            }
            
            return $deudas;
        }

        public function getInstanciaDeudaTodasFecha($fecha) {
            $consulta = "SELECT * 
                        FROM deuda
                        WHERE YEAR(fecha) = ?
                            AND MONTH(fecha) = ?";
            $registros = $this->bd->sql($consulta, $fecha);
            
            if(empty($registros)) {
                throw new Exception('No existe el representante con dicha cedula');
            }

            $deudas = [];
            for($i=0; $i<count($registros); $i++) {
                $deuda = $registros[$i];

                $id = $deuda['id'];
                $cedula = $deuda['cedula_representante'];
                $idEstudiante = $deuda['id_estudiante'];
                $fecha = $deuda['fecha'];
                $idMotivo = $deuda['id_motivo'];
                $descripcion = $deuda['descripcion'];
                $montoInicial = $deuda['monto_inicial'];
                $montoEstado = $deuda['monto_estado'];
                $deuda = $deuda['deuda'];
                
                $deb= new Deuda($id, $cedula, $idEstudiante, $idMotivo, $descripcion, 
                                $fecha, $montoInicial, $montoEstado, $deuda);
                $deudas[] = $deb;
            }
            
            return $deudas;
        }

        public function getInstanciaDeudaTodasMotivo($motivo) {
            $consulta = "SELECT * 
                        FROM deuda
                        WHERE id_motivo=?";
            $registros = $this->bd->sql($consulta, $motivo);
            
            if(empty($registros)) {
                throw new Exception('No existe el representante con dicha cedula');
            }

            $deudas = [];
            for($i=0; $i<count($registros); $i++) {
                $deuda = $registros[$i];

                $id = $deuda['id'];
                $cedula = $deuda['cedula_representante'];
                $idEstudiante = $deuda['id_estudiante'];
                $fecha = $deuda['fecha'];
                $idMotivo = $deuda['id_motivo'];
                $descripcion = $deuda['descripcion'];
                $montoInicial = $deuda['monto_inicial'];
                $montoEstado = $deuda['monto_estado'];
                $deuda = $deuda['deuda'];
                
                $deb= new Deuda($id, $cedula, $idEstudiante, $idMotivo, $descripcion, 
                                $fecha, $montoInicial, $montoEstado, $deuda);
                $deudas[] = $deb;
            }
            
            return $deudas;
        }

        public function getInstanciaDeudaTodasMotivoFecha($motivo) {
            $consulta = "SELECT * 
                        FROM deuda
                        WHERE id_motivo=?
                            AND YEAR(fecha) = ?
                            AND MONTH(fecha) = ?";
            $registros = $this->bd->sql($consulta, $motivo);
            
            if(empty($registros)) {
                throw new Exception('No existe el representante con dicha cedula');
            }

            $deudas = [];
            for($i=0; $i<count($registros); $i++) {
                $deuda = $registros[$i];

                $id = $deuda['id'];
                $cedula = $deuda['cedula_representante'];
                $idEstudiante = $deuda['id_estudiante'];
                $fecha = $deuda['fecha'];
                $idMotivo = $deuda['id_motivo'];
                $descripcion = $deuda['descripcion'];
                $montoInicial = $deuda['monto_inicial'];
                $montoEstado = $deuda['monto_estado'];
                $deuda = $deuda['deuda'];
                
                $deb= new Deuda($id, $cedula, $idEstudiante, $idMotivo, $descripcion, 
                                $fecha, $montoInicial, $montoEstado, $deuda);
                $deudas[] = $deb;
            }
            
            return $deudas;
        }

        public function getInstanciaDeudaTodasCedula($cedula) {
            $consulta = "SELECT * 
                        FROM deuda
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
                $idEstudiante = $deuda['id_estudiante'];
                $fecha = $deuda['fecha'];
                $idMotivo = $deuda['id_motivo'];
                $descripcion = $deuda['descripcion'];
                $montoInicial = $deuda['monto_inicial'];
                $montoEstado = $deuda['monto_estado'];
                $deuda = $deuda['deuda'];
                
                $deb= new Deuda($id, $cedula, $idEstudiante, $idMotivo, $descripcion, 
                                $fecha, $montoInicial, $montoEstado, $deuda);
                $deudas[] = $deb;
            }
            
            return $deudas;
        }

        public function getInstanciaDeudaTodasCedulaFecha($cedula) {
            $consulta = "SELECT * 
                        FROM deuda
                        WHERE cedula_representante=?
                            AND YEAR(fecha) = ?
                            AND MONTH(fecha) = ?";
            $registros = $this->bd->sql($consulta, $cedula);
            
            if(empty($registros)) {
                throw new Exception('No existe el representante con dicha cedula');
            }

            $deudas = [];
            for($i=0; $i<count($registros); $i++) {
                $deuda = $registros[$i];

                $id = $deuda['id'];
                $cedula = $deuda['cedula_representante'];
                $idEstudiante = $deuda['id_estudiante'];
                $fecha = $deuda['fecha'];
                $idMotivo = $deuda['id_motivo'];
                $descripcion = $deuda['descripcion'];
                $montoInicial = $deuda['monto_inicial'];
                $montoEstado = $deuda['monto_estado'];
                $deuda = $deuda['deuda'];
                
                $deb= new Deuda($id, $cedula, $idEstudiante, $idMotivo, $descripcion, 
                                $fecha, $montoInicial, $montoEstado, $deuda);
                $deudas[] = $deb;
            }
            
            return $deudas;
        }

        public function getInstanciaDeudaTodasCedulaMotivo($cedula) {
            $consulta = "SELECT * 
                        FROM deuda
                        WHERE cedula_representante=?
                            AND id_motivo=?";
            $registros = $this->bd->sql($consulta, $cedula);
            
            if(empty($registros)) {
                throw new Exception('No existe el representante con dicha cedula');
            }

            $deudas = [];
            for($i=0; $i<count($registros); $i++) {
                $deuda = $registros[$i];

                $id = $deuda['id'];
                $cedula = $deuda['cedula_representante'];
                $idEstudiante = $deuda['id_estudiante'];
                $fecha = $deuda['fecha'];
                $idMotivo = $deuda['id_motivo'];
                $descripcion = $deuda['descripcion'];
                $montoInicial = $deuda['monto_inicial'];
                $montoEstado = $deuda['monto_estado'];
                $deuda = $deuda['deuda'];
                
                $deb= new Deuda($id, $cedula, $idEstudiante, $idMotivo, $descripcion, 
                                $fecha, $montoInicial, $montoEstado, $deuda);
                $deudas[] = $deb;
            }
            
            return $deudas;
        }

        public function getInstanciaDeudaTodasCedulaMotivoFecha($cedula) {
            $consulta = "SELECT * 
                        FROM deuda
                        WHERE cedula_representante=?
                            AND id_motivo=?
                            AND YEAR(fecha) = ?
                            AND MONTH(fecha) = ?";
            $registros = $this->bd->sql($consulta, $cedula);
            
            if(empty($registros)) {
                throw new Exception('No existe el representante con dicha cedula');
            }

            $deudas = [];
            for($i=0; $i<count($registros); $i++) {
                $deuda = $registros[$i];

                $id = $deuda['id'];
                $cedula = $deuda['cedula_representante'];
                $idEstudiante = $deuda['id_estudiante'];
                $fecha = $deuda['fecha'];
                $idMotivo = $deuda['id_motivo'];
                $descripcion = $deuda['descripcion'];
                $montoInicial = $deuda['monto_inicial'];
                $montoEstado = $deuda['monto_estado'];
                $deuda = $deuda['deuda'];
                
                $deb= new Deuda($id, $cedula, $idEstudiante, $idMotivo, $descripcion, 
                                $fecha, $montoInicial, $montoEstado, $deuda);
                $deudas[] = $deb;
            }
            
            return $deudas;
        }

        public function getDeficit($fecha) {
            $consulta = "SELECT 	*
                        FROM deuda
                        WHERE YEAR(fecha) = ?
                            AND MONTH(fecha) = ?;";
            $registros = $this->bd->sql($consulta, $fecha);
            
            if(empty($registros)) {
                throw new Exception('No existe el representante con dicha cedula');
            }

            $deudas = [];
            for($i=0; $i<count($registros); $i++) {
                $deuda = $registros[$i];

                $id = $deuda['id'];
                $cedula = $deuda['cedula_representante'];
                $idEstudiante = $deuda['id_estudiante'];
                $fecha = $deuda['fecha'];
                $idMotivo = $deuda['id_motivo'];
                $descripcion = $deuda['descripcion'];
                $montoInicial = $deuda['monto_inicial'];
                $montoEstado = $deuda['monto_estado'];
                $deuda = $deuda['deuda'];
                
                $deb= new Deuda($id, $cedula, $idEstudiante, $idMotivo, $descripcion, 
                                $fecha, $montoInicial, $montoEstado, $deuda);
                $deudas[] = $deb;
            }
            
            return $deudas;
        }

        public function getDeficitHistorico() {
            $consulta = "SELECT 	*
                        FROM deuda
                        ORDER BY cedula_representante, id_estudiante, fecha";
            $registros = $this->bd->sql($consulta, null);
            
            if(empty($registros)) {
                throw new Exception('No existe el representante con dicha cedula');
            }

            $deudas = [];
            for($i=0; $i<count($registros); $i++) {
                $deuda = $registros[$i];

                $id = $deuda['id'];
                $cedula = $deuda['cedula_representante'];
                $idEstudiante = $deuda['id_estudiante'];
                $fecha = $deuda['fecha'];
                $idMotivo = $deuda['id_motivo'];
                $descripcion = $deuda['descripcion'];
                $montoInicial = $deuda['monto_inicial'];
                $montoEstado = $deuda['monto_estado'];
                $deuda = $deuda['deuda'];
                
                $deb= new Deuda($id, $cedula, $idEstudiante, $idMotivo, $descripcion, 
                                $fecha, $montoInicial, $montoEstado, $deuda);
                $deudas[] = $deb;
            }
            
            return $deudas;
        }

        public function getDeficitDetalladoDeudor($fecha) {
            $consulta = "SELECT id,
                                cedula_representante,
                                id_estudiante,
                                fecha,
                                descripcion,
                                id_motivo,
                                SUM(monto_inicial) AS monto_inicial,
                                SUM(monto_estado) AS monto_estado,
                                SUM(deuda) AS deuda
                        FROM deuda
                        WHERE YEAR(fecha) = ?
                            AND MONTH(fecha) = ?
                            AND deuda>0
                        GROUP BY cedula_representante, id_estudiante
                        ORDER BY cedula_representante;";
            $registros = $this->bd->sql($consulta, $fecha);
            
            if(empty($registros)) {
                throw new Exception('No existe el representante con dicha cedula');
            }

            $deudas = [];
            for($i=0; $i<count($registros); $i++) {
                $deuda = $registros[$i];

                $id = $deuda['id'];
                $cedula = $deuda['cedula_representante'];
                $idEstudiante = $deuda['id_estudiante'];
                $fecha = $deuda['fecha'];
                $idMotivo = $deuda['id_motivo'];
                $descripcion = $deuda['descripcion'];
                $montoInicial = $deuda['monto_inicial'];
                $montoEstado = $deuda['monto_estado'];
                $deuda = $deuda['deuda'];
                
                $deb= new Deuda($id, $cedula, $idEstudiante, $idMotivo, $descripcion, 
                                $fecha, $montoInicial, $montoEstado, $deuda);
                $deudas[] = $deb;
            }
            
            return $deudas;
        }

        public function getDeficitDetalladoHistorico() {
            $consulta = "SELECT 	id,
                                    cedula_representante,
                                    id_estudiante,
                                    fecha,
                                    descripcion,
                                    id_motivo,
                                    SUM(monto_inicial) AS monto_inicial,
                                    SUM(monto_estado) AS monto_estado,
                                    SUM(deuda) AS deuda
                        FROM deuda
                        WHERE deuda>0
                        GROUP BY cedula_representante, id_estudiante
                        ORDER BY cedula_representante;";
            $registros = $this->bd->sql($consulta, null);
            
            if(empty($registros)) {
                throw new Exception('No existe el representante con dicha cedula');
            }

            $deudas = [];
            for($i=0; $i<count($registros); $i++) {
                $deuda = $registros[$i];

                $id = $deuda['id'];
                $cedula = $deuda['cedula_representante'];
                $idEstudiante = $deuda['id_estudiante'];
                $fecha = $deuda['fecha'];
                $idMotivo = $deuda['id_motivo'];
                $descripcion = $deuda['descripcion'];
                $montoInicial = $deuda['monto_inicial'];
                $montoEstado = $deuda['monto_estado'];
                $deuda = $deuda['deuda'];
                
                $deb= new Deuda($id, $cedula, $idEstudiante, $idMotivo, $descripcion, 
                                $fecha, $montoInicial, $montoEstado, $deuda);
                $deudas[] = $deb;
            }
            
            return $deudas;
        }



    }
?>