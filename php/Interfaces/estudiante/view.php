<!DOCTYPE html>
<html lang="en" class="vista">
    
<?php
    include_once('../ruta.php');
    include('../funciones/redireccionarPagina.php');
    include('evento/consultar.php');
    include('evento/consultarAll.php');
    include('evento/cargarEstu.php');
    include('evento/modificarEstu.php');
    include('evento/eliminarEstu.php');
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Estudiante</title>

    <link rel="stylesheet" href="/css/main.css">
</head>
<body class="body-page">
    <?php
        include_once('../funciones/generarUsuario.php');
        generarUsuario();
    ?>
    <div class="body-main">
        <h1 class="vista__titulo">
            Estudiantes
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
                        <col class="output__col output__col--nombre">
                        <col class="output__col output__col--apellido">
                        <col class="output__col output__col--fechaNacimiento">
                        <col class="output__col output__col--clase">
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
                        </tr>
                    </thead>
                    <tbody class="output__body">
                        <?php
                            include_once(DTO_PATH.'/Estudiante.php');
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
                        include_once(FUNCIONES_IG_PATH.'generador/input/GeneradorInputEstudiante.php');
                        $permiso = getPermiso($usuario);
                        $genMenu = new GeneradorInputEstudiante($permiso);
                        $genMenu->generarItems();
                    ?>
            </div>

            <div class="botones">
                <?php
                    include_once(FUNCIONES_IG_PATH.'generador/boton/GeneradorBotonEstudiante.php');
                    $permiso = getPermiso($usuario);
                    $genMenu = new GeneradorBotonEstudiante($permiso);
                    $genMenu->generarItems();
                ?>
            </div>
        </form>
    </div>
</body>
</html>