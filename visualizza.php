<?php
session_start();

// Verifica se l'utente è loggato
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

include 'includes/db_connection.php';

// Query per ottenere il convenzionato
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$sql = "
SELECT 
    c.id,
    c.denominazione,
    c.indirizzo,
    c.cap,
    c.tipoconvenzione,
    c.codicefiscale,
    c.partitaiva,
    c.mail,
    c.pec,
    c.telefono,
    c.fax,
    d.denominazione AS denominazione_distretto,
    cm.descrizione AS denominazione_comune
FROM 
    convenzionati c
LEFT JOIN 
    distretti d ON c.id_distretto = d.id
LEFT JOIN 
    comuni cm ON c.id_comune = cm.id
WHERE 
    c.id = $id";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Nessun dato trovato per l'ID $id";
    exit();
}
?>

<?php
// Query per ottenere le convenzioni associate
$convenzioni_sql = "
SELECT 
    branche.id AS id_branca,
    branche.descrizione AS descrizione_branca,
    convenzioni.datainizio,
    convenzioni.datafine,
    convenzioni.codiceconto,
    profili.descrizione AS profilo_controlli
FROM 
    convenzioni
LEFT JOIN 
    branche ON convenzioni.id_branca = branche.id
LEFT JOIN 
    profili ON convenzioni.profilo_controlli = profili.id
WHERE 
    convenzioni.id_convenzionato = $id";

$convenzioni_result = $conn->query($convenzioni_sql);
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <?php include './includes/header.php'; ?>
    <title><?php echo htmlspecialchars($row['denominazione']); ?></title>
</head>

<body>
    <?php include './includes/navbar.php'; ?>

    <h2 class="text-center py-5 m-0 text-white" style="background-color: #17334F;"><?php echo htmlspecialchars($row['denominazione']); ?></h2>
    <div class="container my-4">
        <div class="table-responsive rounded">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center">Codice</th>
                        <th>Distretto</th>
                        <th>Denominazione</th>
                        <th>Indirizzo</th>
                        <th class="text-center">CAP</th>
                        <th>Comune</th>
                        <th class="text-center">Tipo</th>
                        <th>Codice Fiscale</th>
                        <th>P.IVA</th>
                        <th>Mail</th>
                        <th>PEC</th>
                        <th>Fax</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="align-middle text-center"><?php echo htmlspecialchars($row['id']); ?></td>
                        <td class="align-middle"><?php echo htmlspecialchars($row['denominazione_distretto']); ?></td>
                        <td title="<?php echo htmlspecialchars($row['denominazione']); ?>" class="align-middle"><?php echo htmlspecialchars($row['denominazione']); ?></td>
                        <td class="align-middle"><?php echo htmlspecialchars($row['indirizzo']); ?></td>
                        <td class="align-middle text-center"><?php echo htmlspecialchars($row['cap']); ?></td>
                        <td class="align-middle"><?php echo htmlspecialchars($row['denominazione_comune']); ?></td>
                        <td class="align-middle text-center"><?php echo htmlspecialchars($row['tipoconvenzione']); ?></td>
                        <td class="align-middle"><?php echo htmlspecialchars($row['codicefiscale']); ?></td>
                        <td class="align-middle"><?php echo htmlspecialchars($row['partitaiva']); ?></td>
                        <td class="align-middle"><?php echo htmlspecialchars($row['mail']); ?></td>
                        <td class="align-middle"><?php echo htmlspecialchars($row['pec']); ?></td>
                        <td class="align-middle"><?php echo htmlspecialchars($row['fax']); ?></td>
                    </tr>
                </tbody>

            </table>
        </div>
    </div>
    <h2 class="text-center py-3 m-0" style="color: #17334F;">Convenzioni Associate</h2>
    <div class="container mt-4">
        <div class="table-responsive rounded">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th class="text-center">Descrizione</th>
                        <th class="text-center">Data Inizio</th>
                        <th class="text-center">Data Fine</th>
                        <th class="text-center">Codice Conto</th>
                        <th class="text-center">Profilo Controlli</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($convenzioni_result->num_rows > 0): ?>
                        <?php while ($conv = $convenzioni_result->fetch_assoc()): ?>
                            <tr>
                                <td title="<?php echo htmlspecialchars($conv['descrizione_branca']); ?>" class="text-center"><?php echo htmlspecialchars($conv['id_branca']); ?> - <?php echo htmlspecialchars($conv['descrizione_branca']); ?></td>
                                <td class="text-center"><?php echo htmlspecialchars($conv['datainizio']); ?></td>
                                <td class="text-center"><?php echo htmlspecialchars($conv['datafine']); ?></td>
                                <td class="text-center"><?php echo htmlspecialchars($conv['codiceconto']); ?></td>
                                <td class="text-center"><?php echo htmlspecialchars($conv['profilo_controlli']); ?></td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">Nessuna convenzione associata trovata</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <a href="../gestione_convenzionati.php" class="btn btn-secondary my-3">Torna alla lista</a>
    </div>
</body>

</html>

<?php
// Chiudi la connessione
$conn->close();
?>