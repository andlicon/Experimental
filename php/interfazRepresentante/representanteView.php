<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Representante</title>

    <!-- <link rel="stylesheet" href="/css/main.css"> -->
</head>
<body>
    <h2>Titulo</h2>
    <div class="output">
        <?php
        include_once('../instancias/Representante.php');
        
        if( isset($_GET['representantes']) ) {
            $serialize = $_GET['representantes'];
            
            if($serialize) {
                $representantes = unserialize($serialize);

                for($i=0; $i<count($representantes); $i++) {
                    $representante = $representantes[$i];
                    echo 'cedula: '.$representante->getCedula().' nombre: '.$representante->getNombre().' 
                    apellido: '.$representante->getApellido().' correo'.$representante->getCorreo().'<br>';
                }
            }
        }
    ?>
        <!-- imprimir a los representantes serializados -->
    </div>
    <div class="atributos">
        <form action="" method="POST">
            <label for="nacionalidadInput">Nacionalidad</label>
            <select name="nacionalidadInput" id="nacionalidadInput" required>
                <option value="V-">V-</option>
                <option value="E-">E-</option>
            </select>
            <label for="cedulaInput">Cedula</label>
            <input type="text" id="cedulaInput" name="cedulaInput" required>
            <label for="nombreInput">Nombre</label>
            <input type="text" id="nombreInput" name="nombreInput" required>
            <label for="apellidoInput">Apellido</label>
            <input type="text" id="apellidoInput" name="apellidoInput" required>
            <label for="correoInput">Correo</label>
            <input type="text" id="correoInput" name="correoInput" required>
            <label for="telefonoInput">Telefono (opcional)</label>
            <input type="text" id="telefonoInput" name="telefonoInput">
        </form>
    </div>
    <div class="botones">
        <form action="" method="POST">
            <button name="consultar">consultar</button>
            <button name="cargar">cargar</button>
            <button name="modificar">modificar</button>
            <button name="eliminar">eliminar</button>
            <button name="actualizar">actualizar</button>
        </form>
    </div>
</body>
</html>

<?php
    include('accionBoton/consultarTodosRep.php');
?>