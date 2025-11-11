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
// Järjestetään varaukset rakennuksen mukaan
$reservations_by_building = [];

// Valmistellaan SQL-lauseke, joka yhdistää Varaukset ja Huoneet -taulut
$stmt = $conn->prepare(
    "SELECT h.HuoneNimi, h.Rakennus, h.Kerros, v.VarausAlku, v.VarausLoppu, v.VarausID
     FROM Varaukset v
     JOIN Huoneet h ON v.HuoneID = h.HuoneID
     WHERE v.KayttajaID = ?
     ORDER BY h.Rakennus, v.VarausAlku ASC"
);
$stmt->bind_param("i", $kayttaja_id);
$stmt->execute();
$result = $stmt->get_result();

while ($row = $result->fetch_assoc()) {
    // Ryhmitellään tulokset rakennuksen nimen mukaan
    $reservations_by_building[$row['Rakennus']][] = $row;
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
        <?php if (!empty($reservations_by_building)): ?>
            <?php foreach ($reservations_by_building as $building => $reservations): ?>
                <div class="reservation-group">
                    <h2><?php echo htmlspecialchars($building); ?></h2>
                    <div class="rooms-list">
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
                                <!-- Nappi, joka avaa poiston vahvistusmodaalin -->
                                <button type="button" class="btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#deleteReservationModal"
                                    data-reservation-id="<?php echo $reservation['VarausID']; ?>"
                                    data-room-name="<?php echo htmlspecialchars($reservation['HuoneNimi']); ?>"
                                    data-date-range="<?php echo $alku->format('d.m.Y') . ' - ' . $loppu->format('d.m.Y'); ?>">
                                    Peruuta varaus
                                </button>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="no-reservations-message">Sinulla ei ole aktiivisia varauksia.</div>
        <?php endif; ?>
    </div>
</div>

<!-- Varauksen poiston vahvistusmodaali -->
<div class="modal fade" id="deleteReservationModal" tabindex="-1" aria-labelledby="deleteReservationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <!-- Modal header -->
            <div class="modal-header">
                <h5 class="modal-title" id="deleteReservationModalLabel">Vahvista varauksen poisto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <p>Oletko varma, että haluat poistaa tämän varauksen?</p>
                <p><strong>Huone:</strong> <span id="modal-delete-room-name"></span></p>
                <p><strong>Aikaväli:</strong> <span id="modal-delete-date-range"></span></p>
                <p class="text-danger">Toimintoa ei voi perua.</p>

                <!-- Piilotettu lomake, joka lähettää poistopyynnön -->
                <form id="deleteReservationForm" action="delete_reservation.php" method="POST">
                    <input type="hidden" name="reservation_id" id="modal-delete-reservation-id">
                </form>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Peruuta</button>
                <button type="submit" form="deleteReservationForm" class="btn btn-danger">Vahvista poisto</button>
            </div>
        </div>
    </div>
</div>

<!-- Ladataan skriptit -->
<script src="../public/assets/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>