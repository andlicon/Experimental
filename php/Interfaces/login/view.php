<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login</title>

    <link rel="stylesheet" href="/css/main.css">
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="../js/cambiarLamina.js"></script>
    <script src="../js/iniciarSesion.js"></script>
    <link rel="shortcut icon" href="#">
</head>

<?php
    include_once('../ruta.php');
?>

<body class="body-page">
        <?php
            include_once(MENSAJE_PATH.'/imprimirMensaje.php');
            imprimirMensaje();
        ?>

    <!-- LOGIN -->
    <nav class="usuario">
        <div id="login" class="usuario__contenido login__contenido">
             <div class="login__saludo">
                <img class="login__img" src="../../../img/interfaz/login/logo.jpg" alt="Logo del colegio">
                <!-- <h2 class="login__titulo">Iniciar Sesión.</h2> -->
             </div>
            <form class="login__item" method="POST">
                <input class="" type="text" placeholder="usuario" name="nicknameEntrar" id="nicknameEntrar">
                <input class="" type="password" placeholder="contraseña" name="contrasenaEntrar" id="contrasenaEntrar">
                <input class="boton boton--menu" type="submit" id="iniciarSesion" name="login" value="Acceder">
            </form>
        </div>
    </nav>

    <div class="alerta">
        ESTO ES UNA ALERTA
    </div>

    <div class="body-login">
        <nav class="cambiador">
            <input class="login__boton boton boton--menu" type="button" name="volver" value="Bienvenida" onclick="cambiarVisibilidiad('bienvenida');">
            <input class="login__boton boton boton--menu" type="button" name="crear-usuario" value="Inscripción" onclick="cambiarVisibilidiad('inscripcion');">
        </nav>

        <main>
            <div class="informacion contenido-login visibilidad mainCentrado" id="bienvenida">
                <div class="bienvenida bloque" style="border-radius:3em; padding:0;">
                    <div class="div--seleccionado">
                        <h2 class="titulo--bienvenida formu--titulo" style="font-size:2.5em;">Unidad Educativa Instituto Experimental</h2>
                        <p class="pad">
                            Somos una Institución con 45 años de trayectoria, enfocados en la excelencia educativa.
                            Nuestra prioridad: la Educación en Valores.
                        </p>
                        <img src="../../../img/interfaz/login/experimental.jpg" alt="" class="imagen-login">
                    </div>
                    <div class="div--seleccionado">
                        <h2 class="titulo--bienvenida formu--titulo formu__titulo--recto">Historia</h2>
                        <p class="pad">
                            El colegio fue fundado en el año 1973 con el nombre de “Centro Experimental de Enseñanza Preescolar”, en su inicio únicamente se impartían clases de nivel preescolar y primaria, 
                            y a partir de 1984 se empezó a impartir también las clases de nivel bachillerato.
                            En el año 1986 cambia de nombre al ya conocido Unidad Educativa Instituto Experimental.
                        </p>

                        <figure>
                            <img src="../../../img/interfaz/login/fundadora.jpg" alt="Fundadora del colegio" class="imagen-login">
                            <figcaption class="fundadora">Magda Vecchini de González, fundadora de la U.E.I.Experimental</figcaption>
                        </figure>
                    </div>
                    <div class="div--seleccionado">
                        <h2 class="titulo--bienvenida formu--titulo formu__titulo--recto">Misión</h2>
                        <p class="pad">Ser una institución enmarcada en una educación de calidad y excelencia, caracterizada por el trabajo planificado y participativo (personal directivo, docente, alumno, padres y representantes), un sólido y armonioso clima organizacional y por el desarrollo intelectual, físico, emocional y social de cada uno de los actores que integran la institución.</p>
                    </div>
                    <div class="div--seleccionado">
                        <h2 class="titulo--bienvenida formu--titulo formu__titulo--recto">Visión</h2>
                        <p class="pad">La institución persigue, además de lo que señala la Ley, suministrar a los alumnos, niños y jóvenes venezolanos, una formación ciudadana integral y permanente fundamentada en una base sólida de valores y virtudes, para hacer de ellos personas de elevado nivel académico, cultural y laboral, con capacidad crítica e investigadora capaces de contribuir al mejoramiento de la sociedad y al desarrollo de su entorno socio comunitario.</p>
                    </div>
                </div>

                <div class="mas-informacion bloque">
                    <div class="info subBloque" style="border-radius:3em;">
                        <div class="div--seleccionado" style="margin-top:0;">
                            <h2 class="formu--titulo titulo--bienvenida">Medios de comunicación</h2>
                            <p class="comunicar pad"><span class="contacto" style="text-align: start !important;">Correo de contacto:</span> UEIExperimental@hotmail.com</p>
                            <p class="comunicar pad"><span class="contacto">Telefono de contacto:</span> 0426-6883542</p>
                        </div>
                        <div class="div--seleccionado">
                            <h2 class="formu--titulo titulo--bienvenida formu__titulo--recto">Redes sociales</h2>
                            <a href="https://www.instagram.com/ueiexperimental/" target="_blank"><img src="../../../img/interfaz/login/instagram.png" alt="Instagram" class="red-social"></a>
                        </div>
                    </div>
                    <div class="ubicacion subBloque div--seleccionado" style="border-radius:3em;">
                        <h2 class="formu--titulo titulo--bienvenida">Ubicación</h2>
                        <p class="pad comunicar">C. Guaraguao, Puerto La Cruz 6023, Anzoátegui</p>
                        <iframe class="imagen-login" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15705.763964089569!2d-64.6296116!3d10.2259722!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xa0ac7244980e91e3!2sU.E.%20Instituto%20Experimental!5e0!3m2!1ses!2sve!4v1675441074261!5m2!1ses!2sve" width="400" height="400" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        
            <div id="inscripcion" class="display--oculto visibilidad contenido-login">
                <div class="alLado">
                    <div class="bloque div--seleccionado div--seleccionado div--seleccionado padding pad">
                        <h2 class="formu--titulo titulo--bienvenida">Proceso de Pre-Inscripción</h2>
                        <p class="pad">
                            El proceso de inscripción consta de dos pasos.
                        </p>
                        <ol>
                            <li>Llenado de <a href="#solicitud-ingreso">PLANILLA VIRTUAL</a></li>
                            <li>Entrega de recaudos.</li>
                        </ol>
                    </div>
                    <div class="bloque div--seleccionado div--seleccionado div--seleccionado padding" style="height:100%;">
                        <h2 class="formu--titulo titulo--bienvenida">Recaudos solicitados</h2>
                        <ul class="pad">
                            <li>Copia de la partida de nacimiento</li>
                            <li>copia de la boleta final</li>
                            <li>Certificado de promoción</li>
                            <li>Constancia de conducta</li>
                            <li>Solvencia de pago del último colegio inscrito</li>
                        </ul>
                    </div>
                </div>
                <div id="solicitud-ingreso" class="bloque div--seleccionado div--seleccionado div--seleccionado padding">
                    <h2 class="formu--titulo titulo--bienvenida">Solicitud de ingreso</h3>
                    <form action="" method="POST" class="registro" id="registro">
                        <div class="datos-usuario marco-deuda subBloque centrado subBloqueTitulo nacio">
                            <h4 class="popOver__informacion formu--titulo corregir">Datos usuario</h4>
                            <div class="input__grupo formu">        
                                <input type="text" id="nicknameInput" name="nicknameInput" onkeypress="return soloAlfaNumerico(15, 'nicknameInput')" autocomplete="off" class="input__input input__input--texto" required>
                                <span></span>
                                <label for="nicknameInput" class="input__label">Nickname</label>
                            </div>
                            <div class="input__grupo formu">
                                <input type="password" id="contrasenaInput" name="contrasenaInput" onkeypress="return soloAlfaNumerico(15, 'contrasenaInput')" autocomplete="off" class="input__input input__input--texto" required>
                                <span></span>
                                <label for="contrasenaInput" class="input__label">Contraseña</label>
                            </div>
                        </div>
                         <div class="centrado bloque">
                            <div class="datos-representante marco-deuda subBloque horizontal formu-mediano">
                                <h4 class="popOver__informacion formu--titulo">Datos Representante</h4>
                            <div class="input__grupo">
                                    <div class="formu formu-nacionalidad">
                                        <select name="nacionalidadInput" id="nacionalidadInput" class="input__select">
                                            <option value="V-" class="input__select">V-</option>
                                            <option value="E-" class="input__select">E-</option>
                                        </select>
                                        <span></span>
                                        <label class="negrita label-excepcion" for="nacionalidadInput" class="input__label">Nacionalidad</label>
                                    </div>
                                    <div class="formu">
                                        <input type="text" onkeypress="return soloNumeros(8, 'cedulaInput')" id="cedulaInput" name="cedulaInput" class="input__input input__input--texto" autocomplete="off" required>
                                        <span></span>
                                        <label class="negrita" for="cedulaInput" class="input__label">Cedula</label>
                                    </div>
                                </div>
                                <div class="formu">
                                    <input type="text" onkeypress="return soloAlfabeto(15, 'nombreInput')" id="nombreInput" autocomplete="off" name="nombreInput" class="input__input input__input--texto" required>
                                    <span></span>
                                    <label class="negrita" for="nombreInput" class="input__label">Nombre</label>
                                </div>
                                <div class="formu">
                                    <input type="text" id="apellidoInput" onkeypress="return soloAlfabeto(15, 'apellidoInput')" name="apellidoInput" autocomplete="off" class="input__input input__input--texto" required>
                                    <span></span>
                                    <label class="negrita" for="apellidoInput" class="input__label">Apellido</label>
                                </div>
                                <div class="formu">
                                    <input type="text" id="direccionInput" onkeypress="return soloAlfaNumerico(50, 'direccionInput')" name="direccionInput" autocomplete="off" class="input__input input__input--texto" required>
                                    <span></span>
                                    <label class="negrita" for="direccionInput" class="input__label">Direccion hogar</label>
                                </div>
                                <div class="formu separacion">
                                    <input type="text" id="lugarTrabajoInput" onkeypress="return soloAlfaNumerico(50, 'lugarTrabajoInput')" name="lugarTrabajoInput" autocomplete="off" class="input__input input__input--texto" required>
                                    <span></span>
                                    <label class="negrita" for="lugarTrabajoInput" class="input__label">Direccion trabajo</label>
                                </div>

                                <div class="subBloque horizontal marco-deuda">
                                    <h4 class="popOver__informacion formu--titulo corregir">Datos contacto</h4>
                                    <div class="formu">
                                        <input type="text" id="correoInput" name="correoInput" onkeypress="return correo(50, 'correoInput')" autocomplete="off" class="input__input input__input--texto" required>
                                        <span></span>
                                        <label class="negrita" for="correoInput" class="input__label">Correo</label>
                                    </div>
                                    <div class="formu">
                                        <input type="text" onkeypress="return soloTelefono('telefonoInput')" autocomplete="off" id="telefonoInput" name="telefonoInput" class="input__input input__input--texto" required>
                                        <span></span>
                                        <label class="negrita" for="telefonoInput" class="input__label">Telefono</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="datos-estudiante subBloque marco-deuda bloque centrado subBloquecito bloque--sub bloqueEstudiante formu-chikito" id="estudiantes">
                            <h4 class="popOver__informacion formu--titulo corregir">Datos estudiante</h4>
                                <div class="formu">
                                    <input type="text" id="nombreInputEstudiante[]" name="nombreInputEstudiante" autocomplete="off" class="input__input input__input--texto" required onkeypress="return soloAlfabeto(15, null)" maxlength="15">
                                    <span></span>
                                    <label for="nombreInputEstudiante[]" class="input__label">Nombre</label>
                                </div>
                                <div class="formu">
                                    <input type="text" id="apellidoInputEstudiante[]" name="apellidoInputEstudiante" autocomplete="off" class="input__input input__input--texto" required onkeypress="return soloAlfabeto(15, null)" maxlength="15">
                                    <span></span>
                                    <label for="apellidoInputEstudiante[]" class="input__label">Apellido</label>
                                </div>
                                <div class="formu">
                                    <textarea id="lugarNacimientoInputEstudiante[]" name="lugarNacimientoInputEstudiante[]" autocomplete="off" class="input__input input__input--texto textarea" style="color: black;" onkeypress="return soloAlfaNumerico(50, null)" maxlength="50" required></textarea>
                                    <span></span>
                                    <label for="lugarNacimientoInputEstudiante[]" class="input__label">Lugar Nacimiento</label>
                                </div>
                                <div class="formu">
                                    <input type="date" id="fechaNacimientoInputEstudiante[]" name="fechaNacimientoInputEstudiante" autocomplete="off" class="input__input input__input--texto" required>
                                    <span></span>
                                    <label for="fechaNacimientoInputEstudiante[]" class="input__label">Fecha nacimiento</label>
                                </div>

                                <input type="button" value="Añadir estudiante adicional" id="masEstudiantes">

                                <script src="js/codigo.js"></script>
                                <script src="js/dom.js"></script>
                            </div>
                        <input type="button" class="boton btn" style="text-align:center; display:flex; flex-flow:column; justify-content:center; color:black; font-weight: 300;" id="botonRegistrar" value="Registrar"></button>
                    </form>
                </div>
            </div>
        </main> 
    </div>
</body>
</html>

<script src="logear/cargarUsuario.js"></script>
<script src="logear/validarRegistro.js"></script>
<script src="../js/limitador/soloNumeros.js"></script>
<script src="../js/limitador/soloTelefono.js"></script>
<script src="../js/limitador/soloAlfabeto.js"></script>
<script src="../js/limitador/soloAlfaNumerico.js"></script>
<script src="../js/limitador/correo.js"></script>
<script src="../js/autoEliminar.js"></script>