|<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="stylesheet/style.css">
    <link rel="stylesheet" type="text/css" href="stylesheet/chiSiamo.css">
    <title>UnisaGym</title>
</head>
<body>
    <?php include 'header.php'; ?>
    
    <main>
        <br>

        <br><br><br>
        <section class="container-intro">
            <div class="container_text">
                <h1>Perchè sceglierci?</h1>
                <p>UnisaGym ti offre servizi h24 con la possibilità di scegliere il proprio personal trainer adatto alle vostre esigenze.</p> 
                <p>Le strutture sono certificate e all'avanguardia per permettervi la miglior attività fisica possibile, quando volete e come volete.</p> 
                <p>Vi aspettiamo nelle nostre 3 sedi: Nocera Superiore, Angri e Fisciano con possibilità di agevolazione sul primo acquisto di un corso.</p>
                <p>AFFRETTATEVI!</p>
            </div>

            <div class="container-immagine">
                <div class="immagine-int">
                    <img src="images/PalestraInterno" alt="Foto Palestra Interno">
                </div>
            </div>
        </section>

        <section class="container-intro-2">
            <div class="container-immagine-2">
                <div class="immagine-int-2">
                    <img src=".jpg" alt="Foto Palestra Interno 2">
                </div>
            </div>

            <div class="container-text-2">
                <div class="feature">
                    <img src="images/check-icon" alt="Spunta Verde" class="check-icon">
                    <div class="text">
                        <h2>ABBONAMENTI A PARTIRE DA 9,99€!</h2>
                        <p>Crea il tuo percorso di fitness su misura, scegliendo ciò che fa davvero per te!</p>
                    </div>
                </div>

                <div class="feature">
                    <img src="images/check-icon" alt="Spunta Verde" class="check-icon">
                    <div class="text">
                        <h2>APERTI TUTTO L'ANNO</h2>
                        <p>Allenati quando preferisci: dal lunedì alla domenica, festivi inclusi</p>
                    </div>
                </div>

                <div class="feature">
                    <img src="images/check-icon" alt="Spunta Verde" class="check-icon">
                    <div class="text">
                        <h2>INGRESSO SENZA LIMITI DI ORARIO</h2>
                        <p>Per te che ami la flessibilità, UnisaGym è aperta sempre mattina, pomeriggio o sera</p>
                    </div>
                </div>
            </div>
        
        <section class="container">
            <div class="slideshow-container">
                <div class="freccia freccia-sinistra" onclick="cambiaSlide(-1)">&#10094;</div>

                <div class="slideshow">
                    <div class="slide"><img src=""></div>
                    <div class="slide"><img src=""></div>
                    <div class="slide"><img src=""></div>
                </div>

                <div class="freccia freccia-destra" onclick="cambiaSlide(1)">&#10095;</div>

                <div class="container-punti">
                    <span class="punto" onclick="slideAttiva(0)"></span>
                    <span class="punto" onclick="slideAttiva(0)"></span>
                    <span class="punto" onclick="slideAttiva(0)"></span>
                </div>
            </div>
        </section>

            <div class="branches">
                <div class="branch">
                    <h3>Nocera Superiore</h3>
                    <p><strong>Numero Telefonico</strong><br>333123123123</p>
                    <p><strong>Indirizzo</strong><br>Via Lorem Ipsum 123</p>
                </div>
                <div class="branch">
                    <h3>Angri</h3>
                    <p><strong>Numero Telefonico</strong><br>33333333333</p>
                    <p><strong>Indirizzo</strong><br>Via Nazionale 174</p>
                </div>
                <div class="branch">
                    <h3>Fisciano</h3>
                    <p><strong>Numero Telefonico</strong><br>3334343434</p>
                    <p><strong>Indirizzo</strong><br>Via Lorem Ipsum 174</p>
                </div>
            </div>
        </section>
        <script src="js/slideShowIndex.js"></script>
        <script src="js/header.js"></script>
    </main>
    <?php include 'footer.html'; ?>
</body>