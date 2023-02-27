<?php
    include_once(POP_PATH.'GenerarPopOver.php');

    class RepresentantePop extends GenerarPopOver {

        public function __construct(PersonaDAO $personaDAO) {
            parent::__construct($personaDAO);
        }

        public function generarPop($val, $id) {
            $resultado = $this->consultor->getInstancia(array($val));
            $persona = $resultado[0];
            $cedula = $persona->getCedula();
            $nombre = $persona->getNombre();
            $apellido = $persona->getApellido();
            $direccionHogar = $persona->getDireccionHogar();
            $direccionTrabajo = $persona->getDIreccionTrabajo();

            $telefono;
            $correo;
            //Ahora su contacto
            $contactoDAO = new ContactoDAO(BaseDeDatos::getInstancia());
            $cont = $contactoDAO->getInstanciaCedula(array($cedula));
            $telefono = $cont[1]->getContacto();
            $correo = $cont[0]->getContacto();

            $popOver = 
            "<div class=\"popOver modificable modificable--estado$id\">
                <a id=\"cedula$id\" href=\"#ex$cedula\" rel=\"modal:open\" class=\"popOver__trigger\">$cedula</p>
                <div id=\"ex$cedula\" class=\"modal\">";
                    
            $popOver = $popOver.
            "       <h4 class=\"popOver__informacion popOver__elemento\">Informacion Representante</h4>
                    <p class=\"popOver__elemento\"><span class=\"negrita\">Cedula:</span> $val</p>
                    <p class=\"popOver__elemento\"><span class=\"negrita\">Nombre:</span> $nombre</p>
                    <p class=\"popOver__elemento\"><span class=\"negrita\">Apellido:</span> $apellido</p>
                    <p class=\"popOver__elemento\"><span class=\"negrita\">Direccion hogar:</span> $direccionHogar</p>
                    <p class=\"popOver__elemento\"><span class=\"negrita\">Direccion trabajo:</span> $direccionTrabajo</p>
                    <h4 class=\"popOver__informacion popOver__elemento\">Informacion Contacto</h4>
                    <p class=\"popOver__elemento\"><span class=\"negrita\">Telefóno:</span> $telefono</p>
                    <p class=\"popOver__elemento\"><span class=\"negrita\">Correo:</span> $correo</p>
                </div>
            </div>";


            return $popOver;
        }
    }

?>