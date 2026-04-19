<?php
$host = "localhost";
$dbname = "ulmrecor_db";
$username = "ulmrecor_esteban";
$password = ",vUT%Z}4D^S=0r!s";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur connexion : " . $e->getMessage());
}
?>