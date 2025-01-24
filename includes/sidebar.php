<?php
session_start(); // Avvia la sessione
?>
<div class="d-flex">
    <!-- Sidebar -->
    <nav class="sidebar bg-white flex-column vh-100 p-3">
        <div class="logo text-center">
            <a class="navbar-brand fw-bold  text-white" href="#">PragmaNG LOGO</a>
        </div>
        <ul class="sideOptions nav flex-column">
            <li class="nav-item mb-2">
                <a class="btn btn-primary w-100 text-start" href="<?php echo isset($_SESSION['user_id']) ? 'home.php' : 'index.php'; ?>">Home</a>
            </li>

            <?php if (isset($_SESSION['user_id'])): ?>
                <li class="nav-item mb-2">
                    <a class="btn btn-primary w-100 text-start" href="gestione_convenzionati.php">Gestione Convenzionati</a>
                </li>

                <!-- Dropdown con modali -->
                <li class="nav-item mb-2">
                    <button class="btn btn-primary w-100 text-start" data-bs-toggle="modal" data-bs-target="#flussoMModal">Flusso M</button>
                </li>
                <li class="nav-item mb-2">
                    <button class="btn btn-primary w-100 text-start" data-bs-toggle="modal" data-bs-target="#gestioneUtentiModal">Gestione Utenti</button>
                </li>
                <li class="nav-item mb-2">
                    <button class="btn btn-primary w-100 text-start" data-bs-toggle="modal" data-bs-target="#gestioneTabelleModal">Gestione Tabelle</button>
                </li>
                <li class="nav-item mb-2">
                    <button class="btn btn-primary w-100 text-start" data-bs-toggle="modal" data-bs-target="#supportoModal">Supporto</button>
                </li>
            <?php endif; ?>
        </ul>

        <!-- User ID e Logout in fondo -->
        <?php if (isset($_SESSION['user_id'])): ?>
            <div class="logout d-flex flex-column">
                <span class="d-block text-secondary text-center my-2"><?php echo $_SESSION['user_id']; ?></span>
                <a class="btn btn-danger w-100" href="logout.php">Logout</a>
            </div>
        <?php endif; ?>
    </nav>
</div>

<!-- Modali -->
<div class="modal fade" id="flussoMModal" tabindex="-1" aria-labelledby="flussoMModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="flussoMModalLabel">Flusso M</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-unstyled">
                    <li><a href="#" class="d-block text-primary">Caricamento Flusso M</a></li>
                    <li><a href="#" class="d-block text-primary">Approva Flussi M</a></li>
                    <li><a href="#" class="d-block text-primary">Situazione Flussi M</a></li>
                    <li><a href="#" class="d-block text-primary">Liquida Flussi M</a></li>
                    <li><a href="#" class="d-block text-primary">Approva Liquidazioni</a></li>
                    <li><a href="#" class="d-block text-primary">Pubblica Liquidazioni</a></li>
                    <li><a href="#" class="d-block text-primary">Approva Ruolo</a></li>
                    <li><a href="#" class="d-block text-primary">Ricette</a></li>
                    <li><a href="#" class="d-block text-primary">Reportistica</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="gestioneUtentiModal" tabindex="-1" aria-labelledby="gestioneUtentiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="gestioneUtentiModalLabel">Gestione Utenti</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-unstyled">
                    <li><a href="#" class="d-block text-primary">Lista Utenti</a></li>
                    <li><a href="#" class="d-block text-primary">Aggiungi Utente</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="gestioneTabelleModal" tabindex="-1" aria-labelledby="gestioneTabelleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="gestioneTabelleModalLabel">Gestione Tabelle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-unstyled">
                    <li><a href="#" class="d-block text-primary">Tabella Nazioni</a></li>
                    <li><a href="#" class="d-block text-primary">Tabella Regioni</a></li>
                    <li><a href="#" class="d-block text-primary">Tabella Province</a></li>
                    <li><a href="#" class="d-block text-primary">Tabella Comuni</a></li>
                    <li><a href="#" class="d-block text-primary">Tabella A.S.L.</a></li>
                    <li><a href="#" class="d-block text-primary">Tabella Distretti</a></li>
                    <li><a href="#" class="d-block text-primary">Tabella Medici</a></li>
                    <li><a href="#" class="d-block text-primary">Tabella Branche</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="supportoModal" tabindex="-1" aria-labelledby="supportoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="supportoModalLabel">Supporto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-unstyled">
                    <li><a href="#" class="d-block text-primary">Download Utili</a></li>
                    <li><a href="#" class="d-block text-primary">Contatti</a></li>
                    <li><a href="#" class="d-block text-primary">Cambio Password</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="bootstrap-italia/js/bootstrap-italia.bundle.min.js"></script>