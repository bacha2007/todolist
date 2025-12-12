<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require_once __DIR__ . '/../config/db.php';
include_once __DIR__ . '/../includes/header.php';

$user_id = $_SESSION['user_id'];
$filter = $_GET['filter'] ?? 'todas';

$query = "SELECT * FROM tareas WHERE usuario_id = ?";
$params = [$user_id];

if ($filter === 'pendientes') {
    $query .= " AND estado = 'pendiente'";
} elseif ($filter === 'completadas') {
    $query .= " AND estado = 'completada'";
}

$query .= " ORDER BY creado_at DESC";
$stmt = $pdo->prepare($query);
$stmt->execute($params);
$tareas = $stmt->fetchAll();
?>

<h2>Mis Tareas</h2>
<p>Hola, <?= htmlspecialchars($_SESSION['user_name']) ?>!</p>

<a href="crear_tarea.php" class="btn btn-success mb-3">Nueva Tarea</a>
<a href="?filter=todas" class="btn btn-secondary">Todas</a>
<a href="?filter=pendientes" class="btn btn-warning">Pendientes</a>
<a href="?filter=completadas" class="btn btn-info">Completadas</a>
<a href="../publico/logout.php" class="btn btn-danger float-end">Cerrar Sesión</a>

<table class="table table-striped mt-3">
  <thead>
    <tr>
      <th>Tarea</th>
      <th>Estado</th>
      <th>Acciones</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($tareas as $t): ?>
    <tr>
      <td><?= htmlspecialchars($t['titulo']) ?></td>
      <td>
        <?php if ($t['estado'] === 'pendiente'): ?>
          <span class="badge bg-warning">Pendiente</span>
        <?php else: ?>
          <span class="badge bg-success">Completada</span>
        <?php endif; ?>
      </td>
      <td>
        <?php if ($t['estado'] === 'pendiente'): ?>
          <a href="marcar_completada.php?id=<?= $t['id'] ?>" class="btn btn-sm btn-primary">Completar</a>
        <?php endif; ?>

        <a href="eliminar_tarea.php?id=<?= $t['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar tarea?');">Eliminar</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>
