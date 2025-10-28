<h1>Nuevo Investigador</h1>
<form action="investigador.php?action=create" method="post" enctype="multipart/form-data">

    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Escribe aquí..." required>
    </div>

    <div class="mb-3">
        <label for="primer_apellido" class="form-label">Apellido Paterno</label>
        <input type="text" class="form-control" id="primer_apellido" name="primer_apellido" placeholder="Escribe aquí..." required>
    </div>

    <div class="mb-3">
        <label for="segundo_apellido" class="form-label">Apellido Materno</label>
        <input type="text" class="form-control" id="segundo_apellido" name="segundo_apellido" placeholder="Escribe aquí..." required>
    </div>

    <div class="mb-3">
        <label for="correo" class="form-label">Correo Electronico</label>
        <input type="text" class="form-control" id="correo" name="correo" placeholder="Escribe aquí..." required>
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Contraseña</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Escribe aquí..." required>
    </div>

    <div class="mb-3">
        <label for="id_institucion" class="form-label">Institución</label>
        <select class="form-select" id="id_institucion" name="id_institucion" required>
            <option selected disabled>Seleccione una institución</option>
            <?php foreach($instituciones as $institucion):?>
            <option value="<?php echo $institucion['id_institucion'];?>"><?php echo $institucion['institucion'];?></option>
            <?php endforeach ?>
        </select>
    </div>

    <div class="mb-3">
        <label for="semblanza" class="form-label">Semblanza</label>
        <textarea class="form-control" id="semblanza" name="semblanza" required></textarea>
    </div>

    <div class="mb-3">
        <label for="fotografia" class="form-label">Fotografía</label>
        <input type="file" class="form-control" id="fotografia" name="fotografia" placeholder="foto.png">
    </div>

    <div class="mb-3">
        <label for="id_tratamiento" class="form-label">Tratamiento</label>
        <select class="form-select" id="id_tratamiento" name="id_tratamiento" required>
            <option selected disabled>Seleccione un tratamiento</option>
            <?php foreach($tratamientos as $tratamiento):?>
            <option value="<?php echo $tratamiento['id_tratamiento'];?>"><?php echo $tratamiento['tratamiento'];?></option>
            <?php endforeach ?>
        </select>
    </div>

    <div class="mb-3">
        <input type="submit" class="btn btn-primary" id="enviar" name="enviar" value="Guardar"></input>
    </div>
</form>