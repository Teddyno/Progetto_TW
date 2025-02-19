<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styleSheet/style.css">
    <link rel="stylesheet" type="text/css" href="styleSheet/styleAbbonamento.css">
    <title>UniSa Gym - Abbonamento</title>
</head>
<body>
    <?php include 'header.php'; ?>

    
         <!-- Sezione abbonamenti -->
        <div class="contenitore-abbonamenti" id="sezione-abbonamento">
        <h2 class="titolo-abbonamenti">I Nostri Abbonamenti</h2>
        <div class="opzioni-abbonamento">
            <div class="abbonamento">
                <span class="durata">12</span>
                <p class="testo-mesi">Mesi</p>
                <p class="prezzo">€99,99</p>
            </div>

            <div class="abbonamento">
                <span class="durata">6</span>
                <p class="testo-mesi">Mesi</p>
                <p class="prezzo">€59,99</p>
            </div>

            <div class="abbonamento">
                <span class="durata">2</span>
                <p class="testo-mesi">Mesi</p>
                <p class="prezzo">€19,99</p>
            </div>
        </div>
    </div>


    <div class="contenitore-trainer" id="sezione-trainer">
        <h2 class="titolo-trainer">Personal Trainer</h2>
        <div class="griglia-trainer">
            <!-- Trainer 1 -->
            <div class="trainer">
                <img class="foto-trainer" src="images/pt_1.jpg" alt="Foto Marco Bianchi">
                <p class="nome-trainer">Marco Bianchi</p>
                <div class="social-trainer">
                    <a href="#">📷</a>
                    <a href="#">🔵</a>
                </div>
                <div class="orari-container">
                    <table class="tabella-orari">
                        <tr>
                            <th>Giorno</th>
                            <th>Orario</th>
                        </tr>
                        <tr>
                            <td>Lunedì</td>
                            <td>10:00 - 12:00</td>
                        </tr>
                        <tr>
                            <td>Mercoledì</td>
                            <td>14:00 - 16:00</td>
                        </tr>
                        <tr>
                            <td>Venerdì</td>
                            <td>18:00 - 20:00</td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- Trainer 2 -->
            <div class="trainer">
                <img class="foto-trainer" src="images/pt_1.jpg" alt="Foto Luca Rossi">
                <p class="nome-trainer">Luca Rossi</p>
                <div class="social-trainer">
                    <a href="#">📷</a>
                    <a href="#">🔵</a>
                </div>
                <div class="orari-container">
                    <table class="tabella-orari">
                        <tr>
                            <th>Giorno</th>
                            <th>Orario</th>
                        </tr>
                        <tr>
                            <td>Martedì</td>
                            <td>09:00 - 11:00</td>
                        </tr>
                        <tr>
                            <td>Giovedì</td>
                            <td>15:00 - 17:00</td>
                        </tr>
                        <tr>
                            <td>Sabato</td>
                            <td>10:00 - 12:00</td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- Trainer 3 -->
            <div class="trainer">
                <img class="foto-trainer" src="images/pt_1.jpg" alt="Foto Andrea Verdi">
                <p class="nome-trainer">Andrea Verdi</p>
                <div class="social-trainer">
                    <a href="#">📷</a>
                    <a href="#">🔵</a>
                </div>
                <div class="orari-container">
                    <table class="tabella-orari">
                        <tr>
                            <th>Giorno</th>
                            <th>Orario</th>
                        </tr>
                        <tr>
                            <td>Lunedì</td>
                            <td>16:00 - 18:00</td>
                        </tr>
                        <tr>
                            <td>Mercoledì</td>
                            <td>09:00 - 11:00</td>
                        </tr>
                        <tr>
                            <td>Venerdì</td>
                            <td>17:00 - 19:00</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <div class="contenitore-servizi">
        <h2 class="titolo-servizi">Servizi Offerti</h2>
        <div class="griglia-servizi">
            <!-- Servizio 1 -->
            <div class="servizio">
                <div class="icona-servizio">💪</div>
                <p class="nome-servizio">Allenamenti Personalizzati</p>
                <p class="descrizione-servizio">Programmi su misura per ogni esigenza, dal dimagrimento alla massa muscolare.</p>
            </div>

            <!-- Servizio 2 -->
            <div class="servizio">
                <div class="icona-servizio">🥗</div>
                <p class="nome-servizio">Consigli Nutrizionali</p>
                <p class="descrizione-servizio">Piani alimentari bilanciati per ottimizzare i tuoi risultati.</p>
            </div>

            <!-- Servizio 3 -->
            <div class="servizio">
                <div class="icona-servizio">🧘</div>
                <p class="nome-servizio">Recupero e Mobilità</p>
                <p class="descrizione-servizio">Tecniche di stretching e mobilità per migliorare il benessere fisico.</p>
            </div>
        </div>
    </div>


    <?php include 'footer.html'; ?>
</body>
</html>