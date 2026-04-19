<?php

require "connexion.php";

header('Content-Type: application/json');

try {

    $stmt = $conn->prepare("
        SELECT id, nom, prenom, pseudo, poste, date_naissance, date_demande, statut
        FROM contrats
        WHERE statut = 'en_attente'
        ORDER BY id DESC
    ");

    $stmt->execute();

    $contrats = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($contrats);

} catch (PDOException $e) {

    echo json_encode([
        "success" => false,
        "error" => $e->getMessage()
    ]);
}