<?php
// Aloitetaan sessi
session_start();

// Sisällytetään tietokantayhteys
include '../includes/db_connect.php';

// Varmistetaan, että käyttäjä on kirjautunut sisään, ohjataan muuten login.php sivulle
if (!isset($_SESSION['KayttajaID'])) {
    header('Location: login.php');
    exit;
}

// Varmistetaan, että pyyntö on POST-tyyppinen
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Haetaan ja puhdistetaan lomakkeen tiedot
    $huone_id = filter_input(INPUT_POST, 'huone_id', FILTER_VALIDATE_INT);
    $alku_pvm = $_POST['alku'] ?? '';
    $loppu_pvm = $_POST['loppu'] ?? '';
    $kayttaja_id = $_SESSION['KayttajaID'];

    // Tarkistetaan, että kaikki tarvittavat tiedot on annettu
    if (!$huone_id || empty($alku_pvm) || empty($loppu_pvm)) {
        // Jos tiedot puuttuvat, ohjataan takaisin virheviestillä
        $_SESSION['error_message'] = "Tapahtui virhe. Yritä mhyöhemmin uudelleen.";
        header('Location: index.php'); // Ohjataan takaisin etusivulle
        exit;
    }

    // Varmistetaan, ettei huone ole jo varattu
    $stmt_check = $conn->prepare(
        "SELECT VarausID FROM Varaukset WHERE HuoneID = ? AND NOT (VarausLoppu < ? OR VarausAlku > ?)"
    );
    $stmt_check->bind_param("iss", $huone_id, $alku_pvm, $loppu_pvm);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        // Huone on jo varattu tällä aikavälillä
        $_SESSION['error_message'] = "Valitettavasti joku ehti varata tämän huoneen. Valitse toinen aika tai huone.";
        header('Location: index.php');
        exit;
    }
    $stmt_check->close();

    // Tallennetaan varaus tietokantaan käyttäen valmisteltua lauseketta
    $stmt = $conn->prepare("INSERT INTO Varaukset (HuoneID, KayttajaID, VarausAlku, VarausLoppu) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("iiss", $huone_id, $kayttaja_id, $alku_pvm, $loppu_pvm);

    if ($stmt->execute()) {
        // Jos tallennus onnistuu, ohjataan onnistumissivulle TODO lisä onnistumisviesti vaikka toad illa
        header('Location: reservations.php');
        exit;
    }
}
// Jos pyyntö ei ollut POST, ohjataan etusivulle
header('Location: index.php');
exit;
