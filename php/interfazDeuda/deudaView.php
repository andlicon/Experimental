<!DOCTYPE html>
<html lang="en" class="vista">

<?php
    include('accionBoton/cargarDeuda.php');
    include('accionBoton/consultarDeudaRep.php');
    include('accionBoton/consultarRepDeudor.php');
    include('accionBoton/eliminarDeuda.php');
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Gestionar deudas</title>

    <link rel="stylesheet" href="/css/main.css">
</head>
<body class="vista__contenido">
    <?php
        include_once('../general/imprimirMensaje.php');;

        imprimirMensaje();
    ?>
    <h2 class="vista__titulo">Gestionar deudas</h2>
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
                           Motivo
                        </th>
                        <th class="output__celda output__celda--header">
                           Fecha
                        </th>
                        <th class="output__celda output__celda--header">
                            Debe
                        </th>
                    </tr>
                </thead>
                <tbody class="output__body">
                    <?php
                        include_once('../instancias/Deuda.php');
                        if( isset($_GET['deudas']) ) {
                            $serialize = $_GET['deudas'];
            
                            if($serialize) {
                                $deudas = unserialize($serialize);
                    
                                for($i=0; $i<count($deudas); $i++) {
                                    $deuda = $deudas[$i];
                                    $id = $deuda->getId();
                                    $cedula = $deuda->getCedula();
                                    $motivo = $deuda->getMotivo()->getDescripcion();
                                    $fecha = $deuda->getFecha();
                                    $debe = $deuda->getDebe();
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
                                                    $fecha
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
                    <label for="motivoeInput" class="input__label">Motivo</label>
                    <select class="input__select" id="motivoeInput" name="motivoInput">
                        <?php 
                            include_once('generarMotivo.php');
                            generarMotivo();
                        ?>
                    </select>
                </div>
                <div class="input__grupo">
                    <label for="fechaInput" class="input__label">Fecha</label>
                    <input type="date" id="fechaInput" name="fechaInput" class="input__input">
                </div>
                <div class="input__grupo">
                    <label for="montoInput" class="input__label">Monto</label>
                    <input type="text" id="montoInput" name="montoInput" class="input__input">
                </div>
            </div>
            <!-- botones -->
            <div class="botones">
                <h2 class="botones__titulo">Acciones</h2>
                <button name="consultarDeudor" class="boton">Consultar Deudores</button>
                <button name="consultarCedula" class="boton">Deuda por representante</button>
                <button name="modificar" class="boton">modificar</button>
                <button name="eliminar" class="boton">eliminar</button>
                <button name="cargar" class="boton">Cargar deuda</button>
                <button name="actualizar" class="boton">Cobrar mensualidad</button>
            </div>
        </form>
    </div>
</body>
</html>