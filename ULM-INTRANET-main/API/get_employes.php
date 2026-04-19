<?php
require "connexion.php";
header('Content-Type: application/json');

$stmt = $conn->query("SELECT * FROM employes ORDER BY id DESC");
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));