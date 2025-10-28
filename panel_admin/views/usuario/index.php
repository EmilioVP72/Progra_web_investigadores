<?php
require_once("../../models/sistema.php");
require_once("../../models/usuario.php");

$sistema = new Sistema();
$usuario = new Usuario();

// Verificar si el usuario está autenticado y tiene el rol adecuado
// Asumiendo que 'administrador' es el rol que puede gestionar usuarios
if (!$sistema->checkRoll('administrador')) {
    // Si no tiene el rol, redirigir o mostrar un mensaje de error
    // Por simplicidad, aquí solo se detiene la ejecución.
    // En un entorno real, podrías redirigir a una página de inicio o de error.
    die("Acceso denegado. No tienes permisos para ver esta sección.");
}

// Manejar la eliminación de un usuario
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id_usuario = $_GET['id'];
    $affectedRows = $usuario->delete($id_usuario);
    if ($affectedRows) {
        $sistema->alerta("Usuario eliminado correctamente.", "success");
    } else {
        $sistema->alerta("Error al eliminar el usuario.", "danger");
    }
    header("Location: index.php"); // Redirigir para evitar reenvío del formulario
    exit();
}

$data = $usuario->read();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Usuarios</title>
    <!-- Incluir Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Gestión de Usuarios</h1>

        <?php $sistema->showAlerta(); // Mostrar alertas si las hay ?>

        <a href="create.php" class="btn btn-primary mb-3">Nuevo Usuario</a>

        <div class="table-responsive">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Correo</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($data)): ?>
                        <?php foreach ($data as $user): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($user['id_usuario']); ?></td>
                                <td><?php echo htmlspecialchars($user['correo']); ?></td>
                                <td>
                                    <a href="update.php?id=<?php echo htmlspecialchars($user['id_usuario']); ?>" class="btn btn-warning btn-sm">Editar</a>
                                    <a href="index.php?action=delete&id=<?php echo htmlspecialchars($user['id_usuario']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de que quieres eliminar este usuario?');">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="text-center">No hay usuarios registrados.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Incluir Bootstrap JS (opcional, para componentes interactivos) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>