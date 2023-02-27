<?php
    include_once('../rutaAcciones.php');
    include_once(DAO_PATH.'BaseDeDatos.php');
    include_once(DAO_PATH.'DeudaDAO.php');
    include_once(DAO_PATH.'EstudianteDAO.php');
    include_once(DAO_PATH.'MotivoConsul.php');

    $deudaId = $_POST['deudaId'];

    $deudaDAO = new DeudaDAO(BaseDeDatos::getInstancia());
    $resultado = $deudaDAO->getInstancia(array($deudaId));
    $deuda = $resultado[0];

    $cedula = $deuda->getCedula();
    $descripcion = $deuda->getDescripcion();
    $fecha = $deuda->getFecha();
    $montoInicial = $deuda->getMontoInicial();
    $montoEstado = $deuda->getMontoEstado();
    $debe = $deuda->getDeuda();
    $idEstudiante = $deuda->getIdEstudiante();
    $fecha = $deuda->getFecha();
    //motivo
    $motivoConsul = new MotivoConsul(BaseDeDatos::getInstancia());
    $idMotivo = $deuda->getIdMotivo();
    $motivo = $motivoConsul->getInstancia(array($idMotivo))[0]->getDescripcion();
    //estudiante
    $estudianteDAO = new EstudianteDAO(BaseDeDatos::getInstancia());
    $estudiante = $estudianteDAO->getInstancia(array($idEstudiante))[0];
    $nombreEstudiante = $estudiante->getNombre().' '.$estudiante->getApellido();

    $json = array();

    array_push($json, array(
        "id"=>$deudaId,
        "cedula"=>$cedula,
        "descripcion"=>$descripcion,
        "fecha"=>$fecha,
        "montoInicial"=>$montoInicial,
        "montoEstado"=>$montoEstado,
        "debe"=>$debe,
        "motivo"=>$motivo,
        "nombreEstudiante"=>$nombreEstudiante
    ));

    echo json_encode($json);
?>