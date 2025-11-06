<!-- Näyttää kalenterin mistä valita halutut päviät ja näyttää vapaana olevat luokat valituille päiville -->
<?php
// Aloitetaan session ja tuodaan tarvittavat tiedostot, tietokanta sekä apufunktiot
session_start();
require_once '../includes/db_connect.php';
require_once '../includes/functions.php';
?>

<!DOCTYPE html>
<html lang="fi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luokkavaraus järjestelmä</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
</head>

<body>

    <!-- 🔹 Sticky Navbar -->
    <nav class="navbar">
        <div class="nav-left">
            <img src="../includes/images/profile.jpg" alt="Profiilikuva" class="profile-pic">
            <span class="user-name">Hei, <?php echo isset($_SESSION['name']) ? htmlspecialchars($_SESSION['name']) : 'Käyttäjä'; ?>!</span>
        </div>

        <div class="nav-center">
            <a href="#rooms" class="nav-link active">Luokat</a>
            <a href="#reservations" class="nav-link">Varaukset</a>
            <a href="#settings" class="nav-link">Asetukset</a>
        </div>
    </nav>

    <!-- Pääsisältö -->
    <main class="content">
        <section id="rooms">
            <h1>Varaa luokkahuone</h1>
            <p>Valitse päivämäärä ja näe vapaat huoneet.</p>
            <!-- Varauslomake + huonelistaus tähän -->
        </section>

        <section id="reservations">
            <h2>Omat varaukset</h2>
            <!-- Käyttäjän varaukset -->
        </section>

        <section id="settings">
            <h2>Asetukset</h2>
            <!-- Käyttäjäasetukset -->
        </section>
    </main>
</body>

</html>