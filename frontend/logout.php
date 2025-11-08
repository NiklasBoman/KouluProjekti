<?php
// Aloitetaan sessio, jotta voidaan käsitellä sessiomuuttujia.
session_start();

// Tyhjennetään kaikki sessiomuuttujat.
$_SESSION = array();

// Tuhotaan sessio.
session_destroy();

// Ohjataan käyttäjä takaisin kirjautumissivulle.
header("Location: login.php");
exit;