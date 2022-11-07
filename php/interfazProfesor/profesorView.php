<!DOCTYPE html>
<html lang="en" class="vista">

<?php
    include_once('accionBoton/actualizarProf.php');
    include_once('accionBoton/consultarProf.php');
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gestionar Profesores</title>

    <link rel="stylesheet" href="/css/main.css">
</head>
<body class="vista__contenido">
    <?php
        include_once('../general/imprimirMensaje.php');;

        imprimirMensaje();
    ?>
    <h2 class="vista__titulo">Gestionar Profesores</h2>
    <div class="vista__cuerpo">
        <form action="" method="POST" class="vista__form">
            <!-- output seleccionable -->
            <table class="output">
                <colgroup> 
                    <col class="output__col output__col--seleccion">
                    <col class="output__col output__col--cedula">
                    <col class="output__col output__col--nombre">
                    <col class="output__col output__col--apellido">
                    <col class="output__col output__col--tipo">
                    <col class="output__col output__col--contacto">
                </colgroup>
                <thead class="output__header">
                    <tr class="output__renglon">
                        <th class="output__celda output__celda--header">
                           Seleccionar 
                        </th>
                        <th class="output__celda output__celda--header">
                           Cedula 
                        </th>
                        <th class="output__celda output__celda--header">
                           Nombre 
                        </th>
                        <th class="output__celda output__celda--header">
                           Apellido
                        </th>
                        <th class="output__celda output__celda--header">
                           clase
                        </th>
                        <th class="output__celda output__celda--header">
                           Contacto 
                        </th>
                    </tr>
                </thead>
                <tbody class="output__body">
                    <?php
                        include_once('../instancias/Persona.php');
                        if( isset($_GET['profesores']) ) {
                            $serialize = $_GET['profesores'];     //AHORA SE TIENE QUE PASAR POR HEADER PERSONA
                        
                            if($serialize) {
                                $profesores = unserialize($serialize);
                            
                                for($i=0; $i<count($profesores); $i++) {
                                    $profesor = $profesores[$i];
                                    $cedula = $profesor->getCedula();
                                    $nombre = $profesor->getNombre();
                                    $apellido = $profesor->getApellido();
                                    /*Clase informacion*/
                                    $claseProf = $profesor->getClase();
                                    $clase = $claseProf->getDescripcion();

                                    echo "  <tr class=\"output__renglon\">
                                                <td class=\"output__celda\ output__celda--centrado\">
                                                    <input type=\"checkbox\" name=\"check[]\" value=\"$cedula\" 
                                                            id=\"check$i\" class=\"output__check\">
                                                </td>
                                                <td class=\"output__celda\">
                                                    $cedula
                                                </td>
                                                <td class=\"output__celda\">
                                                    $nombre
                                                </td>
                                                <td class=\"output__celda\">
                                                    $apellido
                                                </td>
                                                <td class=\"output__celda\">
                                                    $clase
                                                </td>
                                                <td>";
                                                    include_once('../general/generarTablaContactos.php');
                                                    generarTablaContactos($cedula);
                                    echo        "</td>
                                            </tr>";
                                }
                            }
                        }
                    ?>
                </tbody>
            </table>
            <!-- inputs -->
            <div class="input">
                <h2>Introducir informacion</h2>
                <div class="input__grupo">
                    <label for="nacionalidadInput" class="input__label">Nacionalidad</label>
                    <select name="nacionalidadInput" id="nacionalidadInput" class="input__select">
                        <option value="V-" class="input__select">V-</option>
                        <option value="E-" class="input__select">E-</option>
                    </select>
                    <label for="cedulaInput" class="input__label">Cedula</label>
                    <input type="text" id="cedulaInput" name="cedulaInput" class="input__input input__input--texto">
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
                    <label for="correoInput" class="input__label">Correo</label>
                    <input type="text" id="correoInput" name="correoInput" class="input__input input__input--texto">
                </div>
                <div class="input__grupo">
                    <label for="telefonoInput" class="input__label">Telefono (opcional)</label>
                    <input type="text" id="telefonoInput" name="telefonoInput" class="input__input input__input--texto">
                </div>
            </div>
            <!-- botones -->
            <div class="botones">
                <h2 class="botones__titulo">Acciones</h2>
                <button name="consultar" class="boton">consultar</button>
                <button name="asignar" class="boton">Asignar clase</button>
                <button name="actualizar" class="boton">actualizar</button>
            </div>
        </form>
    </div>
</body>
</html>