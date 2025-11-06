<?php
session_start();
include '../sql/db.php';
include "../includes/header_footer/header_frontend.php";

// Jos käyttäjä ei ole kirjautunut sisään, ohjataan kirjautumissivulle
/*if (!isset($_SESSION['JasenID'])) {
    header('Location: login.php');
    exit;
}*/
?>
<body>
    <nav class="navbar">
        <div class="nav-left">
            <span class="user-name">Hei, <?php echo isset($_SESSION['Nimi']) ? htmlspecialchars($_SESSION['Nimi']) : 'Käyttäjä'; ?>!</span>
        </div>
        <div class="nav-right">
            <a href="index.php" class="nav-link">Luokat</a>
            <a href="index.php#reservations" class="nav-link">Varaukset</a>
            <a href="settings.php" class="nav-link active">Asetukset</a>
        </div>
    </nav>
    <main class="content">
        <h1>Asetukset</h1>
        <p>Tälle sivulle voit lisätä käyttäjäasetusten hallintaan liittyviä toimintoja.</p>
    </main>
</body>
</html>
