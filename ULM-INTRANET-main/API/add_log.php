<?php
require "connexion.php";
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data["user"], $data["role"], $data["action"], $data["details"])) {
    echo json_encode(["success" => false]);
    exit;
}

$stmt = $conn->prepare("
    INSERT INTO logs (user, role, action, details)
    VALUES (:user, :role, :action, :details)
");

$stmt->execute([
    ":user" => $data["user"],
    ":role" => $data["role"],
    ":action" => $data["action"],
    ":details" => $data["details"]
]);

echo json_encode(["success" => true]);