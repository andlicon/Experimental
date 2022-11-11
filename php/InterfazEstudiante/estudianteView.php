<!DOCTYPE html>
<html lang="en" class="vista">
    
<?php
    include('accionBoton/actualizarEstu.php');
    include('accionBoton/consultarClaseEstu.php');
    include('accionBoton/consultarCedulaEstu.php');
    include('accionBoton/cargarEstu.php');
    include('accionBoton/modificarEstu.php');
    include('accionBoton/eliminarEstu.php');
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gestionar Estudiante</title>

    <link rel="stylesheet" href="/css/main.css">
</head>
<body class="vista__contenido">
    <?php
        include_once('../general/imprimirMensaje.php');
        
        imprimirMensaje();
    ?>
    <h2 class="vista__titulo">Gestionar estudiante</h2>
    <div class="vista__cuerpo">
        <form action="" method="POST" class="vista__form">
            <!-- output seleccionable -->
            <table class="output">
                <colgroup> 
                    <col class="output__col output__col--seleccion">
                    <col class="output__col output__col--nombre">
                    <col class="output__col output__col--apellido">
                    <col class="output__col output__col--fechaNacimiento">
                    <col class="output__col output__col--clase">
                    <col class="output__col output__col--cedulaRepresentante">
                </colgroup>
                <thead class="output__header">
                    <tr class="output__renglon">
                        <th class="output__celda output__celda--header">
                           Seleccionar 
                        </th>
                        <th class="output__celda output__celda--header">
                           Nombre
                        </th>
                        <th class="output__celda output__celda--header">
                           Apellido 
                        </th>
                        <th class="output__celda output__celda--header">
                           Fecha nacimiento
                        </th>
                        <th class="output__celda output__celda--header">
                           Clase
                        </th>
                        <th class="output__celda output__celda--header">
                           Cedula Representante
                        </th>
                    </tr>
                </thead>
                <tbody class="output__body">
                    <?php
                        include_once('../instancias/Estudiante.php');
                        include_once('getNombreClase.php');

                        if( isset($_GET['estudiantes']) ) {
                            $serialize = $_GET['estudiantes'];
                        
                            if($serialize) {
                                $estudiantes = unserialize($serialize);
                            
                                for($i=0; $i<count($estudiantes); $i++) {
                                    $estudiante = $estudiantes[$i];
                                    
                                    //Informacion Estudiante
                                    $idEstudiante = $estudiante->getId();
                                    $nombre = $estudiante->getNombre();
                                    $apellido = $estudiante->getApellido();
                                    $fechaNacimiento = $estudiante->getFechaNacimiento();
                                    $idClase = $estudiante->getIdClase();
                                    $cedulaRepresentante = $estudiante->getCedulaRepresentante();
                                    //Informacion clase
                                    $nombreClase = getNombreClase($idClase);
                                
                                    echo "  <tr class=\"output__renglon\">
                                                <td class=\"output__celda output__celda--centrado\">
                                                    <input type=\"checkbox\" name=\"check[]\" value=\"$idEstudiante\" id=\"check$i\">
                                                </td>
                                                <td class=\"output__celda\">
                                                    $nombre
                                                </td>
                                                <td class=\"output__celda\">
                                                    $apellido
                                                </td>
                                                <td class=\"output__celda\">
                                                    $fechaNacimiento
                                                </td>
                                                <td class=\"output__celda\">
                                                    $nombreClase
                                                </td>
                                                <td class=\"output__celda\">
                                                    $cedulaRepresentante
                                                </td>
                                            </tr>";
                                }
                            }
                        }
                    ?>
                </tbody>
            </table>
            <!-- input -->
            <div class="input">
                <h2>Introducir informacion</h2>
                <div class="input__grupo">
                    <label for="claseInput" class="input__label">Clase</label>
                    <select class="input__select" id="claseInput" name="claseInput">
                        <?php 
                            include_once('optionClases.php');
                            optionClases();
                        ?>
                    </select>
                </div>
                <div class="input__grupo">
                    <label for="nombreInput" class="input__label">Nombre</label>
                    <input type="text" id="nombreInput" name="nombreInput" class="input__input input__input--texto">
                </div>
                <div class="input__grupo">
                    <label for="apellidoInput" class="input__label">Apellido</label>
                    <input type="text" id="apellidoInput" name="apellidoInput" class="input__input input__input--texto">
                </div>
                <div class="input__grupo">
                    <label for="fechaInput" class="input__label">Fecha Nacimiento</label>
                    <input type="date" id="fechaInput" name="fechaInput" class="input__input input__input--texto">
                </div>
                <div class="input__grupo">
                    <label for="nacionalidadInput" class="input__label">Nacionalidad</label>
                    <select name="nacionalidadInput" id="nacionalidadInput" class="input__select">
                        <option value="V-" class="input__select">V-</option>
                        <option value="E-" class="input__select">E-</option>
                    </select>
                </div>
                <div class="input__grupo">
                    <label for="cedulaInput" class="input__label">Cedula</label>
                    <input type="text" id="cedulaInput" name="cedulaInput" class="input__input input__input--texto">
                </div>
            </div>
            <!-- botones -->
            <div class="botones">
                <h2 class="botones__titulo">Acciones</h2>
                <button name="consultar-clase" class="boton">consultar por clase</button>
                <button name="consultar-cedula" class="boton">consultar por representante</button>
                <button name="cargar" class="boton">cargar</button>
                <button name="modificar" class="boton">modificar</button>
                <button name="eliminar" class="boton">eliminar</button>
                <button name="actualizar" class="boton">actualizar</button>
            </div>
        </form>
    </div>
</body>
</html>