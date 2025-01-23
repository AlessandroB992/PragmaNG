<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestione Convenzionati</title>
    <!-- Bootstrap Italia CSS -->
    <link rel="stylesheet" href="assets/bootstrap-italia/css/bootstrap-italia.min.css">
</head>

<body>
    <?php include('navbar.php'); ?>
    <div class="container my-5">
        <h1>Gestione Convenzionati</h1>
        <p>Questa è la pagina per gestire i convenzionati.</p>
    </div>
</body>

</html>
