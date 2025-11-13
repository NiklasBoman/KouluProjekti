<?php
include 'admin_check.php'; // Varmistaa, että käyttäjä on admin
include '../includes/db_connect.php';

// Varmistetaan, että pyyntö on POST-tyyppinen ja sisältää tarvittavat tiedot
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reservation_id'])) {
    $reservation_id = filter_input(INPUT_POST, 'reservation_id', FILTER_VALIDATE_INT);
    
    // Säilytetään user_id, jotta voidaan palata oikean käyttäjän näkymään
    $user_id_return = filter_input(INPUT_POST, 'user_id_return', FILTER_VALIDATE_INT);

    if ($reservation_id) {
        // Valmistellaan SQL-lauseke, joka poistaa varauksen.
        // Admin voi poistaa minkä tahansa varauksen, joten emme tarkista KayttajaID:tä.
        $stmt = $conn->prepare("DELETE FROM Varaukset WHERE VarausID = ?");
        $stmt->bind_param("i", $reservation_id);

        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Varaus poistettu onnistuneesti.";
        } else {
            $_SESSION['error_message'] = "Varauksen poistaminen epäonnistui.";
        }
        $stmt->close();
    }
}

// Ohjataan takaisin admin-paneeliin. Jos user_id on asetettu, lisätään se URL-parametriksi.
$redirect_url = 'index.php';
if (!empty($user_id_return)) {
    $redirect_url .= '?user_id=' . $user_id_return;
}

header('Location: ' . $redirect_url);
exit;
?>