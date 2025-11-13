# 🏫 Luokkavarausjärjestelmä

Tämä projekti on PHP- ja MySQL-pohjainen luokkavarausjärjestelmä, jonka avulla käyttäjät voivat kirjautua sisään, tarkastella vapaita luokkahuoneita ja tehdä varauksia haluamalleen päivämäärälle.  
Admin-paneelin kautta ylläpitäjä voi hallita käyttäjiä ja varauksia helposti.

---

## ✨ Ominaisuudet
- 🔐 Käyttäjän rekisteröinti ja kirjautuminen  
- 🗓️ Luokkahuoneiden haku ja varaaminen  
- 📋 Varausten hallinta  
- ⚙️ Admin-paneeli ylläpitäjälle  

---

## 🛠️ Käytetyt teknologiat
- **PHP** (backend)
- **MySQL** (tietokanta)
- **HTML, CSS, JavaScript** (frontend)
- **XAMPP** (kehitysympäristö)

---

## 🚀 Asennusohjeet
1. Kloonaa repository:
   ```bash
   git clone https://github.com/NiklasBoman/KouluProjekti.git

## Siirry projekti kansioon
2. cd KouluProjekti

3. Lataa tarvittavat riippuvuudet ja varmista, että sinulla on XAMPP tai muu PHP-palvelin käynnissä.

4. Luo tietokanta MySQL:ssä ja tuo tietokannan rakenne:

5. Luo tietokanta nimeltä luokkavarausjärjestelma (tai haluamasi nimi).

6. Käytä mukana olevaa SQL-tiedostoa tietokannan luomiseksi.

7. Kopioi .env.example tiedosto ja nimeä se .env:
Määrittele .env tiedostoon arkaluonteiset asiat kuten tietokantayhteys asetukset sekä API -avaimet

---

🏞️ Pexels API - Integraatio

Projektissa käytetään Pexels API:a luokkahuonekuvien hakemiseen ja tallentamiseen tietokantaan. API-hakujen suorittaminen edellyttää API-avaimen lisäämistä ja konfigurointia.

1. Pexels API -avain

Hanki Pexels API -avain Pexelsin verkkosivuilta

2. Lisää omaan .env tiedostoon API -avain 

PEXELS_API_KEY=oma-api-avain

---

## Kuinka suorittaa skripti, joka hakee kuvat

Skripti, joka hakee luokkahuoneiden kuvia Pexelsista, on fetch.php-tiedostossa. Voit suorittaa skriptin avaamalla seuraavan URL-osoitteen selaimessa: http://localhost/OMA_TIEDOSTO_POLKU/includes/fetch.php

## Muutokset .htaccess-tiedostoon ennen skriptin suorittamista

Huom! Muista poistaa seuraava osio .htaccess-tiedostosta väliaikaisesti, jotta voit suorittaa skriptin:

<IfModule mod_rewrite.c>
    RewriteEngine On
    RewriteRule ^(includes|sql|vendor|config|\.env).* - [F,L]
</IfModule>

---


# Tietokannan asetukset

.env-tiedostossa määritellään myös tietokannan asetukset. Muokkaa tiedostoa ja lisää omat tietokannan yhteystietosi seuraavasti:

DB_HOST=localhost
DB_NAME=kouludatabase
DB_USER=root
DB_PASS=salasana

# Sovelluksen asetukset
APP_ENV=development
APP_DEBUG=true # vaihda false jos et halua debug-tilaa

# API -avain
PEXELS_API_KEY=Liitä tähän oma API -avaimesi

👥 Tekijät

1. Niklas Monkkonen https://github.com/NiklasMonkkonen
2. Niklas Boman https://github.com/NiklasBoman
3. Santtu Kumpulainen https://github.com/sgee-del
