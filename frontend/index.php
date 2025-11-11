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

// Hae rakennukset tietokannasta dropdownia varten
$buildings_result = $conn->query("SELECT DISTINCT Rakennus FROM Huoneet ORDER BY Rakennus");
$buildings = [];
if ($buildings_result) {
    while ($row = $buildings_result->fetch_assoc()) {
        $buildings[] = $row['Rakennus'];
    }
}

// Käyttäjä valitsee päivämäärät ja rakennuksen jonka jälkeen haetaan vapaat huoneet näille päiville tietokannasta
$start_date = '';
$end_date = '';
$available_rooms = [];
$error_message = '';
$building = '';

// Nöytä vapaat huoneet, jos lomake on lähetetty
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['start_date']) && isset($_POST['end_date']) && isset($_POST['building'])) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];
    $building = $_POST['building'] ?? '';

    // Tarkistetaan, että päivämäärät ovat kelvollisia
    if ($start_date > $end_date) {
        $error_message = 'Tarkista valitut päivämäärät.';
    } elseif (empty($building)) {
        $error_message = 'Valitse rakennus.';
    } else {

        // Hae kaikki huoneet valitusta rakennuksesta
        $stmt_all_rooms = $conn->prepare("SELECT HuoneID, HuoneNimi, Rakennus, Kerros, Paikat FROM Huoneet WHERE Rakennus = ?");
        $stmt_all_rooms->bind_param("s", $building);

        $stmt_all_rooms->execute();
        $all_rooms_result = $stmt_all_rooms->get_result();
        $all_rooms = [];
        while ($row = $all_rooms_result->fetch_assoc()) {
            $all_rooms[$row['HuoneID']] = $row;
        }
        $stmt_all_rooms->close();

        // Hae varatut huoneet valitulta aikaväliltä ja rakennuksesta
        $stmt = $conn->prepare(
            "SELECT DISTINCT v.HuoneID FROM Varaukset v JOIN Huoneet h ON v.HuoneID = h.HuoneID WHERE v.VarausAlku <= ? AND v.VarausLoppu >= ? AND h.Rakennus = ?"
        );

        $stmt->bind_param("sss", $end_date, $start_date, $building);

        $stmt->execute();
        $result = $stmt->get_result();
        $booked_room_ids = [];
        while ($row = $result->fetch_assoc()) {
            $booked_room_ids[] = $row['HuoneID'];
        }
        $stmt->close();

        // Suodatetaan pois varatut huoneet `all_rooms`-taulukosta, joka on jo mahdollisesti suodatettu rakennuksen mukaan.
        $available_rooms = array_diff_key($all_rooms, array_flip($booked_room_ids));
    }
}
?>

<!-- Rakennuksen valitseminen -->

<!-- Lisätään flatpickr visuaalista kalenteria varten -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


