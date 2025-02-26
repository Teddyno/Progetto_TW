<?php 
    session_start(); 

    $admin = FALSE;
    if(isset($_SESSION['admin'])){
        $admin = $_SESSION['admin'];
    }
?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="styleSheet/style.css">
        <link rel="stylesheet" type="text/css" href="styleSheet/styleAbbonamento.css">
        <link rel="stylesheet" type="text/css" href="stylesheet/FormAggiuntaTrainer.css">
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
            <?php
                require 'db.php';

                $db = pg_connect($connection_string) or die('Impossibile connettersi al database: ' . pg_last_error());

                $sqlPersonal = "SELECT * FROM personaltrainer";
                $retPersonal = pg_query($db, $sqlPersonal);

                $sqlCorsi = "SELECT giornocorso,orainizio,orafine FROM daticorsi WHERE idpersonal = $1;";
                $prepCorsi = pg_prepare($db, "sqlCorsi", $sqlCorsi);

                if(!$retPersonal) {
                    echo pg_last_error($db); 
                } else {
                    while($rowP = pg_fetch_assoc($retPersonal)){
            ?>
                    <!-- Trainer -->
                        <div class="trainer">
                            <img class="foto-trainer" src="<?php echo $rowP['fotopath']?>" alt="Foto Profilo">
                            <p class="nome-trainer"><?php echo $rowP['nome']." ".$rowP['cognome']?></p>
                            <div class="orari-container">
                                <table class="tabella-orari">
                                    <tr>
                                        <th>Giorno</th>
                                        <th>Orario</th>
                                    </tr>
            <?php   /* tabella corsi */
                            $retCorsi = pg_execute($db, "sqlCorsi", array($rowP['id']));
                            if(!$retCorsi) {
                                echo pg_last_error($db); 
                            } else {
                                if(pg_num_rows($retCorsi) == 0){
                                    echo <<<HTML
                                        <tr>
                                            <td colspan="2">Nessun corso disponibile</td>
                                        </tr>
HTML;
                                } else {
                                    while($rowCorsi = pg_fetch_assoc($retCorsi)){
                                        $giorno = $rowCorsi['giornocorso'];
                                        $orainizio = $rowCorsi['orainizio'];
                                        $orafine = $rowCorsi['orafine'];
                                        echo <<<HTML
                                            <tr>
                                                <td>$giorno</td>
                                                <td>$orainizio - $orafine</td>
                                            </tr>
HTML;
                                    }
                                }
                                
                            }
            ?>                            
                                </table>
                            </div>
                        </div>
            <?php
                    }
                }
                pg_close($db);
            ?>
            </div>
        </div>

        <?php
            if($admin){
        ?>
            <div class="contenitore-aggiunta-trainer">
                <h1>Aggiunta personal trainer</h1>
                <form class="form-aggiunta" action="aggiuntaTrainer.php" method="POST" enctype="multipart/form-data">
                    <label for="nome">nome</label>
                    <input type="text" id="nome" name="nome" placeholder="Inserisci nome" required>

                    <label for="cognome">cognome</label>
                    <input type="text" id="cognome" name="cognome" placeholder="Inserisci cognome" required>

                    <label for="foto">foto</label>
                    <div id="drop-area">
                        <h2>Trascina la foto qui</h2>
                        <p>Oppure clicca per selezionare un file</p>
                        <input type="file" id="foto" name="foto">
                    </div>

                    <button type="submit" class="pulsante-aggiunta" id="bottone-aggiunta">Aggiungi</button>
                </form>
            </div>    
        <?php
            }
        ?>

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

        <script src="js/script_drag_drop.js"></script>
    </body>
</html>