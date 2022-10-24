<?php 
     include_once ('IDAO.php');
     include_once ('../Instancia/Contacto.php');

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
                
                $cont = new Contacto($cedula, $idTipo, $info);

                $contactos[] = $cont;
            }
            
            return $representantes;
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
                
                $cont = new Contacto($cedula, $idTipo, $info);

                $contactos[] = $cont;
            }
            
            return $representantes;
        }

        public function cargar($parametros) {
            $insert = "INSERT INTO contacto (cedula, id_tipo, contacto)
                       VALUES               (?,      ?,       ?)";
            $this->bd->sql($insert, $parametros);
        }


        
    }
?>