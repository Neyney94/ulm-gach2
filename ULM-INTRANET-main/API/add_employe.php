<?php
require "connexion.php";
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data["nom"], $data["prenom"], $data["artiste"], $data["poste"], $data["iban"], $data["arrivee"])) {
    echo json_encode(["success" => false]);
    exit;
}

try {
    $stmt = $conn->prepare("
        INSERT INTO employes
        (nom, prenom, artiste, poste, iban, arrivee)
        VALUES
        (:nom, :prenom, :artiste, :poste, :iban, :arrivee)
    ");

    $stmt->execute([
        ":nom" => $data["nom"],
        ":prenom" => $data["prenom"],
        ":artiste" => $data["artiste"],
        ":poste" => $data["poste"],
        ":iban" => $data["iban"],
        ":arrivee" => $data["arrivee"]
    ]);

    echo json_encode(["success" => true]);

} catch (PDOException $e) {
    echo json_encode(["success" => false]);
}