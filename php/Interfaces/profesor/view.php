<!DOCTYPE html>
<html lang="en" class="vista">
    
<?php
    include_once('../ruta.php');
    include('../funciones/redireccionarPagina.php');
    include_once('evento/actualizarProf.php');
    include_once('evento/consultarProf.php');
    include_once(GENERAL_PATH.'/accionVolver.php');
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Profesor</title>

    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

    <link rel="stylesheet" href="/css/main.css">
</head>
<body class="body-page">
    <?php
        include_once('../funciones/generarUsuario.php');
        generarUsuario();
    ?>
    <div class="body-main">
        <h1 class="vista__titulo">
            Profesor
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
                               clase
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
                                    $profesores = unserialize($serialize);
                                
                                    for($i=0; $i<count($profesores); $i++) {
                                        $profesor = $profesores[$i];
                                        $cedula = $profesor->getCedula();
                                        $nombre = $profesor->getNombre();
                                        $apellido = $profesor->getApellido();
    
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
                                                        include_once(ROOT_PATH.'/general/generarClase.php');
                                                        generarClase($cedula);
                                        echo        "</td>
                                                    <td>";
                                                        include_once(ROOT_PATH.'/general/generarTablaContactos.php');
                                                        generarTablaContactos($cedula);
                                        echo        "</td>
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
                        include_once(GENERADOR_PATH.'/input/GeneradorInputProfesor.php');
                        $permiso = getPermiso($usuario);
                        $genMenu = new GeneradorInputProfesor($permiso);
                        $genMenu->generarItems();
                    ?>

            </div>

            <div class="botones">
                <?php
                    include_once(GENERADOR_PATH.'/boton/GeneradorBotonProfesor.php');
                    $permiso = getPermiso($usuario);
                    $genMenu = new GeneradorBotonProfesor($permiso);
                    $genMenu->generarItems();
                ?>
            </div>
        </form>
    </div>
</body>
</html>