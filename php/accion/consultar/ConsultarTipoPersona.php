<?php
    include_once('../rutaAcciones.php');
    include_once(DAO_PATH.'/BaseDeDatos.php');
    include_once(DAO_PATH.'/TipoPersonaConsul.php');

    $json = array();

    $tipoPersonaConsul = new TipoPersonaConsul(BaseDeDatos::getInstancia());
    $registros = $tipoPersonaConsul->getTodos();
    
    $tiposPersonas = [];
    for($i=0; $i<count($registros); $i++) {
        $tipoPersona = $registros[$i];
        $idTipo = $tipoPersona->getId();
        $descripcionTipo = $tipoPersona->getDescripcion();
        array_push($json, array(
                                "id"=>$idTipo,
                                "descripcion"=>$descripcionTipo
                            ));
    }

    echo json_encode($json);
?>