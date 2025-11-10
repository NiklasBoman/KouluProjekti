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

// Käyttäjä valitsee päivämäärät ja haetaan vapaat huoneet näille päiville tietokannasta
$start_date = '';
$end_date = '';
$available_rooms = [];
$error_message = '';

// Nöytä vapaat huoneet, jos lomake on lähetetty
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['start_date']) && isset($_POST['end_date'])) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Tarkistetaan, että päivämäärät ovat kelvollisia
    if ($start_date > $end_date) {
        $error_message = 'Tarkista valitut päivämäärät.';
    } else {
        // Hae kaikki huoneet
        $all_rooms_result = $conn->query("SELECT HuoneID, HuoneNimi, Rakennus, Kerros, Paikat FROM Huoneet");
        $all_rooms = [];
        while ($row = $all_rooms_result->fetch_assoc()) {
            $all_rooms[$row['HuoneID']] = $row;
        }

        // Hae varatut huoneet valitulle päivälle
        $stmt = $conn->prepare(
            "SELECT DISTINCT HuoneID FROM Varaukset WHERE VarausAlku <= ? AND VarausLoppu >= ?"
        );
        $stmt->bind_param("ss", $end_date, $start_date);
        $stmt->execute();
        $result = $stmt->get_result();
        $booked_room_ids = [];
        while ($row = $result->fetch_assoc()) {
            $booked_room_ids[] = $row['HuoneID'];
        }
        $stmt->close();

        // Suodata pois varatut huoneet, jotta saadaan vapaat huoneet
        $available_rooms = array_diff_key($all_rooms, array_flip($booked_room_ids));
    }
}
?>

<!-- Lisätään flatpickr-kirjaston tyylit ja skriptit -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


<div class="main-content">
    <!-- H1 otsikko -->
    <header class="header">
        <h1>Tervetuloa luokkavarauksiin, <?php echo htmlspecialchars($kayttaja); ?>!</h1>
        <p>Valitse haluamasi aikaväli ja varaa vapaa luokkahuone.</p>
    </header>

    <!-- Päivämäärän valinnan container -->
    <div class="content-section">
        <div class="date-selection">
            
            <form action="index.php" method="post" class="date-form">
                <!-- Visuaalinen kalenteri msitä valitaan aikaväli varaukselle -->
                <div class="form-group">
                    <input type="text" id="date-range-picker" placeholder="Valitse päivämäärät...">
                </div>

                <!-- Piilotetut kentät, jotka lähetetään palvelimelle -->
                <input type="hidden" name="start_date" id="start_date" value="<?php echo htmlspecialchars($start_date); ?>">
                <input type="hidden" name="end_date" id="end_date" value="<?php echo htmlspecialchars($end_date); ?>">

                <!--  Hakee vapaat huoneet valitulle aikavälille-->
                <div class="form-group">
                    <button type="submit">Hae vapaat huoneet</button>
                </div>
            </form>

            <?php if ($start_date && $end_date): ?>
                <div class="selected-dates">
                    <p>Valitut päivämäärät: <?php echo htmlspecialchars($start_date); ?> - <?php echo htmlspecialchars($end_date); ?></p>
                </div>
            <?php endif; ?>

            <?php if ($error_message): ?>
                <div class="error-message"><?php echo $error_message; ?></div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Vapaiden huoneiden tulosten container -->
    <div class="content-section">
        <section class="available-rooms">
            <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($error_message)): ?>
                <h2 class="class-rooms-title">Vapaat luokat:</h2>

                <?php if (!empty($available_rooms)): ?>
                    <div class="rooms-list">
                        <?php foreach ($available_rooms as $room): ?>
                            <div class="room-item">
                                <h3><?php echo htmlspecialchars($room['HuoneNimi']); ?></h3>
                                <p><?php echo htmlspecialchars($room['Rakennus']); ?>, kerros <?php echo htmlspecialchars($room['Kerros']); ?></p>
                                <p>Huoneen numero: <?php echo intval(substr($room['HuoneNimi'], -2)); ?></p>
                                <p>Paikkoja: <?php echo htmlspecialchars($room['Paikat']); ?></p>

                                <!-- Nappi avaa modaalin -->
                                <button type="button" class="reserve-btn" data-bs-toggle="modal" data-bs-target="#reservationModal"
                                    data-room-id="<?php echo $room['HuoneID']; ?>"
                                    data-room-name="<?php echo htmlspecialchars($room['HuoneNimi']); ?>"
                                    data-start-date="<?php echo htmlspecialchars($start_date); ?>"
                                    data-end-date="<?php echo htmlspecialchars($end_date); ?>">
                                    Varaa
                                </button>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="no-rooms-message">Ei vapaita huoneita tällä aikavälillä.</div>
                <?php endif; ?>
            <?php endif; ?>
        </section>
    </div>
</div>

<!-- Varauksen vahvistusmodaali, avaa pop-up ikkunan kun käyttäjä painaa "Varaa" nappia -->
<div class="modal fade" id="reservationModal" tabindex="-1" aria-labelledby="reservationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="reservationModalLabel">Tarkasta varaus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <p>Olet varaamassa huonetta:</p>
                <p><strong>Huone:</strong> <span id="modal-room-name"></span></p>
                <p><strong>Aikaväli:</strong> <span id="modal-date-range"></span></p>

                <!-- Piilotetut kentät, jotka lähetetään palvelimelle -->
                <form id="reservationForm" action="submit_form.php" method="POST">
                    <input type="hidden" name="huone_id" id="modal-room-id">
                    <input type="hidden" name="alku" id="modal-start-date">
                    <input type="hidden" name="loppu" id="modal-end-date">
                    <input type="hidden" name="kayttaja_id" id="modal-user-id" value="<?php echo htmlspecialchars($_SESSION['KayttajaID']); ?>">
                    <input type="hidden" name="nimi" id="modal-user-name" value="<?php echo htmlspecialchars($_SESSION['Nimi']); ?>">
                </form>
            </div>

            <!-- Vahvista tai perruta varaus -->
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Peruuta</button>

                <button type="submit" form="reservationForm" class="btn btn-primary">Vahvista varaus</button>
            </div>
        </div>
    </div>
</div>

<!-- Ladataan main.js, joka sisältää nyt myös kalenterin toiminnallisuuden -->
<script src="../public/assets/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>