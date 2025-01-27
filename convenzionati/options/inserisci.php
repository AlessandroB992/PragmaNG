<?php
session_start();

// Verifica se l'utente è loggato
if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

include '../../includes/db_connection.php';

// Variabili per errori
$error_message = '';

// Verifica se il modulo è stato inviato
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanifica i dati del modulo
    $id_convenzionato = $conn->real_escape_string($_POST['id_convenzionato']);
    $denominazione_centro = $conn->real_escape_string($_POST['denominazione']);
    $indirizzo = $conn->real_escape_string($_POST['indirizzo']);
    $cap = $conn->real_escape_string($_POST['cap']);
    $comune = $conn->real_escape_string($_POST['comune']);
    $tipo_convenzione = $conn->real_escape_string($_POST['tipo_convenzione']);
    $codice_fiscale = $conn->real_escape_string($_POST['codice_fiscale']);
    $partita_iva = $conn->real_escape_string($_POST['partita_iva']);
    $mail = $conn->real_escape_string($_POST['mail']);
    $pec = $conn->real_escape_string($_POST['pec']);
    $telefono = $conn->real_escape_string($_POST['telefono']);
    $fax = $conn->real_escape_string($_POST['fax']);
    $id_distretto = (int)$_POST['id_distretto'];

    // Esegui la query di inserimento
    $sql = "INSERT INTO convenzionati (id_convenzionato, denominazione, indirizzo, cap, comune, tipo_convenzione, codice_fiscale, partita_iva, mail, pec, telefono, fax, id_distretto) 
            VALUES ('$id_convenzionato', '$denominazione_centro', '$indirizzo', '$cap', '$comune', '$tipo_convenzione', '$codice_fiscale', '$partita_iva', '$mail', '$pec', '$telefono', '$fax', '$id_distretto')";

    if ($conn->query($sql) === TRUE) {
        header("Location: gestione_convenzionati.php");
        exit();
    } else {
        $error_message = "Errore nell'inserimento: " . $conn->error;
    }
}

// Recupera i distretti per il menu a tendina
$distretti_sql = "SELECT id, denominazione FROM distretti";
$distretti_result = $conn->query($distretti_sql);
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <?php include '../../includes/header.php'; ?>
    <title>Inserisci Convenzionato</title>
</head>

<body>
    <?php include '../../includes/navbar.php'; ?>

    <h2 class="text-center py-5 m-0 text-white" style="background-color: #17334F;">Inserisci Nuovo Convenzionato</h2>

    <div class="container my-4">
        <form action="inserisci_convenzionato.php" method="POST">
            <div class="row">
                <!-- Colonna 1 -->
                <div class="col-md-6">
                    <div class="mb-2">
                        <label for="id_convenzionato" class="form-label">ID Convenzionato:</label>
                        <input type="text" id="id_convenzionato" name="id_convenzionato" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label for="distretto" class="form-label">Distretto:</label>
                        <select id="distretto" name="id_distretto" class="form-select" required>
                            <option value="" disabled selected>Scegli un distretto</option>
                            <?php while ($distretto = $distretti_result->fetch_assoc()) : ?>
                                <option value="<?= $distretto['id']; ?>"><?= htmlspecialchars($distretto['denominazione']); ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label for="denominazione" class="form-label">Denominazione:</label>
                        <input type="text" id="denominazione" name="denominazione" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label for="indirizzo" class="form-label">Indirizzo:</label>
                        <input type="text" id="indirizzo" name="indirizzo" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label for="cap" class="form-label">C.A.P.:</label>
                        <input type="text" id="cap" name="cap" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label for="comune" class="form-label">Comune:</label>
                        <input type="text" id="comune" name="comune" class="form-control" required>
                    </div>
                </div>

                <!-- Colonna 2 -->
                <div class="col-md-6">
                    <div class="mb-2">
                        <label for="tipo_convenzione" class="form-label">Tipo Convenzione:</label>
                        <input type="text" id="tipo_convenzione" name="tipo_convenzione" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label for="codice_fiscale" class="form-label">Codice Fiscale:</label>
                        <input type="text" id="codice_fiscale" name="codice_fiscale" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label for="partita_iva" class="form-label">Partita IVA:</label>
                        <input type="text" id="partita_iva" name="partita_iva" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label for="mail" class="form-label">Mail:</label>
                        <input type="email" id="mail" name="mail" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label for="pec" class="form-label">PEC:</label>
                        <input type="email" id="pec" name="pec" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label for="telefono" class="form-label">Telefono:</label>
                        <input type="text" id="telefono" name="telefono" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label for="fax" class="form-label">Fax:</label>
                        <input type="text" id="fax" name="fax" class="form-control">
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between"> <a href="../gestione_convenzionati.php" class="btn btn-secondary">⬅ Torna Indietro</a>
                <button type="submit" class="btn btn-success" style="background-color: #17334F;">Inserisci</button>
            </div>


        </form>
    </div>
</body>

</html>
<?php $conn->close(); ?>