<?php 
    include_once(FUNCIONES_IG_PATH.'generador/GeneradorItems.php');

    abstract class GeneradorOption extends GeneradorItems {
        public function __construct($idTipoPermiso) {
            parent::__construct($idTipoPermiso);
        }

        protected function crearItem($id, $texto) {
            return
                '<option  value="'.$id.'">'.$texto.'</option>';
        }
        
    }
?>