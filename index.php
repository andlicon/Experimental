<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>

</head>
<body>
    
</body>
</html>

<?php

    class Coche {
        var $ruedas;
        var $color;
        var $motor;

        function Coche() {
            $this->ruedas = 4;
            $this->color = "rojo";
            $this->motor = null;
        }

        function arrancar() {
            echo 'se ha arrrancado';
        }
    }

    $carrito = new Coche();
    $carrito->arrancar();
?>