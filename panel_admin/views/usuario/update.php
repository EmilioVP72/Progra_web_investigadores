<?php
require_once("../../models/sistema.php");
require_once("../../models/usuario.php");

$sistema = new Sistema();
$usuario = new Usuario();

// Verificar si el usuario está autenticado y tiene el rol adecuado
if (!$sistema->checkRoll('administrador')) {
    die("Acceso denegado. No tienes permisos para editar usuarios.");
}

$id_usuario = null;
$user_data = [];

if (isset($_GET['id'])) {
    $id_usuario = $_GET['id'];
    $user_data = $usuario->readOne($id_usuario);
    if (!$user_data) {
        $sistema->alerta("Usuario no encontrado.", "danger");
        header("Location: index.php");
        exit();
    }
} elseif (isset($_POST['id_usuario'])) {
    $id_usuario = $_POST['id_usuario'];
} else {
    $sistema->alerta("ID de usuario no proporcionado.", "danger");
    header("Location: index.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $id_usuario) {
    $data = [
        'correo' => $_POST['correo'],
        'password' => $_POST['password'] // Puede estar vacío
    ];

    $affectedRows = $usuario->update($id_usuario, $data);
    if ($affectedRows !== null) { // update puede devolver 0 si no hay cambios, pero no null si es exitoso
        $sistema->alerta("Usuario actualizado correctamente.", "success");
        header("Location: index.php");
        exit();
    } else {
        $sistema->alerta("Error al actualizar el usuario.", "danger");
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <!-- Incluir Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Editar Usuario</h1>

        <?php $sistema->showAlerta(); // Mostrar alertas si las hay ?>

        <form action="update.php" method="POST">
            <input type="hidden" name="id_usuario" value="<?php echo htmlspecialchars($id_usuario); ?>">
            <div class="mb-3">
                <label for="correo" class="form-label">Correo Electrónico:</label>
                <input type="email" class="form-control" id="correo" name="correo" value="<?php echo htmlspecialchars($user_data['correo'] ?? ''); ?>" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Nueva Contraseña (dejar en blanco para no cambiar):</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-success">Actualizar Usuario</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>

    <!-- Incluir Bootstrap JS (opcional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>