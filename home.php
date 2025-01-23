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
    <title>Home</title>
</head>

<body>
    <?php include('./includes/navbar.php'); ?>
    <div class="container my-5">
        <h1>Benvenuto nella pagina Home</h1>
        <p>Questa è una semplice pagina di esempio.</p>
    </div>
</body>

</html>