<?php 
    function crearCedula($nameNacionalidad, $nameCedula) {
        $inputNacionalidad = $_POST[$nameNacionalidad];
        $inputCedula =  $_POST[$nameCedula];
        $cedula = $inputNacionalidad.$inputCedula;
        return $cedula;
    }
?>