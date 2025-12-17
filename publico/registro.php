<?php
require_once __DIR__ . '/../config/db.php';
include_once __DIR__ . '/../includes/header.php';

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = trim($_POST['nombre'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';
    $password2 = $_POST['password2'] ?? '';

    if ($nombre === '' || $email === '' || $password === '' || $password2 === '') {
        $errors[] = 'Todos los campos son obligatorios.';
    }

    if ($password !== $password2) {
        $errors[] = 'Las contraseñas no coinciden.';
    }

    if (!$errors) {
        $stmt = $pdo->prepare('SELECT id FROM usuarios WHERE email = ?');
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            $errors[] = 'El email ya está registrado.';
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $pdo->prepare('INSERT INTO usuarios (nombre, email, password) VALUES (?, ?, ?)');
            $stmt->execute([$nombre, $email, $hash]);
            header('Location: sesion.php?registered=1');
            exit;
        }
    }
}
?>

<div class="row justify-content-center">
  <div class="col-md-6">
    <h2>Registro</h2>

    <?php if ($errors): ?>
    <div class="alert alert-danger">
      <?php foreach ($errors as $err) echo '<div>' . htmlspecialchars($err) . '</div>'; ?>
    </div>
    <?php endif; ?>

    <form method="post">
      <div class="mb-3">
        <label class="form-label">Nombre</label>
        <input type="text" class="form-control" name="nombre" value="<?= htmlspecialchars($nombre ?? '') ?>">
      </div>

      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($email ?? '') ?>">
      </div>

      <div class="mb-3">
        <label class="form-label">Contraseña</label>
        <input type="password" class="form-control" name="password">
      </div>

      <div class="mb-3">
        <label class="form-label">Repetir Contraseña</label>
        <input type="password" class="form-control" name="password2">
      </div>

      <button class="btn btn-primary w-100">Registrarse</button>
    </form>
    ya tenes cuenta? inicia sesion <a href="../publico/sesion.php">aca</a>
  </div>
</div>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>
