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
$gmail = $_SESSION['Gmail'] ?? 'Gmail';


$profiilikuva = $_SESSION['Profiilikuva'] ?? '../public/assets/images/profile_placeholder.svg';
?>
<!doctype html>
<html>
<head>
<title>settings</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../public/assets/css/style.css">

</head>
<body>


<div class="keskitin">
    <div class="container">
<h1>Asetukset</h1>
    <div class="settings-profile">
            <img src="<?php echo htmlspecialchars($profiilikuva); ?>" 
                 alt="Profiilikuva" class="profile-pic">
                 <button  id="kvaihto">Vaihda kuva</button>
        </div>
        
        <label>Nimi</label>
        <input type="text" value= "<?php echo htmlspecialchars($kayttaja); ?>">
        <div class="button2">
        <button  id="nvaihto">Nimen vaihto</button>
        </div>

        <label>Sähköposti</label>
        <input type="email" value="<?php echo htmlspecialchars($gmail); ?>">
        <div class="button2">
        <button  id="spvaihto">Sähköpostin vaihto</button>
        </div>

        <label>Salasana</label>
        <input type="password" value = "<?php echo htmlspecialchars($salasana); ?>" >
        <div class="button2">
        <button  id="svaihto">Salasanan vaihto</button>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<body>
