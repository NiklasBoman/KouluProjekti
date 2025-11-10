<?php
session_start();
include '../includes/db_connect.php';

// Varmistetaan, että käyttäjä on kirjautunut sisään
if (!isset($_SESSION['KayttajaID'])) {
    header('Location: login.php');
    exit;
}

// Varmistetaan, että pyyntö on POST-tyyppinen ja sisältää reservation_id:n
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reservation_id'])) {
    $reservation_id = filter_input(INPUT_POST, 'reservation_id', FILTER_VALIDATE_INT);
    $kayttaja_id = $_SESSION['KayttajaID']; // Kirjautuneen käyttäjän ID

    if ($reservation_id) {
        // Valmistellaan SQL-lauseke, joka poistaa varauksen.
        // Lisätään WHERE-ehtoon KayttajaID, jotta käyttäjä voi poistaa VAIN omia varauksiaan.
        $stmt = $conn->prepare("DELETE FROM Varaukset WHERE VarausID = ? AND KayttajaID = ?");
        $stmt->bind_param("ii", $reservation_id, $kayttaja_id);

        if ($stmt->execute()) {
            // Jos poisto onnistui, asetetaan onnistumisviesti ja ohjataan takaisin varaukset-sivulle.
            // Tähän voisi lisätä myöhemmin esim. toast-notifikaation. TODO lisää toaster popup
            $_SESSION['success_message'] = "Varaus poistettu onnistuneesti.";
        } else {
            // Jos poisto epäonnistui
            $_SESSION['error_message'] = "Varauksen poistaminen epäonnistui.";
        }
        $stmt->close();
    }
}

// Ohjataan aina takaisin varaukset-sivulle
header('Location: reservations.php');
exit;
