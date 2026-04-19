<?php
require "connexion.php";
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if (!isset($data["id"])) {
    echo json_encode(["success" => false]);
    exit;
}

$stmt = $conn->prepare("
    UPDATE employes SET
    nom = :nom,
    prenom = :prenom,
    artiste = :artiste,
    poste = :poste,
    iban = :iban,
    arrivee = :arrivee
    WHERE id = :id
");

$stmt->execute($data);

echo json_encode(["success" => true]);