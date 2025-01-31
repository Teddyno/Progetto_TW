<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>HomePage - UniSA Gym</title>
    <link rel="stylesheet" type="text/css" href="stylesheet/style.css">
</head>
<body style="background-color:rgb(238, 238, 238);">
    <?php include 'header.html'; ?>
    <main>
        <br>

        <br><br><br>
        <div class="container-vantaggi">
        <h1>I Nostri Vantaggi</h1>
            <div class="container-info">
                <div class="card-info">
                    <div class="dettagli-info">
                        <p class="titolo-info">Aperti 24h su 24</p>
                        <p class="descrizione-info">Lorem ipsum dolor sit amet</p>
                    </div>
                    <button class="bottone-info">Scopri di più</button>
                </div>
                <div class="card-info">
                    <div class="dettagli-info">
                        <p class="titolo-info">Personale Qualificato</p>
                        <p class="descrizione-info">Lorem ipsum dolor sit amet</p>
                    </div>
                    <a href="abbonamento.php#sezione-trainer"><button class="bottone-info">Scopri di più</button></a>
                </div>
                <div class="card-info">
                    <div class="dettagli-info">
                        <p class="titolo-info">Energia Rinnovabile</p>
                        <p class="descrizione-info">Lorem ipsum dolor sit amet</p>
                    </div>
                    <button class="bottone-info">Scopri di più</button>
                </div>
            </div>
        </div>

        <br><br>
        <br>

        <div class="container-abbonamento">
            <h1>Il tuo Abbonamento</h1>
            <br><br><br>

            <div class="container-barra">
                <div class="barra-progressiva" id="barra-progressiva"></div>
            </div>
            <p id="testo-barra"></p>
            <script src="js/barraProgressiva.js"></script>
            
        </div>

        <br><br>
        <br>
        <br><br><br>

        <div class="container-offerte">
            <h1>Le Nostre Offerte</h1>
            <div class="container-offerte-card">
                <div class="offerta-card">
                    <p>🐚 NUOVO CODICE SCONTO!</p>
                    <p class="descrizione-offerta">Usa il codice "PAGURO" per ottenere il 10% di sconto sul tuo prossimo abbonamento</p>
                    <p class="descrizione-offerta">Clicca qui per COPIARE il codice</p>
                    <div class="angolo">
                        <div class="freccia">→</div>
                    </div>
                </div>

                <div class="offerta-card">
                    <p>💰 SCONTO DEL 20%!</p>
                    <p class="descrizione-offerta">Ottieni il 20% di sconto sull'abbonamento da 12 mesi</p>
                    <p class="descrizione-offerta">Affrettati, scade tra 2 giorni!</p>
                    <div class="angolo">
                        <div class="freccia">→</div>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <?php include 'footer.html'; ?>
</body>
</html>