<?php
    //Este metodo lo que hara sera realizar una consulta
    //cargar los valores a los inputs
    //de presionar modificar, se hara la modificacion
    if( isset($_POST['modificar']) ) {
        try {   //Extraer informacion de la base de datos
            $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
            $representanteConsul = new RepresentanteConsul($bd);
            $representanteConsul = $representanteConsul->getTodos();

            //Serializar el objeto para poderlo pasar a la vista resultado
            $serialize = serialize($representanteConsul);
            header("Location: modificarRepView.php?representantes=".urlencode($serialize));
        }
        catch(Exception $mensaje) {  
            alerta($mensaje);
        }
    }
?>