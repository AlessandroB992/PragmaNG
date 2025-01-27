<?php
session_start();

// Variabile per il messaggio di errore
$error_message = "";

// Se l'utente è già loggato, reindirizza direttamente alla home
if (isset($_SESSION['user_id'])) {
    header("Location: home.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Simula validazione (da sostituire con la connessione al database)
    if ($email === "admin@example.com" && $password === "password123") {
        // Login riuscito: salva l'ID utente nella sessione
        $_SESSION['user_id'] = $email;  // Puoi anche usare un ID numerico o altro

        // Reindirizza l'utente alla home
        header("Location: home.php");
        exit();
    } else {
        // Imposta il messaggio di errore
        $error_message = "Credenziali non valide.";
    }
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <?php include './includes/header.php'; ?>
    <title>Login</title>
</head>

<body>
    <?php include './includes/navbar.php'; ?>

    <!-- Login Form -->
    <div class="loginContainer w-75">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="it-card-wrapper">
                    <div class="it-card rounded-3">
                        <div class="it-card-header">
                            <h3 class="it-card-title py-4 text-center">Login</h3>
                        </div>
                        <!-- Mostra il messaggio di errore se presente -->
                        <?php if ($error_message): ?>
                            <div class="alert alert-danger alert-dismissible fade show w-75 m-auto" role="alert">
                                <?php echo $error_message; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php endif; ?>
                        <div class="it-card-body p-5">
                            <form action="index.php" method="POST" class="needs-validation" novalidate>
                                <div class="form-group">
                                    <label for="email" class="required">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                    <div class="invalid-feedback">
                                        Inserisci una email valida.
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="required">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                    <div class="invalid-feedback">
                                        Inserisci la tua password.
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Accedi</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Italia JS -->
    <script src="/bootstrap-italia/js/bootstrap-italia.bundle.min.js"></script>

    <script>
        // Abilita validazione dei form di Bootstrap Italia
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>
</body>

</html>