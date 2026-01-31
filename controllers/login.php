<?php
ini_set('display_errors', 0);
error_reporting(0);
header('Content-Type: application/json');
session_save_path(__DIR__ . '/../sessions');
session_start();
require_once "../classes/User.php";

// Comprobamos que llegan datos por POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["success" => false, "message" => "Access not allowed"]);
    exit;
}

try {
    $user = new User();
    $username = $user->login($_POST["email"] ?? "", $_POST["password"] ?? "");
    $_SESSION['username'] = $username;
    echo json_encode(["success" => true, "message" => "Login successful"]);
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
}
?>