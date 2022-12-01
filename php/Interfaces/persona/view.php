<!DOCTYPE html>
<html lang="en" class="vista">
    
<?php
    include_once('../ruta.php');
    include('../funciones/redireccionarPagina.php');
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Persona</title>

    <link rel="stylesheet" href="/css/main.css">
</head>
<body class="body-page">
    <?php
        include_once('../funciones/generarUsuario.php');
        generarUsuario();
    ?>
    <div class="body-main">
        <h1 class="vista__titulo">
            Persona
        </h1>
        <?php
            include_once(MENSAJE_PATH.'/imprimirMensaje.php');
            imprimirMensaje();
        ?>
        <!-- Display -->
        <form action="" method="POST" class="display">
            <div class="output">
                <table class="output__table">
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
                               Contacto 
                            </th>
                        </tr>
                    </thead>
                    <tbody class="output__body">
                        <?php
                            include_once(DTO_PATH.'/Persona.php');
                            if( isset($_GET['personas']) ) {
                                $serialize = $_GET['personas'];     //AHORA SE TIENE QUE PASAR POR HEADER PERSONA
                            
                                if($serialize) {
                                    $personas = unserialize($serialize);
                                
                                    for($i=0; $i<count($personas); $i++) {
                                        /*Obteniendo los datos de la persona*/
                                        $persona = $personas[$i];
                                        $cedula = $persona->getCedula();
                                        $nombre = $persona->getNombre();
                                        $apellido = $persona->getApellido();
                                        
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
                                                    <td class=\"output__celda\">";    
                                                        include_once(ROOT_PATH.'/general/generarTablaContactos.php');
                                                        generarTablaContactos($cedula);
                                        echo       "</td>
                                                </tr>";
                                    }
                                } 
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="input">
                <h2>Introducir informacion</h2>
                    <?php
                        //include_once(FUNCIONES_IG_PATH.'generador/input/GeneradorInputEstudiante.php');
                        //$permiso = getPermiso($usuario);
                        //$genMenu = new GeneradorInputEstudiante($permiso);
                        //$genMenu->generarItems();
                    ?>

            </div>

            <div class="botones">
                <?php
                    //include_once(FUNCIONES_IG_PATH.'generador/boton/GeneradorBotonEstudiante.php');
                    //$permiso = getPermiso($usuario);
                    //$genMenu = new GeneradorBotonEstudiante($permiso);
                    //$genMenu->generarItems();
                ?>
            </div>
        </form>
    </div>
</body>
</html>

<!--

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
        
 
<div class="botones">
    <h2 class="botones__titulo">Acciones</h2>
    <button name="consultar" class="boton">consultar</button>
    <button name="cargar" class="boton">cargar</button>
    <button name="modificar" class="boton">modificar</button>
    <button name="eliminar" class="boton">eliminar</button>
    <button name="actualizar" class="boton">actualizar</button>
    <button name="volver" class="boton">volver</button>
</div>

-->