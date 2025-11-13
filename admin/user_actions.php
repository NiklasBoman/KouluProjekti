<?php
include 'admin_check.php'; // Varmistaa, että käyttäjä on admin
include '../includes/db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    // --- KÄYTTÄJÄN LISÄYS TAI MUOKKAUS ---
    if ($action === 'add' || $action === 'edit') {
        $nimi = trim($_POST['nimi']);
        $gmail = trim($_POST['gmail']);
        $puhelin = trim($_POST['puhelin']);
        $rooli = $_POST['rooli'];
        $salasana = $_POST['salasana'];
        $user_id = filter_input(INPUT_POST, 'user_id', FILTER_VALIDATE_INT);

        // Tarkistetaan, että rooli on joko 'user' tai 'admin'
        if (!in_array($rooli, ['user', 'admin'])) {
            $_SESSION['error_message'] = "Virheellinen rooli.";
            header('Location: admin_kayttajat.php');
            exit;
        }

        if ($action === 'add') {
            // Lisätään uusi käyttäjä
            if (empty($salasana)) {
                $_SESSION['error_message'] = "Salasana on pakollinen uutta käyttäjää luodessa.";
            } else {
                $hash = password_hash($salasana, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("INSERT INTO Kayttajat (Nimi, Gmail, PuhelinNro, SalasanaHash, Rooli) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("sssss", $nimi, $gmail, $puhelin, $hash, $rooli);
                if ($stmt->execute()) {
                    $_SESSION['success_message'] = "Uusi käyttäjä lisätty onnistuneesti.";
                } else {
                    $_SESSION['error_message'] = "Käyttäjän lisääminen epäonnistui. Sähköposti saattaa olla jo käytössä.";
                }
                $stmt->close();
            }
        } elseif ($action === 'edit' && $user_id) {
            // Päivitetään olemassa olevaa käyttäjää
            if (!empty($salasana)) {
                // Jos uusi salasana on annettu, päivitetään se
                $hash = password_hash($salasana, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("UPDATE Kayttajat SET Nimi = ?, Gmail = ?, PuhelinNro = ?, Rooli = ?, SalasanaHash = ? WHERE KayttajaID = ?");
                $stmt->bind_param("sssssi", $nimi, $gmail, $puhelin, $rooli, $hash, $user_id);
            } else {
                // Muuten päivitetään ilman salasanaa
                $stmt = $conn->prepare("UPDATE Kayttajat SET Nimi = ?, Gmail = ?, PuhelinNro = ?, Rooli = ? WHERE KayttajaID = ?");
                $stmt->bind_param("ssssi", $nimi, $gmail, $puhelin, $rooli, $user_id);
            }

            if ($stmt->execute()) {
                $_SESSION['success_message'] = "Käyttäjän tiedot päivitetty onnistuneesti.";
            } else {
                $_SESSION['error_message'] = "Tietojen päivitys epäonnistui.";
            }
            $stmt->close();
        }
    }

    // --- KÄYTTÄJÄN POISTO ---
    elseif ($action === 'delete') {
        $user_id = filter_input(INPUT_POST, 'user_id', FILTER_VALIDATE_INT);
        
        // Varmistetaan, ettei admin voi poistaa itseään
        if ($user_id && $user_id != $_SESSION['KayttajaID']) {
            // Tässä voisi olla lisälogiikkaa, esim. siirretäänkö käyttäjän varaukset toiselle vai poistetaanko ne.
            // Yksinkertaisuuden vuoksi poistamme nyt vain käyttäjän.
            $stmt = $conn->prepare("DELETE FROM Kayttajat WHERE KayttajaID = ?");
            $stmt->bind_param("i", $user_id);
            if ($stmt->execute()) {
                $_SESSION['success_message'] = "Käyttäjä poistettu onnistuneesti.";
            } else {
                $_SESSION['error_message'] = "Käyttäjän poistaminen epäonnistui.";
            }
            $stmt->close();
        } else {
            $_SESSION['error_message'] = "Et voi poistaa omaa käyttäjätiliäsi.";
        }
    }
}

header('Location: admin_kayttajat.php');
exit;