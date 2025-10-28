<?php
include_once("../models/sistema.php");
$app = new Sistema();
$action = isset($_GET['action']) ? $_GET['action'] : 'login';

switch ($action){
    case 'logout':
        $app->logout();
        $alerta['mensaje'] = "Usted ha salido exitosamente del sistema";
            $alerta['tipo'] = "success";
            include_once("./views/alert.php");
            include_once("./views/login/login.php");
        break;
    
    case 'login':
        if (isset($_POST['enviar'])){
            $correo = $_POST['correo'];
            $contrasena = $_POST['contrasena'];
            $login = $app->login($correo, $contrasena);
            
            if ($login){
                header("Location: index.php");
            } else {
                $alerta['mensaje'] = "Correo o contraseña incorrectos";
                $alerta['tipo'] = "danger";
                include_once("./views/alert.php");
                include_once("./views/login/login.php");
            }
        } else {
            include_once("./views/login/login.php");
        }
        break;
    
    case 'recuperar':
        require_once("./views/login/recuperar.php");
        break;
    
    case 'cambio':
        $data = $_POST;
        $cambio = $app->cambiarContraseña($data);
        if($cambio){
            $alerta['mensaje'] = "Se ha enviado un correo con instrucciones para cambiar su contraseña";
            $alerta['tipo'] = "success";
            include_once("./views/alert.php");
            include_once("./views/login/login.php");
        } else{
            $alerta['mensaje'] = "Ocurrio un error al cambiar su contraseña";
            $alerta['tipo'] = "danger";
            include_once("./views/alert.php");
            include_once("./views/login/recuperar.php");
        }
        break;
    
    case 'token':
        require_once('./views/login/token.php');
        break;

    case 'restablecer':
        $data = $_POST;
        $reestablecer = $app->restablecerContraseña($data);
        if($reestablecer){
            $alerta['mensaje'] = "Su contraseña ha sido cambiada exitosamente";
            $alerta['tipo'] = "success";
            include_once("./views/alert.php");
            include_once("./views/login/recuperar.php");
        }else{
            $alerta['mensaje'] = "Ocurrio un error al cambiar su contraseña";
            $alerta['tipo'] = "danger";
            include_once("./views/alert.php");
            include_once("./views/login/token.php");
        }
        break;

    default:
        include_once("./views/login/login.php");
        break;
        }

?>