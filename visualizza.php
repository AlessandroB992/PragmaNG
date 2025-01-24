<?php
session_start();

// Verifica se l'utente è loggato
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

include('includes/db_connection.php');

// Ottieni l'ID dalla query string
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Recupera i dati del convenzionato
$sql = "SELECT id, denominazione, id_comune, id_distretto, id_asl FROM convenzionati WHERE id = $id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Nessun dato trovato per l'ID $id";
    exit();
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <?php include('./includes/header.php'); ?>
    <title>Visualizza Convenzionato</title>
</head>
<body>
    <?php include('./includes/navbar.php'); ?>

    <div class="container mt-4">
        <h2>Dettagli Convenzionato</h2>
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <td><?php echo htmlspecialchars($row['id']); ?></td>
            </tr>
            <tr>
                <th>Denominazione</th>
                <td><?php echo htmlspecialchars($row['denominazione']); ?></td>
            </tr>
            <tr>
                <th>Comune</th>
                <td><?php echo htmlspecialchars($row['id_comune']); ?></td>
            </tr>
            <tr>
                <th>Distretto</th>
                <td><?php echo htmlspecialchars($row['id_distretto']); ?></td>
            </tr>
            <tr>
                <th>A.S.L.</th>
                <td><?php echo htmlspecialchars($row['id_asl']); ?></td>
            </tr>
        </table>

        <a href="gestione_convenzionati.php" class="btn btn-secondary">Torna alla lista</a>
    </div>
</body>
</html>

<?php
// Chiudi la connessione
$conn->close();
?>
