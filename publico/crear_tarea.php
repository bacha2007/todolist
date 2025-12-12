<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require_once __DIR__ . '/../config/db.php';
include_once __DIR__ . '/../includes/header.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo'] ?? '');

    if ($titulo === '') {
        $errors[] = 'El campo de tarea no puede estar vacío.';
    }

    if (!$errors) {
        $stmt = $pdo->prepare('INSERT INTO tareas (usuario_id, titulo, estado, creado_at) VALUES (?, ?, "pendiente", NOW())');
        $stmt->execute([$_SESSION['user_id'], $titulo]);
        header('Location: dashboard.php');
        exit;
    }
}
?>

<h2>Nueva Tarea</h2>

<?php if ($errors): ?>
<div class="alert alert-danger">
  <?php foreach ($errors as $e) echo '<div>' . htmlspecialchars($e) . '</div>'; ?>
</div>
<?php endif; ?>

<form method="post">
  <div class="mb-3">
    <label class="form-label">Título de la Tarea</label>
    <input type="text" class="form-control" name="titulo" value="<?= htmlspecialchars($titulo ?? '') ?>">
  </div>

  <button class="btn btn-success">Crear</button>
  <a href="dashboard.php" class="btn btn-secondary">Volver</a>
</form>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>
