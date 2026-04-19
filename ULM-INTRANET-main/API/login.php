<?php
require "connexion.php";
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

$username = $data["username"] ?? "";
$password = $data["password"] ?? "";

if (!$username || !$password) {
    echo json_encode(["success" => false]);
    exit;
}

$stmt = $conn->prepare("SELECT id, username, password, role, avatar FROM users WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($password, $user["password"])) {

    unset($user["password"]); // on enlève le hash

    echo json_encode([
        "success" => true,
        "user" => $user
    ]);
} else {
    echo json_encode(["success" => false]);
}