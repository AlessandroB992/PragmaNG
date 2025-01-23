<?php
$servername = "192.168.1.36"; // Cambia con l'host del database
$username = "pragma";        // Cambia con il tuo username
$password = "6Propriotu!";            // Cambia con la tua password
$dbname = "pragma";        // Cambia con il nome del database

// Creazione della connessione
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica della connessione
if ($conn->connect_error) {
    die("Errore di connessione: " . $conn->connect_error);
}
?>
