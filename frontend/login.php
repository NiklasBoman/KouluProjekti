<!-- Kirjautumissivu mikä hashaa salasanan + mut taristukset -->
<?php 
session_start();
include 'db.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gmail = $_POST['gmail'] ?? '';
    $salasana = $_POST['salasana'] ?? '';

    // Valmistellaan kysely
    $stmt = $conn->prepare("SELECT JasenID, SalasanaHash FROM Kayttajat WHERE Gmail = ?");
    $stmt->bind_param("s", $gmail);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($jasenID, $hash);
        $stmt->fetch();

        if (password_verify($salasana, $hash)) {
            $_SESSION['JasenID'] = $jasenID;
            header("Location: index.php");
            exit;
        } else {
            $error = "❌ Väärä salasana.";
        }
    } else {
        $error = "❌ Käyttäjätunnusta ei löytynyt.";
    }
    $stmt->close();
}
?>
<!doctype html>
<html>
<head>
<title>login</title>
<link rel="stylesheet" href="logintyyli.css">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<h1>Kirjautuminen</h1>
<div class="container">
<form action="index.php" method="post">
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
    <input type="password" name="SalasanaHash" id="SalasanaHash">
    <br>
    <br>
    <button type="submit">Kirjaudu</button>
<br> <br>
<a href="register.html">
    <button type="button">Rekisteröidy</button>
</a>
</form>
</div>
</body>
</html>
