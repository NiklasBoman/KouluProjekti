<?php
include '../includes/db_connect.php'; // Korjattu käyttämään oikeaa tietokantayhteyttä

if (isset($_POST['rekisteroi'])) {
    // Lomakkeen tiedot
    $nimi = trim($_POST['Nimi']);
    $gmail = trim($_POST['Gmail']);
    $puhelinNro = trim($_POST['PuhelinNro']);
    $salasana = $_POST['salasana'];

    $virheet = [];

    // Tarkistetaan että kentät eivät ole tyhjiä
    if (empty($nimi) || empty($gmail) || empty($puhelinNro) || empty($salasana)) {
        $virheet[] = "Kaikki kentät ovat pakollisia.";
    }

    // Sähköpostin validointi
    if (!filter_var($gmail, FILTER_VALIDATE_EMAIL)) {
        $virheet[] = "Sähköposti ei ole kelvollinen.";
    }
    //Puhelinnumeron validointi
    if (!preg_match("/^\d+$/", $puhelinNro)) {
        $virheet[] = "Puhelinnumero ei ole kelvollinen.";
    }
    $stmt_check = $conn->prepare("SELECT KayttajaID FROM Kayttajat WHERE Gmail = ?");
    $stmt_check->bind_param("s", $gmail);
    $stmt_check->execute();
    $stmt_check->store_result();

    if ($stmt_check->num_rows > 0) {
        $virheet[] = "Sähköposti on jo käytössä. Valitse toinen.";
    }
    if (empty($virheet)) {
        $hash = password_hash($salasana, PASSWORD_DEFAULT); //Salaa salasanan

        //Jos ei virheitä käyttäjätiedot luodaan ja tallenetaan tietokantaan.
        $stmt = $conn->prepare("INSERT INTO Kayttajat (Nimi, Gmail, PuhelinNro, SalasanaHash) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nimi, $gmail, $puhelinNro, $hash);
        if ($stmt->execute()) {
            echo "<div class='message success'>✅ Rekisteröinti onnistui!</div>";
        } else {
            echo "<div class='message error'>❌ Rekisteröinti epäonnistui. Yritä uudelleen.</div>";
        }
    } else {
        foreach ($virheet as $virhe) {
            echo "<div class='message error'>❌ $virhe</div>";
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
</head>
<body>
<h1>Rekisteröityminen</h1>
<div class="container">
<form action="" method="post">
    <label>Nimi</label>
    <br>
    <input type="text" name="Nimi" id="Nimi">
    <br>
    <label>Sähköposti</label>
    <br>
    <input type="email" name="Gmail" id="Gmail">
    <br>
    <label>Puhelinnumero</label>
    <br>
    <input type="number" name="PuhelinNro" id="PuhelinNro">
    <br>
    <label>Salasana</label>
    <br>
    <input type="password" name="salasana" id="salasana">
    <br>
    <br>
    <button type="submit" name="rekisteroi">Rekisteröidy</button>

<br><br>
<a href="login.php">
    <button type="button">Kirjautumaan</button>
</a>
</form>
</div>
</body>
</html>
