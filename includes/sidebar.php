<?php
session_start(); // Avvia la sessione
?>
<div class="d-flex">
    <!-- Sidebar -->
    <nav class="sidebar flex-column vh-100 p-3">
        <div class="logo text-center">
            <a class="navbar-brand fw-bold text-white" href="#">PragmaNG LOGO</a>
        </div>
        <ul class="sideOptions nav flex-column">
            <li class="nav-item mb-2">
                <a class="btn btn-light w-100 text-start" href="<?php echo isset($_SESSION['user_id']) ? 'home.php' : 'index.php'; ?>">Home</a>
            </li>

            <?php if (isset($_SESSION['user_id'])): ?>
                <li class="nav-item mb-2">
                    <a class="btn btn-light w-100 text-start" href="./convenzionati/gestione_convenzionati.php">Gestione Convenzionati</a>
                </li>

                <!-- Dropdown con modali -->
                <li class="nav-item mb-2">
                    <button class="btn btn-light w-100 text-start" data-bs-toggle="modal" data-bs-target="#flussoMModal">Flusso M</button>
                </li>
                <li class="nav-item mb-2">
                    <button class="btn btn-light w-100 text-start" data-bs-toggle="modal" data-bs-target="#gestioneUtentiModal">Gestione Utenti</button>
                </li>
                <li class="nav-item mb-2">
                    <button class="btn btn-light w-100 text-start" data-bs-toggle="modal" data-bs-target="#gestioneTabelleModal">Gestione Tabelle</button>
                </li>
                <li class="nav-item mb-2">
                    <button class="btn btn-light w-100 text-start" data-bs-toggle="modal" data-bs-target="#supportoModal">Supporto</button>
                </li>
            <?php endif; ?>
        </ul>

        <!-- User ID e Logout in fondo -->
        <?php if (isset($_SESSION['user_id'])): ?>
            <div class="logout d-flex flex-column">
                <span class="d-block text-secondary text-center text-white my-2"><?php echo $_SESSION['user_id']; ?></span>
                <a class="btn btn-danger w-100" href="logout.php">Logout</a>
            </div>
        <?php endif; ?>
    </nav>
</div>

<!-- Modali -->
<div class="modal fade" id="flussoMModal" tabindex="-1" aria-labelledby="flussoMModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content rounded-3">
            <div class="modal-header bg-info p-4">
                <h5 class="modal-title text-light" id="flussoMModalLabel">Flusso M</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-unstyled">
                    <li><a href="#" class="d-block text-dark text-decoration-none pb-2 border-bottom border-1">Caricamento Flusso M</a></li>
                    <li><a href="#" class="d-block text-dark text-decoration-none pb-2 border-bottom border-1">Approva Flussi M</a></li>
                    <li><a href="#" class="d-block text-dark text-decoration-none pb-2 border-bottom border-1">Situazione Flussi M</a></li>
                    <li><a href="#" class="d-block text-dark text-decoration-none pb-2 border-bottom border-1">Liquida Flussi M</a></li>
                    <li><a href="#" class="d-block text-dark text-decoration-none pb-2 border-bottom border-1">Approva Liquidazioni</a></li>
                    <li><a href="#" class="d-block text-dark text-decoration-none pb-2 border-bottom border-1">Pubblica Liquidazioni</a></li>
                    <li><a href="#" class="d-block text-dark text-decoration-none pb-2 border-bottom border-1">Approva Ruolo</a></li>
                    <li><a href="#" class="d-block text-dark text-decoration-none pb-2 border-bottom border-1">Ricette</a></li>
                    <li><a href="#" class="d-block text-dark text-decoration-none pb-2">Reportistica</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="gestioneUtentiModal" tabindex="-1" aria-labelledby="gestioneUtentiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content rounded-3">
            <div class="modal-header bg-info p-4">
                <h5 class="modal-title text-light" id="gestioneUtentiModalLabel">Gestione Utenti</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-unstyled">
                    <li><a href="#" class="d-block text-dark text-decoration-none pb-2 border-bottom border-1">Lista Utenti</a></li>
                    <li><a href="#" class="d-block text-dark text-decoration-none pb-2">Aggiungi Utente</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="gestioneTabelleModal" tabindex="-1" aria-labelledby="gestioneTabelleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content rounded-3">
            <div class="modal-header bg-info p-4">
                <h5 class="modal-title text-light" id="gestioneTabelleModalLabel">Gestione Tabelle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-unstyled">
                    <li><a href="#" class="d-block text-dark text-decoration-none pb-2 border-bottom border-1">Tabella Nazioni</a></li>
                    <li><a href="#" class="d-block text-dark text-decoration-none pb-2 border-bottom border-1">Tabella Regioni</a></li>
                    <li><a href="#" class="d-block text-dark text-decoration-none pb-2 border-bottom border-1">Tabella Province</a></li>
                    <li><a href="#" class="d-block text-dark text-decoration-none pb-2 border-bottom border-1">Tabella Comuni</a></li>
                    <li><a href="#" class="d-block text-dark text-decoration-none pb-2 border-bottom border-1">Tabella A.S.L.</a></li>
                    <li><a href="#" class="d-block text-dark text-decoration-none pb-2 border-bottom border-1">Tabella Distretti</a></li>
                    <li><a href="#" class="d-block text-dark text-decoration-none pb-2 border-bottom border-1">Tabella Medici</a></li>
                    <li><a href="#" class="d-block text-dark text-decoration-none pb-2">Tabella Branche</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="supportoModal" tabindex="-1" aria-labelledby="supportoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content rounded-3">
            <div class="modal-header bg-info p-4">
                <h5 class="modal-title text-light" id="supportoModalLabel">Supporto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="list-unstyled">
                    <li><a href="#" class="d-block text-dark text-decoration-none pb-2 border-bottom border-1">Download Utili</a></li>
                    <li><a href="#" class="d-block text-dark text-decoration-none pb-2 border-bottom border-1">Contatti</a></li>
                    <li><a href="#" class="d-block text-dark text-decoration-none pb-2">Cambio Password</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="bootstrap-italia/js/bootstrap-italia.bundle.min.js"></script>