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
    <title>Home</title>
    <!-- Bootstrap Italia CSS -->
    <link rel="stylesheet" href="assets/bootstrap-italia/css/bootstrap-italia.min.css">
</head>

<body>
    <?php include('navbar.php'); ?>
    <div class="container my-5">
        <h1>Benvenuto nella pagina Home</h1>
        <p>Questa è una semplice pagina di esempio.</p>
    </div>
</body>

</html>
