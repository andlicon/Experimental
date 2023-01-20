<?php
    include_once(__DIR__.'/../rutaAcciones.php');
    include_once(DAO_PATH.'BaseDeDatos.php');
    include_once(DAO_PATH.'UsuarioDAO.php');

    class EliminarUsuario  {
        public function eliminar(array $id) {
            try {
                $dao = new UsuarioDAO(BaseDeDatos::getInstancia());
                $dao->eliminar($id);
                return true;
            }
            catch(Exception $e) {
                return "Ha ocurrido un error, no se puede eliminar el usuario.";
            }
        }
    }
?>