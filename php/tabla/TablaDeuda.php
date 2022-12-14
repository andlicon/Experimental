<?php
    include_once(TABLA_PATH.'/Tabla.php');
    include_once(DTO_PATH.'/Deuda.php');
    include_once(DAO_PATH.'DeudaDAO.php');
    include_once(DAO_PATH.'EstudianteDAO.php');
    include_once(DTO_PATH.'Motivo.php');
    include_once(FUNCIONES_IG_PATH.'popOver/RepresentantePop.php');
    include_once(FUNCIONES_IG_PATH.'popOver/EstudiantePop.php');
    include_once(INTERFACES_PATH.'/deuda/getDescripcionMotivo.php');

    class TablaDeuda extends Tabla {

        public function crearTabla() {
            $tabla = "
            <table class=\"output__table\">
            <colgroup> 
                <col class=\"output__col output__col--seleccion\">
                <col class=\"output__col output__col--cedula\">
                <col class=\"output__col output__col--estudiante\">
                <col class=\"output__col output__col--motivo\">
                <col class=\"output__col output__col--descripcion\">
                <col class=\"output__col output__col--fecha\">
                <col class=\"output__col output__col--montoInicial\">
                <col class=\"output__col output__col--pagado\">
                <col class=\"output__col output__col--debe\">
            </colgroup>
            <thead class=\"output__header\">
                <tr class=\"output__renglon\">
                    <th class=\"output__celda output__celda--header\">
                       Seleccionar 
                    </th>
                    <th class=\"output__celda output__celda--header\">
                       Cedula 
                    </th>
                    <th class=\"output__celda output__celda--header\">
                       Estudiante
                    </th>
                    <th class=\"output__celda output__celda--header\">
                       Motivo
                    </th>
                    <th class=\"output__celda output__celda--header\">
                       Descripcion
                    </th>
                    <th class=\"output__celda output__celda--header\">
                       Fecha
                    </th>
                    <th class=\"output__celda output__celda--header\">
                        Monto Inicial
                    </th>
                    <th class=\"output__celda output__celda--header\">
                        Pagado
                    </th>
                    <th class=\"output__celda output__celda--header\">
                        Debe
                    </th>
                </tr>
            </thead>";

            $deudaTotal = 0;

            if( isset($_GET['deudas']) ) {
                $serialize = $_GET['deudas'];

                if($serialize) {
                    $deudas = unserialize($serialize);

                    //persona
                    $bd = new BaseDeDatos('127.0.0.1:3306', 'mysql', 'Experimental', 'root', '');
                    $personaDAO = new PersonaDAO($bd);
                    $popOverRep = new RepresentantePop($personaDAO);

                    //estudiante
                    $estudianteDAO = new EstudianteDAO($bd);
                    $popOverEstu = new EstudiantePop($estudianteDAO);

                    for($i=0; $i<count($deudas); $i++) {
                        //Deuda
                        $deuda = $deudas[$i];
                        $id = $deuda->getId();
                        $cedula = $deuda->getCedula();
                        $descripcion = $deuda->getDescripcion();
                        $fecha = $deuda->getFecha();
                        $montoInicial = $deuda->getMontoInicial();
                        $montoEstado = $deuda->getMontoEstado();
                        $debe = $deuda->getDeuda();
                        $idEstudiante = $deuda->getIdEstudiante();

                        //motivo
                        $idMotivo = $deuda->getIdMotivo();
                        $motivo = getDescripcionMotivo($idMotivo);

                        //popOvers
                        $popRep = $popOverRep->generarPop($cedula, $cedula);
                        $popEstu = $popOverEstu->generarPop($idEstudiante, $idEstudiante);

                        $deudaTotal += $debe;

                        //Acciones
                        $eliminador = "
                            <input type=\"button\" id=\"$id\" class=\"eliminar\" value=\"Eliminar\">
                        ";

                        $tabla = $tabla."
                            <tr class=\"output__renglon\">
                                <td class=\"output__celda output__celda--centrado\">
                                    <input type=\"checkbox\" name=\"check[]\" value=\"$id\" 
                                    id=\"check$i\" class=\"output__check\">
                                </td>
                                <td class=\"output__celda\">
                                    $popRep
                                </td>
                                <td class=\"output__celda\">
                                    $popEstu
                                </td>
                                <td class=\"output__celda\">
                                    $motivo
                                </td>
                                <td class=\"output__celda\">
                                    $descripcion
                                </td>
                                <td class=\"output__celda\">
                                    $fecha
                                </td>
                                <td class=\"output__celda\">
                                    $montoInicial
                                </td>
                                <td class=\"output__celda\">
                                    $montoEstado
                                </td>
                                <td class=\"output__celda\">
                                    $debe
                                </td>
                            </tr>";
                    }
                
                }
            }

            $tabla = $tabla."
                <tfoot>
                    <tr>
                        <td colspan=\"8\"></td>
                        <td>
                            Deuda total: $deudaTotal
                        </td>
                    </tr>
                </tfoot>
            </table>";

            echo $tabla;
        }
    }
?>