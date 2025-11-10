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

// Haetaan käyttäjän varaukset tietokannasta
$kayttaja_id = $_SESSION['KayttajaID'];
// Varaukset taulukko
$reservations = [];

// Valmistellaan SQL-lauseke, joka yhdistää Varaukset ja Huoneet -taulut
$stmt = $conn->prepare(
    "SELECT h.HuoneNimi, h.Rakennus, h.Kerros, v.VarausAlku, v.VarausLoppu, v.VarausID
     FROM Varaukset v
     JOIN Huoneet h ON v.HuoneID = h.HuoneID
     WHERE v.KayttajaID = ?
     ORDER BY v.VarausAlku ASC"
);
$stmt->bind_param("i", $kayttaja_id);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    $reservations[] = $row;
}
$stmt->close();
?>

<div class="main-content">
    <!-- H1 otsikko -->
    <header class="header">
        <h1>Omat varauksesi, <?php echo htmlspecialchars($kayttaja); ?>!</h1>
        <p>Sivulla voit hallita varauksiasi.</p>
    </header>

    <!-- Käyttäjän varatut huoneet -->
    <div class="content-section">
        <div class="rooms-list">
            <?php if (!empty($reservations)): ?>
                <?php foreach ($reservations as $reservation): ?>
                    <div class="room-item">
                        <h3><?php echo htmlspecialchars($reservation['HuoneNimi']); ?></h3>
                        <p>
                            <?php echo htmlspecialchars($reservation['Rakennus']); ?>,
                            kerros <?php echo htmlspecialchars($reservation['Kerros']); ?>
                        </p>
                        <p>
                            <strong>Varattu ajalle:</strong>
                            <?php
                                // Muotoillaan päivämäärät luettavampaan muotoon
                                $alku = new DateTime($reservation['VarausAlku']);
                                $loppu = new DateTime($reservation['VarausLoppu']);
                                echo $alku->format('d.m.Y') . ' - ' . $loppu->format('d.m.Y');
                            ?>
                        </p>
                        <!-- Lisätään peruuta-nappi, joka on visuaalisesti poistettu käytöstä (disabled) -->
                         <!-- Lisää samanalainen mdaali kun indexissä -->
                        <button class="delete-btn" data-reservation-id="<?php echo $reservation['VarausID']; ?>" disabled>Peruuta varaus</button>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="no-reservations-message">Sinulla ei ole aktiivisia varauksia.</div>
            <?php endif; ?>
        </div>
    </div>
</div>