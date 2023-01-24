<?php
    include_once('../rutaAcciones.php');
    include_once(DAO_PATH.'DeudaDAO.php');
    include_once(DAO_PATH.'BaseDeDatos.php');

    class CargarDeuda {
        public function cargar() {

            if( isset($_POST['estudiante']) && isset($_POST['motivo']) 
            && isset($_POST['fecha']) && isset($_POST['descripcion']) 
            && isset($_POST['monto']) && isset($_POST['select'])) {
                $estudiante = $_POST['estudiante'];
                $motivo = $_POST['motivo'];
                $fecha = $_POST['fecha'];
                $descripcion = $_POST['descripcion'];
                $monto = $_POST['monto'];
                $select = $_POST['select'];
                
                if(str_contains($select, "Todos")) {
                    $estudiante = 0;
                    $select = true;
                }
                else if(str_contains($select, "Representante:")) {
                    $select = false;
                }
                else {
                    $select = true;
                }

                $deudaDAO = new DeudaDAO(BaseDeDatos::getInstancia());
                echo 'se ha cargado correctamente la deuda.';
                $deudaDAO->cargar(array($estudiante, $motivo, $fecha, $descripcion, $monto, $select));
            }
        }
    }

?>