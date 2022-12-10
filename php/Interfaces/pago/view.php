<!DOCTYPE html>
<html lang="en" class="vista">
    
<?php
    include_once('../ruta.php');
    include('../funciones/redireccionarPagina.php');
    include_once(DAO_PATH.'DeudaDAO.php');
    include_once(DAO_PATH.'EstudianteDAO.php');
    include_once(DAO_PATH.'CuentaConsul.php');
    include_once(DAO_PATH.'TipoPagoConsul.php');
    include_once(FUNCIONES_IG_PATH.'popOver/DeudaPop.php');

    include_once('eventos/consultar-rep.php');
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pagos</title>

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
            Pagos
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
                        <col class="output__col output__col--contacto">
                        <col class="output__col output__col--contacto">
                    </colgroup>
                    <thead class="output__header">
                        <tr class="output__renglon">
                            <th class="output__celda output__celda--header">
                               Seleccionar 
                            </th>
                            <th class="output__celda output__celda--header">
                               Referencia deuda
                            </th>
                            <th class="output__celda output__celda--header">
                               Cedula
                            </th>
                            <th class="output__celda output__celda--header">
                               Fecha
                            </th>
                            <th class="output__celda output__celda--header">
                                Monto
                            </th>
                            <th class="output__celda output__celda--header">
                                Cuenta
                            </th>
                            <th class="output__celda output__celda--header">
                                Tipo pago
                            </th>
                            <th class="output__celda output__celda--header">
                                Referencia
                            </th>
                            <th class="output__celda output__celda--header">
                                Estado
                            </th>
                        </tr>
                    </thead>
                    <tbody class="output__body">
                        <?php
                            include_once(DTO_PATH.'/Pago.php');
                        
                            if( isset($_GET['pagos']) ) {
                                $serialize = $_GET['pagos'];
            
                                if($serialize) {
                                    $pagos = unserialize($serialize);

                                    $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
                                    $deudaDAO = new DeudaDAO($bd);
                                    $deudaPop = new DeudaPop($deudaDAO);
                                    $cuentaConsul = new CuentaConsul($bd);
                                    $tipoPagoConsul = new TipoPagoConsul($bd);

                                    for($i=0; $i<count($pagos); $i++) {
                                        //Pago
                                        $pago = $pagos[$i];
                                        $id = $pago->getId();

                                        $popDeuda = $deudaPop->generarPop($pago->getIdDeuda());
                                        $cedula = $pago->getCedula();
                                        $fecha = $pago->getFecha();
                                        $monto = $pago->getMonto();
                                        $estado = $pago->getValido();
                                        $estado = $estado==false ? "por confirmar" : "confirmado";
                                        //cuenta
                                        $idCuenta = $pago->getIdCuenta();
                                        $resultado = $cuentaConsul->getInstancia(array($idCuenta));
                                        $cuenta = $resultado[0]->getDescripcion();
                                        $banco = $resultado[0]->getBanco();
                                        $cuentaImp = $banco.' '.$cuenta;
                                        //pago
                                        $resultado = $tipoPagoConsul->getInstancia(array($pago->getIdTipoPago()));
                                        $tipoPago = $resultado[0]->getDescripcion();

                                        $referencia = $pago->getRef();

                                        echo "  <tr class=\"output__renglon\">
                                                    <td class=\"output__celda\ output__celda--centrado\">
                                                    <input type=\"checkbox\" name=\"check[]\" value=\"$id\" 
                                                            id=\"check$i\" class=\"output__check\">
                                                    </td>
                                                    <td class=\"output__celda\">
                                                        $popDeuda
                                                    </td>
                                                    <td class=\"output__celda\">
                                                        $cedula
                                                    </td>
                                                    <td class=\"output__celda\">
                                                        $fecha
                                                    </td>
                                                    <td class=\"output__celda\">
                                                        $monto
                                                    </td>
                                                    <td class=\"output__celda\">
                                                        $cuentaImp 
                                                    </td>
                                                    <td class=\"output__celda\">
                                                        $tipoPago
                                                    </td>
                                                    <td class=\"output__celda\">
                                                        $referencia
                                                    </td>
                                                    <td class=\"output__celda\">
                                                        $estado
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
                        include_once(GENERADOR_PATH.'/input/GeneradorInputPago.php');
                        $permiso = getPermiso($usuario);
                        $genMenu = new GeneradorInputPago($permiso);
                        $genMenu->generarItems();
                    ?>

            </div>

            <div class="botones">
                <?php
                    include_once(GENERADOR_PATH.'boton/GeneradorBotonPago.php');
                    $permiso = getPermiso($usuario);
                    $genMenu = new GeneradorBotonPago($permiso);
                    $genMenu->generarItems();
                ?>
            </div>
        </form>
    </div>
</body>
</html>