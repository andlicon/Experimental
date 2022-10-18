<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <!-- Interfaz para consultar por un representante-->
    <form class="interfaz interfaz--visible" method="POST">
        <label for="selector" class="formulario__label">Nacionalidad:</label>
        <select class="selector" id="selector" name="nacionalidad">
            <option selected class="selector__option">V-</option>
            <option class="selector__option">E-</option>
        </select>
        <label for="cedula" class="formulario__label">Cedula:</label>
        <input type="text" class="formulario__input" id="cedula" name="cedula" required onkeypress='return (event.charCode >= 48 && event.charCode <= 57)' required>
        <input type="submit" class="formulario__boton" value="buscar" name="buscar">
    </form>
</body>
</html>

<?php
    include_once('botonBuscar.php');
?>