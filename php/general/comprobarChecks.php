<?php
    include_once('../Excepciones/ExceptionSelect.php');

    /* 
        Comprueba los checks seleccionados por el usuario

        @param $sonVarios   
            <ul>
                <li>true: son varios los checks que el usuario puede seleccionar</li>
                <li>false: el usuario solo puede seleccionar 1 check</li>
            </ul>  

        @return arreglo de Value asignados a los checks en su etiqueta HTML
    */
    function comprobarChecks(bool $sonVarios, $pagina) {
        if( isset($_POST['check']) ) {
            $checks = $_POST['check'];
            $cantidad = count($checks);

            if($cantidad==0) {
                throw new ExceptionSelect("Se debe elegir al menos 1 item.", $pagina);
            }
            else if(!$sonVarios) {
                if($cantidad>1) {
                    throw new ExceptionSelect("Se debe seleccionar un unico item.", $pagina);
                }
            }

            return $checks;
        }
    }
?>