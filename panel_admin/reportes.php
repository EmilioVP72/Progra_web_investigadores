<?php
require_once __DIR__.('/../models/sistema.php');
require_once __DIR__.('/../models/institucion.php');
require_once __DIR__.('/../models/reportes.php');
require_once __DIR__.('/../vendor/autoload.php');

$app = new Reportes();
ob_start();

$action = isset($_GET['action']) ? $_GET['action'] : 'read';

switch($action){
    case 'institucionesInvestigadores':
        $app->checkRoll('Administrador');
        $app->institucionesInvestigadores();
        break;
    default:
        $app->institucionesInvestigadores();
        break;
}
?>