<?php
require "connexion.php";
header('Content-Type: application/json');

$stmt = $conn->query("SELECT * FROM logs ORDER BY id DESC LIMIT 50");
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));