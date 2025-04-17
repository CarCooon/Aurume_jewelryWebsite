<?php
    
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_SESSION["alert"])) {
        $alert = $_SESSION["alert"];
    }
    session_unset();  // Cancella tutte le variabili di sessione
    session_destroy();  // Distrugge la sessione

    // Elimino i cookie
    setcookie("user_id", "", time() - 1000, "/");
    setcookie("user_name", "", time() - 1000, "/");
    setcookie("user_email", "", time() - 1000, "/");

    if (isset($alert)) {
        header("Location: ../autenticazione.php?alert=" . urlencode($alert)); // Reindirizza alla pagina di login/registrazione
    } else {
        header("Location: ../autenticazione.php"); 
    }
    exit();
?>