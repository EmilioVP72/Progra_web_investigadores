<h1>Instituciones</h1>
<div class="btn-group" role="group" aria-label="Basic mixed styles example">
    <a href="institucion.php?action=create" class="btn btn-success">Nuevo</a>
    <a class="btn btn-primary">Imprimir</a>
</div>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Logotipo</th>
            <th scope="col">Institución</th
            <th scope="col">Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($data as $institucion):?>
        <tr>
            <th scope="row"><?php echo $institucion['id_institucion'] ?></th>
            <td><img src="../images/institucion/<?php echo $institucion['logotipo'] ?>" width="75" height="75"" class="rounded-cicle" alt="logotipo"></td>
            <td><?php echo $institucion['institucion'] ?></td>
            <td>
                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                    <a href="institucion.php?action=update&id=<?php echo $institucion['id_institucion'];?>"  class="btn btn-warning">Editar</a>
                    <a href="institucion.php?action=delete&id=<?php echo $institucion['id_institucion'];?>" class="btn btn-danger">Eliminar</a>
                </div>
            </td>
        </tr>
        <?php endforeach?>
    </tbody>
</table>