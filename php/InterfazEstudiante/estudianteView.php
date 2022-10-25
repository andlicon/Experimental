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

    <title>Gestionar representantes</title>

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
                       Nombre 
                    </th>
                    <th class="output__celda output__celda--header">
                       Apellido
                    </th>
                    <th class="output__celda output__celda--header">
                       Fecha Nacimiento
                    </th>
                    <th class="output__celda output__celda--header">
                       Cedula Representante
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

                                echo "  <tr>
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