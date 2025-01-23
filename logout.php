<?php
session_start(); // Avvia la sessione

// Distrugge la sessione e rimuove tutte le variabili di sessione
session_unset();
session_destroy();

// Reindirizza alla pagina di login
header("Location: index.php");
exit();
?>
