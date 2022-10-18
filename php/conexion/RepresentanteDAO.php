<?php
    include_once('IDAO.php');
    include_once('BaseDeDatos.php');
    include_once('../instancias/Representante.php');

    /*
        Implementacion del Data Access Object para los representantes
    */
    class RepresentanteDAO implements IDAO {
        private BaseDeDatos $bd;

        public function __construct(BaseDeDatos $bd) {
            $this->bd = $bd;
        }

        /*
            Consulta a la base de dato por un representante en particular, todo basado en su cedula

            @param  array $cedula arreglo que unicamente debe contener la cedula del representante, si trae mas
                    variables, entonces arrojara error

            @trown Exception No existe el representante

            @return <ul>
                        <li>De existir registro: instancia de representante</li>
                        <li>De no existir registro: NULL</li>
                    </ul>
        */
        public function getInstancia(array $cedula) {
            $consulta = "SELECT * 
                        FROM v_representantes
                        WHERE cedula=?";
            $registros = $this->bd->consultar($consulta, $cedula);
            
            if(empty($registros)) {
                throw new Exception('No existe el representante con dicha cedula');
            }

            $representante = null;
            $registro = $registros[0];
            if ($registro) {
                $cedula = $registro ['cedula'];
                $nombre = $registro ['nombre'];
                $apellido = $registro ['apellido'];
                $correo = $registro ['correo'];

                $representante = new Representante($cedula, $nombre, $apellido, $correo);
            }

            return $representante;
        }

        /*
            Consulta por todos los registros de representantes

            @thrown Exception - Arroja error de no existir registros.

            @return <ul>
                        <li>De existir registro: Array de Representantes</li>
                        <li>De no existir registro: NULL</li>
                    </ul>
        */
        public function getTodos() {
            $consulta = "SELECT * 
                         FROM v_representantes;";
             $registros = $this->bd->consultar($consulta, null);

             if(empty($registros)) {
                throw new Exception('No existen registros de Representante');
            }
            
            $representantes = [];
            for($i=0; $i<count($registros); $i++) {
                $representante = $registros[$i];

                $cedula = $representante['cedula'];
                $nombre = $representante['nombre'];
                $apellido = $representante['apellido'];
                $correo = $representante['correo'];
                $rep = new Representante($cedula, $nombre, $apellido, $correo);

                $representantes[] = $rep;
            }
            
            return $representantes;
         }
    }
    
?>