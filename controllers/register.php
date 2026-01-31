<?php
ini_set('display_errors', 0);
error_reporting(0);
header('Content-Type: application/json');
require_once "../classes/User.php";

// Comprobamos que llegan datos por POST
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["success" => false, "message" => "Access not allowed"]);
    exit;
}

try {
    $user = new User();
    $message = $user->register($_POST["username"] ?? "", $_POST["email"] ?? "", $_POST["password"] ?? "");
    echo json_encode(["success" => true, "message" => $message]);
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
}
