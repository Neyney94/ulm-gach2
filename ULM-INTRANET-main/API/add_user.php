<?php
require "connexion.php";
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

$username = $data["username"];
$password = password_hash($data["password"], PASSWORD_DEFAULT);
$role = $data["role"];

$stmt = $conn->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
$stmt->execute([$username, $password, $role]);

echo json_encode(["success" => true]);