<?php 

// Turvallisemmat sessioasetukset
session_set_cookie_params([
    'lifetime' => 0,          // Istunto päättyy, kun selain suljetaan
    'path' => '/',            // Saatavilla kaikilla poluilla
    'domain' => '',           // Automaattisesti nykyinen domain
    'secure' => isset($_SERVER['HTTPS']), // Käytä vain HTTPS:ää, jos saatavilla
    'httponly' => true,       // Evästettä ei voi lukea JavaScriptillä
    'samesite' => 'Strict'    // Estää CSRF- ja cross-site -hyökkäykset
]);

session_start();
include '../includes/db_connect.php'; // Yhteys tietokantaan

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $gmail = $_POST['gmail'] ?? '';
    $salasana = $_POST['salasana'] ?? '';

    // Valmistellaan kysely
    // *** MUUTOS: Lisätään Rooli-sarakkeen haku ***
    $stmt = $conn->prepare("SELECT KayttajaID, Nimi, SalasanaHash, Rooli FROM Kayttajat WHERE Gmail = ?");
    $stmt->bind_param("s", $gmail);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        // Määritellään muuttujat ennen bind_result-kutsua
        $kayttajaID = null; $nimi = null; $hash = null; $rooli = null;

        // *** MUUTOS: Sidotaan myös Rooli-muuttuja ***
        $stmt->bind_result($kayttajaID, $nimi, $hash, $rooli);
        $stmt->fetch();

        if (password_verify($salasana, $hash)) {
            // Luodaan uusi sessiotunniste turvallisuussyistä (estää session fixation)
            // ja poistetaan vanha sessiotiedosto.
            session_regenerate_id(true);
            
            // *** MUUTOS: Tallennetaan rooli sessioon ja ohjataan oikealle sivulle ***
            $_SESSION['KayttajaID'] = $kayttajaID;
            $_SESSION['Nimi'] = $nimi;
            $_SESSION['Rooli'] = $rooli; // Saadaan admin roolin tarkastus

            if ($rooli === 'admin') {
                header("Location: ../admin/index.php"); // Ohjaa adminit admin-paneeliin
            } else {
                header("Location: index.php"); // Ohjaa muut käyttäjät normaalisti
            }
            exit;
        } else {
            $error = "❌ Väärä salasana.";  //Jos salasana väärin annetaan virhe.
        }
    } else {
        $error = "❌ Käyttäjätunnusta ei löytynyt."; //Sama juttu jos käyttäjätunnus ei löydy tietokannasta.
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
<link rel="stylesheet" href="../public/assets/css/logintyyli.css">
</head>
<body>
<h1>Kirjautuminen</h1>
<div class="container">
<form action="login.php" method="post">
    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <label>Sähköposti</label>
    <br>
    <input type="email" name="gmail" id="gmail" placeholder="Syötä sähköpostiosoitteesi" required>
    <br>
    <label>Salasana</label>
    <br>
    <input type="password" name="salasana" id="salasana" placeholder="Syötä salasanasi" required>
    <br>
    <br>
    <button type="submit">Kirjaudu</button>
<br> <br>
<a href="register.php">
    <button type="button">Rekisteröidy</button>
</a>
</form>
</div>
</body>
</html>
