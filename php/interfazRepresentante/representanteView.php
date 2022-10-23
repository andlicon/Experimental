<!DOCTYPE html>
<html lang="en">
    
<?php
    include('accionBoton/consultarTodosRep.php');
    include('accionBoton/consultarInstanciaRep.php');
    include('accionBoton/cargarRep.php');
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Representante</title>

    <!-- <link rel="stylesheet" href="/css/main.css"> -->
</head>
<body>
    <?php
        include_once('../formulario/Mensaje.php');

        if( isset($_GET['mensaje']) ) {
            $serialize = $_GET['mensaje'];
        
            if($serialize) {
                $mensaje = unserialize($serialize);

                echo $mensaje->getKeyInput().' '.$mensaje->getMotivo().' '.$mensaje->getMensaje();
            }
        }
    ?>
    <h2>Titulo</h2>
    <table class="output">
        <thead>
            <tr>
                <th>
                   cedula 
                </th>
                <th>
                   nombre 
                </th>
                <th>
                   apellido
                </th>
                <th>
                   tipo contacto 
                </th>
                <th>
                   contacto 
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
                include_once('../instancias/Representante.php');
                if( isset($_GET['representantes']) ) {
                    $serialize = $_GET['representantes'];
                
                    if($serialize) {
                        $representantes = unserialize($serialize);
                    
                        for($i=0; $i<count($representantes); $i++) {
                            $representante = $representantes[$i];
                            $cedula = $representante->getCedula();
                            $nombre = $representante->getNombre();
                            $apellido = $representante->getApellido();
                            $tipoContacto = 'correo';
                            $contacto = $representante->getCorreo();
                            echo "  <tr>
                                        <td>
                                            $cedula
                                        </td>
                                        <td>
                                            $nombre
                                        </td>
                                        <td>
                                            $apellido
                                        </td>
                                        <td>
                                            $tipoContacto
                                        </td>
                                        <td>
                                            $contacto
                                        </td>
                                    </tr>";
                        }
                    }
                }
            ?>
        </tbody>
    </table>
    <div class="atributos">
        <form action="" method="POST">
            <label for="nacionalidadInput">Nacionalidad</label>
            <select name="nacionalidadInput" id="nacionalidadInput">
                <option value="V-">V-</option>
                <option value="E-">E-</option>
            </select>
            <label for="cedulaInput">Cedula</label>
            <input type="text" id="cedulaInput" name="cedulaInput">
            <label for="nombreInput">Nombre</label>
            <input type="text" id="nombreInput" name="nombreInput">
            <label for="apellidoInput">Apellido</label>
            <input type="text" id="apellidoInput" name="apellidoInput">
            <label for="correoInput">Correo</label>
            <input type="text" id="correoInput" name="correoInput">
            <label for="telefonoInput">Telefono (opcional)</label>
            <input type="text" id="telefonoInput" name="telefonoInput">
            <!-- botones -->
            <button name="consultar">consultar</button>
            <button name="cargar">cargar</button>
            <button name="modificar">modificar</button>
            <button name="eliminar">eliminar</button>
            <button name="actualizar">actualizar</button>
        </form>
    </div>
</body>
</html>