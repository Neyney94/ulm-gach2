<?php
require "connexion.php";
header('Content-Type: application/json');

$stmt = $conn->query("SELECT * FROM events ORDER BY date_event ASC");
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));