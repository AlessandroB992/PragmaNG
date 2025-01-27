<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: /index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <?php include './includes/header.php'; ?>
    <title>Home</title>
</head>

<body>
    <div class="d-flex">
        <?php include('./includes/sidebar.php'); ?>
        <div class="d-flex flex-column m-auto">
            <h1 class="p-5 m-0 border-bottom border-2">Portale Gestione del Flusso M</h1>
            <img src="https://www.asptrapani.it/immagini/logo/logo-ente.png" alt="">
        </div>

    </div>
</body>

</html>