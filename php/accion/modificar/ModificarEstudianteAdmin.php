<?php
    include_once('../rutaAcciones.php');
    include_once(DAO_PATH.'/BaseDeDatos.php');
    include_once(DAO_PATH.'/EstudianteDAO.php');

    if(isset($_POST['id']) && isset($_POST['nombre']) && isset($_POST['apellido'])
    && isset($_POST['fecha']) && isset($_POST['clase']) && isset($_POST['valido'])
    && isset($_POST['lugarNacimiento'])) {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $fecha = $_POST['fecha'];
        $clase = $_POST['clase'];
        $valido = $_POST['valido'] == 1 ? true : false;
        $lugarNacimiento = $_POST['lugarNacimiento'];

        $estudianteDAO = new EstudianteDAO(BaseDeDatos::getInstancia());
        $estudianteDAO->modificarAdmin(array($nombre, $apellido, $fecha, 
                                        $clase, $valido, $lugarNacimiento, $id));

        echo "true";
    }
?>