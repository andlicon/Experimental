<?php
    include_once('IConsultor.php');
    include_once('BaseDeDatos.php');
    include_once('../instancias/Profesor.php');
    include_once('../instancias/Clase.php');


    /*
        Esta clase es un "consultor", junta las tablas:


        Todo esto se hace en base a la vista "v_representante_contacto" esta retorna todos los contactos, ya sea de tlf o de correo electornico
    */
    class ProfesorConsulta implements IConsultor {
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
                        <li>De existir registro: arreglo de representante</li>
                        <li>De no existir registro: NULL</li>
                    </ul> 
        */
        public function getInstancia(array $cedula) {
            $consulta = "SELECT * 
                        FROM v_profesores
                        WHERE cedula=?";
            $registros = $this->bd->sql($consulta, $cedula);

            if(empty($registros)) {
                throw new Exception('No existe el representante con dicha cedula');
            }

            $profesores = [];
            for($i=0; $i<count($registros); $i++) {
                $profesor = $registros[$i];

                $cedula = $profesor['cedula'];
                $nombre = $profesor['nombre'];
                $apellido = $profesor['apellido'];
                /*Info de la clase*/
                $claseId = $profesor['id_clase'];
                $claseDescrip = $profesor['descrip_clase'];
                $claseSalon = $profesor['salon'];
                $clase = new Clase($claseId, $claseDescrip, $claseSalon, $cedula);

                $prof = new Profesor($cedula, $nombre, $apellido, null, $clase);                       

                $profesores[] = $prof;
            }

            return $profesores;
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
                        FROM v_profesores";
            $registros = $this->bd->sql($consulta, null);

            if(empty($registros)) {
                throw new Exception('No existe el representante con dicha cedula');
            }

            $profesores = [];
            for($i=0; $i<count($registros); $i++) {
                $profesor = $registros[$i];

                $cedula = $profesor['cedula'];
                $nombre = $profesor['nombre'];
                $apellido = $profesor['apellido'];
                /*Info de la clase*/
                $claseId = $profesor['id_clase'];
                $claseDescrip = $profesor['descrip_clase'];
                $claseSalon = $profesor['salon'];
                $clase = new Clase($claseId, $claseDescrip, $claseSalon, $cedula);

                $prof = new Profesor($cedula, $nombre, $apellido, null, $clase);                       

                $profesores[] = $prof;
            }

            return $profesores;
         }

    }
    
?>