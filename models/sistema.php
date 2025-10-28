<?php
session_start();

class Sistema{
    var $_dsn = "pgsql:host=postgres;dbname=database";
    var $_user = "user";
    var $_password = "password";
    var $_db = null;
    
    function connect(){
        $this->_db = new PDO($this->_dsn, $this->_user, $this->_password);

    }

    function cargarFotografia($carpeta, $nombre){
        $types = array('image/gif', 'image/jpeg', 'image/png');
        $maz_size = 5000 * 1024;
        if (isset($_FILES[$nombre])){
            $imagen = $_FILES[$nombre];
            if ($imagen['error'] == 0){
                if (in_array($imagen['type'], $types)){
                    if ($imagen['size'] <= $maz_size){
                        $n =  rand(1, 100000000);
                        $archive_name = md5($imagen['name'].$imagen['size'].$n.':b:B');
                        $extension = explode('.', $imagen['name']);
                        $extension = $extension[count($extension) - 1];
                        $archive_name = $archive_name.'.'.$extension;
                        $finalRoute = '../images/'.$carpeta.'/'.$archive_name;
                        if (!file_exists($finalRoute)) {
                            if(move_uploaded_file($imagen['tmp_name'],$finalRoute)){
                            return $archive_name;
                        } 
                        }
                    }
                }
            }        
        }
        return null;
    }

    public function login($correo, $contrasena){
        $contrasena = md5($contrasena);
        if(filter_var($correo, FILTER_VALIDATE_EMAIL)){
            $this->connect();
            $sql = "SELECT * FROM usuario WHERE correo = :correo AND contrasena = :contrasena";
            $stml = $this->_db->prepare($sql);
            $stml->bindParam(":correo", $correo, PDO::PARAM_STR);
            $stml->bindParam(":contrasena", $contrasena, PDO::PARAM_STR);
            $stml->execute();
            if($stml->rowCount() > 0){
                $_SESSION['validado'] = true;
                $_SESSION['correo'] = $correo;
                $roles = $this->getRoles($correo);
                $permisos = $this->getPermisos($correo);
                $_SESSION['rol'] = $roles;
                $_SESSION['privilegio'] = $permisos;
                return true;
            }
        }
    }

    public function logout(){
        unset($_SESSION);
        session_destroy();   
    }

    public function getRoles($correo){
        $this->connect();
        $sql = "SELECT r.rol FROM usuario u join usuario_rol ur on u.id_usuario = ur.id_usuario
                join rol r on ur.id_rol = r.id_rol where u.correo = :correo";
        $stml = $this->_db->prepare($sql);
        $stml->bindParam(":correo", $correo, PDO::PARAM_STR);
        $stml->execute();
        if($stml->rowCount() > 0){
            while($row = $stml->fetch(PDO::FETCH_ASSOC)){
                $roles[] = $row['rol'];
            }   
        }
        return $roles;

    }

    public function getPermisos($correo){
        $permisos = array();
        $this->connect();
        $sql = "SELECT distinct p.privilegio FROM usuario u join usuario_rol ur on u.id_usuario = ur.id_usuario
                LEFT JOIN rol r on ur.id_rol = r.id_rol
                LEFT JOIN rol_privilegio rp on r.id_rol = rp.id_rol
                LEFT JOIN privilegio p on rp.id_privilegio = p.id_privilegio where u.correo = :correo";
        $stml = $this->_db->prepare($sql);
        $stml->bindParam(":correo", $correo, PDO::PARAM_STR);
        $stml->execute();
        if($stml->rowCount() > 0){
            while($row = $stml->fetch(PDO::FETCH_ASSOC)){
                $permisos[] = $row['privilegio'];
            }   
        }
        return $permisos;
    }

    function checkRoll($rol){
        $roles = isset($_SESSION['rol']) ? $_SESSION['rol'] : array();
        if(!in_array($rol, $roles)){
            $alerta['mensaje'] = "Usted no tiene el rol adecuado";
            $alerta['tipo'] = "danger";
            include_once("./views/error.php");
            die();
        }
        return false;
    }
}
?>