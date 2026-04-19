<?php

require "connexion.php";

header('Content-Type: application/json');

error_reporting(0); 
ini_set('display_errors', 0);

$data = json_decode(file_get_contents("php://input"), true);

if (
    !isset($data["nom"], $data["prenom"], $data["poste"],
            $data["arrivee"], $data["raison"])
) {
    echo json_encode(["success" => false]);
    exit;
}

try {

    $stmt = $conn->prepare("
        INSERT INTO licenciements
        (nom, prenom, poste, arrivee, raison, date_demande, statut)
        VALUES
        (:nom, :prenom, :poste, :arrivee, :raison, NOW(), 'en_attente')
    ");

    $stmt->execute([
        ":nom" => $data["nom"],
        ":prenom" => $data["prenom"],
        ":poste" => $data["poste"],
        ":arrivee" => $data["arrivee"],
        ":raison" => $data["raison"]
    ]);

    echo json_encode(["success" => true]);
    exit;

} catch (PDOException $e) {

    echo json_encode(["success" => false]);
    exit;
}