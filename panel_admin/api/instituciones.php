<?php
require_once __DIR__ . '/../../models/institucion.php'; 

$app = new Institucion();
$app->checkRoll('Administrador');
$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();

switch ($action){
    case 'create':
        if (isset($_POST['enviar'])){
            $data['institucion'] = $_POST['institucion'];
            $data['logotipo'] = $_POST['logotipo'];
            $filas = $app->create($data);
            if ($filas){
                $alerta['mensaje'] = "Institución dada de alta con exito";
                $alerta['tipo'] = "success";
            } else {
                $alerta['mensaje'] = "La institución no fue dada de alta";
                $alerta['tipo'] = "danger";
            }
            $data = $app->read();
        } else {
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
            } else {
                $alerta['mensaje'] = "La institución no fue modificada";
                $alerta['tipo'] = "danger";
            }
            $data = $app->read();
        } else {
            $id = $_GET['id'];
            $data = $app->readOne($id);
        }
        break;

    case 'delete':
        if (isset($_GET['id'])){
            $id = $_GET['id'];
            $filas = $app->delete($id);
            if ($filas){
                $alerta['mensaje'] = "Institución eliminada con exito";
                $alerta['tipo'] = "success";
            } else {
                $alerta['mensaje'] = "La institución no fue eliminada";
                $alerta['tipo'] = "danger";
            }
        }
        $data = $app->read();
        break;

    case 'read':
    default:
        $data = $app->read();
        print_r($data);
        die();
        break;
}

?>