<?php
    include_once('IModificar.php');

    class ModificarRepresentante implements IModificar {
        private $personaDAO;
        private $contactoDAO;
        private $pagina;
        private $objSerializar;

        public function __construct(PersonaDAO $personaDAO, 
                                    ContactoDAO $contactoDAO, 
                                    $pagina,
                                    $objSerializar) {
            $this->personaDAO = $personaDAO;
            $this->contactoDAO = $contactoDAO;
            $this->pagina = $pagina;
            $this->objSerializar = $objSerializar;
        }

        public function modificar($matriz) {
            //Obtener inputs
            $arregloCedula = $matriz[0];
            $cedula = $arregloCedula[0];

            $arregloPersona = $matriz[1];
            $nombreInput = $arregloPersona[0];
            $apellidoInput = $arregloPersona[1];

            $arregloCorreo = $matriz[2];
            $correo = $arregloCorreo[0];
            $idCorreo = $arregloCorreo[2];

            $arregloTelefono = $matriz[3];
            $telefono = $arregloTelefono[0];
            $idTelefono = $arregloTelefono[2];

            //Revisar que se haya introducido algo en el input.
            $persona = $this->personaDAO->getInstancia($arregloCedula);     //instancia persona

            $nombre = $nombreInput=="" ? $persona->getNombre() : $nombreInput;
            $apellido = $apellidoInput=="" ? $persona->getApellido() : $apellidoInput;
            $this->personaDAO->modificar(array($nombre, $apellido, $cedula));   // modifica persona

            $contactos = $this->contactoDAO->getInstancia($arregloCedula);   //arreglo instancias Contactos.

            for($i=0; $i<count($contactos); $i++) {
                $contacto = $contactos[$i];
                $tipoContacto = $contacto->getIdTipo();
                $cont = null;

                if($tipoContacto==1) { //correo
                    $cont = $correo=="" ? $contacto->getContacto() : $correo;
                }
                elseif($tipoContacto==2) {
                    $cont = $telefono=="" ? $contacto->getContacto() : $telefono;
                }

                $this->contactoDAO->modificar(array($cont, $cedula, $tipoContacto));
            }

            $mensaje = new Mensaje(null, true, 'se ha modificado con exito al '.$this->objSerializar);
            mandarMensaje($mensaje, $this->pagina);
        }
    }
?>