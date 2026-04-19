<?php
require "connexion.php";
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

$stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
$stmt->execute([$data["id"]]);

echo json_encode(["success" => true]);