<div class="hero-section"></div>
<div class="main-content">

    <!-- H1 otsikko -->
    <header class="header">
        <h1>Tervetuloa luokkavarauksiin, <?php echo htmlspecialchars($kayttaja); ?>!</h1>
        <p>Valitse haluamasi aikaväli ja varaa vapaa luokkahuone.</p>
    </header>

    <!-- Päivämäärän valinnainen container -->
    <div class="content-section">
        <div class="date-selection">

            <form action="index.php" method="post" class="date-form">
                <!-- Visuaalinen kalenteri msitä valitaan aikaväli varaukselle -->
                <div class="form-group">
                    <label for="date-range-picker">Valitse aikaväli</label>
                    <input type="text" id="date-range-picker" placeholder="Valitse päivämäärät...">
                </div>

                <!-- Piilotetut kentät, jotka lähetetään palvelimelle -->
                <input type="hidden" name="start_date" id="start_date" value="<?php echo htmlspecialchars($start_date); ?>">
                <input type="hidden" name="end_date" id="end_date" value="<?php echo htmlspecialchars($end_date); ?>">

                <!-- Rakennuksen valinta -->
                <div class="form-group">
                    <label for="building-select">Valitse rakennus</label>
                    <select class="building-label" name="building" id="building-select">
                        <option value="" disabled <?php if (empty($building)) echo 'selected'; ?>>Valitse rakennus</option>
                        <?php foreach ($buildings as $b): ?>
                            <option value="<?php echo htmlspecialchars($b); ?>" <?php if ($building == $b) echo 'selected'; ?>>
                                <?php echo htmlspecialchars($b); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!--  Hakee vapaat huoneet valitulle aikavälille-->
                <div class="form-group">
                    <button type="submit">Hae vapaat huoneet</button>
                </div>
            </form>

            <?php if ($error_message): ?>
                <div class="error-message"><?php echo $error_message; ?></div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Vapaiden huoneiden tulosten container -->
    <div class="content-section">
        <section class="available-rooms">
            <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($start_date) && !empty($end_date) && !empty($building) && empty($error_message)): ?>

                <!-- Näytä käyttäjälle valitut päivämäärät sekä rakennus -->
                <?php if ($start_date && $end_date): ?>
                    <div class="selected-dates">
                        <p>Vapaat luokat ajalle: <?php echo date("d.m.Y", strtotime($start_date)); ?> - <?php echo date("d.m.Y", strtotime($end_date)); ?></p>
                        <?php if ($building): ?>
                            <p>Rakennus: <?php echo htmlspecialchars($building); ?></p>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($available_rooms)): ?>
                    <div class="rooms-list">
                        <?php
                        $counter = 0;
                        foreach ($available_rooms as $room):
                            $isHidden = ($counter >= 6) ? 'room-hidden' : '';
                        ?>
                            <div class="room-item <?php echo $isHidden; ?>">

                            <!-- Rakennuksen/ huoneen tunnus -->
                                <div class="room-details">
                                    <h3><?php echo htmlspecialchars($room['HuoneNimi']); ?></h3>

                                    <!-- Rakennuksen kuva -->
                                    <div class="room-image">
                                        <img src="path/to/your/image.jpg" alt="Rakennuksen kuva"> <!-- Hae tietokannasta kyseisen rakennuksen kuva-->
                                    </div>

                                    <!-- Rakennuksen tiedot -->
                                    <p><?php echo htmlspecialchars($room['Rakennus']); ?>, kerros <?php echo htmlspecialchars($room['Kerros']); ?></p>
                                    <p>Huoneen numero: <?php echo intval(substr($room['HuoneNimi'], -2)); ?></p>
                                    <p>Paikkoja: <?php echo htmlspecialchars($room['Paikat']); ?></p>
                                </div>
                                <div class="room-footer">

                                    <!-- Nappi avaa modaalin -->
                                    <button type="button" class="reserve-btn" data-bs-toggle="modal" data-bs-target="#reservationModal"
                                        data-room-id="<?php echo $room['HuoneID']; ?>"
                                        data-room-name="<?php echo htmlspecialchars($room['HuoneNimi']); ?>"
                                        data-start-date="<?php echo htmlspecialchars($start_date); ?>"
                                        data-end-date="<?php echo htmlspecialchars($end_date); ?>">
                                        Varaa
                                    </button>
                                </div>
                            </div>
                        <?php
                            $counter++;
                        endforeach;
                        ?>
                    </div>
                    <?php if (count($available_rooms) > 6): ?>
                        <div class="show-more-container">
                            <button id="show-more-btn" class="btn btn-secondary">Näytä lisää</button>
                        </div>
                    <?php endif; ?>
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

            <!-- Modal header -->
            <div class="modal-header">
                <h5 class="modal-title" id="reservationModalLabel">Tarkasta varaus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal body -->
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

            <!-- Modal footer -->
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


<!-- https://code-it-write-it.hashnode.dev/integrate-bootstrap-modal-popup-form-and-submit-data-to-email-and-mysql-database-in-php-using-ajax
 MODAALIN dokumentit
 
 TODO Lisää tietokantaan luokkia ja index sivulle minkätyyppisen luokan käyttäjä haluaa valita. 
 Tee modalista tyylikäs ja lisää varausnappi index.php sivulle. Lisää myös varauksien hallintasivu frontend/reservations.php
 Tee grid itemeistä vähän isommat ja tyylikkäämmäät mihin mahtuu kuva luokasta reunaan ja lisää häivytykset kuvaan

 
 
 -->