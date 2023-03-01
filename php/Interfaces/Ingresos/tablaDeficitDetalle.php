<?php
    include_once('../../accion/rutaAcciones.php');
    include_once(DAO_PATH.'/BaseDeDatos.php');
    include_once(DAO_PATH.'/DeudaDAO.php');
    include_once(DAO_PATH.'/EstudianteDAO.php');
    include_once(DAO_PATH.'/ClaseConsul.php');
    include_once(DAO_PATH.'/PersonaDAO.php');
    include_once(DAO_PATH.'/ContactoDAO.php');

    if(isset($_POST['fecha'])) {
        $fecha = $_POST['fecha'];
        $html = "
                    <h2 class=\"tabla__titulo tituloGrid\">Representantes deudores en el cíclo</h2>";
        
        $anio = null;
        $mes = null;

        $deudaDAO = new DeudaDAO(BaseDeDatos::getInstancia());

        $deudores = [];

        try {
            if($fecha!=null) {
                $fecha = explode("-", $fecha);
                $anio = $fecha[0];
                $mes = $fecha[1];
    
                $registros = $deudaDAO->getDeudorFecha(array($anio, $mes));
                for($i=0; $i<count($registros); $i++) {
                    $deudores[] = $registros[$i]->getCedula();
                }
            }
            else {
                $registros = $deudaDAO->getDeudorHistorico();
                for($i=0; $i<count($registros); $i++) {
                    $deudores[] = $registros[$i]->getCedula();
                }
            }

            if(!empty($deudores)) {
                $estudianteDAO = new EstudianteDAO(BaseDeDatos::getInstancia());

                //Comparadores
                $representanteAux = "";
                $tablaAux = "";
                $estudianteRow = "";
                $tablaAux = "";
                //Contadores
                $pagoTotalRep = 0;
                $deudaTotalRep = 0;
                $deficitTotal = 0;

                //Por cada representante consultar su deuda por estudiante
                for($i=0; $i<count($deudores); $i++) {
                    //Consultar por estudiante deudor
                    $resultado;
                    $estudianteRow = "";
                    $tablaAux = "";
                    $pagoTotalRep = 0;
                    $deudaTotalRep = 0;
                    $deficitTotal = 0;

                    if($anio!=null && $mes!=null) {
                        $resultado = $deudaDAO->getDeficitDetalladoDeudor(array($anio, $mes, $deudores[$i]));
                    }
                    else {
                        $resultado = $deudaDAO->getDeficitDetalladoHistoricoDeudor(array($deudores[$i]));
                    }
                    
                    for($j=0; $j<count($resultado); $j++) {
                        $deuda = $resultado[$j];
                        $representante = $deuda->getCedula();
                        $idEstudiante = $deuda->getIdEstudiante();
                        $montoInicial = $deuda->getMontoInicial();
                        $montoEstado = $deuda->getMontoEstado();
                        $deficit = $deuda->getDeuda() * -1;

                         //Info estudiante
                        $estudianteResul = $estudianteDAO->getInstancia(array($idEstudiante));
                        $estudiante = $estudianteResul[0];
                        $estudianteNombre = $estudiante->getNombre();
                        $estudianteApellido = $estudiante->getApellido();
                        $estudianteFecha = $estudiante->getFechaNacimiento();
                        $estudianteLugarNacimiento = $estudiante->getLugarNacimiento();
                        $estudianteClaseNombre = $estudiante->getIdClase();
                        $estudianteCedulaRep = $estudiante->getCedulaRepresentante();

                        //clase
                        $claseConsul = new ClaseConsul(BaseDeDatos::getInstancia());

                        if($estudianteClaseNombre!=null) {
                            $resultadoClase = $claseConsul->getInstancia(array($estudianteClaseNombre));
                            $clase = $resultadoClase[0];
                            $estudianteClaseNombre = $clase->getDescripcion();
                        }
                        else {
                            $estudianteClaseNombre = "Sin asignar";
                        }


                        //Info
                        $classDeficit = $deficit<0 ? "tabla__td--deuda" : "tabla__td--ingresos";
                        $estudianteRow = $estudianteRow."
                        <tr>
                            <td><a id=\"estudiante$idEstudiante\" href=\"#ex$idEstudiante\" rel=\"modal:open\" class=\"popOver__trigger\">$estudianteNombre</a></td>
                            <div id=\"ex$idEstudiante\" class=\"modal\">
                                <h4 class=\"popOver__informacion popOver__elemento\">Informacion Estudiante</h4>
                                <p class=\"popOver__elemento\"><span class=\"negrita\">Nombre:</span> $estudianteNombre</p>
                                <p class=\"popOver__elemento\"><span class=\"negrita\">Apellido:</span> $estudianteApellido</p>
                                <p class=\"popOver__elemento\"><span class=\"negrita\">Fecha nacimiento:</span> $estudianteFecha</p>
                                <p class=\"popOver__elemento\"><span class=\"negrita\">Lugar nacimiento:</span> $estudianteLugarNacimiento</p>
                                <p class=\"popOver__elemento\"><span class=\"negrita\">Clase inscrito:</span> $estudianteClaseNombre</p>
                                <p class=\"popOver__elemento\"><span class=\"negrita\">Cédula representante:</span> $estudianteCedulaRep</p>
                            </div>
                            <td class=\"tabla__td--deuda\"><div>$montoInicial</div></td>
                            <td class=\"tabla__td--deuda\"><div>$deficit</div></td>
                        </tr>";

                        $deudaTotalRep = $deudaTotalRep + $montoInicial;
                        $pagoTotalRep = $pagoTotalRep + $montoEstado;
                        $deficitTotal = $pagoTotalRep - $deudaTotalRep;

                        $personaDAO = new PersonaDAO(BaseDeDatos::getInstancia());
                        $resultadoRep = $personaDAO->getInstancia(array($estudianteCedulaRep));
                        $persona= $resultadoRep[0];
                        $cedulaRep = $persona->getCedula();
                        $nombreRep = $persona->getNombre();
                        $apellidoRep = $persona->getApellido();
                        $direccionHogarRep = $persona->getDireccionHogar();
                        $direccionTrabajoRep = $persona->getDIreccionTrabajo();

                        //Ahora su contacto
                        $contactoDAO = new ContactoDAO(BaseDeDatos::getInstancia());
                        $cont = $contactoDAO->getInstanciaCedula(array($representante));
                        $telefono = $cont[1]->getContacto();
                        $correo = $cont[0]->getContacto();

                        $representanteAux = "<a id=\"rep$representante\" href=\"#re$representante\" rel=\"modal:open\" class=\"popOver__trigger\">Deudor: $representante</a>
                                            <div id=\"re$representante\" class=\"modal\">
                                                <h4 class=\"popOver__informacion popOver__elemento\">Informacion Representante</h4>
                                                <p class=\"popOver__elemento\"><span class=\"negrita\">Cedula:</span> $representante</p>
                                                <p class=\"popOver__elemento\"><span class=\"negrita\">Nombre:</span> $nombreRep</p>
                                                <p class=\"popOver__elemento\"><span class=\"negrita\">Apellido:</span> $apellidoRep</p>
                                                <p class=\"popOver__elemento\"><span class=\"negrita\">Direccion hogar:</span> $direccionHogarRep</p>
                                                <p class=\"popOver__elemento\"><span class=\"negrita\">Direccion trabajo:</span> $direccionTrabajoRep</p>
                                                <h4 class=\"popOver__informacion popOver__elemento\">Informacion Contacto</h4>
                                                <p class=\"popOver__elemento\"><span class=\"negrita\">Telefóno:</span> $telefono</p>
                                                <p class=\"popOver__elemento\"><span class=\"negrita\">Correo:</span> $correo</p>
                                        </div>
                                            </div>";

                        $classDeficit = $deficitTotal<0 ? "tabla__td--deuda" : "tabla__td--ingresos";
                        $tablaAux = "<div class=\"div--seleccionado padding\">
                                        <table class=\"tabla__table\">
                                            </thead>
                                                <caption>
                                                    <h2 class=\"tabla__titulo titulo--bienvenida formu--titulo\">$representanteAux</h4>
                                                </caption>
                                                <tr class=\"tabla__tr\">
                                                    <th class=\"tabla__td tabla__th\">Estudiante</th>
                                                    <th class=\"tabla__td tabla__th\">Deuda generada</th>
                                                    <th class=\"tabla__td tabla__th\">Deficit</th>
                                                </tr>
                                            </thead>
                                            <tbody>".
                                                $estudianteRow
                                            ."  
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td><div>TOTAL</div></td>
                                                    <td class=\"tabla__td--deuda\"><div>$deudaTotalRep</div></td>
                                                    <td class=\"$classDeficit\"><div>$deficitTotal</div></td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>";
                    }

                    $html = $html.$tablaAux;
                }

            }
        }
        catch(Exception $e) {
           
        }

        echo $html."";
    }
?>

<!-- 
    <h4 class=\"popOver__informacion popOver__elemento\">Informacion Contacto</h4>
    <p class=\"popOver__elemento\"><span class=\"negrita\">Telefóno:</span> $telefono</p>
    <p class=\"popOver__elemento\"><span class=\"negrita\">Correo:</span> $correo</p>
-->