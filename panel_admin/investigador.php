<?php
require_once(__DIR__ . "/../models/investigador.php");
require_once(__DIR__ . "/../models/institucion.php");
require_once(__DIR__ . "/../models/tratamiento.php");    
$app = new Investigador();
$app->checkRoll('Administrador');
$appinstitucion = new Institucion();
$apptratamiento = new Tratamiento();
$instituciones = $appinstitucion->read();
$tratamientos = $apptratamiento->read();
$action = isset($_GET['action']) ? $_GET['action'] : 'read';
$data = array();
include_once(__DIR__ . "/views/header.php");

switch ($action){
    case 'create':
        if (isset($_POST['enviar'])){
            $data = $_POST;
            $filas = $app->create($data);
            if ($filas){
                $alerta['mensaje'] = "Investigador dado de alta con exito";
                $alerta['tipo'] = "success";
                include_once(__DIR__ . "/views/alert.php");
            } else {
                $alerta['mensaje'] = "El investigador no fue dado de alta";
                $alerta['tipo'] = "danger";
                include_once(__DIR__ . "/views/alert.php");
            }
            $data = $app->read();
            include_once(__DIR__ . "/views/investigador/index.php");
        } else {
            include_once(__DIR__ . "/views/investigador/_form.php");
        }
        break;

    case 'update':
        if (isset($_POST['enviar'])){
            $data = $_POST;
            $id = $_GET['id'];
            $filas = $app->update($id, $data);
            if ($filas){
                $alerta['mensaje'] = "Investiagador modificada con exito";
                $alerta['tipo'] = "success";
                include_once(__DIR__ . "/views/alert.php");
            } else {
                $alerta['mensaje'] = "El investigador no fue modificado";
                $alerta['tipo'] = "danger";
                include_once(__DIR__ . "/views/alert.php");
            }
            $data = $app->read();
            include_once(__DIR__ . "/views/investigador/index.php");
        } else {
            $id = $_GET['id'];
            $data = $app->readOne($id);
            include_once(__DIR__ . "/views/investigador/_form_update.php");
        }
        break;

    case 'delete':
        if (isset($_GET['id'])){
            $id = $_GET['id'];
            $filas = $app->delete($id);
            if ($filas){
                $alerta['mensaje'] = "Investigador eliminado con exito";
                $alerta['tipo'] = "success";
                include_once(__DIR__ . "/views/alert.php");
            } else {
                $alerta['mensaje'] = "El investigador no fue eliminado";
                $alerta['tipo'] = "danger";
                include_once(__DIR__ . "/views/alert.php");
            }
        }
        $data = $app->read();
        include_once(__DIR__ . "/views/investigador/index.php");
        break;

    case 'read':
    default:
        $data = $app->read();
        include_once(__DIR__ . "/views/investigador/index.php");
        break;
}

include_once(__DIR__ . "/views/footer.php");
?>