<?php
session_save_path(__DIR__ . '/../sessions');
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit;
}

require_once "../classes/User.php";
$userClass = new User();
$userData = $userClass->getUserByUsername($_SESSION['username']);
if (!$userData) {
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
  <title>Perfil - Gestión de Usuarios</title>

  <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
  <main>
    <div class="main-container">
      <div>
        <h1>Perfil</h1>
        <p><strong>Username:</strong> <?php echo htmlspecialchars($userData['username']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($userData['email']); ?></p>

        <h2>Actualizar Username</h2>
        <form id="updateForm" action="../controllers/update_profile.php" method="POST" novalidate>
            <div>
              <label for="new_username">Nuevo Username</label><br>
              <input class="form-control" type="text" id="new_username" name="new_username" value="<?php echo htmlspecialchars($userData['username']); ?>">
            </div>
            
            <br>
            
            <button class="form-button" type="submit">Actualizar</button>
        </form>
        <div id="loading">Cargando...</div>
        <p id="message"></p>

        <br>
        <a href="dashboard.php">Volver al Dashboard</a>
      </div>
    </div>

    <footer class="site-footer">
      © 2025 Gestión de Usuarios. Todos los derechos reservados.
    </footer>
  </main>

  <script src="../assets/script.js"></script>
</body>
</html>