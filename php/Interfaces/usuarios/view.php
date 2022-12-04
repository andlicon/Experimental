<!DOCTYPE html>
<html lang="en" class="vista">
    
<?php
    include_once('../ruta.php');
    include('../funciones/redireccionarPagina.php');

    include('evento/consultar.php');
    include('evento/validez.php');
    include('evento/eliminar.php');
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Usuarios</title>

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
            Usuarios
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
                               Tipo
                            </th>
                            <th class="output__celda output__celda--header">
                               Nickname
                            </th>
                            <th class="output__celda output__celda--header">
                               Valido
                            </th>
                        </tr>
                    </thead>
                    <tbody class="output__body">
                        <?php
                            include_once(DTO_PATH.'/Usuario.php');
                            include_once(DTO_PATH.'/Persona.php');
                            include_once(DTO_PATH.'/TipoPersona.php');

                            if( isset($_GET['usuarios']) ) {
                                $serialize = $_GET['usuarios'];     //AHORA SE TIENE QUE PASAR POR HEADER PERSONA
                            
                                if($serialize) {
                                    $usuarios = unserialize($serialize);
                                
                                    for($i=0; $i<count($usuarios); $i++) {
                                        /*Obteniendo los datos de la persona*/
                                        $usuario = $usuarios[$i];
                                        $cedula = $usuario->getCedula();

                                        $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');

                                        //Info persona.
                                        $personaDAO = new PersonaDAO($bd);
                                        $resultados = $personaDAO->getInstancia(array($cedula));
                                        $persona = $resultados[0];
                                        $nombre = $persona->getNombre();
                                        $apellido = $persona->getApellido();
                                        $idTipoPersona = $persona->getIdTipoPersona();

                                        //Info usuario.
                                        $usuarioDAO = new UsuarioDAO($bd);
                                        $resultados = $usuarioDAO->getInstancia(array($cedula));
                                        $usuario = $resultados[0];
                                        $nickname = $usuario->getNickname();
                                        $valido = $usuario->getValido();
                                        $valido = $valido==true ? "valido" : "invalido";

                                        //Info TipoUsuario
                                        $tipoPersonaConsul = new TipoPersonaConsul($bd);
                                        $resultados = $tipoPersonaConsul->getInstancia(array($idTipoPersona));
                                        $tipoUsuario = $resultados[0]->getDescripcion();
                                        
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
                                                        $tipoUsuario
                                                   </td>
                                                    <td class=\"output__celda\">
                                                      $nickname
                                                    </td> 
                                                    <td class=\"output__celda\">
                                                        $valido
                                                    </td>         
                                                </tr>";
                                    }
                                } 
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="botones">
                <h2>Acción</h2>
                <?php
                    include_once(GENERADOR_PATH.'boton/GeneradorBotonUsuario.php');
                    $permiso = getPermiso($usuario);
                    $genMenu = new GeneradorBotonUsuario($permiso);
                    $genMenu->generarItems();
                ?>
            </div>
        </form>
    </div>
</body>
</html>