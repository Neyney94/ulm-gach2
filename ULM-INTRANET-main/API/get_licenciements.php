<?php

require "connexion.php";

header('Content-Type: application/json');

try {

    $stmt = $conn->prepare("
        SELECT id, nom, prenom, poste, raison, date_demande, statut
        FROM licenciements
        WHERE statut = 'en_attente'
        ORDER BY id DESC
    ");

    $stmt->execute();

    $licenciements = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($licenciements);

} catch (PDOException $e) {

    echo json_encode([
        "success" => false,
        "error" => $e->getMessage()
    ]);
}