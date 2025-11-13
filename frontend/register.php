<?php
session_start();
include '../includes/db_connect.php'; // Korjattu käyttämään oikeaa tietokantayhteyttä

$virheet = [];
$success_message = '';

if (isset($_POST['rekisteroi'])) {
    // 1. Honeypot-tarkistus
    if (!empty($_POST['website'])) {
        // Todennäköisesti botti, älä tee mitään tai kirjaa lokiin.
        // Ohjataan käyttäjä takaisin, ikään kuin mitään ei olisi tapahtunut.
        header('Location: login.php');
        exit;
    }

    // Lomakkeen tiedot
    $nimi = trim($_POST['Nimi']);
    $gmail = trim($_POST['Gmail']);
    $puhelinNro = trim($_POST['PuhelinNro']);
    $salasana = $_POST['salasana'];

    // Tarkistetaan että kentät eivät ole tyhjiä
    if (empty($nimi) || empty($gmail) || empty($puhelinNro) || empty($salasana)) {
        $virheet[] = "Kaikki kentät ovat pakollisia.";
    }

    // Sähköpostin validointi (jos se ei ole tyhjä)
    if (!empty($gmail) && !filter_var($gmail, FILTER_VALIDATE_EMAIL)) {
        $virheet[] = "Sähköposti ei ole kelvollinen.";
    }
    // Puhelinnumeron validointi (jos se ei ole tyhjä)
    if (!empty($puhelinNro) && !preg_match("/^\+?[0-9\s\-]+$/", $puhelinNro)) {
        $virheet[] = "Puhelinnumero ei ole kelvollinen.";
    }

    // Tarkistetaan sähköpostin uniikkius vain jos ei muita virheitä
    if (empty($virheet)) {
        $stmt_check = $conn->prepare("SELECT KayttajaID FROM Kayttajat WHERE Gmail = ?");
        $stmt_check->bind_param("s", $gmail);
        $stmt_check->execute();
        $stmt_check->store_result();

        if ($stmt_check->num_rows > 0) {
            $virheet[] = "Sähköposti on jo käytössä. Valitse toinen.";
        }
        $stmt_check->close();
    }

    if (empty($virheet)) {
        $hash = password_hash($salasana, PASSWORD_DEFAULT); //Salaa salasanan

        // Jos ei virheitä, käyttäjätiedot luodaan ja tallennetaan tietokantaan.
        $stmt = $conn->prepare("INSERT INTO Kayttajat (Nimi, Gmail, PuhelinNro, SalasanaHash) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nimi, $gmail, $puhelinNro, $hash);
        if ($stmt->execute()) {
            $_SESSION['success_message'] = "Rekisteröinti onnistui! Voit nyt kirjautua sisään.";
            header("Location: login.php");
            exit;
        } else {
            $virheet[] = "Rekisteröinti epäonnistui. Yritä uudelleen.";
        }
    }
}
?>
<!doctype html>
<html>
<head>
<title>register</title>
<link rel="stylesheet" href="logintyyli.css">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../public/assets/css/logintyyli.css">
<style>
    /* Honeypot-kentän piilotus */
    .honeypot-field {
        display: none;
    }
</style>
</head>
<body>
<h1>Rekisteröityminen</h1>
<div class="container">
<form action="" method="post">
    <?php if (!empty($virheet)): ?>
        <div class="alert alert-danger">
            <?php foreach ($virheet as $virhe): ?>
                <p>❌ <?php echo htmlspecialchars($virhe); ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <label>Nimi</label>
    <br>
    <input type="text" name="Nimi" id="Nimi" placeholder="Syötä Nimesi" required>
    <br>
    <label>Sähköposti</label>
    <br>
    <input type="email" name="Gmail" id="Gmail" placeholder="Syötä sähköpostiosoitteesi" required>
    <br>
    <label>Puhelinnumero</label>
    <br>
    <input type="tel" name="PuhelinNro" id="PuhelinNro" placeholder="Syötä Puhelinnumero" required>
    <br>
    <label>Salasana</label>
    <br>
    <input type="password" name="salasana" id="salasana" placeholder="Syötä salasanasi" required>
    <br>
    <br>
    <!-- Honeypot-kenttä -->
    <div class="honeypot-field">
        <label for="website">Website</label>
        <input type="text" name="website" id="website" autocomplete="off">
    </div>
    <button type="submit" name="rekisteroi">Rekisteröidy</button>

<br><br>
<a href="login.php">
    <button type="button">Kirjautumaan</button>
</a>
</form>
</div>
</body>
</html>
