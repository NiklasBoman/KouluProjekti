<!-- Näyttää kalenterin mistä valita halutut päviät ja näyttää vapaana olevat luokat valituille päiville -->
<?php
session_start();
include '../sql/db.php'; // Korjattu tietokantayhteyden polku
include "../includes/header_footer/header_frontend.php";

// Jos käyttäjä ei ole kirjautunut sisään, ohjataan kirjautumissivulle
/*if (!isset($_SESSION['Nimi']) || empty($_SESSION['Nimi'])) {
    header('Location: login.php');
    exit;
}*/

// Käyttäjä valitsee päivämäärät ja haetaan vapaat huoneet kyseisille päiville
$start_date = '';
$end_date = '';
$available_rooms = [];

// Käsitellään lomakkeen lähetys
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['start_date']) && isset($_POST['end_date'])) {
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Hae kaikki huoneet
    $all_rooms_result = $conn->query("SELECT HuoneID, HuoneNimi, Rakennus, Kerros, Paikat FROM Huoneet");
    $all_rooms = [];
    while ($row = $all_rooms_result->fetch_assoc()) {
        $all_rooms[$row['HuoneID']] = $row;
    }

    // Hae varatut huoneet valitulle päivälle
    // Haetaan kaikki huoneet, joilla on vähintään yksi varaus valitulla aikavälillä.
    $stmt = $conn->prepare("SELECT DISTINCT HuoneID FROM Varaukset WHERE VarattuAika BETWEEN ? AND ?");
    $stmt->bind_param("ss", $start_date, $end_date);
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
?>



<body>

    <!-- Sticky Navbar, ei tarvitse olal sticky riippu sivun rakenteesta -->
    <nav class="navbar">

        <!-- Vasen osuus, profiilikuva ja teksti -->
        <div class="nav-left">

            <!-- TODO hae käyttäjän kuva tietokannastaja aseta placeholderkuva -->
            <img src="../includes/images/profile_placeholder.svg" alt="kuva" class="profile-pic">

            <!-- Näyttää kirajutuneen käyttäjän nimen ja kuvan vasemmassa kulmassa navbaria-->
            <span class="user-name">Hei, <?php echo isset($_SESSION['Nimi']) ? htmlspecialchars($_SESSION['Nimi']) : 'Käyttäjä'; ?>!</span>
        </div>

        <!-- Navbarin itemit -->
        <div class="nav-right">
            <a href="#" class="nav-link">Luokat</a>
            <a href="#" class="nav-link">Varaukset</a>

            <!-- TODO tee oma sivu profiilin asetuksille -->
            <a href="settings.php" class="nav-link">Asetukset</a>
        </div>
    </nav>



    <div class="container py-5">

        <!-- Tervetuloa otsikko -->
        <header class="mb-4">
            <h1 class="text-center">Tervetuloa luokkavarauksien järjestelmään!</h1>
            <p class="text-center">Varaa luokkahuone ja hallinoi varauksiasi sivulla.</p>
        </header>


    </div>








    <!-- Pääsisältö -->
    <main class="content">
        <section id="rooms">
            <h1>Varaa luokkahuone</h1>
            <p>Valitse päivämäärä nähdäksesi vapaat huoneet.</p>
            
            <!-- Päivämäärän valintalomake -->
            <form action="index.php#rooms" method="post" class="date-picker-form">
                <div class="date-range-picker">
                    <div>
                        <label for="start_date">Alkupäivämäärä:</label>
                        <input type="date" id="start_date" name="start_date" value="<?php echo htmlspecialchars($start_date); ?>" required>
                    </div>
                    <div>
                        <label for="end_date">Loppupäivämäärä:</label>
                        <input type="date" id="end_date" name="end_date" value="<?php echo htmlspecialchars($end_date); ?>" required>
                    </div>
                </div>
                <button type="submit">Hae vapaita huoneita</button>
            </form>

            <div id="roomsGrid" class="rooms-grid" aria-live="polite">
                <?php if ($_SERVER['REQUEST_METHOD'] === 'POST'): ?>
                    <?php if (!empty($available_rooms)): ?>
                        <h3 class="mt-4">Vapaat huoneet aikavälille <?php echo htmlspecialchars($start_date); ?> - <?php echo htmlspecialchars($end_date); ?>:</h3>
                        <?php foreach ($available_rooms as $room): ?>
                            <div class="room-card">
                                <h4><?php echo htmlspecialchars($room['HuoneNimi']); ?></h4>
                                <p><strong>Rakennus:</strong> <?php echo htmlspecialchars($room['Rakennus']); ?></p>
                                <p><strong>Kerros:</strong> <?php echo htmlspecialchars($room['Kerros']); ?></p>
                                <p><strong>Paikkoja:</strong> <?php echo htmlspecialchars($room['Paikat']); ?></p>
                                <!-- Varausnappi voidaan lisätä tänne. Huom! paiva-parametri on nyt aikaväli -->
                                <a href="reserve.php?huone_id=<?php echo $room['HuoneID']; ?>&alku=<?php echo $start_date; ?>&loppu=<?php echo $end_date; ?>" class="btn btn-primary">Varaa</a>
                            </div>
                        <?php endforeach; ?>
                    <?php elseif(!empty($start_date)): ?>
                        <p class="mt-4">Ei vapaita huoneita valitulla aikavälillä (<?php echo htmlspecialchars($start_date); ?> - <?php echo htmlspecialchars($end_date); ?>).</p>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </section>

        <section id="reservations">
            <h2>Omat varaukset</h2>
            <!-- Käyttäjän varaukset -->
        </section>

        <section id="settings">
            <h2>Asetukset</h2>
            <!-- Käyttäjäasetukset -->
        </section>
    </main>

    <script src="../assets/js/main.js"></script>
</body>

</html>