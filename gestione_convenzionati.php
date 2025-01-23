<?php
session_start();

// Verifica se l'utente è loggato
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

include('includes/db_connection.php');

// Imposta il numero di righe per pagina
$rows_per_page = 10;

// Recupera il numero della pagina corrente
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start_from = ($page - 1) * $rows_per_page;

// Query per recuperare i dati richiesti
$sql = "SELECT id, denominazione, id_comune, id_distretto, id_asl 
        FROM convenzionati 
        LIMIT $start_from, $rows_per_page";
$result = $conn->query($sql);

// Conteggio totale delle righe per la paginazione
$total_sql = "SELECT COUNT(*) AS total FROM convenzionati";
$total_result = $conn->query($total_sql);
$total_rows = $total_result->fetch_assoc()['total'];
$total_pages = ceil($total_rows / $rows_per_page);
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <?php include('./includes/header.php'); ?>
    <title>Gestione Convenzionati</title>
</head>

<body>
    <?php include('./includes/navbar.php'); ?>

    <h2 class="text-center py-5 m-0 text-white" style="background-color: #17334F;">Anagrafiche Struttura Erogatrice</h2>
    <div class="container mt-4">
        <!-- Barra di ricerca -->
        <form method="GET" action="gestione_convenzionati.php" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cerca per denominazione..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <button class="btn btn-primary" type="submit" style="background-color: #17334F;">Cerca</button>
            </div>
        </form>

        <div class="table-responsive shadow-sm rounded">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center">ID</th>
                        <th>Denominazione Centro Convenzionato</th>
                        <th class="text-center">Comune</th>
                        <th class="text-center">Distretto</th>
                        <th class="text-center">A.S.L.</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Verifica se è stata effettuata una ricerca
                    $search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

                    // Modifica la query per includere la ricerca
                    $sql = "SELECT id, denominazione, id_comune, id_distretto, id_asl 
                            FROM convenzionati 
                            WHERE denominazione LIKE '%$search%'
                            LIMIT $start_from, $rows_per_page";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td class="text-center"><?php echo htmlspecialchars($row['id']); ?></td>
                                <td><?php echo htmlspecialchars($row['denominazione']); ?></td>
                                <td class="text-center"><?php echo htmlspecialchars($row['id_comune']); ?></td>
                                <td class="text-center"><?php echo htmlspecialchars($row['id_distretto']); ?></td>
                                <td class="text-center"><?php echo htmlspecialchars($row['id_asl']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">Nessun dato trovato</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Paginazione -->
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center mt-4">
                <li class="page-item <?php if ($page == 1) echo 'disabled'; ?>">
                    <a class="page-link" href="gestione_convenzionati.php?page=<?php echo $page - 1; ?>" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                        <a class="page-link" href="gestione_convenzionati.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?php if ($page == $total_pages) echo 'disabled'; ?>">
                    <a class="page-link" href="gestione_convenzionati.php?page=<?php echo $page + 1; ?>" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</body>

</html>

<?php
// Chiudi la connessione
$conn->close();
?>