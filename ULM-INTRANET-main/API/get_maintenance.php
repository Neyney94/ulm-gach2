<?php
require "connexion.php";
header('Content-Type: application/json');

$stmt = $conn->query("SELECT maintenance FROM site_settings WHERE id = 1");
$data = $stmt->fetch(PDO::FETCH_ASSOC);

echo json_encode(["maintenance" => (int)$data["maintenance"]]);