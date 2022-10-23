<?php 
    function crearCedula() {
        $nacionalidad = $_POST['nacionalidadInput'];
        $cedula = $_POST['cedulaInput'];
        $cedula = $nacionalidad.$cedula;
        return $cedula;
    }
?>