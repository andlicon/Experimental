<!DOCTYPE html>
<html lang="en" class="grande">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Padre-Responsable</title>

    <link rel="stylesheet" href="/css/main.css">
</head>
<body class="grande">
    <div class="formulario formulario--express" method="POST">
        <h2 class="formulario__titulo">Representantes</h2>
        <form class="formulario__input--horizontal" action="">
            <label for="selector" class="formulario__label">Nacionalidad:</label>
            <select class="selector" id="selector">
                <option class="selector__option">V</option>
                <option class="selector__option">E</option>
            </select>
            <label for="cedula" class="formulario__label">Cedula:</label>
            <input type="text" class="formulario__input" id="cedula" onkeypress='return (event.charCode >= 48 && event.charCode <= 57)' required>
        </form>
        <div class="output">
            <div class="output__linea">
                Cedula:
            </div>
            <div class="output__linea">
                Nombre:
            </div>
            <div class="output__linea">
                Apellido:
            </div>
            <div class="output__linea">
                Correo:
            </div>
        </div>
        <div class="formulario__contenedor-botones">
            <button class="formulario__boton">Cargar</button>
            <button class="formulario__boton">elegir</button>
        </div>
    </div>
</body>
</html>