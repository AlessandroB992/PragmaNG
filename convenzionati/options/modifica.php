<?php
session_start();

// Verifica se l'utente è loggato
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

include '../../includes/db_connection.php';

// Variabili per messaggi ed errori
$error_message = '';
$success_message = '';
$convenzionato = [];

// Recupera i dati del convenzionato da modificare
if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    $sql = "SELECT * FROM convenzionati WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $convenzionato = $result->fetch_assoc();
    } else {
        $error_message = "Convenzionato non trovato.";
    }
} else {
    $error_message = "ID Convenzionato non fornito.";
}

// Gestione del salvataggio delle modifiche
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    // Sanifica i dati del modulo
    $id = (int)$_POST['id'];
    $denominazione = $conn->real_escape_string($_POST['denominazione']);
    $indirizzo = $conn->real_escape_string($_POST['indirizzo']);
    $cap = $conn->real_escape_string($_POST['cap']);
    $id_comune = $conn->real_escape_string($_POST['id_comune']);
    $tipoconvenzione = $conn->real_escape_string($_POST['tipoconvenzione']);
    $codicefiscale = $conn->real_escape_string($_POST['codicefiscale']);
    $partita_iva = $conn->real_escape_string($_POST['partitaiva']);
    $mail = $conn->real_escape_string($_POST['mail']);
    $pec = $conn->real_escape_string($_POST['pec']);
    $telefono = $conn->real_escape_string($_POST['telefono']);
    $fax = $conn->real_escape_string($_POST['fax']);
    $id_distretto = (int)$_POST['id_distretto'];

    // Esegui la query di aggiornamento
    $sql = "UPDATE convenzionati 
            SET denominazione = ?, indirizzo = ?, cap = ?, id_comune = ?, tipoconvenzione = ?, 
                codicefiscale = ?, partitaiva = ?, mail = ?, pec = ?, telefono = ?, fax = ?, id_distretto = ? 
            WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssiii", $denominazione, $indirizzo, $cap, $id_comune, $tipoconvenzione, $codicefiscale, $partitaiva, $mail, $pec, $telefono, $fax, $id_distretto, $id);

    if ($stmt->execute()) {
        $success_message = "Modifiche salvate con successo.";
    } else {
        $error_message = "Errore durante l'aggiornamento: " . $conn->error;
    }
}

// Recupera i distretti per il menu a tendina
$distretti_sql = "SELECT id, denominazione FROM distretti";
$distretti_result = $conn->query($distretti_sql);

// Recupera la lista dei comuni (solo id e descrizione)
$comuni_sql = "SELECT id, descrizione FROM comuni";
$comuni_result = $conn->query($comuni_sql);
$comuni = [];
while ($row = $comuni_result->fetch_assoc()) {
    $comuni[$row['id']] = $row['descrizione'];
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <?php include '../../includes/header.php'; ?>
    <title>Modifica Convenzionato</title>
</head>

<body>
    <?php include '../../includes/navbar.php'; ?>

    <h2 class="text-center py-5 m-0 text-white" style="background-color: #17334F;">Modifica Convenzionato</h2>

    <div class="container my-5">
        <?php if ($error_message): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error_message) ?></div>
        <?php endif; ?>

        <?php if ($success_message): ?>
            <div class="alert alert-success"><?= htmlspecialchars($success_message) ?></div>
        <?php endif; ?>

        <?php if ($convenzionato): ?>
            <form action="modifica.php?id=<?= $convenzionato['id'] ?>" method="POST" class="row g-4">
                <div class="col-md-12">
                    <label for="id" class="form-label">ID:</label>
                    <input type="text" id="id" name="id" class="form-control" value="<?= htmlspecialchars($convenzionato['id']) ?>" disabled>
                </div>

                <div class="col-md-6">
                    <label for="denominazione" class="form-label">Denominazione:</label>
                    <input type="text" id="denominazione" name="denominazione" class="form-control" value="<?= htmlspecialchars($convenzionato['denominazione']) ?>" required>
                </div>

                <div class="col-md-6">
                    <label for="indirizzo" class="form-label">Indirizzo:</label>
                    <input type="text" id="indirizzo" name="indirizzo" class="form-control" value="<?= htmlspecialchars($convenzionato['indirizzo']) ?>" required>
                </div>

                <div class="col-md-6">
                    <label for="cap" class="form-label">C.A.P.:</label>
                    <input type="text" id="cap" name="cap" class="form-control" value="<?= htmlspecialchars($convenzionato['cap']) ?>" required>
                </div>

                <div class="col-md-6">
                    <label for="id_comune" class="form-label">Comune:</label>
                    <input type="text" id="id_comune" name="id_comune" class="form-control" value="<?= htmlspecialchars($comuni[$convenzionato['id_comune']] ?? '') ?>" required>
                </div>

                <div class="col-md-6">
                    <label for="tipoconvenzione" class="form-label">Tipo Convenzione:</label>
                    <input type="text" id="tipoconvenzione" name="tipoconvenzione" class="form-control" value="<?= htmlspecialchars($convenzionato['tipoconvenzione']) ?>" required>
                </div>

                <div class="col-md-6">
                    <label for="codicefiscale" class="form-label">Codice Fiscale:</label>
                    <input type="text" id="codicefiscale" name="codicefiscale" class="form-control" value="<?= htmlspecialchars($convenzionato['codicefiscale']) ?>" required>
                </div>

                <div class="col-md-6">
                    <label for="partitaiva" class="form-label">Partita IVA:</label>
                    <input type="text" id="partitaiva" name="partitaiva" class="form-control" value="<?= htmlspecialchars($convenzionato['partitaiva']) ?>" required>
                </div>

                <div class="col-md-6">
                    <label for="mail" class="form-label">Mail:</label>
                    <input type="email" id="mail" name="mail" class="form-control" value="<?= htmlspecialchars($convenzionato['mail']) ?>" required>
                </div>

                <div class="col-md-6">
                    <label for="pec" class="form-label">PEC:</label>
                    <input type="email" id="pec" name="pec" class="form-control" value="<?= htmlspecialchars($convenzionato['pec']) ?>" required>
                </div>

                <div class="col-md-6">
                    <label for="telefono" class="form-label">Telefono:</label>
                    <input type="text" id="telefono" name="telefono" class="form-control" value="<?= htmlspecialchars($convenzionato['telefono']) ?>" required>
                </div>

                <div class="col-md-6">
                    <label for="fax" class="form-label">Fax:</label>
                    <input type="text" id="fax" name="fax" class="form-control" value="<?= htmlspecialchars($convenzionato['fax']) ?>">
                </div>

                <div class="col-md-6">
                    <label for="id_distretto" class="form-label">Distretto:</label>
                    <select id="id_distretto" name="id_distretto" class="form-select" required>
                        <option value="" disabled>Seleziona un distretto</option>
                        <?php while ($distretto = $distretti_result->fetch_assoc()): ?>
                            <option value="<?= $distretto['id'] ?>" <?= $convenzionato['id_distretto'] == $distretto['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($distretto['denominazione']) ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-success" style="background-color: #17334F;">Salva Modifiche</button>
                    <a href="../gestione_convenzionati.php" class="btn btn-secondary">Indietro</a>
                </div>
            </form>
        <?php endif; ?>
    </div>
</body>

</html>

<?php
$conn->close();
?>