<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <?php include('./includes/header.php'); ?>
    <title>Home</title>
</head>

<body>
    <?php include('./includes/navbar.php'); ?>
    <div class="banner py-5 text-center">
        <h1>Portale Gestione del Flusso M</h1>
    </div>
</body>

</html>