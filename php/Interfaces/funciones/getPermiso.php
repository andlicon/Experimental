<?php
    include_once(DAO_PATH.'PersonaDAO.php');
    include_once(DAO_PATH.'TipoPersonaConsul.php');
    include_once(DTO_PATH.'Persona.php');

    function getPermiso($usuario) {
        $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');

        $cedula = $usuario->getCedula();

        $personaDAO = new PersonaDAO($bd);
        $personas = $personaDAO->getInstancia(array($cedula));
        $persona = $personas[0];
        $idPersona = $persona->getIdTipoPersona();
        
        $tipoPersonaConsul = new TipoPersonaConsul($bd);
        $tiposPersonas = $tipoPersonaConsul->getInstancia(array($idPersona));
        $tipoPersona = $tiposPersonas[0];
        $permiso = $tipoPersona->getPermiso();

        return $permiso;
    }
?>