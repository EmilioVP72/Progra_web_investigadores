<?php
include_once("./views/login/header.php");

if (isset ($alerta['mensaje']) && isset ($alerta['tipo'])): ?>
<div class="alert alert-<?php echo $alerta['tipo']?>" role="alert">
    <?php echo $alerta['mensaje'];?>
</div>
<?php endif; 

include_once("./views/login/footer.php");
?>