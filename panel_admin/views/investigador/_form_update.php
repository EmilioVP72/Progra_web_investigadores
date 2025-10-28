<h1>Modificar Investigador</h1>
<form action="investigador.php?action=update&id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">

    <div class="mb-3">
        <td><img src="../images/investigadores/<?php echo $data['fotografia'] ?>" width="75" height="75" class="rounded-cicle" alt="fotografia"></td>
        <label for="fotografia" class="form-label"></label>
        <input type="file" class="form-control" id="fotografia" name="fotografia">
    </div>

    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $data['nombre']; ?>" required>
    </div>

    <div class="mb-3">
        <label for="primer_apellido" class="form-label">Apellido Paterno</label>
        <input type="text" class="form-control" id="primer_apellido" name="primer_apellido" value="<?php echo $data['primer_apellido']; ?>" required>
    </div>

    <div class="mb-3">
        <label for="segundo_apellido" class="form-label">Apellido Materno</label>
        <input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido" value="<?php echo $data['segundo_apellido']; ?>" required>
    </div>

    <div class="mb-3">
        <label for="id_institucion" class="form-label">Institución</label>
        <select class="form-select" id="id_institucion" name="id_institucion" required>
            <option selected disabled>Seleccione una institución</option>
            <?php foreach ($instituciones as $institucion):
                $selected = ("");
                if ($data['id_institucion'] == $institucion['id_institucion']) {
                    $selected = ("selected");
                }
            ?>
                <option <?php echo $selected; ?>value="<?php echo $institucion['id_institucion']; ?>"><?php echo $institucion['institucion']; ?></option>
            <?php endforeach ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="semblanza" class="form-label">Semblanza</label>
        <textarea class="form-control" id="semblanza" name="semblanza" required><?php echo $data['semblanza']; ?></textarea>
    </div>

    <div class="mb-3">
        <label for="id_tratamiento" class="form-label">Tratamiento</label>
        <select class="form-select" id="id_tratamiento" name="id_tratamiento" required>
            <option selected disabled>Seleccione un tratamiento</option>
            <?php foreach ($tratamientos as $tratamiento):
                $selected = ("");
                if ($data['id_tratamiento'] == $tratamiento['id_tratamiento']) {
                    $selected = ("selected");
                }
            ?>
                <option <?php echo $selected; ?> value="<?php echo $tratamiento['id_tratamiento']; ?>"><?php echo $tratamiento['tratamiento']; ?></option>
            <?php endforeach ?>
        </select>
    </div>

    <div class="mb-3">
        <input type="submit" class="btn btn-primary" id="enviar" name="enviar" value="Guardar"></input>
    </div>
</form>