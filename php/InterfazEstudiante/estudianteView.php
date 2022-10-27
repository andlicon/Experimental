<!DOCTYPE html>
<html lang="en">
    
<?php
    include('accionBoton/actualizarEstu.php');
    include('accionBoton/consultarEstu.php');
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
<body class="consulta">
    <?php
        include_once('../formulario/Mensaje.php');

        if( isset($_GET['mensaje']) ) {
            $serialize = $_GET['mensaje'];
        
            if($serialize) {
                $mensaje = unserialize($serialize);
                echo 
                    '<div class="output__mensaje" name="hola">'.
                        $mensaje->getKeyInput().' '.$mensaje->getMotivo().' '.$mensaje->getMensaje().
                    '</div>';
            }
        }
    ?>
    <h2 class="consulta__titulo">Titulo</h2>
    <div class="input">
        <form action="" method="POST" class="input__form">
            <!-- output seleccionable -->
            <table class="output__tabla">
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
                       clase
                    </th>
                    <th class="output__celda output__celda--header">
                       Cedula Representante
                    </th>
                </tr>
            </thead>
            <tbody class="output__body">
                <?php
                    include_once('../instancias/Estudiante.php');
                    if( isset($_GET['estudiantes']) ) {
                        $serialize = $_GET['estudiantes'];
                    
                        if($serialize) {
                            $estudiantes = unserialize($serialize);
                        
                            for($i=0; $i<count($estudiantes); $i++) {
                                $estudiante = $estudiantes[$i];

                                $idEstudiante = $estudiante->getId();
                                $nombre = $estudiante->getNombre();
                                $apellido = $estudiante->getApellido();
                                $fechaNacimiento = $estudiante->getFechaNacimiento();
                                $clase = $estudiante->getClase();
                                $claseDesc = $clase->getDescripcion();
                                $cedulaRepresentante = $estudiante->getCedulaRepresentante();

                                echo "  <tr>
                                            <td class=\"output__celda\">
                                                <input type=\"checkbox\" name=\"check[]\" value=\"$idEstudiante,$cedulaRepresentante\" id=\"check$i\">
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
                                                $claseDesc
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
            <label for="claseInput" class="input__label">Clase</label>
            <select class="input__select" id="claseInput" name="claseInput">
                <?php 
                    include_once('generarClases.php');
                    generarClases() 
                ?>
            </select>
            
            <label for="nombreInput" class="input__label">Nombre</label>
            <input type="text" id="nombreInput" name="nombreInput" class="input__input input__input--texto">
            <label for="apellidoInput" class="input__label">Apellido</label>
            <input type="text" id="apellidoInput" name="apellidoInput" class="input__input input__input--texto">
            <label for="fechaInput" class="input__label">Fecha Nacimiento</label>
            <input type="date" id="fechaInput" name="fechaInput" class="input__input input__input--texto">
            <label for="cedulaRepInput" class="input__label">Cedula Representante</label>
            <input type="text" id="cedulaRepInput" name="cedulaRepInput" class="input__input input__input--texto">
            <!-- botones -->
            <button name="consultar" class="boton">consultar</button>
            <button name="cargar" class="boton">cargar</button>
            <button name="modificar" class="boton">modificar</button>
            <button name="eliminar" class="boton">eliminar</button>
            <button name="actualizar" class="boton">actualizar</button>
        </form>
    </div>
</body>
</html>