|<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="stylesheet/style.css?ts=<?=time()?>&quot">
    <link rel="stylesheet" type="text/css" href="stylesheet/chiSiamo.css?ts=<?=time()?>&quot">
    <title>UnisaGym</title>
</head>
<body>
    <?php include 'header.php'; ?>
    
    <main>
        <br><br><br>
        <div class="container-title">
            <div class="title">
                <h4>BENVENUTI IN <span class="highlight">UNISAGYM!</span></h4>
            </div>
        </div>
        <p class="title-2">
            UnisaGym vanta una struttura di oltre 3000 mq che offre numerosi servizi dedicati al benessere della persona.
            La <span class="highlight"> persona al centro</span> è questa la missione di UnisaGym che mira ad offrire non solo attività sportiva, ma accompagnare i suoi soci alla ricerca del benessere psico-fisico.
            Non è solo un impegno con te stesso, ma la nostra promessa di fare sempre meglio.
        </p>
        <br><br><br>
        <section class="container-intro">
            <div class="container-text">
                <h1>UnisaGym</h1>
                <h4>Cosa offriamo</h4>
                <p>UnisaGym ti offre servizi h24 con la possibilità di scegliere il proprio personal trainer adatto alle vostre esigenze.</p> 
                <p>Le strutture sono certificate e all'avanguardia per permettervi la miglior attività fisica possibile, quando volete e come volete.</p> 
                <p>Vi aspettiamo nelle nostre 3 sedi: Nocera Superiore, Angri e Fisciano con possibilità di agevolazione sul primo acquisto di un corso.</p>
                <p>AFFRETTATEVI!</p>
            </div>

            <div class="container-immagine">
                <div class="immagine-int">
                    <img src="images/foto-palestra-interno-2.jpg" alt="Foto Palestra Interno">
                </div>
            </div>
        </section>

        <section class="container-intro-2">
            <div class="container-immagine-2">
                <div class="immagine-int-2">
                    <img src="images/PalestraInterno2.jpg" alt="Foto Palestra Interno 2">
                </div>
            </div>
            
            <div class="container-text-2">
                <div class="feature">
                    <img src="images/check-icon" alt="Spunta Verde" class="check-icon">
                    <div class="text">
                        <h2>ABBONAMENTI A PARTIRE DA 19,99€!</h2>
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

                <div class="feature">
                    <img src="images/check-icon" alt="Spunta Verde" class="check-icon">
                    <div class="text">
                        <h2>CHIAMARE PER SAPERNE DI PIU'</h2>
                        <p>Puoi contattarci quando vuoi, per fissare un appuntamento per una consulenza, o per richiedere il tuo periodo di prova gratuito di 7 giorni</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="container-intro-3">
            <div class="container-text-3">
                <div class="feature">
                    <img src="images/check-icon" alt="Spunta Verde" class="check-icon">
                    <div class="text">
                        <h2>WELNESS & SPA</h2>
                        <p>Un percorso multisensoriale vi accompagnerà nella nostra Spa firmata Starpool, tra profumi, suoni e colori.  Un’esperienza unica, una pausa rigenerante tra sauna, bagno turco, percorso di docce emozionali, cascata del ghiaccio, piscina idromassaggio</p>
                    </div>
                </div>

                <div class="feature">
                    <img src="images/check-icon" alt="Spunta Verde" class="check-icon">
                    <div class="text">
                        <h2>ESPERIENZA RIGENERATIVA</h2>
                        <p>L’attività fisica contribuisce a modellare il nostro corpo e renderlo più sano, soprattutto grazie ai trattamenti estetici in grado di massimizzare i benefici dello sport stesso. Le nostre beauty specialist lavorano su protocolli viso e corpo personalizzati per risolvere le imperfezioni come smagliature, rughe, cellulite e migliorare la tonificazione e l’elasticità dei tessuti, anche con il supporto delle nostre tecnologie</p>
                    </div>
                </div>

                <div class="feature">
                    <img src="images/check-icon" alt="Spunta Verde" class="check-icon">
                    <div class="text">
                        <h2>HEALTHY BAR</h2>
                        <p>Bar interno per colazioni, pause e pranzi all’insegna del benessere</p>
                    </div>
                </div>
            </div>
            <div class="container-immagine-3">
            <div class="immagine-int-3">
                    <img src="images/FotoPalestraInterno3.jpg" alt="Foto Palestra Interno 3">
                </div>
            </div>
        </section>

        <section class="stats-section">
            <div class="stat">
                <img src="images/heart_icon.jpg" alt="Iscritti">
                <p>+</p>
                <div class="number" data-target="1000">0</div>
                <p>ISCRITTI</p>
            </div>
            <div class="stat">
                <img src="images/people_icon.jpg" alt="Trainer">
                <p>+</p>
                <div class="number" data-target="30">0</div>
                <p>PERSONAL TRAINER</p>
            </div>
            <div class="stat">
                <img src="images/running_icon.jpg" alt="Classi Attive">
                <p>+</p>
                <div class="number" data-target="30">0</div>
                <p>CLASSI ATTIVE</p>
            </div>

            <script>
                function animateCountUp(element, target) {
                    let start = 0;
                    const duration = 5000;
                    const stepTime = Math.abs(Math.floor(duration / target));

                    const timer = setInterval(() => {
                        start += Math.ceil(target / 100);
                        if (start >= target) {
                            element.textContent = target.toLocaleString();
                            clearInterval(timer);
                        } else {
                            element.textContent = start.toLocaleString();
                        }
                    }, stepTime);
                }

                document.addEventListener("DOMContentLoaded", () => {
                    document.querySelectorAll(".number").forEach(num => {
                        const target = +num.getAttribute("data-target");
                        animateCountUp(num, target);
                    });
                });
            </script>
        </section>
        <br><br><br><br><br>
        <div class="sedi-text">
            <h3>Le Nostre Sedi</h3>
            <p>Dove potrai allenarti nel modo che preferisci, ma sopratutto più vicino a te</p>
        </div>
        
        <section class="container">
            <div class="slideshow-container">
                <div class="freccia freccia-sinistra" onclick="cambiaSlide(-1)">&#10094;</div>

                <div class="slideshow">
                    <div class="slide"><img src="images/PalestraNocSup.jpg"></div>
                        <div class="caption-text">Nocera Superiore</div>
                    <div class="slide"><img src="images/PalestraAngri.jpg"></div>
                        <div class="caption-text">Angri</div>
                    <div class="slide"><img src="images/PalestraFisciano.jpg"></div>
                        <div class="caption-text">Fisciano</div>
                </div>

                <div class="freccia freccia-destra" onclick="cambiaSlide(1)">&#10095;</div>

                <div class="container-punti">
                    <span class="punto" onclick="slideAttiva(0)"></span>
                    <span class="punto" onclick="slideAttiva(1)"></span>
                    <span class="punto" onclick="slideAttiva(2)"></span>
                </div>
            </div>
        </section>
     
        <section class="branches">
                <div class="branch">
                    <h3>Nocera Superiore</h3>
                    <p><strong>Numero Telefonico</strong><br>3398777704</p>
                    <p><strong>Indirizzo</strong><br>Via Pareti 167</p>
                    <p><strong>Email</strong><br>info@unisagym.it</p>
                </div>
                <div class="branch">
                    <h3>Angri</h3>
                    <p><strong>Numero Telefonico</strong><br>33333333333</p>
                    <p><strong>Indirizzo</strong><br>Via Nazionale 174</p>
                    <p><strong>Email</strong><br>info@unisagym.it</p>
                </div>
                <div class="branch">
                    <h3>Fisciano</h3>
                    <p><strong>Numero Telefonico</strong><br>3334343434</p>
                    <p><strong>Indirizzo</strong><br>Via Lorem Ipsum 174</p>
                    <p><strong>Email</strong><br>info@unisagym.it</p>
                </div>
            </div>
        </section>
        <script src="js/slideShowIndex.js"></script>
    </main>
    <?php include 'footer.html'; ?>
</body>