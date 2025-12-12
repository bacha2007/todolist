<?php
session_start();

require_once __DIR__ . '/../config/db.php';

 
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($email === '' || $password === '') {
        $errors[] = 'Email y contraseña son obligatorios.';
    } else {
        $stmt = $pdo->prepare('SELECT id, nombre, password FROM usuarios WHERE email = ?');
        $stmt->execute([$email]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['nombre'];

            header('Location: dashboard.php');
            exit;
        } else {
            $errors[] = 'Credenciales inválidas.';
        }
    }
}


include_once __DIR__ . '/../includes/header.php';
?>


<div class="row justify-content-center">
  <div class="col-md-6">
    <h2>Login</h2>

    <?php if (isset($_GET['registered'])): ?>
      <div class="alert alert-success">Registro hecho. Ahora si podes</div>
    <?php endif; ?>

    <?php if ($errors): ?>
      <div class="alert alert-danger">
        <?php foreach ($errors as $err) echo '<div>' . htmlspecialchars($err) . '</div>'; ?>
      </div>
    <?php endif; ?>

    <form method="post">
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" class="form-control" name="email" value="<?= htmlspecialchars($email ?? '') ?>">
      </div>

      <div class="mb-3">
        <label class="form-label">Contraseña</label>
        <input type="password" class="form-control" name="password">
      </div>

      <button class="btn btn-primary w-100">Ingresar</button>
    </form>
    No estas registrado? <a href="../publico/registro.php">hacelo aca
</a>  </div>
</div>

<?php include_once __DIR__ . '/../includes/footer.php'; ?>
