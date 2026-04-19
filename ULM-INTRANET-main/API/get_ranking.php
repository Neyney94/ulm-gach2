<?php
require "connexion.php";
header('Content-Type: application/json');

$stmt = $conn->query("SELECT * FROM ranking ORDER BY position ASC");
echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));