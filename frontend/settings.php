<?php
session_start();
include '../sql/db.php';
include "../includes/header_footer/header_frontend.php";

?>
<link rel="stylesheet" href="style.css">

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
  <div class="keskitin">
  <div class="container">
    <h1>Asetukset</h1>
    <p>Tälle sivulle voit lisätä käyttäjäasetusten hallintaan liittyviä toimintoja.</p>
  </div>
</div>
</body>
</html>
