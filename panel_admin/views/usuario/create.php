<?php
require_once("../../models/sistema.php");
require_once("../../models/usuario.php");

$sistema = new Sistema();
$usuario = new Usuario();

if (!$sistema->checkRoll('administrador')) {
    die("Acceso denegado. No tienes permisos para crear usuarios.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'correo' => $_POST['correo'],
        'password' => $_POST['password']
    ];

    $affectedRows = $usuario->create($data);
    if ($affectedRows) {
        $sistema->alerta("Usuario creado correctamente.", "success");
        header("Location: index.php");
        exit();
    } else {
        $sistema->alerta("Error al crear el usuario. El correo podría ya existir.", "danger");
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nuevo Usuario</title>
    <!-- Incluir Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Crear Nuevo Usuario</h1>

        <?php $sistema->showAlerta(); // Mostrar alertas si las hay ?>

        <form action="create.php" method="POST">
            <div class="mb-3">
                <label for="correo" class="form-label">Correo Electrónico:</label>
                <input type="email" class="form-control" id="correo" name="correo" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-success">Guardar Usuario</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

    <!-- Incluir Bootstrap JS (opcional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>