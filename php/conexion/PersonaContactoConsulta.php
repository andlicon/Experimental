<?php
    include_once('IDAO.php');
    include_once('BaseDeDatos.php');
    include_once('../instancias/Persona.php');
    include_once('../instancias/Contacto.php');

    /*
        Esta clase es un "consultor", junta las tablas:
                                                        *representante
                                                        *persona
                                                        *contacto
                                                        *tipo_contacto

        Todo esto se hace en base a la vista "v_representante_contacto" esta retorna todos los contactos, ya sea de tlf o de correo electornico
    */
    class PersonaContactoConsulta implements IConsultor {
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
                        FROM v_personas
                        WHERE cedula=?";
            $registros = $this->bd->sql($consulta, $cedula);

            if(empty($registros)) {
                throw new Exception('No existe el representante con dicha cedula');
            }

            $personas = [];
            for($i=0; $i<count($registros); $i++) {
                $persona = $registros[$i];

                $cedula = $persona['cedula'];
                $nombre = $persona['nombre'];
                $apellido = $persona['apellido'];
                $idTipoContacto = $persona['id_tipo'];
                $descripcion = $persona['descripcion'];
                $contacto = $persona['contacto'];

                $per = new Persona($cedula, $nombre, $apellido, 
                                    new Contacto($idTipoContacto, $contacto, $descripcion));                       

                $personas[] = $per;
            }

            return $personas;
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
                        FROM v_personas";
            $registros = $this->bd->sql($consulta, null);

            if(empty($registros)) {
                throw new Exception('No existe el representante con dicha cedula');
            }

            $personas = [];
            for($i=0; $i<count($registros); $i++) {
                $persona = $registros[$i];

                $cedula = $persona['cedula'];
                $nombre = $persona['nombre'];
                $apellido = $persona['apellido'];
                $idTipoContacto = $persona['id_tipo'];
                $descripcion = $persona['descripcion'];
                $contacto = $persona['contacto'];

                $per = new Persona($cedula, $nombre, $apellido, 
                                    new Contacto($idTipoContacto, $contacto, $descripcion));                       

                $personas[] = $per;
            }

            return $personas;
         }

    }
    
?>