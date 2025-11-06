<!-- Kirjautumissivu mikä hashaa salasanan + mut taristukset -->
<!doctype html>
<html>
<head>
<title>login</title>
<link rel="stylesheet" href="logintyyli.css">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>
<h1>Kirjautuminen</h1>
<div class="container">
<form action="" method="post">
    <label>Nimi</label>
    <br>
    <input type="text" name="nimi" id="nimi">
    <br>
    <label>Sähköposti</label>
    <br>
    <input type="email" name="gmail" id="gmail">
    <br>
    <label>Puhelinnumero</label>
    <br>
    <input type="number" name="puh" id="puh">
    <br>
    <label>Salasana</label>
    <br>
    <input type="password" name="salasana" id="salasana">
    <br>
    <br>
    <button type="submit">Kirjaudu</button>
<br> <br>
<a href="register.html">
    <button type="button">Rekisteröidy</button>
</a>
</form>
</div>
</body>
</html>
