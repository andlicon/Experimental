<?php 
    function crearCedula() {
        $inputNacionalidad = $_POST['nacionalidad'];
        $inputCedula =  $_POST['cedula'];
        $cedula = $inputNacionalidad.$inputCedula;
        return $cedula;
    }
?>