<h1>Tratamientos</h1>
<div class="btn-group" role="group" aria-label="Basic mixed styles example">
    <a href="tratamiento.php?action=create" class="btn btn-success">Nuevo</a>
    <a class="btn btn-primary">Imprimir</a>
</div>
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Tratamiento</th>
            <th scope="col">Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($data as $tratamiento):?>
        <tr>
            <th scope="row"><?php echo $tratamiento['id_tratamiento'] ?></th>
            <td><?php echo $tratamiento['tratamiento']?></td>
            <td>
                <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                    <a href="tratamiento.php?action=update&id=<?php echo $tratamiento['id_tratamiento'];?>"  class="btn btn-warning">Editar</a>
                    <a href="tratamiento.php?action=delete&id=<?php echo $tratamiento['id_tratamiento'];?>" class="btn btn-danger">Eliminar</a>
                </div>
            </td>
        </tr>
        <?php endforeach?>
    </tbody>
</table>