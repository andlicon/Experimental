<?php
    include_once(DTO_PATH.'/Usuario.php');
    include_once('IDAO.php');
    include_once('BaseDeDatos.php');

    /*
        Implementación de la interfaz Data Access Object para el caso particular de 
        las instancias "usuario"
    */
    class UsuarioDAO implements IDAO {
        private BaseDeDatos $bd;
        /*
            Constructor, crea un acceso a la base de dato.
        */
        public function __construct(BaseDeDatos $bd) {
            $this->bd = $bd;
        }


        /*
            Busca usuarios en la base de datos, comparando los nombres.

            @param array $nombre - Es una array que solo debe contener el nombre del usuario
            @thrown Exception - Arroja Exception de no existir una combinación usuario/cliente
            @return Usuario es un transfer object 
        */
        public function getInstancia(array $cedula) {
            $consulta = "SELECT * 
                        FROM usuario
                        WHERE cedula=?";
            $registros = $this->bd->sql($consulta, $cedula);

            if(!is_array($registros)) {
                throw new Exception('No existe usuario con dicha cedula');
            }
            
            $usuarios = [];
            for($i=0; $i<count($registros); $i++) {
                $registro = $registros[$i];

                $cedula = $registro['cedula'];
                $nickname = $registro['nickname'];
                $contrasena = $registro['contrasena'];
                $valido = $registro['valido'];
                $fechaRegistro = $registro['fecha_registro'];
                $us = new Usuario($cedula, $nickname, $contrasena, $valido, $fechaRegistro);

                $usuarios[] = $us;
            }
            
            return $usuarios;
        }

        public function getInstanciaValidez(array $valido) {
            $consulta = "SELECT * 
                        FROM usuario
                        JOIN persona
                        ON (usuario.cedula=persona.cedula)
                        WHERE persona.id_tipo_persona=1
                            AND valido=?";
            $registros = $this->bd->sql($consulta, $valido);

            if(!is_array($registros)) {
                throw new Exception('No existe usuario valido');
            }
            
            $usuarios = [];
            for($i=0; $i<count($registros); $i++) {
                $registro = $registros[$i];

                $cedula = $registro['cedula'];
                $nickname = $registro['nickname'];
                $contrasena = $registro['contrasena'];
                $valido = $registro['valido'];
                $fechaRegistro = $registro['fecha_registro'];
                $us = new Usuario($cedula, $nickname, $contrasena, $valido, $fechaRegistro);

                $usuarios[] = $us;
            }
            
            return $usuarios;
        }

        public function getInstanciaValidezRepresentante(array $valido) {
           $consulta = "SELECT u.cedula,
                               u.nickname,
                               u.contrasena,
                               u.valido,
                               u.fecha_registro
                           FROM USUARIO u
                           JOIN PERSONA p
                           ON (u.cedula = p.cedula)
                           WHERE valido=?
                                AND u.cedula=?
                                AND p.id_tipo_persona=1;";
           $registros = $this->bd->sql($consulta, $valido);

            if(!is_array($registros)) {
                throw new Exception('No existe usuario valido');
            }
            
            $usuarios = [];
            for($i=0; $i<count($registros); $i++) {
                $registro = $registros[$i];

                $cedula = $registro['cedula'];
                $nickname = $registro['nickname'];
                $contrasena = $registro['contrasena'];
                $valido = $registro['valido'];
                $fechaRegistro = $registro['fecha_registro'];
                $us = new Usuario($cedula, $nickname, $contrasena, $valido, $fechaRegistro);

                $usuarios[] = $us;
            }
            
            return $usuarios;
        }

        public function getInstanciaValidezRepresentanteFecha(array $valido) {
            $consulta = "SELECT u.cedula,
                                u.nickname,
                                u.contrasena,
                                u.valido,
                               u.fecha_registro
                            FROM USUARIO u
                            JOIN PERSONA p
                            ON (u.cedula = p.cedula)
                            WHERE valido=?
                                 AND u.cedula=?
                                 AND YEAR(u.fecha_registro) = ?
                                 AND MONTH(u.fecha_registro) = ?
                                 AND p.id_tipo_persona=1;";
            $registros = $this->bd->sql($consulta, $valido);
 
             if(!is_array($registros)) {
                 throw new Exception('No existe usuario valido');
             }
             
             $usuarios = [];
             for($i=0; $i<count($registros); $i++) {
                 $registro = $registros[$i];
 
                 $cedula = $registro['cedula'];
                 $nickname = $registro['nickname'];
                 $contrasena = $registro['contrasena'];
                 $valido = $registro['valido'];
                 $fechaRegistro = $registro['fecha_registro'];
                 $us = new Usuario($cedula, $nickname, $contrasena, $valido, $fechaRegistro);

                $usuarios[] = $us;
            }
            
            return $usuarios;
        }

        public function getInstanciaValidezTipoPersona(array $valido) {
            $consulta = 
                    "SELECT t.permisos
                    FROM persona		p
                    JOIN tipo_persona	t
                    ON (p.id_tipo_persona = t.id)
                    WHERE p.cedula = ?
                        AND valido=?";
            $registros = $this->bd->sql($consulta, $valido);

            if(!is_array($registros)) {
                throw new Exception('No existe usuario valido');
            }
            
            $usuarios = [];
            for($i=0; $i<count($registros); $i++) {
                $registro = $registros[$i];

                $cedula = $registro['cedula'];
                $nickname = $registro['nickname'];
                $contrasena = $registro['contrasena'];
                $valido = $registro['valido'];
                $fechaRegistro = $registro['fecha_registro'];
                $us = new Usuario($cedula, $nickname, $contrasena, $valido, $fechaRegistro);

                $usuarios[] = $us;
            }
            
            return $usuarios;
        }

        public function getInstanciaNickname(array $nickname) {
            $consulta = "SELECT * 
                        FROM usuario
                        WHERE nickname=?";
            $registros = $this->bd->sql($consulta, $nickname);

            if(!is_array($registros)) {
                throw new Exception('No existe usuario con dicho nickname.');
            }
            
            $usuarios = [];
            for($i=0; $i<count($registros); $i++) {
                $registro = $registros[$i];

                $cedula = $registro['cedula'];
                $nickname = $registro['nickname'];
                $contrasena = $registro['contrasena'];
                $valido = $registro['valido'];
                $fechaRegistro = $registro['fecha_registro'];
                $us = new Usuario($cedula, $nickname, $contrasena, $valido, $fechaRegistro);

                $usuarios[] = $us;
            }
            
            return $usuarios;
        }

        public function getInstanciaSesion(array $parametros) {
            $consulta = "SELECT * 
                        FROM usuario
                        WHERE nickname=? AND contrasena=?";
            $registros = $this->bd->sql($consulta, $parametros);

            if(!is_array($registros)) {
                throw new Exception('No existe usuario con dicho nickname.');
            }
            
            $usuarios = [];
            for($i=0; $i<count($registros); $i++) {
                $registro = $registros[$i];

                $cedula = $registro['cedula'];
                $nickname = $registro['nickname'];
                $contrasena = $registro['contrasena'];
                $valido = $registro['valido'];
                $fechaRegistro = $registro['fecha_registro'];
                $us = new Usuario($cedula, $nickname, $contrasena, $valido, $fechaRegistro);

                $usuarios[] = $us;
            }
            
            return $usuarios;
        }

        public function getPermisoUsuario(array $cedula) {
            $consulta = "SELECT t.permisos
                        FROM persona		p
                        JOIN tipo_persona	t
                        ON (p.id_tipo_persona = t.id)
                        WHERE p.cedula = ?";
            $registros = $this->bd->sql($consulta, $cedula);

            if(!is_array($registros)) {
                throw new Exception('No existe usuario valido');
            }
            
            $permiso = 0;
            for($i=0; $i<count($registros); $i++) {
                $registro = $registros[$i];

                $permiso = $registro['permisos'];
            }
            
            return $permiso;
        }

        /*
            Retorna a todos los usuarios existentes dentro de la base de datos
        */
        public function getTodos() {
            $consulta = "SELECT * 
                         FROM usuario
                         JOIN persona
                         ON (usuario.cedula=persona.cedula)
                         WHERE persona.id_tipo_persona=1";
             $registros = $this->bd->sql($consulta, null);

             if(empty($registros)) {
                throw new Exception('No existen registros de Usuarios.');
            }
            
            $usuarios = [];
            for($i=0; $i<count($registros); $i++) {
                $registro = $registros[$i];

                $cedula = $registro['cedula'];
                $nickname = $registro['nickname'];
                $contrasena = $registro['contrasena'];
                $valido = $registro['valido'];
                $fechaRegistro = $registro['fecha_registro'];
                $us = new Usuario($cedula, $nickname, $contrasena, $valido, $fechaRegistro);

                $usuarios[] = $us;
            }
            
            return $usuarios;
        }
        
        public function getTodosCedula($cedula) {
            $consulta = "SELECT u.cedula,
                                u.nickname,
                                u.contrasena,
                                u.valido,
                               u.fecha_registro
                        FROM USUARIO u
                        JOIN PERSONA p
                        ON (u.cedula = p.cedula)
                        WHERE u.cedula=?
                            AND p.id_tipo_persona=1";
             $registros = $this->bd->sql($consulta, $cedula);

             if(empty($registros)) {
                throw new Exception('No existen registros de Usuarios.');
            }
            
            $usuarios = [];
            for($i=0; $i<count($registros); $i++) {
                $registro = $registros[$i];

                $cedula = $registro['cedula'];
                $nickname = $registro['nickname'];
                $contrasena = $registro['contrasena'];
                $valido = $registro['valido'];
                $fechaRegistro = $registro['fecha_registro'];
                $us = new Usuario($cedula, $nickname, $contrasena, $valido, $fechaRegistro);

                $usuarios[] = $us;
            }
            
            return $usuarios;
        }

        public function getTodosTipoPersona($tipoPersona) {
            $consulta = "SELECT *
                        FROM usuario	u
                        JOIN persona	p
                        ON u.cedula = p.cedula
                        WHERE id_tipo_persona=?;";
             $registros = $this->bd->sql($consulta, $tipoPersona);

             if(empty($registros)) {
                throw new Exception('No existen registros de Usuarios.');
            }
            
            $usuarios = [];
            for($i=0; $i<count($registros); $i++) {
                $registro = $registros[$i];

                $cedula = $registro['cedula'];
                $nickname = $registro['nickname'];
                $contrasena = $registro['contrasena'];
                $valido = $registro['valido'];
                $fechaRegistro = $registro['fecha_registro'];
                $us = new Usuario($cedula, $nickname, $contrasena, $valido, $fechaRegistro);

                $usuarios[] = $us;
            }
            
            return $usuarios;
        }

        public function getTodosTipoPersonaRepresentante($tipoPersona) {
            $consulta = "SELECT *
                        FROM usuario	u
                        JOIN persona	p
                        ON u.cedula = p.cedula
                        WHERE id_tipo_persona=?
                            AND u.cedula = ?;";
             $registros = $this->bd->sql($consulta, $tipoPersona);

             if(empty($registros)) {
                throw new Exception('No existen registros de Usuarios.');
            }
            
            $usuarios = [];
            for($i=0; $i<count($registros); $i++) {
                $registro = $registros[$i];

                $cedula = $registro['cedula'];
                $nickname = $registro['nickname'];
                $contrasena = $registro['contrasena'];
                $valido = $registro['valido'];
                $fechaRegistro = $registro['fecha_registro'];
                $us = new Usuario($cedula, $nickname, $contrasena, $valido, $fechaRegistro);

                $usuarios[] = $us;
            }
            
            return $usuarios;
        }

        public function getTodosTipoPersonaValidez($tipoPersona) {
            $consulta = "SELECT *
                        FROM usuario	u
                        JOIN persona	p
                        ON u.cedula = p.cedula
                        WHERE id_tipo_persona=?
                            AND valido=?;";
             $registros = $this->bd->sql($consulta, $tipoPersona);

             if(empty($registros)) {
                throw new Exception('No existen registros de Usuarios.');
            }
            
            $usuarios = [];
            for($i=0; $i<count($registros); $i++) {
                $registro = $registros[$i];

                $cedula = $registro['cedula'];
                $nickname = $registro['nickname'];
                $contrasena = $registro['contrasena'];
                $valido = $registro['valido'];
                $fechaRegistro = $registro['fecha_registro'];
                $us = new Usuario($cedula, $nickname, $contrasena, $valido, $fechaRegistro);

                $usuarios[] = $us;
            }
            
            return $usuarios;
        }

        public function getTodosTipoPersonaValidezRepresentante($tipoPersona) {
            $consulta = "SELECT *
                        FROM usuario	u
                        JOIN persona	p
                        ON u.cedula = p.cedula
                        WHERE id_tipo_persona=?
                            AND u.valido=?
                            AND u.cedula=?;";
             $registros = $this->bd->sql($consulta, $tipoPersona);

             if(empty($registros)) {
                throw new Exception('No existen registros de Usuarios.');
            }
            
            $usuarios = [];
            for($i=0; $i<count($registros); $i++) {
                $registro = $registros[$i];

                $cedula = $registro['cedula'];
                $nickname = $registro['nickname'];
                $contrasena = $registro['contrasena'];
                $valido = $registro['valido'];
                $fechaRegistro = $registro['fecha_registro'];
                $us = new Usuario($cedula, $nickname, $contrasena, $valido, $fechaRegistro);

                $usuarios[] = $us;
            }
            
            return $usuarios;
        }

        public function cargar($parametros) {
            try {               //cedula nickname contrasena
                $cargar= "INSERT INTO usuario (cedula, 	nickname, 	contrasena)
                VALUES				          (?, 	    ?,          ?);";
                $registros = $this->bd->sql($cargar, $parametros);
            }
            catch(PDOException $e) {
                throw new DaoException(DaoException::USUARIO, DaoException::CARGAR, "ya existe un usuario con dicho nickname.");
            }
        }

        public function getTodosFecha($fecha) {
            $consulta = "SELECT *
                        FROM usuario	u
                        JOIN persona	p
                        ON u.cedula = p.cedula
                        WHERE YEAR(u.fecha_registro) = ?
                            AND MONTH(u.fecha_registro) = ?
                            AND p.id_tipo_persona=1;";
             $registros = $this->bd->sql($consulta, $fecha);

             if(empty($registros)) {
                throw new Exception('No existen registros de Usuarios.');
            }
            
            $usuarios = [];
            for($i=0; $i<count($registros); $i++) {
                $registro = $registros[$i];

                $cedula = $registro['cedula'];
                $nickname = $registro['nickname'];
                $contrasena = $registro['contrasena'];
                $valido = $registro['valido'];
                $fechaRegistro = $registro['fecha_registro'];
                $us = new Usuario($cedula, $nickname, $contrasena, $valido, $fechaRegistro);

                $usuarios[] = $us;
            }
            
            return $usuarios;
        }

        public function getTodosValidezFecha($fecha) {
            $consulta = "SELECT *
                        FROM usuario	u
                        JOIN persona	p
                        ON u.cedula = p.cedula
                        WHERE valido=?
                            AND p.id_tipo_persona=1
                            AND YEAR(u.fecha_registro) = ?
                            AND MONTH(u.fecha_registro) = ?";
             $registros = $this->bd->sql($consulta, $fecha);

             if(empty($registros)) {
                throw new Exception('No existen registros de Usuarios.');
            }
            
            $usuarios = [];
            for($i=0; $i<count($registros); $i++) {
                $registro = $registros[$i];

                $cedula = $registro['cedula'];
                $nickname = $registro['nickname'];
                $contrasena = $registro['contrasena'];
                $valido = $registro['valido'];
                $fechaRegistro = $registro['fecha_registro'];
                $us = new Usuario($cedula, $nickname, $contrasena, $valido, $fechaRegistro);

                $usuarios[] = $us;
            }
            
            return $usuarios;
        }

        public function getInstanciaFechaRep($fecha) {
            $consulta = "SELECT *
                        FROM usuario	u
                        JOIN persona	p
                        ON u.cedula = p.cedula
                        WHERE p.cedula = ?
                            AND p.id_tipo_persona=1
                            AND YEAR(u.fecha_registro) = ?
                            AND MONTH(u.fecha_registro) = ?";
             $registros = $this->bd->sql($consulta, $fecha);

             if(empty($registros)) {
                throw new Exception('No existen registros de Usuarios.');
            }
            
            $usuarios = [];
            for($i=0; $i<count($registros); $i++) {
                $registro = $registros[$i];

                $cedula = $registro['cedula'];
                $nickname = $registro['nickname'];
                $contrasena = $registro['contrasena'];
                $valido = $registro['valido'];
                $fechaRegistro = $registro['fecha_registro'];
                $us = new Usuario($cedula, $nickname, $contrasena, $valido, $fechaRegistro);

                $usuarios[] = $us;
            }
            
            return $usuarios;
        }

        public function modificar($parametros) {
            $update = " UPDATE usuario
                        SET nickname = ?,
                            contrasena = ?
                        WHERE cedula = ?;";
            $this->bd->sql($update, $parametros);
        }

        public function modificarNickname($parametros) {
            $update = " UPDATE usuario
                        SET nickname=?
                        WHERE cedula=?";
            $this->bd->sql($update, $parametros);
        }

        public function modificarAdmin($parametros) {
            $modificar = 
                "CALL p_modificar_usuario_admin(?, ?, ?)";
            $registros = $this->bd->sql($modificar, $parametros);
        }

        public function modificarValidez(array $parametros) {
            $update =  "UPDATE  usuario
                        SET     valido=?
                        WHERE cedula=?";
            $this->bd->sql($update, $parametros);
        }

        public function eliminar($parametros) {
            try {
                $delete =  "DELETE FROM usuario
                            WHERE cedula=?";
                $this->bd->sql($delete, $parametros);
            }
            catch(PDOException $e) {
                throw new DaoException(DaoException::USUARIOS, DaoException::ELIMINAR, "Existe alguna dependencia que impide borrar al usuario.");
            }
        }

        public function validarUsuario($nickname, $cedula) {
            $consulta = "SELECT *
                        FROM usuario
                        WHERE nickname=?
                            AND cedula=?";
            $registros = $this->bd->sql($consulta, array($nickname, $cedula));

            if(!empty($registros)) {
                return true;
            }

            $consulta = "SELECT *
                        FROM usuario
                        WHERE nickname=?";
            $registros = $this->bd->sql($consulta, array($nickname));

            if(empty($registros)) {
                return true;
            }
            
            return false;
        }

    }
?>