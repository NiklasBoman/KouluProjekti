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

// Haetaan käyttäjän tiedot tietokannasta, jotta ne ovat aina ajan tasalla
$kayttajaID = $_SESSION['KayttajaID'];
$stmt_user = $conn->prepare("SELECT Nimi, Gmail, Profiilikuva FROM kayttajat WHERE KayttajaID = ?");
$stmt_user->bind_param("i", $kayttajaID);
$stmt_user->execute();
$result_user = $stmt_user->get_result();
$user_data = $result_user->fetch_assoc();
$stmt_user->close();

$kayttaja = $user_data['Nimi'] ?? 'Käyttäjä';
$gmail = $user_data['Gmail'] ?? 'sähköposti@esimerkki.com';
$profiilikuva = $user_data['Profiilikuva'] ?? '../public/assets/images/profile_placeholder.svg';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $kayttajaID = $_SESSION['KayttajaID'];

    // Nimen vaihto
    if (isset($_POST['nvaihto'])) {
        $uusiNimi = trim($_POST['nimi']);
        if (!empty($uusiNimi)) {
            $stmt = $conn->prepare("UPDATE kayttajat SET Nimi = ? WHERE KayttajaID = ?");
            $stmt->bind_param("si", $uusiNimi, $kayttajaID);
            if ($stmt->execute()) {
                $_SESSION['Nimi'] = $uusiNimi; // Päivitetään myös sessio
                header("Location: settings.php"); exit; // Uudelleenohjaus
                $kayttaja = $uusiNimi;
            }
            $stmt->close();
        }
    }

    // Sähköpostin vaihto
    if (isset($_POST['spvaihto'])) {
        $uusiEmail = trim($_POST['gmail']);
        if (filter_var($uusiEmail, FILTER_VALIDATE_EMAIL)) {
            $stmt = $conn->prepare("UPDATE kayttajat SET Gmail = ? WHERE KayttajaID = ?");
            $stmt->bind_param("si", $uusiEmail, $kayttajaID);
            if ($stmt->execute()) {
                $_SESSION['Gmail'] = $uusiEmail;
                header("Location: settings.php"); exit; // Uudelleenohjaus
                $gmail = $uusiEmail;
            }
            $stmt->close();
        }
    }

    // Salasanan vaihto
    if (isset($_POST['svaihto'])) {
        $uusiSalasana = $_POST['salasana'];
        if (!empty($uusiSalasana)) {
            $hash = password_hash($uusiSalasana, PASSWORD_BCRYPT);
            $stmt = $conn->prepare("UPDATE kayttajat SET SalasanaHash = ? WHERE KayttajaID = ?");
            $stmt->bind_param("si", $hash, $kayttajaID);
            $stmt->execute();
            header("Location: settings.php"); exit; // Uudelleenohjaus
            $stmt->close();
        }
    }
    // Profiilikuvan vaihto
    if (isset($_POST['kvaihto']) && isset($_FILES['Profiilikuva'])) {
    $kayttajaID = $_SESSION['KayttajaID'];
    $file = $_FILES['Profiilikuva'];

    // Tarkista ettei virheitä
    if ($file['error'] === UPLOAD_ERR_OK) {
        $targetDir = "../public/uploads/";
        // Luo hakemisto jos ei ole
        if (!is_dir($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Luo uniikki tiedostonimi
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $newName = "profile_" . $kayttajaID . "." . $ext;
        $targetFile = $targetDir . $newName;

        // Siirrä tiedosto
        if (move_uploaded_file($file['tmp_name'], $targetFile)) {
            // Päivitä tietokantaan polku
            $stmt = $conn->prepare("UPDATE kayttajat SET Profiilikuva = ? WHERE KayttajaID = ?");
            $stmt->bind_param("si", $targetFile, $kayttajaID);
            if ($stmt->execute()) {
                $_SESSION['Profiilikuva'] = $targetFile;
                header("Location: settings.php"); exit; // Uudelleenohjaus
                $profiilikuva = $targetFile;
            }
            $stmt->close();
        }
    }
}
}
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

        <!-- Profiilikuvan vaihto -->
        <form method="post" action="" enctype="multipart/form-data" class="settings-profile">
            <div class="profile-image-container">
                <img src="<?php echo htmlspecialchars($profiilikuva); ?>" alt="Profiilikuva" class="profile-pic">
                <br>
                <input type="file" name="Profiilikuva" accept="image/*">
                <div class="button2">
                    <button type="submit" name="kvaihto">Vaihda kuva</button>
                </div>
            </div>
        </form>

        <!-- Nimen vaihto -->
        <form method="post" action="">
            <label>Nimi</label>
            <input type="text" name="nimi" value="<?php echo htmlspecialchars($kayttaja); ?>">
            <div class="button2">
                <button type="submit" name="nvaihto">Nimen vaihto</button>
            </div>
        </form>

        <!-- Sähköpostin vaihto -->
        <form method="post" action="">
        <label>Sähköposti</label>
            <input type="email" name="gmail" value="<?php echo htmlspecialchars($gmail); ?>">
            <div class="button2">
                <button type="submit" name="spvaihto">Sähköpostin vaihto</button>
            </div>
        </form>

        <!-- Salasanan vaihto -->
        <form method="post" action="">
        <label>Salasana</label>
            <input type="password" name="salasana" placeholder="********">
            <div class="button2">
                <button type="submit" name="svaihto">Salasanan vaihto</button>
            </div>
        </form>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<body>
