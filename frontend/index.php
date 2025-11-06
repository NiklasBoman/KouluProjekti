<!-- Näyttää kalenterin mistä valita halutut päviät ja näyttää vapaana olevat luokat valituille päiville -->
<?php
// Aloitetaan session ja tuodaan tarvittavat tiedostot, tietokanta sekä apufunktiot
session_start();
require_once '../includes/db_connect.php';
require_once '../includes/functions.php';
include "../includes/header_footer/header_frontend.php";

// Jos käyttäjä ei ole kirjautunut sisään, ohjataan kirjautumissivulle
/*if (!isset($_SESSION['name']) || empty($_SESSION['name'])) {
    header('Location: login.php');
    exit;
}*/
?>



<body>

    <!-- Sticky Navbar, ei tarvitse olal sticky riippu sivun rakenteesta -->
    <nav class="navbar">

        <!-- Vasen osuus, profiilikuva ja teksti -->
        <div class="nav-left">

            <!-- TODO hae käyttäjän kuva tietokannastaja aseta placeholderkuva -->
            <img src="../includes/images/profile_placeholder.svg" alt="kuva" class="profile-pic">

            <!-- Näyttää kirajutuneen käyttäjän nimen ja kuvan vasemmassa kulmassa navbaria-->
            <span class="user-name">Hei, <?php echo isset($_SESSION['Nimi']) ? htmlspecialchars($_SESSION['Nimi']) : 'Käyttäjä'; ?>!</span>
        </div>

        <!-- Navbarin itemit -->
        <div class="nav-right">
            <a href="#" class="nav-link active">Luokat</a>
            <a href="#" class="nav-link">Varaukset</a>

            <!-- TODO tee oma sivu profiilin asetuksille -->
            <a href="#" class="nav-link">Asetukset</a>
        </div>
    </nav>



    <div class="container py-5">

        <!-- Tervetuloa otsikko -->
        <header class="mb-4">
            <h1 class="text-center">Tervetuloa luokkavarauksien järjestelmään!</h1>
            <p class="text-center">Varaa luokkahuone ja hallinoi varauksiasi sivulla.</p>
        </header>


    </div>








    <!-- Pääsisältö -->
    <main class="content">
        <section id="rooms">
            <h1>Varaa luokkahuone</h1>
            <p>Valitse päivämäärä ja näe vapaat huoneet.</p>
            <!-- Varauslomake + huonelistaus tähän -->
            <div id="roomsGrid" class="rooms-grid" aria-live="polite">
                <!-- Luokkahuoneet haetaan tänne JavaScriptillä tietokannasta -->
            </div>
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

    <script src="../assets/js/main.js"></script>
</body>

</html>