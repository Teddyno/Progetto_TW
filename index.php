<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>HomePage - UniSA Gym</title>
    <link rel="stylesheet" type="text/css" href="stylesheet/style.css">
</head>
<body style="background-color:rgb(188, 200, 253);">
    <?php include 'header.html'; ?>
    <main>
        <br>
        <h1>I Nostri Vantaggi</h1>
        <br><br><br>
        <div class="container">
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
                <button class="bottone-info">Scopri di più</button>
            </div>
            <div class="card-info">
                <div class="dettagli-info">
                    <p class="titolo-info">Energia Rinnovabile</p>
                    <p class="descrizione-info">Lorem ipsum dolor sit amet</p>
                </div>
                <button class="bottone-info">Scopri di più</button>
            </div>
        </div>

        <br><br>
        <hr>
        <br>
        <h1>Il tuo Abbonamento</h1>
        <br><br><br>

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
        <div class="container-offerte">
            <div class="card-offerta">
                <div class="immagine-offerta">I</div>
                <div class="dettagli-offerta">
                    <p class="titolo-offerta">Piano Base</p><br>
                    <p class="prezzo-offerta">€19,90</p>
                    <p class="prezzo-vecchio-offerta"> $20,00</p>
                </div>
                <button class="bottone-offerta">ACQUISTA ORA</button>
            </div>

            <div class="card-offerta">
                <div class="immagine-offerta">II</div>
                <div class="dettagli-offerta">
                    <p class="titolo-offerta">Piano Medio</p><br>
                    <p class="prezzo-offerta">€29,90</p>
                    <p class="prezzo-vecchio-offerta"> $32,00</p>
                </div>
                <button class="bottone-offerta">ACQUISTA ORA</button>
            </div>

            <div class="card-offerta">
                <div class="immagine-offerta">III</div>
                <div class="dettagli-offerta">
                    <p class="titolo-offerta">Piano Pro</p><br>
                    <p class="prezzo-offerta">€49,90</p>
                    <p class="prezzo-vecchio-offerta"> $60,00</p>
                </div>
                <button class="bottone-offerta">ACQUISTA ORA</button>
            </div>

        </div>
    </main>
    <?php include 'footer.html'; ?>
</body>
</html>