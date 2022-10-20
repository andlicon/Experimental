<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <?php
        include_once('../instancias/Representante.php');
    ?>
    
</head>
<body>
    <?php
        //Esta view a juro debe recibir un array serializado de representantes, 
        $serialize = $_GET['representantes'];
        $representantes = unserialize($serialize);

        for($i=0; $i<count($representantes); $i++) {
            $representante = $representantes[$i];
            echo 'cedula: '.$representante->getCedula().' nombre: '.$representante->getNombre().' 
            apellido: '.$representante->getApellido().' correo'.$representante->getCorreo().'<br>';
        }
    ?>
</body>
</html>