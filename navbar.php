<?php
session_start(); // Avvia la sessione
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- Bootstrap Italia CSS -->
    <link rel="stylesheet" href="assets/bootstrap-italia/css/bootstrap-italia.min.css">
    <link rel="stylesheet" href="styles.css">
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
                    <a class="btn btn-primary p-1 mx-1" href="<?php echo isset($_SESSION['user_id']) ? 'home.php' : 'login.php'; ?>">Home</a>
                </li>

                <!-- Link "Gestione Convenzionati" visibile solo se l'utente è loggato -->
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item">
                        <a class="btn btn-primary p-1 mx-1" href="gestione_convenzionati.php">Gestione Convenzionati</a>
                    </li>
                    <!-- Dropdown "Flusso M" -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle btn btn-primary p-1 mx-1 text-white fw-bold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Flusso M
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Opzione 1</a></li>
                            <li><a class="dropdown-item" href="#">Opzione 2</a></li>
                            <li><a class="dropdown-item" href="#">Opzione 3</a></li>
                        </ul>
                    </li>
                <?php endif; ?>


            </ul>

            <ul class="navbar-nav ms-auto">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li class="nav-item">
                        <a class="btn btn-danger p-1 mx-1" href="logout.php">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="btn btn-primary p-1 mx-1" href="login.php">Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Bootstrap Italia JS -->
<script src="assets/bootstrap-italia/js/bootstrap-italia.bundle.min.js"></script>