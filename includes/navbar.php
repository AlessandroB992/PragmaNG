<?php

session_start();

?>

<head>
    <?php include('header.php'); ?>
</head>

<nav class="navbar navbar-expand-lg py-3">
    <div class="container-fluid">
        <a class="navbar-brand mx-4 fw-bold text-white" href="#">PragmaNG LOGO</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="btn btn-light p-2 mx-1" href="<?php echo isset($_SESSION['user_id']) ? '/home' : '/'; ?>">Home</a>
                </li>

                <!-- Link "Gestione Convenzionati" visibile solo se l'utente è loggato -->
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item">
                        <a class="btn btn-light p-2 mx-1" href="../convenzionati">Gestione Convenzionati</a>
                    </li>
                    <!-- Dropdown "Flusso M" -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle btn btn-light p-2 mx-1 fw-bold text-black" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Flusso M <svg class="icon icon-black icon-xs"><use href="/bootstrap-italia/svg/sprites.svg#it-expand"></use></svg>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item py-1" href="#">Caricamento Flusso M</a></li>
                            <li><a class="dropdown-item py-1" href="#">Approva Flussi M</a></li>
                            <li><a class="dropdown-item py-1" href="#">Situazione Flussi M</a></li>
                            <li><a class="dropdown-item py-1" href="#">Liquida Flussi M</a></li>
                            <li><a class="dropdown-item py-1" href="#">Approva Liquidazioni</a></li>
                            <li><a class="dropdown-item py-1" href="#">Pubblica Liquidazioni</a></li>
                            <li><a class="dropdown-item py-1" href="#">Approva Ruolo</a></li>
                            <li><a class="dropdown-item py-1" href="#">Ricette</a></li>
                            <li><a class="dropdown-item py-1" href="#">Reportistica</a></li>
                        </ul>
                    </li>
                    <!-- Dropdown "Gestione Utenti" -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle btn btn-light p-2 mx-1 fw-bold text-black" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Gestione Utenti <svg class="icon icon-black icon-xs"><use href="/bootstrap-italia/svg/sprites.svg#it-expand"></use></svg>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item py-1" href="#">Lista Utenti</a></li>
                            <li><a class="dropdown-item py-1" href="#">Aggiungi Utente</a></li>
                        </ul>
                    </li>
                    <!-- Dropdown "Gestione Tabelle" -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle btn btn-light p-2 mx-1 fw-bold text-black" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Gestione Tabelle <svg class="icon icon-black icon-xs"><use href="/bootstrap-italia/svg/sprites.svg#it-expand"></use></svg>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item py-1" href="#">Tabella Nazioni</a></li>
                            <li><a class="dropdown-item py-1" href="#">Tabella Regioni</a></li>
                            <li><a class="dropdown-item py-1" href="#">Tabella Province</a></li>
                            <li><a class="dropdown-item py-1" href="#">Tabella Comuni</a></li>
                            <li><a class="dropdown-item py-1" href="#">Tabella A.S.L.</a></li>
                            <li><a class="dropdown-item py-1" href="#">Tabella Distretti</a></li>
                            <hr>
                            <li><a class="dropdown-item py-1" href="#">Tabella Medici</a></li>
                            <li><a class="dropdown-item py-1" href="#">Tabella Branche</a></li>
                            <li><a class="dropdown-item py-1" href="#">Tabella Diagnosi</a></li>
                            <li><a class="dropdown-item py-1" href="#">Tabella Esenzioni</a></li>
                            <li><a class="dropdown-item py-1" href="#">Tabella Prestazioni</a></li>
                            <li><a class="dropdown-item py-1" href="#">Tabella Tariffe</a></li>
                            <li><a class="dropdown-item py-1" href="#">Tabella Causali</a></li>
                            <hr>
                            <li><a class="dropdown-item py-1" href="#">Tabella Errori</a></li>
                            <li><a class="dropdown-item py-1" href="#">Tabella News</a></li>
                        </ul>
                    </li>
                    <!-- Dropdown "Supporto" -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle btn btn-light p-2 mx-1 fw-bold text-black" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Supporto <svg class="icon icon-black icon-xs"><use href="/bootstrap-italia/svg/sprites.svg#it-expand"></use></svg>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item py-1" href="#">Download Utili</a></li>
                            <li><a class="dropdown-item py-1" href="#">Contatti</a></li>
                            <li><a class="dropdown-item py-1" href="#">Cambio Password</a></li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>

            <ul class="navbar-nav ms-auto d-flex align-items-center">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <!-- Mostra il nome utente e il logout -->
                    <li class="nav-item">
                        <span class="navbar-text text-white mx-2"><?php echo $_SESSION['user_id']; ?></span>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-danger p-2 mx-1" href="/logout">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="btn btn-light p-2 mx-1" href="/">Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Bootstrap Italia JS -->
<script src="/bootstrap-italia/js/bootstrap-italia.bundle.min.js"></script>
