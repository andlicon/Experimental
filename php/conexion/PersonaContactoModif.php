<?php
    include_once('IModificador.php');

    class PersonaContactoModif implements IModificador{
        private PersonaDAO $personaDAO;
        private ContactoDAO $contactoDAO;

        
        public function __construct(PersonaDAO $personaDAO, ContactoDAO $contactoDAO) {
            $this->personaDAO = $personaDAO;
            $this->contactoDAO = $contactoDAO;
        }

        /*

         */
        public function cargar($matriz) {
            $arregloPersona = $matriz[0];
            $this->personaDAO->cargar($arregloPersona);

            $arregloContacto = $matriz[1];
            $this->contactoDAO->cargar($arregloContacto);
        }

        public function modificar($matriz) {
            //Obtener inputs
            $arregloCedula = $matriz[0];
            $cedula = $arregloCedula[0];
    
            $arregloPersona = $matriz[1];
            $nombreInput = $arregloPersona[1];
            $apellidoInput = $arregloPersona[2];
            $esRepresentante = $arregloPersona[3];
    
            $arregloCorreo = $matriz[2];
            $correoInput = $arregloCorreo[2];

            $arregloTelefono = $matriz[3];
            $telefonoInput = $arregloTelefono[2];

            $persona = $this->personaDAO->getInstancia($arregloCedula);     //instancia persona
    
            $nombre = $nombreInput=="" ? $persona->getNombre() : $nombreInput;
            $apellido = $apellidoInput=="" ? $persona->getApellido() : $apellidoInput;
            $this->personaDAO->modificar(array($nombre, $apellido, $cedula, $esRepresentante));   // modifica persona
    
            $contactos = $this->contactoDAO->getInstancia($arregloCedula);   //arreglo instancias Contactos.
    
            for($i=0; $i<count($contactos); $i++) {
                $contacto = $contactos[$i];
                $tipoContacto = $contacto->getIdTipo();
                $cont = null;
            
                if($tipoContacto==1) { //correo
                    $cont = $correoInput=="" ? $contacto->getContacto() : $correoInput;
                }
                elseif($tipoContacto==2) {  //telefono
                    $cont = $telefono=="" ? $contacto->getContacto() : $telefono;
                }
    
                $this->contactoDAO->modificar(array($cont, $cedula, $tipoContacto));
            }
    
            $mensaje = new Mensaje(null, true, 'se ha modificado con exito al '.$this->objSerializar);
            mandarMensaje($mensaje, $this->pagina);
        }

        public function eliminar($parametros) {
            $delete =  "DELETE FROM representante
                        WHERE cedula_representante=?";
            $this->bd->sql($delete, $parametros);
        }
    }
?>