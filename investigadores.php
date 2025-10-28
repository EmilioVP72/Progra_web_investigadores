<?php
include_once("./views/header.php");
require_once("./models/investigador.php");
$app = new Investigador();
$investigadores = $app -> read();
require_once("./views/investigadores/index.php");
include_once("./views/footer.php");
?>
