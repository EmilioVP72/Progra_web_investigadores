<?php
include_once("../models/sistema.php");
$app = new Sistema();
$app->checkRoll('Index');
include_once("./views/header.php");
$action = isset($_GET['action']) ? $_GET['action'] : 'login';

switch ($action){
    default:
        include_once("./views/index_main.php");
        break;
}

include_once("./views/footer.php");
?>
