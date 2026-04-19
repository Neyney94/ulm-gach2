<?php

require "connexion.php";

header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if (!$data) {
    echo json_encode(["success" => false, "error" => "Aucune donnée reçue"]);
    exit;
}

try {

    $stmt = $conn->prepare("
        INSERT INTO contrats (nom, prenom, pseudo, poste, date_naissance)
        VALUES (:nom, :prenom, :pseudo, :poste, :date_naissance)
    ");

    $stmt->execute([
        ":nom" => $data["nom"],
        ":prenom" => $data["prenom"],
        ":pseudo" => $data["pseudo"],
        ":poste" => $data["poste"],
        ":date_naissance" => $data["date_naissance"]
    ]);

    echo json_encode(["success" => true]);

} catch (PDOException $e) {
    echo json_encode([
        "success" => false,
        "error" => $e->getMessage()
    ]);
}
?>