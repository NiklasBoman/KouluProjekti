<?php
include 'admin_check.php'; // Varmistaa, että käyttäjä on admin
include '../includes/db_connect.php';

// Otetaan mukaan frontendin header, jotta ulkoasu on yhtenäinen, tehdään pieniä muutoksia
include "includes/header_admin.php";

// Haetaan kaikki käyttäjät dropdown-valikkoa varten
$users_result = $conn->query("SELECT KayttajaID, Nimi FROM Kayttajat ORDER BY Nimi ASC");
$users = [];
while ($row = $users_result->fetch_assoc()) {
    $users[] = $row;
}

// Haetaan kaikki varaukset kalenteria varten JSON-muodossa
$all_reservations_result = $conn->query(
    "SELECT h.HuoneNimi, v.VarausAlku, v.VarausLoppu, k.Nimi AS KayttajanNimi
     FROM Varaukset v 
     JOIN Huoneet h ON v.HuoneID = h.HuoneID
     JOIN Kayttajat k ON v.KayttajaID = k.KayttajaID"
);
$calendar_events = [];
while ($row = $all_reservations_result->fetch_assoc()) {

    // Yhdistetään huoneen nimi ja varaajan nimi otsikoksi
    $event_title = $row['HuoneNimi'] . ' (' . htmlspecialchars($row['KayttajanNimi']) . ')';
    $calendar_events[] = [
        'title' => $event_title,
        'start' => $row['VarausAlku'],
        'end' => date('Y-m-d', strtotime($row['VarausLoppu'] . ' +1 day')), // FullCalendar vaatii loppupäivän olevan +1
        'backgroundColor' => '#d9534f', 
        'borderColor' => '#d43f3a'
    ];
}
$events_json = json_encode($calendar_events);

// Tarkistetaan, onko jokin käyttäjä valittu ja näytetään sen varaukset
$selected_user_id = filter_input(INPUT_GET, 'user_id', FILTER_VALIDATE_INT);
$user_reservations = [];
if ($selected_user_id) {
    $stmt = $conn->prepare(
        "SELECT v.VarausID, h.HuoneNimi, h.Rakennus, v.VarausAlku, v.VarausLoppu, h.KuvaURL
         FROM Varaukset v
         JOIN Huoneet h ON v.HuoneID = h.HuoneID
         WHERE v.KayttajaID = ?
         ORDER BY v.VarausAlku DESC"
    );
    $stmt->bind_param("i", $selected_user_id);
    $stmt->execute();
    $user_reservations_result = $stmt->get_result();
    while ($row = $user_reservations_result->fetch_assoc()) {
        $user_reservations[] = $row;
    }
    $stmt->close();
}
?>

<!-- FullCalendar-kirjaston linkit -->
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>

<div class="main-content">
    <!-- Toast-ilmoituksen container -->
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1100">
        <?php if (isset($_SESSION['success_message'])): ?>
            <div id="notificationToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <?php 
                            echo htmlspecialchars($_SESSION['success_message']); 
                            unset($_SESSION['success_message']);
                        ?>
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
            </div>
        <?php elseif (isset($_SESSION['error_message'])): ?>
            <!-- Voit lisätä virheviestin käsittelyn samalla tavalla -->
        <?php endif; ?>
    </div>

    <header class="header">
        <h1>Admin-paneeli</h1>
        <p>Täällä voit hallinnoida varauksia ja tarkastella käyttäjien tekemiä varauksia.</p>
    </header>

    <!-- Kalenteri -->
    <div class="content-section">
        <h2>Varauskalenteri</h2>
        <div id='calendar'></div>
    </div>

    <!-- Käyttäjän valinta ja varausten näyttö -->
    <div class="content-section">
        <h2>Tarkastele käyttäjän varauksia</h2>
        <form action="index.php" method="GET" class="date-form" style="justify-content: flex-start;">
            <div class="form-group">
                <label for="user-select">Valitse käyttäjä:</label>
                <select name="user_id" id="user-select" class="building-label" onchange="this.form.submit()">
                    <option value="">-- Kaikki käyttäjät --</option>
                    <?php foreach ($users as $user): ?>
                        <option value="<?php echo $user['KayttajaID']; ?>" <?php if ($selected_user_id == $user['KayttajaID']) echo 'selected'; ?>>
                            <?php echo htmlspecialchars($user['Nimi']); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </form>

        <?php if ($selected_user_id && !empty($user_reservations)): ?>
            <h3 style="margin-top: 2rem;">Käyttäjän varaukset</h3>
            <div class="rooms-list">
                <?php foreach ($user_reservations as $reservation): ?>
                    <div class="room-item">
                        <!-- Kuva, kuten frontend/index.php:ssä -->
                        <div class="room-image">
                            <?php 
                                // Käytetään huoneen omaa kuvaa tai placeholder-kuvaa
                                $image_url = !empty($reservation['KuvaURL']) ? htmlspecialchars($reservation['KuvaURL']) : '../public/assets/images/room_placeholder.jpg';
                            ?>
                            <img src="<?php echo $image_url; ?>" alt="Kuva huoneesta <?php echo htmlspecialchars($reservation['HuoneNimi']); ?>">
                        </div>
                        <div class="room-content">
                            <div class="room-header">
                                <h3><?php echo htmlspecialchars($reservation['HuoneNimi']); ?></h3>
                                <p class="room-location"><?php echo htmlspecialchars($reservation['Rakennus']); ?></p>
                            </div>
                            <div class="room-info">
                                <?php
                                    $alku = new DateTime($reservation['VarausAlku']);
                                    $loppu = new DateTime($reservation['VarausLoppu']);
                                    $date_range_formatted = $alku->format('d.m.Y') . ' - ' . $loppu->format('d.m.Y');
                                ?>
                                <span><strong>Varattu:</strong> <?php echo $date_range_formatted; ?></span>
                            </div>
                            <!-- Nappi, joka avaa poiston vahvistusmodaalin -->
                            <button type="button" class="btn btn-danger delete-btn" data-bs-toggle="modal" data-bs-target="#deleteReservationModal"
                                data-reservation-id="<?php echo $reservation['VarausID']; ?>"
                                data-room-name="<?php echo htmlspecialchars($reservation['HuoneNimi']); ?>"
                                data-date-range="<?php echo $date_range_formatted; ?>">
                                Poista varaus
                            </button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php elseif ($selected_user_id): ?>
            <p style="margin-top: 1rem;">Tällä käyttäjällä ei ole varauksia.</p>
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
                <form id="deleteReservationForm" action="delete_reservation_admin.php" method="POST">
                    <input type="hidden" name="reservation_id" id="modal-delete-reservation-id">
                    <input type="hidden" name="user_id_return" value="<?php echo htmlspecialchars($selected_user_id ?? ''); ?>">
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'fi', // Asetetaan kieleksi suomi
        events: <?php echo $events_json; ?>,
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek'
        }
    });
    calendar.render();
});
</script>

<!-- Ladataan skriptit -->
<script src="../public/assets/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>