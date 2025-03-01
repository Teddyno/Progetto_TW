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
        <link rel="stylesheet" type="text/css" href="stylesheet/FormGestioneTrainer.css">
        <link rel="ICON" href="images/icon.ico" type="image/X-ixon">
        <title>UniSa Gym - Abbonamento</title>
    </head>
    <body background-color:rgb(238, 238, 238);>
        <?php include 'header.php'; ?>

        <!-- Sezione abbonamenti -->
        <div class="contenitore-abbonamenti" id="sezione-abbonamento">
            <h2 class="titolo-abbonamenti">I Nostri Abbonamenti</h2>
            <div class="opzioni-abbonamento">
                <div class="abbonamento">
                    <span class="durata">12</span>
                    <p class="testo-mesi">Mesi</p>
                    <p class="prezzo">€99</p>
                </div>

                <div class="abbonamento">
                    <span class="durata">6</span>
                    <p class="testo-mesi">Mesi</p>
                    <p class="prezzo">€59</p>
                </div>

                <div class="abbonamento">
                    <span class="durata">3</span>
                    <p class="testo-mesi">Mesi</p>
                    <p class="prezzo">€29</p>
                </div>

                <div class="abbonamento">
                    <span class="durata">1</span>
                    <p class="testo-mesi">Mese</p>
                    <p class="prezzo">€15</p>
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

                

                $sqlCorsi = "SELECT id,giornocorso,orainizio,orafine FROM daticorsi WHERE idpersonal = $1;";
                $prepCorsi = pg_prepare($db, "sqlCorsi", $sqlCorsi);

                if(!$retPersonal) {
                    echo pg_last_error($db); 
                } else {
                    while($rowP = pg_fetch_assoc($retPersonal)){
                        $idPersonal = $rowP['id'];
            ?>
                    <!-- Trainer -->
                        <div class="trainer">
                            <img class="foto-trainer" src="<?php echo $rowP['fotopath']?>" alt="Foto Profilo">
                            <p class="nome-trainer"><?php echo $rowP['nome']." ".$rowP['cognome']?></p>
                            <div class="orari-container">
                                <table class="tabella-orari" id="tabella-orari-<?php echo $idPersonal?>">
                                    <tr>
                                        <th>Giorno</th>
                                        <th>Orario</th>
                                    </tr>
            <?php   /* tabella corsi */
                            $retCorsi = pg_execute($db, "sqlCorsi", array($idPersonal));
                            if(!$retCorsi) {
                                echo pg_last_error($db); 
                            } else {
                                if(pg_num_rows($retCorsi) == 0){
                                    echo '<tr id="riga-nessun-corso-' . $idPersonal . '">
                                            <td colspan="2">Nessun corso disponibile</td>
                                        </tr>';
                                } else {
                                    while($rowCorsi = pg_fetch_assoc($retCorsi)){
                                        $idCorso = $rowCorsi['id'];
                                        $giorno = $rowCorsi['giornocorso'];
                                        $orainizio = $rowCorsi['orainizio'];
                                        $orafine = $rowCorsi['orafine'];
                                        if($admin){
                                            echo "<tr id='riga-corso-$idCorso'>
                                                <td>$giorno</td>
                                                <td>$orainizio - $orafine<button class='bottone-elimina-orario' onclick='removeOrario($idCorso,$idPersonal)'>-</button></td>
                                            </tr>";
                                        }else{
                                            echo "<tr id='riga-corso-$idCorso'>
                                                <td>$giorno</td>
                                                <td>$orainizio - $orafine</td>
                                            </tr>";
                                        }
                                    }
                                }
                                
                            }
            ?>                     
                                <?php if($admin){ ?>
                                    <tr id='aggiunta-orario-<?php echo $idPersonal?>'>
                                        <td id='aggiunta-orario-td-<?php echo $idPersonal?>' onclick="aggiuntaOrari(<?php echo $idPersonal?>)" colspan='2'><button  class="bottone-aggiungi-orario">Aggiungi Orario</button></td>
                                    </tr>
                                <?php } ?>       
                                </table>
                            </div>
            <?php if($admin){ ?>
                            <div class="azioni-trainer">
                                <a href="<?php echo $_SERVER['PHP_SELF'] ?>?idModifica=<?php echo $idPersonal; ?>">
                                    <img src="images/modify.png"></a>
                                <a href="eliminaTrainer.php?id=<?php echo $idPersonal; ?>&fotopath=<?php echo $rowP['fotopath']; ?>" onclick="return confirm('Sei sicuro di voler eliminare questo trainer?');">
                                    <img src="images/cestino.png"></a>
                            </div>
            <?php } ?>
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
        <div class="contenitore-gestione-trainer">
            <div class="contenitore-aggiunta-trainer">
                <h1>Aggiunta</h1>
                <form class="form-aggiunta" action="aggiuntaTrainer.php" method="POST" enctype="multipart/form-data">
                    <label for="nome">nome</label>
                    <input type="text" id="nome" name="nome" placeholder="Inserisci nome" required>

                    <label for="cognome">cognome</label>
                    <input type="text" id="cognome" name="cognome" placeholder="Inserisci cognome" required>

                    <label for="foto">foto</label>
                    <div id="drop-area">
                        <h2>Trascina la foto qui</h2>
                        <p id="file-list">Oppure clicca per selezionare un file</p>
                        <input type="file" id="foto" name="foto" value="">
                    </div>

                    <input type="text" id="fotopath" name="fotopath" value='' style="display:none;">

                    <button type="submit" class="pulsante-aggiunta" id="bottone-aggiunta">Aggiungi</button>
                </form>
            </div>
            <div class="contenitore-modifica-trainer" >
                <h1>Modifica</h1>
                <form class="form-modifica" action="" method="POST" enctype="multipart/form-data">
                    <label for="nome">nome</label>
                    <input type="text" id="nome" name="nome" value="" placeholder="Inserisci nome" required>

                    <label for="cognome">cognome</label>
                    <input type="text" id="cognome" name="cognome" placeholder="Inserisci cognome" required>

                    <label for="foto">foto</label>
                    <div id="drop-area">
                        <h2>Trascina la foto qui</h2>
                        <p id="file-list">Oppure clicca per selezionare un file</p>
                        <input type="file" id="foto" name="foto">
                    </div>

                    <button type="submit" class="pulsante-modifica" id="bottone-modifica">modifica</button>
                </form>
            </div> 
        </div>    
        <?php
            }
        ?>

        <div class="contenitore-servizi">
            <h2 class="titolo-servizi">I Nostri Servizi</h2>
            <div class="griglia-servizi">
                <!-- Servizio 1 -->
                <div class="servizio">
                    <div class="icona-servizio">💪</div>
                    <p class="nome-servizio">Personal Trainer Specializzati</p>
                    <p class="descrizione-servizio">Personal Trainer esperti per aiutarti a raggiungere i tuoi obiettivi fitness. Allenamenti personalizzati e 
                        supporto nutrizionale per massimizzare i risultati.</p>
                </div>

                <!-- Servizio 2 -->
                <div class="servizio">
                    <div class="icona-servizio">🥗</div>
                    <p class="nome-servizio">Alimenti e Integratori di prima scelta</p>
                    <p class="descrizione-servizio">Offriamo una selezione completa di integratori per sostenere la tua performance, favorire il recupero muscolare e 
                        mantenere un equilibrio nutrizionale ottimale.</p>
                </div>

                <!-- Servizio 3 -->
                <div class="servizio">
                    <div class="icona-servizio">🏋</div>
                        <p class="nome-servizio">Attrezzatura Professionale</p>
                        <p class="descrizione-servizio">Offriamo tutto ciò di cui hai bisogno per il tuo allenamento: pesi, attrezzi cardio, accessori fitness e molto altro. 
                            Progettati per durare e aiutarti a raggiungere i tuoi obiettivi.</p>
                </div>
            </div>
        </div>
        <?php include 'footer.html'; ?>

        <script src="js/gestioneOrari.js"></script>
        <script src="js/drag_and_drop_abbonamento.js"></script>
    </body>
</html>