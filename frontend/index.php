<?php
session_start();
include '../sql/db.php'; // Korjattu tietokantayhteyden polku, vaihda tarvittaessa koulun palvelimelle
include "../includes/header_footer/header_frontend.php";

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

// Käsitellään lomakkeen lähetys
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


<div class="main-content">
    <!-- H1 otsikko -->
    <header class="header">
        <h1>Tervetuloa luokkavarauksiin, <?php echo htmlspecialchars($kayttaja); ?>!</h1>
        <p>Valitse haluamasi aikaväli ja varaa vapaa luokkahuone.</p>
    </header>

    <!-- Valitut päivämäärät -->
    <div class="date-selection">
        <form action="index.php" method="post" class="date-form">
            <div class="form-group">
                <label for="start_date">Alkupäivämäärä:</label>
                <input type="date" name="start_date" id="start_date" required value="<?php echo htmlspecialchars($start_date); ?>">
            </div>
            <div class="form-group">
                <label for="end_date">Loppupäivämäärä:</label>
                <input type="date" name="end_date" id="end_date" required value="<?php echo htmlspecialchars($end_date); ?>">
            </div>
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

    <!-- Vapaiden huoneiden tulokset -->
    <section class="available-rooms">
        <?php if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($error_message)): ?>
            <h2>Vapaat luokat:</h2>
            
            <?php if (!empty($available_rooms)): ?>
                <div class="rooms-list">
                    <?php foreach ($available_rooms as $room): ?>
                        <div class="room-item">
                            <h3><?php echo htmlspecialchars($room['HuoneNimi']); ?></h3>
                            <p><?php echo htmlspecialchars($room['Rakennus']); ?>, kerros <?php echo htmlspecialchars($room['Kerros']); ?></p>
                            <p>Huoneen numero: <?php echo intval(substr($room['HuoneNimi'], -2)); ?></p>
                            <p>Paikkoja: <?php echo htmlspecialchars($room['Paikat']); ?></p>
                            <a href="reserve.php?huone_id=<?php echo $room['HuoneID']; ?>&alku=<?php echo $start_date; ?>&loppu=<?php echo $end_date; ?>" class="reserve-btn">Varaa</a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="no-rooms-message">Ei vapaita huoneita tällä aikavälillä.</div>
            <?php endif; ?>
        <?php endif; ?>
    </section>
</div>

<script src="../assets/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
