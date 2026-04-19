<?php
$conn = new mysqli("localhost", "ulmrecor_esteban", "esteban1611", "ulmrecor_db");

if ($conn->connect_error) {
    die("Erreur : " . $conn->connect_error);
}

echo "Connexion OK";
?>