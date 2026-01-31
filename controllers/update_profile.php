<?php
ini_set('display_errors', 0);
error_reporting(0);
header('Content-Type: application/json');
session_save_path(__DIR__ . '/../sessions');
session_start();
require_once "../classes/User.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["success" => false, "message" => "Access not allowed"]);
    exit;
}

if (!isset($_SESSION['username'])) {
    echo json_encode(["success" => false, "message" => "Not logged in"]);
    exit;
}

$user = new User();

try {
    $message = $user->updateUsername($_SESSION['username'], $_POST["new_username"] ?? "");
    $_SESSION['username'] = $_POST["new_username"];
    echo json_encode(["success" => true, "message" => $message]);
} catch (Exception $e) {
    echo json_encode(["success" => false, "message" => $e->getMessage()]);
}
?>