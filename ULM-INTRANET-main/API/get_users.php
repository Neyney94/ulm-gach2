<?php
require "connexion.php";
header('Content-Type: application/json');

$stmt = $conn->query("SELECT id, username, role, avatar FROM users ORDER BY id DESC");
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));