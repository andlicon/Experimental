<!DOCTYPE html>
<html lang="en" class="vista">
    
<?php
    include_once('../ruta.php');
    include('../funciones/redireccionarPagina.php');
    include('evento/cargarDeuda.php');
    include('evento/cargarPago.php');
    include('evento/eliminarDeuda.php');
    include('evento/modificarDeuda.php');
    include('evento/consultar.php');
    include('evento/consultarRep.php');
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Deuda</title>


    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script src="../js/soloMonto.js"></script>

    <link rel="stylesheet" href="/css/main.css">
</head>
<body class="body-page">
    <?php
        include_once('../funciones/generarUsuario.php');
        generarUsuario();
    ?>
    <div class="body-main">
        <h1 class="vista__titulo">
            Deudas Vigentes Detalladas
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
                        <col class="output__col output__col--estudiante">
                        <col class="output__col output__col--motivo">
                        <col class="output__col output__col--descripcion">
                        <col class="output__col output__col--fecha">
                        <col class="output__col output__col--montoInicial">
                        <col class="output__col output__col--pagado">
                        <col class="output__col output__col--debe">
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
                               Estudiante
                            </th>
                            <th class="output__celda output__celda--header">
                               Motivo
                            </th>
                            <th class="output__celda output__celda--header">
                               Descripcion
                            </th>
                            <th class="output__celda output__celda--header">
                               Fecha
                            </th>
                            <th class="output__celda output__celda--header">
                                Monto Inicial
                            </th>
                            <th class="output__celda output__celda--header">
                                Pagado
                            </th>
                            <th class="output__celda output__celda--header">
                                Debe
                            </th>
                        </tr>
                    </thead>
                    <tbody class="output__body">
                        <?php
                            include_once(FUNCIONES_IG_PATH.'popOver/RepresentantePop.php');
                            include_once(FUNCIONES_IG_PATH.'popOver/EstudiantePop.php');
                            include_once(DAO_PATH.'/BaseDeDatos.php');
                            include_once(DAO_PATH.'/PersonaDAO.php');
                            include_once(DAO_PATH.'/EstudianteDAO.php');
                            include_once(DTO_PATH.'/Deuda.php');
                            include_once('getDescripcionMotivo.php');
                
                            $deudaTotal = 0;
                            
                            if( isset($_GET['deudas']) ) {
                                $serialize = $_GET['deudas'];
                
                                if($serialize) {
                                    $deudas = unserialize($serialize);

                                    //persona
                                    $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
                                    $personaDAO = new PersonaDAO($bd);
                                    $popOverRep = new RepresentantePop($personaDAO);

                                    //estudiante
                                    $estudianteDAO = new EstudianteDAO($bd);
                                    $popOverEstu = new EstudiantePop($estudianteDAO);
    
                                    for($i=0; $i<count($deudas); $i++) {
                                        //Deuda
                                        $deuda = $deudas[$i];
                                        $id = $deuda->getId();
                                        $cedula = $deuda->getCedula();
                                        $descripcion = $deuda->getDescripcion();
                                        $fecha = $deuda->getFecha();
                                        $montoInicial = $deuda->getMontoInicial();
                                        $montoEstado = $deuda->getMontoEstado();
                                        $debe = $deuda->getDeuda();
                                        $idEstudiante = $deuda->getIdEstudiante();

                                        //motivo
                                        $idMotivo = $deuda->getIdMotivo();
                                        $motivo = getDescripcionMotivo($idMotivo);
    
                                        $deudaTotal += $debe;

                                        //Acciones
                                        $eliminador = new EliminadorPago();
                        

                                        echo "  <tr class=\"output__renglon\">
                                                    <td class=\"output__celda output__celda--centrado\">
                                                        <input type=\"checkbox\" name=\"check[]\" value=\"$id\" 
                                                                id=\"check$i\" class=\"output__check\">
                                                    </td>
                                                    <td class=\"output__celda\">";
                                                        echo $popOverRep->generarPop($cedula, $cedula);
                                        echo        "</td>
                                                    <td class=\"output__celda\">";
                                                        echo $popOverEstu->generarPop($idEstudiante, $idEstudiante);
                                        echo        "</td>
                                                    <td class=\"output__celda\">
                                                        $motivo
                                                    </td>
                                                    <td class=\"output__celda\">
                                                        $descripcion
                                                    </td>
                                                    <td class=\"output__celda\">
                                                        $fecha
                                                    </td>
                                                    <td class=\"output__celda\">
                                                        $montoInicial
                                                    </td>
                                                    <td class=\"output__celda\">
                                                        $montoEstado
                                                    </td>
                                                    <td class=\"output__celda\">
                                                        $debe
                                                    </td>
                                                </tr>";
                                    }
                                }
                            }
                        ?>
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="8"></td>
                        <td>
                            <?php echo"Deuda total: $deudaTotal"?>
                        </td>
                    </tr>
                </tfoot>
                </table>
            </div>
            <div class="input">
                <h2>Introducir informacion</h2>
                    <?php
                        include_once(GENERADOR_PATH.'/input/GeneradorInputDeuda.php');
                        $permiso = getPermiso($usuario);
                        $genMenu = new GeneradorInputDeuda($permiso);
                        $genMenu->generarItems();
                    ?>

            </div>

            <div class="botones">
                <?php
                    include_once(GENERADOR_PATH.'/boton/GeneradorBotonDeuda.php');
                    $permiso = getPermiso($usuario);
                    $genMenu = new GeneradorBotonDeuda($permiso);
                    $genMenu->generarItems();
                ?>
            </div>
        </form>
    </div>
</body>
</html>

<script>
    $(document).ready(function () {
    //change selectboxes to selectize mode to be searchable
        $('#estudianteInput').select2();
    });
    $(document).ready(function () {
    //change selectboxes to selectize mode to be searchable
        $('#representanteInput').select2();
    });
</script>