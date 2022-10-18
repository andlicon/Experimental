<!DOCTYPE html>
<html lang="en" class="interfaz-contenedor">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="displayInterfaz.js" type="text/javascript"></script>

    <title>Padre-Responsable</title>

    <link rel="stylesheet" href="/css/main.css">
</head>
<body class="div--centrador">
    <div class="interfaz interfaz--main interfaz--visible">
        <h2 class="interfaz__titulo">Representante</h2>
        
        <button class="interfaz__boton" onClick="displayInterfaz(1)">Consultar</button>
        <button class="interfaz__boton" onClick="displayInterfaz(2)">Cargar</button>
        <button class="interfaz__boton" onClick="displayInterfaz(3)">Modificar</button>
        <button class="interfaz__boton" onClick="displayInterfaz(4)">Eliminar</button>
    </div>

    <!-- Interfaz para consultar por un representante-->
    <form class="interfaz interfaz--invisible" method="POST">
        <label for="selector" class="formulario__label">Nacionalidad:</label>
        <select class="selector" id="selector" name="nacionalidad">
            <option selected class="selector__option">V-</option>
            <option class="selector__option">E-</option>
        </select>
        <label for="cedula" class="formulario__label">Cedula:</label>
        <input type="text" class="formulario__input" id="cedula" name="cedula" required onkeypress='return (event.charCode >= 48 && event.charCode <= 57)' required>
        <input type="submit" class="formulario__boton" value="buscar" name="buscar">
        <button class="formulario__boton" onClick="displayInterfaz(0)">Volver</button>
    </form>
</body>
</html>
</body>
</html>

<?php
    include_once('botonBuscar.php');
?>