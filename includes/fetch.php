<!--  Tiedosto hakee kuvat pexelistä api-avaimen avulla -->
  <?php
// Haetaan db_connect.php ja config.php
require_once __DIR__ . '/../includes/db_connect.php';
require_once __DIR__ . '/../includes/config.php';

// Funktio Pexelsin kuvien hakemiseen
function haePexelsKuvat($haku, $maara) {
    // Haetaan satainen sivu, jotta saadaan eri kuvia joka kerta
    $sivu = rand(1, 20); 
    $pexelsApiUrl = "https://api.pexels.com/v1/search?query=" . urlencode($haku) . "&per_page=" . $maara . "&page=" . $sivu;

    // cURL-pyyntö API:in
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $pexelsApiUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: ' . $_ENV['PEXELS_API_KEY']
    ));
    $response = curl_exec($ch);
    if (!$response) {
        die("API-pyyntö epäonnistui: " . curl_error($ch));
    }
    curl_close($ch);

    $data = json_decode($response, true);

    // Palautetaan vain kuvien URL-osoitteet taulukkona
    if (isset($data['photos']) && !empty($data['photos'])) {
        return array_column($data['photos'], 'src');
    }
    return null;
}

// Hae kaikki huoneet tietokannasta
$result = $conn->query("SELECT HuoneID FROM huoneet");
$huoneet = $result->fetch_all(MYSQLI_ASSOC);

if (empty($huoneet)) {
    die("Tietokannasta ei löytynyt huoneita päivitettäväksi.");
}

// Hae Pexelsistä kuvia (haetaan vähän enemmän kuin on huoneita, max 80 per sivu)
$kuvienMaara = min(count($huoneet), 80);
$kuvat = haePexelsKuvat('modern classroom', $kuvienMaara);

if ($kuvat) {
    echo "Haettu " . count($kuvat) . " kuvaa Pexelsistä. Aloitetaan huoneiden päivitys...<br>";

    // Valmistellaan päivityslauseke
    $stmt = $conn->prepare("UPDATE huoneet SET KuvaURL = ? WHERE HuoneID = ?");
    $kuvaUrl = '';
    $huoneId = 0;
    $stmt->bind_param('si', $kuvaUrl, $huoneId);

    $paivitetytHuoneet = 0;

    // 3. Käy läpi jokainen huone ja päivitä sille kuva
    foreach ($huoneet as $index => $huone) {
        $huoneId = $huone['HuoneID'];
        // Käytetään modulo-operaattoria, jotta kuvat kiertävät, jos huoneita on enemmän kuin kuvia
        $kuvaData = $kuvat[$index % count($kuvat)];
        $kuvaUrl = $kuvaData['large2x']; // Käytetään laadukasta, mutta ei valtavaa kuvaa

        if ($stmt->execute()) {
            $paivitetytHuoneet++;
        }
    }
    echo "Päivitys valmis! {$paivitetytHuoneet} huonetta päivitettiin uusilla kuvilla.";
} else {
    echo "Pexelsistä ei löytynyt kuvia haulla 'modern classroom'.";
}
