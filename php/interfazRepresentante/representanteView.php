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
        
        <button class="interfaz__boton" onClick="displayInterfaz(1)">Consultar por cedula</button>
        <button class="interfaz__boton" onClick="displayInterfaz(2)">Consultar todos</button>
        <button class="interfaz__boton" onClick="displayInterfaz(3)">Cargar</button>
        <button class="interfaz__boton" onClick="displayInterfaz(4)">Modificar</button>
        <button class="interfaz__boton" onClick="displayInterfaz(5)">Eliminar</button>
    </div>

    <!-- Interfaz para consultar por un representante-->
    <form class="interfaz interfaz--invisible" method="POST">
        <label for="selector_nacionalidad_consulta" class="formulario__label">Nacionalidad:</label>
        <select class="selector" id="selector_nacionalidad_consulta" name="nacionalidad-consulta">
            <option selected class="selector__option">V-</option>
            <option class="selector__option">E-</option>
        </select>
        <label for="cedula_consulta" class="formulario__label">Cedula:</label>
        <input type="text" class="formulario__input" id="cedula_consulta" name="cedula-consulta" required onkeypress='return (event.charCode >= 48 && event.charCode <= 57)' required>
        <input type="submit" class="formulario__boton" value="consultar" name="consultarInstancia">
        <button class="formulario__boton" onClick="displayInterfaz(0)">Volver</button>
    </form>

    <!-- Interfaz para consultar por TODOS los representantes -->
    <form class="interfaz interfaz--invisible" method="POST">
        <input type="submit" class="formulario__boton" value="consultar" name="consultarTodos">
        <button class="formulario__boton" onClick="displayInterfaz(0)">Volver</button>
    </form>

    <!-- Interfaz para cargar un representante a la base de dato  -->
    <form class="interfaz interfaz--invisible" method="POST">
        <label for="selector-nacionalidad-cargar" class="formulario__label">Nacionalidad:</label>
        <select class="selector" id="selector-nacionalidad-cargar" name="nacionalidad-cargar" required>
            <option selected class="selector__option">V-</option>
            <option class="selector__option">E-</option>
        </select>
        <label for="cedula-cargar" class="formulario__label">Cedula:</label>
        <input type="text" class="formulario__input" id="cedula-cargar" name="cedula-cargar" required onkeypress='return (event.charCode >= 48 && event.charCode <= 57)' required>
        <label for="nombre-cargar">Nombre</label>
        <input id="nombre-cargar" name="nombre-cargar" type="text" required>
        <label for="apellido-cargar">Apellido</label>
        <input id="apellido-cargar" class="apellido-cargar" type="text" required>
        <label for="correo-cargar">Correo</label>
        <input id="correo-cargar" name="correo-cargar" type="text" required>
        <input type="submit" class="formulario__boton" value="cargar" name="cargar">
        <button class="formulario__boton" onClick="displayInterfaz(0)">Volver</button>
    </form>
</body>
</html>
</body>
</html>

<?php
    include_once('accionBoton/consultarInstanciaRep.php');
    include_once('accionBoton/consultarTodosRep.php');
    include_once('accionBoton/cargarRep.php');
?>