<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require_once __DIR__ . '/../config/db.php';

if (!isset($_GET['id'])) {
    header('Location: dashboard.php');
    exit;
}

$tarea_id = (int) $_GET['id'];
$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare('UPDATE tareas SET estado = "completada" WHERE id = ? AND usuario_id = ?');
$stmt->execute([$tarea_id, $user_id]);

header('Location: dashboard.php');
exit;
