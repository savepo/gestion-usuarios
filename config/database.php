<?php

$host = "localhost";
$dbname = "gestion_usuarios_db";
$user = "root";
$password = ""; // en XAMPP suele estar vacío

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $user,
        $password
    );

    // Opciones recomendadas
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("Connection error:  " . $e->getMessage());
}
