<?php
session_start();

// Verifica se l'utente è loggato
if (!isset($_SESSION['user_id'])) {
    header("Location: /");
    exit();
}

include '../includes/db_connection.php';

// Imposta il numero di righe per pagina
$rows_per_page = 9; // Impostato su 9, come desiderato

// Recupera il numero della pagina corrente
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start_from = ($page - 1) * $rows_per_page;

// Verifica se è stata effettuata una ricerca
$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

// Query per ottenere i dati con il filtro di ricerca e la paginazione
$sql = "SELECT DISTINCT 
            c.id AS id, 
            c.denominazione AS denominazione_centro, 
            comuni.descrizione AS comune_descrizione, 
            distretti.denominazione AS distretto_denominazione, 
            asl.denominazione AS asl_denominazione 
        FROM convenzionati c
        LEFT JOIN comuni ON c.id_comune = comuni.id
        LEFT JOIN distretti ON c.id_distretto = distretti.id
        LEFT JOIN asl ON c.id_asl = asl.id
        WHERE c.denominazione LIKE '%$search%' 
        LIMIT $start_from, $rows_per_page";

$result = $conn->query($sql);

// Calcola il numero totale di righe basato sulla ricerca
$total_sql = "SELECT COUNT(DISTINCT c.id) AS total 
              FROM convenzionati c
              LEFT JOIN comuni ON c.id_comune = comuni.id
              LEFT JOIN distretti ON c.id_distretto = distretti.id
              LEFT JOIN asl ON c.id_asl = asl.id
              WHERE c.denominazione LIKE '%$search%'";

$total_result = $conn->query($total_sql);
$total_rows = $total_result->fetch_assoc()['total']; // Numero totale di righe
$total_pages = ceil($total_rows / $rows_per_page); // Calcolo del numero totale di pagine

?>

<!DOCTYPE html>
<html lang="it">
<head>
    <?php include '../includes/header.php'; ?>
    <title>Gestione Convenzionati</title>
</head>
<body>
    <?php include '../includes/navbar.php'; ?>

    <h2 class="text-center py-5 m-0 text-white" style="background-color: #17334F;">Anagrafiche Struttura Erogatrice</h2>
    <div class="container mt-4">
        <!-- Barra di ricerca -->
        <form method="GET" action="gestione_convenzionati.php" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cerca per denominazione..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                <button class="btn btn-primary" type="submit" style="background-color: #17334F;">Cerca</button>
            </div>
        </form>

        <div class="table-responsive rounded">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center">Seleziona</th>
                        <th class="text-center">ID</th>
                        <th>Denominazione Centro Convenzionato</th>
                        <th class="text-center">Comune</th>
                        <th class="text-center">Distretto</th>
                        <th class="text-center">A.S.L.</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result->num_rows > 0): ?>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td class="text-center">
                                    <input type="radio" name="selected_row" value="<?php echo $row['id']; ?>">
                                </td>
                                <td class="text-center"><?php echo htmlspecialchars($row['id']); ?></td>
                                <td title="<?php echo htmlspecialchars($row['denominazione_centro']); ?>"><?php echo htmlspecialchars($row['denominazione_centro']); ?></td>
                                <td class="text-center"><?php echo htmlspecialchars($row['comune_descrizione']); ?></td>
                                <td class="text-center"><?php echo htmlspecialchars($row['distretto_denominazione']); ?></td>
                                <td class="text-center"><?php echo htmlspecialchars($row['asl_denominazione']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">Nessun dato trovato</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Paginazione con pulsanti CRUD -->
        <div class="d-flex justify-content-between align-items-center mt-4">
            <!-- Paginazione con puntini di sospensione -->
            <nav aria-label="Page navigation">
                <ul class="pagination rounded-2 bg-white m-0">
                    <!-- Pulsante per pagina precedente -->
                    <li class="page-item <?php if ($page == 1) echo 'disabled'; ?>">
                        <a class="page-link" href="gestione_convenzionati.php?page=<?php echo $page - 1; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php
                    // Limite di pagine da mostrare prima e dopo la pagina corrente
                    $range = 2;

                    // Prima pagina sempre visibile
                    if ($page > $range + 1) {
                        echo '<li class="page-item"><a class="page-link" href="gestione_convenzionati.php?page=1">1</a></li>';
                        if ($page > $range + 2) {
                            echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                        }
                    }

                    // Pagine centrali dinamiche
                    for ($i = max(1, $page - $range); $i <= min($total_pages, $page + $range); $i++) {
                        echo '<li class="page-item ' . ($i == $page ? 'active' : '') . '">
                    <a class="page-link" href="gestione_convenzionati.php?page=' . $i . '">' . $i . '</a>
                  </li>';
                    }

                    // Ultima pagina sempre visibile
                    if ($page < $total_pages - $range) {
                        if ($page < $total_pages - $range - 1) {
                            echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
                        }
                        echo '<li class="page-item"><a class="page-link" href="gestione_convenzionati.php?page=' . $total_pages . '">' . $total_pages . '</a></li>';
                    }
                    ?>

                    <!-- Pulsante per pagina successiva -->
                    <li class="page-item <?php if ($page == $total_pages) echo 'disabled'; ?>">
                        <a class="page-link" href="gestione_convenzionati.php?page=<?php echo $page + 1; ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <!-- Pulsanti CRUD -->
            <div class="d-flex justify-content-center align-items-center gap-2">
                <button class="btn btn-info" onclick="visualizza()">Visualizza</button>
                <button class="btn btn-success" onclick="window.location.href='options/inserisci.php'">Inserisci</button>
                <button class="btn btn-primary" onclick="modifica()">Modifica</button>
                <button class="btn btn-danger" onclick="cancella()">Cancella</button>
            </div>
        </div>
    </div>

    <script>
        // Funzioni CRUD
        function visualizza() {
            const selectedRow = document.querySelector('input[name="selected_row"]:checked');
            if (selectedRow) {
                window.location.href = `options/visualizza.php?id=${selectedRow.value}`;
            } else {
                alert("Seleziona la per visualizzare.");
            }
        }

        function modifica() {
            const selectedRow = document.querySelector('input[name="selected_row"]:checked');
            if (selectedRow) {
                window.location.href = `options/modifica.php?id=${selectedRow.value}`;
            } else {
                alert("Seleziona la riga da modificare.");
            }
        }

        function cancella() {
            const selectedRow = document.querySelector('input[name="selected_row"]:checked');
            if (selectedRow) {
                if (confirm("Sei sicuro di voler cancellare questa riga?")) {
                    window.location.href = `cancella.php?id=${selectedRow.value}`;
                }
            } else {
                alert("Seleziona una riga per cancellare.");
            }
        }
    </script>
</body>
</html>

<?php
$conn->close();
?>
