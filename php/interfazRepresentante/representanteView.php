<!DOCTYPE html>
<html lang="en" class="vista">

<?php
    include('accionBoton/actualizarRep.php');
    include('accionBoton/consultarRep.php');
    include('accionBoton/cargarRep.php');
    include('accionBoton/modificarRep.php');
    include('accionBoton/eliminarRep.php');
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gestionar representantes</title>

    <link rel="stylesheet" href="/css/main.css">
</head>
<body class="vista__contenido">
    <?php
        include_once('../general/imprimirMensaje.php');;

        imprimirMensaje();
    ?>
    <h2 class="vista__titulo">Titulo</h2>
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
                           Tipo contacto 
                        </th>
                        <th class="output__celda output__celda--header">
                           Contacto 
                        </th>
                    </tr>
                </thead>
                <tbody class="output__body">
                    <?php
                        include_once('../instancias/Representante.php');
                        if( isset($_GET['representantes']) ) {
                            $serialize = $_GET['representantes'];
                        
                            if($serialize) {
                                $representantes = unserialize($serialize);
                            
                                for($i=0; $i<count($representantes); $i++) {
                                    $representante = $representantes[$i];
                                    $cedula = $representante->getCedula();
                                    $nombre = $representante->getNombre();
                                    $apellido = $representante->getApellido();
                                    $idTipoContacto = $representante->getidTipoContacto();
                                    $tipoContacto = $representante->getTipoContacto();
                                    $contacto = $representante->getContacto();

                                    echo "  <tr class=\"output__renglon\">
                                                <td class=\"output__celda\">
                                                    <input type=\"checkbox\" name=\"check[]\" value=\"$cedula,$idTipoContacto\" id=\"check$i\">
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
                                                    $tipoContacto
                                                </td>
                                                <td class=\"output__celda\">
                                                    $contacto
                                                </td>
                                            </tr>";
                                }
                            }
                        }
                    ?>
                </tbody>
            </table>
            <!-- inputs -->
            <label for="nacionalidadInput" class="input__label">Nacionalidad</label>
            <select name="nacionalidadInput" id="nacionalidadInput" class="input__select">
                <option value="V-" class="input__select">V-</option>
                <option value="E-" class="input__select">E-</option>
            </select>
            <label for="cedulaInput" class="input__label">Cedula</label>
            <input type="text" id="cedulaInput" name="cedulaInput" class="input__input input__input--texto">
            <label for="nombreInput" class="input__label">Nombre</label>
            <input type="text" id="nombreInput" name="nombreInput" class="input__input input__input--texto">
            <label for="apellidoInput" class="input__label">Apellido</label>
            <input type="text" id="apellidoInput" name="apellidoInput" class="input__input input__input--texto">
            <label for="correoInput" class="input__label">Correo</label>
            <input type="text" id="correoInput" name="correoInput" class="input__input input__input--texto">
            <label for="telefonoInput" class="input__label">Telefono (opcional)</label>
            <input type="text" id="telefonoInput" name="telefonoInput" class="input__input input__input--texto">
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