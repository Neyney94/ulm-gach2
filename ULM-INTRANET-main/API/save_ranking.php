<?php
require "connexion.php";
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if (!is_array($data)) {
    echo json_encode(["success" => false]);
    exit;
}

/* On vide l'ancien classement */
$conn->query("DELETE FROM ranking");

$stmt = $conn->prepare("
    INSERT INTO ranking (position, name, streams)
    VALUES (:position, :name, :streams)
");

foreach ($data as $index => $artist) {
    $stmt->execute([
        ":position" => $index + 1,
        ":name" => $artist["name"],
        ":streams" => $artist["streams"]
    ]);
}

echo json_encode(["success" => true]);