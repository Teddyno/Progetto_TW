<?php 
    session_start(); 

    $accesso = FALSE;
    if(isset($_SESSION['autenticato'])){
        $accesso = $_SESSION['autenticato'];
        $nome = $_SESSION['nome'];
        $sesso = $_SESSION['sesso'];
        $email = $_SESSION['email'];
    }
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <title>UniSA Gym</title>
    <link rel="stylesheet" type="text/css" href="styleSheet/style.css">
    <link rel="ICON" href="images/icon.ico" type="image/X-ixon">
</head>
<body style="background-color:rgb(238, 238, 238);">
    <?php include 'header.php'; ?>
    <main>
        <div class="container-pieno">
    <div class="container-slideshow">
        <div class="freccia freccia-sinistra" onclick="cambiaSlide(-1)">&#10094;</div>

        <div class="slideshow">
            <div class="slide"><img src="images/slideshow1.jpg"></div>
            <div class="slide"><img src="images/slideshow2.jpg"></div></a>
            <div class="slide"><img src="images/slideshow3.jpg"></div>
        </div>

        <div class="freccia freccia-destra" onclick="cambiaSlide(1)">&#10095;</div>

        <div class="container-punti">
            <span class="punto" onclick="slideAttiva(0)"></span>
            <span class="punto" onclick="slideAttiva(1)"></span>
            <span class="punto" onclick="slideAttiva(2)"></span>
        </div>
    </div>
