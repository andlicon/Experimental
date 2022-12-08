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
                    </colgroup>
                    <thead class="output__header">
                        <tr class="output__renglon">
                            <th class="output__celda output__celda--header">
                               Seleccionar 
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
                                Tipo_pago
                            </th>
                            <th class="output__celda output__celda--header">
                                Referencia
                            </th>
                        </tr>
                    </thead>
                    <tbody class="output__body">
                        <?php
                            include_once(DTO_PATH.'/Deuda.php');
                            $deudaTotal = 0;
                        
                            if( isset($_GET['pagos']) ) {
                                $serialize = $_GET['pagos'];
            
                                if($serialize) {
                                    $deudas = unserialize($serialize);

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
                                        //motivo
                                        $idMotivo = $deuda->getIdMotivo();
                                        $motivo = getDescripcionMotivo($idMotivo);

                                        $deudaTotal += $debe;

                                        echo "  <tr class=\"output__renglon\">
                                                    <td class=\"output__celda\ output__celda--centrado\">
                                                    <input type=\"checkbox\" name=\"check[]\" value=\"$id\" 
                                                            id=\"check$i\" class=\"output__check\">
                                                    </td>
                                                    <td class=\"output__celda\">
                                                        $cedula
                                                    </td>
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
                </table>
            </div>
            <div class="input">
                <h2>Introducir informacion</h2>
                    <?php
                        //include_once(GENERADOR_PATH.'/input/GeneradorInputEstudiante.php');
                        //$permiso = getPermiso($usuario);
                        //$genMenu = new GeneradorInputEstudiante($permiso);
                        //$genMenu->generarItems();
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

<!--

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
    <label for="fechaInput" class="input__label">Fecha</label>
    <input type="date" id="fechaInput" name="fechaInput" class="input__input">
</div>
<div class="input__grupo">
    <label for="montoInput" class="input__label">Monto inicial</label>
    <input type="text" id="montoInput" name="montoInput" class="input__input">
</div>
<div class="input__grupo">
    <label for="cuentaInput" class="input__label">Cuenta</label>
    <select class="input__select" id="cuentaInput" name="cuentaInput">
    <?php 
            //include('generarCuenta.php');
            //optionCuenta();
        ?>
    </select>
</div>
<div class="input__grupo">
    <label for="tipoPagoInput" class="input__label">Tipo Pago</label>
    <select class="input__select" id="tipoPagoInput" name="tipoPagoInput">
        <?php 
            //include('generarTipoPago.php');
            //optionTipoPago();
        ?>
    </select>
</div>
<div class="input__grupo">
    <label for="refInput" class="input__label">Referencia</label>
    <input type="text" id="refInput" name="refInput" class="input__input">
</div>


<h2 class="botones__titulo">Acciones</h2>
<button name="consultarDeudor" class="boton">Consultar por cedula</button>
<button name="consultarCedula" class="boton">Actualizar</button>
<button name="modificar" class="boton">modificar</button>
<button name="eliminar" class="boton">eliminar</button>
<button name="cargarDeuda" class="boton">Cargar</button>

-->