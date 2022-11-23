<?php 
     include_once ('IDAO.php');
     include_once (DTO_PATH.'/Contacto.php');

     class ContactoDAO implements IDAO {
        private BaseDeDatos $bd;

        public function __construct(BaseDeDatos $bd) {
            $this->bd = $bd;
        }


        public function getInstancia(array $id) {
            $consulta = "SELECT * 
                        FROM contacto
                        WHERE id=?";
            $registros = $this->bd->sql($consulta, $id);

            if(empty($registros)) {
                throw new Exception('No existe el representante con dicha cedula');
            }

            $contactos = [];
            for($i=0; $i<count($registros); $i++) {
                $contacto = $registros[$i];

                $id = $contacto['id'];
                $cedula = $contacto['cedula'];
                $idTipo = $contacto['id_tipo'];
                $info = $contacto['contacto'];
                
                $cont = new Contacto($id, $cedula, $idTipo,  $info);

                $contactos[] = $cont;
            }
            
            return $contactos;
        }

        public function getInstanciaCedula(array $cedula) {
            $consulta = "SELECT * 
                        FROM contacto
                        WHERE cedula=?";
            $registros = $this->bd->sql($consulta, $cedula);

            if(empty($registros)) {
                throw new Exception('No existe el representante con dicha cedula');
            }

            $contactos = [];
            for($i=0; $i<count($registros); $i++) {
                $contacto = $registros[$i];

                $id = $contacto['id'];
                $cedula = $contacto['cedula'];
                $idTipo = $contacto['id_tipo'];
                $info = $contacto['contacto'];
                
                $cont = new Contacto($id, $cedula, $idTipo,  $info);

                $contactos[] = $cont;
            }
            
            return $contactos;
        }
        
        public function getTodos() {
            $consulta = "SELECT * 
                        FROM contacto";
            $registros = $this->bd->sql($consulta, null);

            if(empty($registros)) {
                throw new Exception('No existe el representante con dicha cedula');
            }

            $contactos = [];
            for($i=0; $i<count($registros); $i++) {
                $contacto = $registros[$i];

                $id = $contacto['id'];
                $cedula = $contacto['cedula'];
                $idTipo = $contacto['id_tipo'];
                $info = $contacto['contacto'];
                
                $cont = new Contacto($id, $cedula, $idTipo,  $info);

                $contactos[] = $cont;
            }
            
            return $contactos;
        }

        public function cantidadContactos(array $cedula) {
            $consulta = "SELECT *
                        FROM v_cantidad_contactos
                        WHERE cedula=?";
            $contactos = $this->bd->sql($consulta, $cedula);

            $contacto = $contactos[0];
            $cantidad = $contacto['cantidad'];
            return $cantidad;
        }

        public function cargar(array $parametros) {
            $insert = "INSERT INTO contacto (cedula, id_tipo, contacto)
                       VALUES               (?,      ?,       ?)";
            $this->bd->sql($insert, $parametros);
        }

        public function modificar(array $id) {
            $update = " UPDATE contacto
                        SET contacto=?
                        WHERE id=?";
            $this->bd->sql($update, $parametros);
        }

        public function eliminar(array $id) {
            $delete=   " DELETE FROM contacto
                        WHERE id=?";
            $this->bd->sql($delete, $id);
        }

        public function eliminarPorCedula(array $cedula) {
            $delete=   " DELETE FROM contacto
                        WHERE cedula=?;";
            $this->bd->sql($delete, $cedula);
        }

    }
?>