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
        $serialize = $_GET['representantes'];
        $representantes = unserialize($serialize);

        for($i=0; $i<count($representantes); $i++) {
            $representante = $representantes[$i];
            echo $representante->getCedula().'';
        }
    ?>
</body>
</html>