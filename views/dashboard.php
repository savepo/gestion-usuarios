<?php
session_save_path(__DIR__ . '/../sessions');
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Content-Security-Policy" content="default-src 'self'; script-src 'self'; connect-src 'self'">
  <title>Dashboard - Gestión de Usuarios</title>

  <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
  <main>
    <div class="main-container">
      <div>
        <h1>Dashboard</h1>
        <h2>Bienvenido, <?php echo htmlspecialchars($_SESSION['username']); ?></h2>
        <p>Has iniciado sesión correctamente.</p>
        <p>Aquí puedes gestionar tus usuarios o realizar otras acciones.</p>
        <a href="profile.php">Ver Perfil</a> | <button id="logoutBtn">Cerrar sesión</button>
      </div>
    </div>

    <footer class="site-footer">
      © 2025 Gestión de Usuarios. Todos los derechos reservados.
    </footer>
  </main>

  <script src="../assets/script.js"></script>
</body>
</html>