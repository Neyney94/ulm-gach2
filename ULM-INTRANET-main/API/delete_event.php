<?php
require "connexion.php";
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

$stmt = $conn->prepare("DELETE FROM events WHERE id = :id");
$stmt->execute([":id" => $data["id"]]);

echo json_encode(["success" => true]);