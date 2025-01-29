<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>HomePage - UniSA Gym</title>
    <link rel="stylesheet" type="text/css" href="styleSheet/style.css">
</head>
<body style="background-color: #2a2a32;">
    <?php include 'header.html'; ?>
    <main>
        <br>
        <h1>I Nostri Vantaggi</h1>
        <br><br><br>
        <div class="container">
            <div class="card">
                <div class="dettagli-card">
                    <p class="titolo-card">Aperti 24h su 24</p>
                    <p class="descrizione-card">Lorem ipsum dolor sit amet</p>
                </div>
                <button class="bottone-card">Scopri di più</button>
            </div>
            <div class="card">
                <div class="dettagli-card">
                    <p class="titolo-card">Personale Qualificato</p>
                    <p class="descrizione-card">Lorem ipsum dolor sit amet</p>
                </div>
                <button class="bottone-card">Scopri di più</button>
            </div>
            <div class="card">
                <div class="dettagli-card">
                    <p class="titolo-card">Teddy Nudo</p>
                    <p class="descrizione-card">Lorem ipsum dolor sit amet</p>
                </div>
                <button class="bottone-card">Scopri di più</button>
            </div>
        </div>

        <br><br>
        <hr>
        <br>
        <h1>Il tuo Abbonamento</h1>
        <br><br><br>
        <!-- <div class="container">
            <div class="card">Abbonamento Base</div>
            <div class="card">Abbonamento Premium</div>
            <div class="card">Abbonamento Gold</div> -->

        <div class="container-barra">
            <div class="barra-progressiva" id="barra-progressiva"></div>
        </div>
        <p id="testo-barra"></p>
        <script src="js/barraProgressiva.js"></script>
        <br><br>
        <hr>
        <br>
        <h1>Le Nostre Offerte</h1>
        <br><br><br>
        <div class="container">
            <div class="card">Aperti 24h su 24</div>
            <div class="card">Personale qualificato</div>
            <div class="card">Teddy Nudo</div>
        </div>
        
    </main>
    <?php // include 'footer.html'; ?>
</body>
</html>