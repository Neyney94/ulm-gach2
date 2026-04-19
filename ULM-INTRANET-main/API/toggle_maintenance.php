<?php
require "connexion.php";
header('Content-Type: application/json');

$stmt = $conn->query("SELECT maintenance FROM site_settings WHERE id = 1");
$current = $stmt->fetch(PDO::FETCH_ASSOC)["maintenance"];

$new = $current ? 0 : 1;

$update = $conn->prepare("UPDATE site_settings SET maintenance = :m WHERE id = 1");
$update->execute([":m" => $new]);

echo json_encode(["success" => true, "maintenance" => $new]);