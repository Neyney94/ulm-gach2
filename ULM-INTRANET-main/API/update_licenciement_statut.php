<?php

require "connexion.php";

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data["id"], $data["statut"])) {
    echo json_encode(["success" => false]);
    exit;
}

try {

    $stmt = $conn->prepare("
        UPDATE licenciements
        SET statut = :statut
        WHERE id = :id
    ");

    $stmt->execute([
        ":statut" => $data["statut"],
        ":id" => $data["id"]
    ]);

    echo json_encode(["success" => true]);

} catch (PDOException $e) {

    echo json_encode([
        "success" => false,
        "error" => $e->getMessage()
    ]);
}