<h1>Nueva Institución</h1>
<form action="institucion.php?action=create" method="post">
    <div class="mb-3">
        <label for="Institucion" class="form-label">Nombre de la Institución</label>
        <input type="text" class="form-control" id="institucion" name="institucion" placeholder="Escribe aqui..." required>
    </div>
    <div class="mb-3">
        <label for="logotipo" class="form-label">Logotipo de la Institución</label>
        <input type="text" class="form-control" id="logotipo" name="logotipo" placeholder="logo.png">
    </div>
    <div class="mb-3">
        <input type="submit" class="btn btn-primary" id="enviar" name="enviar" value="Guardar">Guardar</input>
    </div>
</form>