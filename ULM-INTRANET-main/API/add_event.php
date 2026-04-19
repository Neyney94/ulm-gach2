<?php
require "connexion.php";
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if (!isset(
    $data["name"], $data["date"], $data["organiser"],
    $data["phone"], $data["company"],
    $data["start"], $data["end"], $data["description"]
)) {
    echo json_encode(["success" => false]);
    exit;
}

$stmt = $conn->prepare("
    INSERT INTO events
    (name, date_event, organiser, phone, company, start_time, end_time, description)
    VALUES
    (:name, :date, :organiser, :phone, :company, :start, :end, :description)
");

$stmt->execute([
    ":name" => $data["name"],
    ":date" => $data["date"],
    ":organiser" => $data["organiser"],
    ":phone" => $data["phone"],
    ":company" => $data["company"],
    ":start" => $data["start"],
    ":end" => $data["end"],
    ":description" => $data["description"]
]);

echo json_encode(["success" => true]);