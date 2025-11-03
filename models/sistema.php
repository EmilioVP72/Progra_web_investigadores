<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

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

    function enviarCorreo($para, $asunto, $mensaje, $nombre = null){
        require '../vendor/autoload.php';
        $mail = new PHPMailer();
        $mail->SMTPOptions = [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            ]
        ];
        $mail->isSMTP();
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 465;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->SMTPAuth = true;
        $mail->Username = '22030918@itcelaya.edu.mx';
        $mail->Password = 'fwrrlwwizgkksqbd';
        $mail->setFrom('22030918@itcelaya.edu.mx', 'Emilio Francisco Vazquez Perez');
        $mail->addAddress($para, $nombre ? $nombre : 'Red de Investigación');
        $mail->Subject = $asunto;
        $mail->msgHTML($mensaje);
        if (!$mail->send()) {
            return false;
        } else {
            return true;
        }
    }

    function cambiarContraseña($data){
        if(!filter_var($data['correo'], FILTER_VALIDATE_EMAIL)){
            return false;
        }
        $this->connect();
        $token = bin2hex(random_bytes(16));
        $token = md5($token);
        $token = $token.md5('CruzAzulCampeon');
        $sql = "UPDATE usuario SET token = :token
                WHERE correo = :correo";
        $sth = $this->_db->prepare($sql);
        $sth->bindParam(":token", $token, PDO::PARAM_STR);
        $sth->bindParam(":correo", $data['correo'], PDO::PARAM_STR);
        $sth->execute();
        if($sth->rowCount() > 0){
            $para = $data['correo'];
            $asunto = "Recuperación de Contraseña Red de Investigación";
            $mensaje = "Para cambiar su contraseña ingrese al siguiente link:
                <br><br><a href='http://localhost:8080/proyecto_v2_bootstrap/panel_admin/login.php?action=token&token=". $token. 
                "&correo=". $data['correo']. "'>Recuperar Contraseña</a>
                <br><br>Atentamente, Adinistrador de Red de Investigación.";
            $mail = $this->enviarCorreo($para, $asunto, $mensaje);
            return true;
        } else{
            return false;
        }
    }

    function restablecerContraseña($data){
        if(!filter_var($data['correo'], FILTER_VALIDATE_EMAIL)){
            return false;
        }
        $this->connect();
        $contrasena = md5($data['contrasena']);
        $sql = "UPDATE usuario SET contrasena = :contrasena, token = NULL
                WHERE correo = :correo AND token = :token";
        $sth = $this->_db->prepare($sql);
        $sth->bindparam(":contrasena", $contrasena, PDO::PARAM_STR);
        $sth->bindparam(":correo", $data['correo'], PDO::PARAM_STR);
        $sth->bindparam(":token", $data['token'], PDO::PARAM_STR);
        $sth->execute();
        if($sth->rowCount() > 0){
            return true;
        } else{
            return false;
        }
    }
}
?>