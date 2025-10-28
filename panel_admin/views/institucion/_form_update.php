<h1>Modificar Institución</h1>
<form action="institucion.php?action=update&id=<?php echo $id;?>" method="post">
    <div class="mb-3">
        <label for="Institucion" class="form-label">Nombre de la Institución</label>
        <input type="text" class="form-control" id="institucion" name="institucion" value="<?php echo $data['institucion']; ?>" placeholder="Escribe aqui..." required>
    </div>
    <div class="mb-3">
        <label for="logotipo" class="form-label">Logotipo de la Institución</label>
        <input type="text" class="form-control" id="logotipo" name="logotipo" value="<?php echo $data['logotipo']; ?>" placeholder="logo.png">
    </div>
    <div class="mb-3">
        <input type="submit" class="btn btn-primary" id="enviar" name="enviar" value="Guardar">Guardar</input>
    </div>
</form>