</div>

        <div class="container-a-meta">

            <div class="container-cta">
                <?php
                    if($accesso){
                        if($sesso == 'M') echo"<h1>$nome Benvenuto in UniSA Gym</h1>";
                        else if($sesso == 'F') echo"<h1>$nome Benvenuta in UniSA Gym</h1>";
                        else echo"<h1>$nome Benvenuto/a in UniSA Gym</h1>";
                    ?>
                    <?php
                        if($email == 'admin@admin'){
                    ?>
                            <p class="descrizione-admin">
                                Gestisci facilmente tutti i servizi di UnisaGym: iscrizioni, Personal Trainer, e 
                                lo Shop. Tutto ciò di cui hai bisogno per mantenere la palestra efficiente e 
                                dinamica.
                            </p>
                    <?php
                        }else{
                    ?>
                        <p class="domandona" id="domanda">Ti sei allenato oggi?</p>
                        <div class="bottoni">
                            <button class="bottone-si" onclick="rispondiAllenamento(true)">Sì 💪</button>
                            <button class="bottone-no" onclick="rispondiAllenamento(false)">No 😅</button>
                        </div>
                        <p id="messaggio-risposta" class="messaggio"></p>
                    <?php
                        }
                    } else {
                    ?>
                        <h1>Benvenuto in UniSA Gym</h1>
                        <p class="descrizione-non-registrati">
                            UnisaGym è la palestra ideale per chi vuole migliorare la propria 
                            forma fisica. Personal trainer esperti e uno shop contente i migliori prodotti sul 
                            mercato ti aspettano qui, dove salute e benessere sono al centro 
                            dell'attenzione. Sei pronto per raggiungere i tuoi obiettivi? 🚀
                        </p>
                    <?php
                    }
                ?>
            </div>

            <div class="container-abbonamento">
                <?php
                    if($accesso){
                        include 'datiAbbonamento.php';
                        $abbonato = $_SESSION['abbonato'];
                        if($abbonato){
                ?>
                <h1>Il tuo Abbonamento</h1>
                <div class="container-barra">
                    <div class="barra-progressiva" id="barra-progressiva"></div>
                    <script>
                        let tipoAbbonamento = <?php echo json_encode($tipoAbbonamento); ?>;
                        let dataScadenza = <?php echo json_encode($dataScadenza); ?>;    
                    </script>
                </div>
                <p id="testo-barra" class="testo-barra-index"></p>
                <?php
                        } else {
                            echo "<h1>Non hai un abbonamento attivo</h1>
                                    <div><a href='shop.php' class='pulsante-acquisto'>Iscriviti Ora!</a></div>";
                        }
                    } else {
                ?>
                        <h1>Accedi per avere info sul tuo abbonamento</h1>
                        <div class="bottoni">
                            <button class="bottone-login" onclick="window.location.href='login.php'">Login</button>
                        </div>
                <?php
                    }
                ?>
            </div>
        </div>

        <div class="container-offerte">
            <h1>Le Nostre Offerte</h1>
            <div class="container-offerte-card">
                <a class="offerta-card" href="servizi.php#sezione-trainer">
                    <p>💪 PERSONAL TRAINER GRATUITO!</p>
                    <p class="descrizione-offerta">La prima lezione con un tuo personal trainer a scelta è gratuita!<br></p>
                    <p class="descrizione-offerta">Scopri gli orari e approfittane!</p>
                    <div class="angolo">
                        <div class="freccia-offerta">→</div>
                    </div>
                </a>

                <a class="offerta-card" href="shop.php">
                    <p>💰 SCONTO DEL 20%!</p>
                    <p class="descrizione-offerta">Ottieni il 20% di sconto sull'abbonamento da 12 mesi</p>
                    <p class="descrizione-offerta">Affrettati, scade tra 2 giorni!</p>
                    <div class="angolo">
                        <div class="freccia-offerta">→</div>
                    </div>
                </a>
            </div>
        </div>

        <div class="container-a-meta">

            <div class="contenitore-playlist">
                <div class="card-playlist">
                    <img src="images/playlist1.png" alt="Copertina Playlist" class="copertina-playlist">
                    <div class="info-playlist">
                        <h3 class="titolo-playlist">Playlist Motivazionale</h3>
                        <p class="descrizione-playlist">Una selezione di brani potenti e carichi di energia per spingerti </p>
                        <p class="descrizione-playlist">oltre i tuoi limiti. 🏋️🏅</p>
                    </div>
                <a href="https://open.spotify.com/playlist/3EsJeVdF6LGU08QoCv7Jnn?si=1c53f08dfd6c46e2"><button class="button-riproduzione">▶</button></a>
                </div>
                <div class="card-playlist">
                    <img src="images/playlist2.png" class="copertina-playlist">
                    <div class="info-playlist">
                        <h3 class="titolo-playlist">Top 100 Global</h3>
                        <p class="descrizione-playlist">I brani più ascoltati del momento, per allenarti con il ritmo che fa tendenza! 🎶💪</p>
                    </div>
                    <a href="https://open.spotify.com/playlist/7ckYCUqfzKKJceZEiZu1QI?si=NIYa44hHTYCvhhA_DDb_DQ"><button class="button-riproduzione">▶</button></a>
                </div>
                <div class="card-playlist">
                    <img src="images/playlist3.png" alt="Copertina Playlist" class="copertina-playlist">
                    <div class="info-playlist">
                        <h3 class="titolo-playlist">Hot Hits Italia</h3>
                        <p class="descrizione-playlist">Allenati con le migliori canzoni italiane! 🔥🔥</p>
                    </div>
                    <a href="https://open.spotify.com/playlist/5hHMJVp0I5y5iSxz3XFPSm?si=xZX9MLSVTQO6gsoEyppf6w"><button class="button-riproduzione">▶</button></a>
                </div>
            </div>

            <div class="container-provvisorio">
                <div class="promozione-tapis-roulant">
                    <img src="images/shop/biscotti_proteici.jpg" alt="Tapis Roulant">
                    <div class="contenuto-destra">
                        <h2>🚀 Offerta Imperdibile! 🚀</h2>
                        <p>Biscotti proteici croccanti, arricchiti con proteine <br>di alta qualità per un snack delizioso e nutriente!</p>
                        <p class="prezzo">
                            Solo <span class="vecchio-prezzo">€12</span> <span class="nuovo-prezzo">€4!</span>
                        </p>
                        <a href="shop.php" class="pulsante-acquisto">Acquista Ora!</a>
                    </div>
                </div>
            </div>
        </div>

        <script src="js/barraProgressiva.js"></script>
        <script src="js/copiaCodiceSconto.js"></script>
        <script src="js/slideShowIndex.js"></script>
        <script src="js/rispondiAllenamento.js"></script>

    </main>
    <?php include 'footer.html'; ?>
</body>
</html>

