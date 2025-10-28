<h1>Modificar tratamiento</h1>
<form action="tratamiento.php?action=update&id=<?php echo $id;?>" method="post">
    <div class="mb-3">
        <label for="Tratamiento" class="form-label">Nombre del Tratamiento</label>
        <input type="text" class="form-control" id="tratamiento" name="tratamiento" value="<?php echo $data['tratamiento']; ?>" placeholder="Escribe aqui..." required>
    </div>
    <div class="mb-3">
        <input type="submit" class="btn btn-primary" id="enviar" name="enviar" value="Guardar">Guardar</input>
    </div>
</form>