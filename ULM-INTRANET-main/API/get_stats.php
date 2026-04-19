<?php

require "connexion.php";

header('Content-Type: application/json');

function countTable($conn, $table) {
    try {
        $stmt = $conn->query("SELECT COUNT(*) as total FROM $table");
        return $stmt->fetch(PDO::FETCH_ASSOC)["total"];
    } catch (Exception $e) {
        return 0;
    }
}

function countContratsEnAttente($conn) {
    try {
        $stmt = $conn->query("
            SELECT COUNT(*) as total
            FROM contrats
            WHERE statut = 'en_attente'
        ");
        return $stmt->fetch(PDO::FETCH_ASSOC)["total"];
    } catch (Exception $e) {
        return 0;
    }
}

function countLicenciementsEnAttente($conn) {
    try {
        $stmt = $conn->query("
            SELECT COUNT(*) as total
            FROM licenciements
            WHERE statut = 'en_attente'
        ");
        return $stmt->fetch(PDO::FETCH_ASSOC)["total"];
    } catch (Exception $e) {
        return 0;
    }
}

echo json_encode([
    "users" => countTable($conn, "users"),
    "contrats" => countContratsEnAttente($conn),
    "licenciements" => countLicenciementsEnAttente($conn),
    "events" => countTable($conn, "events"),
    "employes" => countTable($conn, "employes"),
    "music" => countTable($conn, "music_requests"),
    "ranking" => countTable($conn, "ranking")
]);