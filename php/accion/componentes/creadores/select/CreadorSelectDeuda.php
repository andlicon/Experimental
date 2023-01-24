<?php
    include_once(__DIR__.'/../../../rutaAcciones.php');
    include_once('CreadorSelect.php');
    include_once(DAO_PATH.'/DeudaDAO.php');
    include_once(DAO_PATH.'/EstudianteDAO.php');
    include_once(DAO_PATH.'/BaseDeDatos.php');

    class CreadorSelectDeuda extends CreadorSelect {
        
        public function __construct() {
            parent::__construct(new DeudaDAO(new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '')));
        }



        protected function crearOption($consulta, $seleccion) {
            $options = "<option value=\"0\"> - </option>";

            $estudianteDAO = new EstudianteDAO(new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', ''));

            for($i=0; $i<count($consulta); $i++) {
                $deuda = $consulta[$i];
                $id = $deuda->getId();
                $idEstudiante = $deuda->getIdEstudiante();
                $fecha = $deuda->getFecha();
                $descripcion= $deuda->getDescripcion();
                $montoInicial = $deuda->getMontoInicial();
                $montoEstado = $deuda->getMontoEstado();
                $deudaTotal = $deuda->getDeuda();
                //Consulta a estudiante
                $estudianteResul = $estudianteDAO->getInstancia(array($idEstudiante));
                $estudiante = $estudianteResul[0];
                $estudiante = $estudiante->getNombre().' '.$estudiante->getApellido();

                $options = $options."<option value=\"$id\">$estudiante - 
                                                           $descripcion -
                                                           Fecha: $fecha -  
                                                           Deuda: $deudaTotal</option>";
            }

            return $options;
        }

        public function crearItemCedula($id, $atributos, $cedula) {
            $html = "";
            try {
                $consulta = $this->dao->getInstanciaCedula(array($cedula));

                $html = "<div class=\"input__grupo\">
                            <select $atributos id=\"$id\" name=\"tipoPago\" $atributos>";
                $html = $html.$this->crearOption($consulta, null);
                $html = $html."
                            </select>
                        </div>";
            }catch(Exception $e) {
                $html="
                    <select>
                        <option>No existe deuda registrada.</option>
                    </select>";
            }finally {
                return $html;
            }
        }

    }

?>