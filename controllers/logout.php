<?php
ini_set('display_errors', 0);
error_reporting(0);
header('Content-Type: application/json');
session_save_path(__DIR__ . '/../sessions');
session_start();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["success" => false, "message" => "Access not allowed"]);
    exit;
}

session_destroy();
echo json_encode(["success" => true, "message" => "Logged out successfully"]);
?>