<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>UniSA Gym - HomePage</title>
    <link rel="stylesheet" type="text/css" href="styleSheet/style.css">
</head>
<body style="background-color:rgb(238, 238, 238);">
    <?php include 'header.php'; ?>
    <main>
        <br>

        <br><br><br>
        <div class="container-pieno">
    <div class="container-slideshow">
        <div class="freccia freccia-sinistra" onclick="cambiaSlide(-1)">&#10094;</div>

        <div class="slideshow">
            <div class="slide"><img src="images/interno_palestra_1.jpg"></div>
            <div class="slide"><img src="images/pt_2.jpeg"></div>
            <div class="slide"><img src="images/interno_palestra_2.jpg"></div>
        </div>

        <div class="freccia freccia-destra" onclick="cambiaSlide(1)">&#10095;</div>

        <div class="container-punti">
            <span class="punto" onclick="slideAttiva(0)"></span>
            <span class="punto" onclick="slideAttiva(1)"></span>
            <span class="punto" onclick="slideAttiva(2)"></span>
        </div>
    </div>
</div>

        <br><br>

        <div class="container-a-meta">

            <div class="container-cta">
                <h1>Benvenuto in UniSA Gym</h1>
                <p class="domandona" id="domanda">Ti sei allenato oggi?</p>
                <div class="bottoni">
                    <button onclick="rispondiAllenamento(true)">Sì 💪</button>
                    <button onclick="rispondiAllenamento(false)">No 😅</button>
                </div>
                <p id="messaggio-risposta" class="messaggio"></p>
            </div>

            <div class="container-abbonamento">
                <h1>Il tuo Abbonamento</h1>
                <div class="container-barra">
                    <div class="barra-progressiva" id="barra-progressiva"></div>
                </div>
                <p id="testo-barra"></p>
            </div>
        </div>

        <br><br>

        <div class="container-offerte">
            <h1>Le Nostre Offerte</h1>
            <div class="container-offerte-card">
                <a class="offerta-card" id="codice-sconto">
                    <p>🐚 NUOVO CODICE SCONTO!</p>
                    <p class="descrizione-offerta">Usa il codice "PAGURO2024" per ottenere il 10% di sconto sul tuo prossimo abbonamento</p>
                    <p class="descrizione-offerta">Clicca per COPIARE il codice</p>
                    <div class="angolo">
                        <div class="freccia-offerta">→</div>
                    </div>
                </a>

                <a class="offerta-card" href="abbonamento.php#sezione-abbonamento">
                    <p>💰 SCONTO DEL 20%!</p>
                    <p class="descrizione-offerta">Ottieni il 20% di sconto sull'abbonamento da 12 mesi</p>
                    <p class="descrizione-offerta">Affrettati, scade tra 2 giorni!</p>
                    <div class="angolo">
                        <div class="freccia-offerta">→</div>
                    </div>
                </a>
            </div>
        </div>
        <script src="js/barraProgressiva.js"></script>
        <script src="js/copiaCodiceSconto.js"></script>
        <script src="js/slideShowIndex.js"></script>
        <script src="js/header.js"></script>
        <script src="js/rispondiAllenamento.js"></script>
    </main>
    <?php include 'footer.html'; ?>
</body>
</html>