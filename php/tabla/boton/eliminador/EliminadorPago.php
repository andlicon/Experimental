<?php
    class EliminadorPago  {
        public function eliminar(array $id) {
            try {
                $conn = new PDO("mysql:host=127.0.0.1:3306;dbname=Experimental", "root", "");
                $delete =  "DELETE FROM pago
                            WHERE id=?";
                $resultado = $conn->prepare($delete);
                $resultado->execute($id);
            }
            catch(Exception $e) {
                echo $e;
            }
        }
    }
?>