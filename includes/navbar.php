<?php
session_start(); // Avvia la sessione
?>

<head>
    <?php include('header.php'); ?>
</head>


<nav class="navbar navbar-expand-lg navbar-light bg-light py-3">
    <div class="container-fluid">
        <a class="navbar-brand mx-4 fw-bold" href="#">PRAGMA NEXT GEN LOGO</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="btn btn-primary p-2 mx-1" href="<?php echo isset($_SESSION['user_id']) ? 'home.php' : 'login.php'; ?>">Home</a>
                </li>

                <!-- Link "Gestione Convenzionati" visibile solo se l'utente è loggato -->
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item">
                        <a class="btn btn-primary p-2 mx-1" href="gestione_convenzionati.php">Gestione Convenzionati</a>
                    </li>
                    <!-- Dropdown "Flusso M" -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle btn btn-primary p-2 mx-1 text-white fw-bold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Flusso M <svg class="icon icon-white icon-xs"><use href="/bootstrap-italia/svg/sprites.svg#it-expand"></use></svg>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Caricamento Flusso M</a></li>
                            <li><a class="dropdown-item" href="#">Approva Flussi M</a></li>
                            <li><a class="dropdown-item" href="#">Situazione Flussi M</a></li>
                            <li><a class="dropdown-item" href="#">Liquida Flussi M</a></li>
                            <li><a class="dropdown-item" href="#">Approva Liquidazioni</a></li>
                            <li><a class="dropdown-item" href="#">Pubblica Liquidazioni</a></li>
                            <li><a class="dropdown-item" href="#">Approva Ruolo</a></li>
                            <li><a class="dropdown-item" href="#">Ricette</a></li>
                            <li><a class="dropdown-item" href="#">Reportistica</a></li>
                        </ul>
                    </li>
                    <!-- Dropdown "Gestione Utenti" -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle btn btn-primary p-2 mx-1 text-white fw-bold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Gestione Utenti <svg class="icon icon-white icon-xs"><use href="/bootstrap-italia/svg/sprites.svg#it-expand"></use></svg>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Lista Utenti</a></li>
                            <li><a class="dropdown-item" href="#">Aggiungi Utente</a></li>
                        </ul>
                    </li>
                    <!-- Dropdown "Gestione Utenti" -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle btn btn-primary p-2 mx-1 text-white fw-bold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Gestione Tabelle <svg class="icon icon-white icon-xs"><use href="/bootstrap-italia/svg/sprites.svg#it-expand"></use></svg>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Tabella Nazioni</a></li>
                            <li><a class="dropdown-item" href="#">Tabella Regioni</a></li>
                            <li><a class="dropdown-item" href="#">Tabella Province</a></li>
                            <li><a class="dropdown-item" href="#">Tabella Comuni</a></li>
                            <li><a class="dropdown-item" href="#">Tabella A.S.L.</a></li>
                            <li><a class="dropdown-item" href="#">Tabella Distretti</a></li>
                            <hr>
                            <li><a class="dropdown-item" href="#">Tabella Medici</a></li>
                            <li><a class="dropdown-item" href="#">Tabella Branche</a></li>
                            <li><a class="dropdown-item" href="#">Tabella Diagnosi</a></li>
                            <li><a class="dropdown-item" href="#">Tabella Esenzioni</a></li>
                            <li><a class="dropdown-item" href="#">Tabella Prestazioni</a></li>
                            <li><a class="dropdown-item" href="#">Tabella Tariffe</a></li>
                            <li><a class="dropdown-item" href="#">Tabella Causali</a></li>
                            <hr>
                            <li><a class="dropdown-item" href="#">Tabella Errori</a></li>
                            <li><a class="dropdown-item" href="#">Tabella News</a></li>
                        </ul>
                    </li>
                    <!-- Dropdown "Supporto" -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle btn btn-primary p-2 mx-1 text-white fw-bold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Supporto <svg class="icon icon-white icon-xs"><use href="/bootstrap-italia/svg/sprites.svg#it-expand"></use></svg>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Download Utili</a></li>
                            <li><a class="dropdown-item" href="#">Contatti</a></li>
                            <li><a class="dropdown-item" href="#">Cambio Password</a></li>
                        </ul>
                    </li>
                <?php endif; ?>


            </ul>

            <ul class="navbar-nav ms-auto">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item">
                        <a class="btn btn-danger p-2 mx-1" href="logout.php">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="btn btn-primary p-2 mx-1" href="login.php">Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Bootstrap Italia JS -->
<script src="assets/bootstrap-italia/js/bootstrap-italia.bundle.min.js"></script>