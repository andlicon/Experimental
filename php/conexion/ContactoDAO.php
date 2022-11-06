<?php 
     include_once ('IDAO.php');
     include_once ('../Instancias/Contacto.php');

     class ContactoDAO implements IDAO {
        private BaseDeDatos $bd;

        public function __construct(BaseDeDatos $bd) {
            $this->bd = $bd;
        }


        public function getInstancia(array $cedula) {
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

                $cedula = $contacto['cedula'];
                $idTipo = $contacto['id_tipo'];
                $info = $contacto['contacto'];
                
                $cont = new Contacto($cedula, $idTipo, null, $info);

                $contactos[] = $cont;
            }
            
            return $contactos;
        }
        
        public function getTodos() {
            $consulta = "SELECT * 
                        FROM contacto";
            $registros = $this->bd->sql($consulta, $cedula);

            if(empty($registros)) {
                throw new Exception('No existe el representante con dicha cedula');
            }

            $contactos = [];
            for($i=0; $i<count($registros); $i++) {
                $contacto = $registros[$i];

                $cedula = $contacto['cedula'];
                $idTipo = $contacto['id_tipo'];
                $info = $contacto['contacto'];
                
                $cont = new Contacto($cedula, $idTipo, null, $info);

                $contactos[] = $cont;
            }
            
            return $representantes;
        }

        public function cantidadContactos(array $parametros) {
            $consulta = "SELECT *
                        FROM v_cantidad_contactos
                        WHERE cedula=?";
            $contactos = $this->bd->sql($consulta, $parametros);

            $contacto = $contactos[0];
            $cantidad = $contacto['cantidad'];
            return $cantidad;
        }

        public function cargar(array $parametros) {
            $insert = "INSERT INTO contacto (cedula, id_tipo, contacto)
                       VALUES               (?,      ?,       ?)";
            echo 'Se insertaran los valores '.$parametros[0].' '.$parametros[1].' '.$parametros[2];
            $this->bd->sql($insert, $parametros);
        }

        public function modificar(array $parametros) {
            $update = " UPDATE contacto
                        SET contacto=?
                        WHERE cedula=? AND id_tipo=?;";
            $this->bd->sql($update, $parametros);
        }

        public function eliminar(array $parametros) {
            $delete=   " DELETE FROM contacto
                        WHERE cedula=? AND id_tipo=?;";
            $this->bd->sql($delete, $parametros);
        }

    }
?>