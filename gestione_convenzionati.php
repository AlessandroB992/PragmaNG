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
    <?php include('./includes/header.php'); ?>
    <title>Gestione Convenzionati</title>
</head>

<body>
    <?php include('./includes/navbar.php'); ?>
    <div class="container my-5">
        <h1>Gestione Convenzionati</h1>
        <p>Questa è la pagina per gestire i convenzionati.</p>
    </div>
</body>

</html>