<?php
// Varmistetaan, että sessio on aloitettu, mutta ei aloiteta sitä uudelleen, jos se on jo aktiivinen.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Tarkistetaan, onko käyttäjä kirjautunut sisään ja onko hän admin.
// Jos ei, ohjataan hänet pois ja lopetetaan suoritus.
if (!isset($_SESSION['Rooli']) || $_SESSION['Rooli'] !== 'admin') {
    // Ohjataan vain suoraan kirjautumissivulle turvallisuus syistä jottei tiedostopolku paljastu.
    header('Location: ../frontend/login.php');
    exit;
}
