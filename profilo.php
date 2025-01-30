<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styleSheet/style.css">
    <title>Profilo</title>
</head>
<body>
    <?php include 'header.html'; ?>

    <header class="indice">
        <a href="#section1">Dati Personali</a>
        <a href="#section2">abbonamento</a>
        <a href="#section3">Sicurezza</a>
        <a href="#section4">Log out</a>
    </header>

    <section class="section-profilo" id="section1">
        <div class="dettagli-info">
            <p class="titolo-info">Dati Personali</p>
            <p>Contenuto della sezione 1.</p>
        </div>
    </section>
    <section class="section-profilo" id="section2">
        <div class="dettagli-info">
            <p class="titolo-info">abbonamento</p>
            <p>Contenuto della sezione 2.</p>
        </div>
    </section>
    <section class="section-profilo" id="section3">
        <div class="dettagli-info">
            <p class="titolo-info">Sicurezza</p>
            <p>Contenuto della sezione 3.</p>
        </div>
    </section>
    <section class="section-profilo" id="section4">
        <div class="dettagli-info">
            <p class="titolo-info">Log out</p>
            <p><button>Log out</button></p>
        </div>
    </section>
    <script src="js/indiceDinamico.js"></script>
    
    <?php include 'footer.html'; ?>
</body>
</html>