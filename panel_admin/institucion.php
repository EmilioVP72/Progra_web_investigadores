<?php
require_once("../models/institucion.php");

$app = new Institucion();
$app->checkRoll('Administrador');
$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();
include_once("./views/header.php");

switch ($action){
    case 'create':
        if (isset($_POST['enviar'])){
            $data['institucion'] = $_POST['institucion'];
            $data['logotipo'] = $_POST['logotipo'];
            $filas = $app->create($data);
            if ($filas){
                $alerta['mensaje'] = "Institución dada de alta con exito";
                $alerta['tipo'] = "success";
                include_once("./views/alert.php");
            } else {
                $alerta['mensaje'] = "La institución no fue dada de alta";
                $alerta['tipo'] = "danger";
                include_once("./views/alert.php");
            }
            $data = $app->read();
            include_once("./views/institucion/index.php");
        } else {
            include_once("./views/institucion/_form.php");
        }
        break;

    case 'update':
        if (isset($_POST['enviar'])){
            $data['institucion'] = $_POST['institucion'];
            $data['logotipo'] = $_POST['logotipo'];
            $id = $_GET['id'];
            $filas = $app->update($id, $data);
            if ($filas){
                $alerta['mensaje'] = "Institución modificada con exito";
                $alerta['tipo'] = "success";
                include_once("./views/alert.php");
            } else {
                $alerta['mensaje'] = "La institución no fue modificada";
                $alerta['tipo'] = "danger";
                include_once("./views/alert.php");
            }
            $data = $app->read();
            include_once("./views/institucion/index.php");
        } else {
            $id = $_GET['id'];
            $data = $app->readOne($id);
            include_once("./views/institucion/_form_update.php");
        }
        break;

    case 'delete':
        if (isset($_GET['id'])){
            $id = $_GET['id'];
            $filas = $app->delete($id);
            if ($filas){
                $alerta['mensaje'] = "Institución eliminada con exito";
                $alerta['tipo'] = "success";
                include_once("./views/alert.php");
            } else {
                $alerta['mensaje'] = "La institución no fue eliminada";
                $alerta['tipo'] = "danger";
                include_once("./views/alert.php");
            }
        }
        $data = $app->read();
        include_once("./views/institucion/index.php");
        break;

    case 'read':
    default:
        $data = $app->read();
        include_once("./views/institucion/index.php");
        break;
}

include_once("./views/footer.php");
?>