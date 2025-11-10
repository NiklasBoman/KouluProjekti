<!-- Sivu missä näkyy käyttäjäån varaukset -->
<?php
session_start();
include '../includes/db_connect.php'; // Yhteys tietokantaan
include "header_footer/header_frontend.php"; // Include header

// Jos käyttäjä ei ole kirjautunut sisään, ohjataan kirjautumissivulle
if (!isset($_SESSION['KayttajaID'])) {
    header('Location: login.php');
    exit;
}

// Määritellään $kayttaja-muuttuja nimen näyttämistä varten
$kayttaja = $_SESSION['Nimi'] ?? 'Käyttäjä';

?>