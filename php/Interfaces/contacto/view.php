<!DOCTYPE html>
<html lang="en" class="vista">

<?php
    include_once('../ruta.php');
    include_once('evento/actualizarContacto.php');
    include_once('evento/cargarContacto.php');
    include_once('evento/consultarContacto.php');
    include_once('evento/eliminarContacto.php');
    include_once(GENERAL_PATH.'/accionVolver.php');
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gestionar Contacto</title>

    <link rel="stylesheet" href="/css/main.css">
</head>
<body class="vista__contenido">
    <?php
        include_once(GENERAL_PATH.'/imprimirMensaje.php');;

        imprimirMensaje();
    ?>
    <h2 class="vista__titulo">Gestionar Contacto</h2>
    <div class="vista__cuerpo">
        <form action="" method="POST" class="vista__form">
            <!-- output seleccionable -->
            <table class="output">
                <colgroup> 
                    <col class="output__col output__col--seleccion">
                    <col class="output__col output__col--cedula">
                    <col class="output__col output__col--tipo-contacto">
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
                           Tipo contacto 
                        </th>
                        <th class="output__celda output__celda--header">
                           Contacto 
                        </th>
                    </tr>
                </thead>
                <tbody class="output__body">
                    <?php
                        include_once(DTO_PATH.'/Contacto.php');
                        include_once('getDescripcionContacto.php');

                        if( isset($_GET['contactos']) ) {
                            $serialize = $_GET['contactos'];     //AHORA SE TIENE QUE PASAR POR HEADER PERSONA
                        
                            if($serialize) {
                                $contactos = unserialize($serialize);
                            
                                for($i=0; $i<count($contactos); $i++) {
                                    //CONTACTO
                                    $contacto = $contactos[$i];
                                    $id = $contacto->getId();
                                    $cedula = $contacto->getCedula();
                                    $contact = $contacto->getContacto();
                                    //TIPO CONTACTO
                                    $idTipo = $contacto->getIdTipo();
                                    $tipoContacto = getDescripcionContacto($idTipo);
                                    
                                    echo "  <tr class=\"output__renglon\">
                                                <td class=\"output__celda\ output__celda--centrado\">
                                                    <input type=\"checkbox\" name=\"check[]\" value=\"$id\" 
                                                            id=\"check$i\" class=\"output__check\">
                                                </td>
                                                <td class=\"output__celda\">
                                                    $cedula
                                                </td>
                                                <td class=\"output__celda\">
                                                    $tipoContacto
                                                </td>
                                                <td class=\"output__celda\">
                                                    $contact
                                                </td>
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
                    <label for="correoInput" class="input__label">Correo</label>
                    <input type="text" id="correoInput" name="correoInput" class="input__input input__input--texto">
                </div>
                <div class="input__grupo">
                    <label for="telefonoInput" class="input__label">Telefono</label>
                    <input type="text" id="telefonoInput" name="telefonoInput" class="input__input input__input--texto">
                </div>
            <!-- botones -->
            <div class="botones">
                <h2 class="botones__titulo">Acciones</h2>
                <button name="consultar" class="boton">consultar</button>
                <button name="actualizar" class="boton">actualizar</button>
                <button name="cargar" class="boton">cargar</button>
                <button name="eliminar" class="boton">eliminar</button>
                <button name="volver" class="boton">volver</button>
            </div>
        </form>
    </div>
</body>
</html>