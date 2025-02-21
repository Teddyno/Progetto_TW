<?php
session_start();
require_once "db.php";

//CONNESSIONE AL DB
$db = pg_connect($connection_string) or die('Impossibile connettersi al database: ' . pg_last_error());
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styleSheet/style.css">
    <title>UniSa Gym - Profilo</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <?php

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $email = $_SESSION['email'];
        $nome = $_POST['nome'];
        $cognome = $_POST['cognome'];
        $datanascita = $_POST['datanascita'];
        $sesso = $_POST['sesso'];
        $telefono = $_POST['telefono'];

        $sql_update = <<<_QUERY
            UPDATE iscritti 
            SET nome = $1, 
            cognome = $2, 
            datanascita = $3, 
            sesso = $4, 
            telefono = $5 
            WHERE email = $6;
        _QUERY;

        $prep = pg_prepare($db, "updateProfilo", $sql_update);

        $ret = pg_execute($db, "updateProfilo", array($nome, $cognome, $datanascita, $sesso, $telefono, $email));
    }

    //RECUPERO DATI UTENTE
    $email = $_SESSION['email'];

    $sql = "SELECT id, nome, cognome, datanascita, sesso, telefono FROM iscritti WHERE email = $1;";
    $prep = pg_prepare($db, "sqlProfilo", $sql);
    $ret = pg_execute($db, "sqlProfilo", array($email));
    if(!$ret) {
        echo "ERRORE QUERY: " . pg_last_error($db);
        exit; 
    } else {
        $id = pg_fetch_result($ret, 0, 'id');
        $nome = pg_fetch_result($ret, 0, 'nome');
        $cognome = pg_fetch_result($ret, 0, 'cognome');
        $datanascita = pg_fetch_result($ret, 0, 'datanascita');
        $sesso = pg_fetch_result($ret, 0, 'sesso');
        $telefono = pg_fetch_result($ret, 0, 'telefono');
    }

    ?>
    <header class="indice">
        <a href="#section1">Dati Personali</a>
        <a href="#section2">Abbonamento</a>
        <a href="#section3">Sicurezza</a>
        <a href="#section4">Log out</a>
    </header>

    <div class="contenitore-profilo">
        <section class="section-profilo" id="section1">
        <p class="titolo-info">Dati Personali</p>
            <div class="dettagli-info">
                <div id="visualizza-dati" style="display: block;">
                    <div class="col1">
                        <p><strong>Nome: </strong><?php echo"$nome" ?></p>
                        <p><strong>Cognome: </strong><?php echo"$cognome" ?></p>
                        <p><strong>Data di Nascita: </strong><?php echo"$datanascita" ?></p>
                    </div>
                    <div class="col2">
                        <p><strong>Sesso: </strong><?php echo"$sesso" ?></p>
                        <p><strong>Numero di Telefono: </strong><?php echo"$telefono" ?></p>
                    </div>
                    <button id="btn-modifica" class="bottone-modifica">Modifica</button>
                </div>

                <form id="form-modifica" style="display: none;" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <div class="col1">
                        <p><strong>Nome: </strong><input type="text" name="nome" value="<?php echo htmlspecialchars("$nome")?>" required /></p>
                        <p><strong>Cognome: </strong><input type="text" name="cognome" value="<?php echo htmlspecialchars("$cognome")?>" required /></p>
                        <p><strong>Data di Nascita: </strong><input type="date" name="datanascita" value="<?php echo $datanascita;?>" required /></p>
                    </div>
                    <div class="col2">
                        <p><strong>Sesso: </strong>
                            <select name="sesso" required>
                                <option value="M" <?php if ($sesso == 'M') echo 'selected'; ?>>Maschio</option>
                                <option value="F" <?php if ($sesso == 'F') echo 'selected'; ?>>Femmina</option>
                            </select>
                        </p>
                        <p><strong>Numero di Telefono: </strong><input type="text" name="telefono" value="<?php echo $telefono; ?>" required /></p>
                    </div>
                    <button type="submit" class="bottone-salva">Salva</button>
                    <button type="button" id="btn-annulla" class="bottone-annulla">Annulla</button>
                </form>
            </div>
        </section>

        <section class="section-profilo" id="section2">
        <p class="titolo-info">Abbonamento</p>
            <div class="dettagli-info">
                <?php 
                    include 'datiAbbonamento.php'; 
                    if($_SESSION['abbonato']){
                ?> <!-- sezione se utente è abbonato -->
                    <div class="col1">
                        <p><strong>Tipo Abbonamento: </strong><?php echo $tipoAbbonamento; ?></p>
                        <p><strong>Data Sottoscrizione: </strong><?php echo $dataIscrizione; ?></p>
                        <p><strong>Scadenza Abbonamento: </strong><?php echo $dataScadenza; ?></p>
                    </div>
                    <div class="container-barra-e-scritta">
                        <div class="container-barra">
                            <div class="barra-progressiva" id="barra-progressiva"></div>
                            <script>
                                let tipoAbbonamento = <?php echo json_encode($tipoAbbonamento); ?>;
                                let dataScadenza = <?php echo json_encode($dataScadenza); ?>;    
                            </script>
                        </div>
                        <p id="testo-barra"></p>
                    </div>
                <?php /*  sezione utente non abbonato */
                    } else {
                        echo "<p>Non hai ancora un abbonamento, inserisci il tuo abbonamento</p>";
                    }
                ?>
            </div>
        </section>

        <section class="section-profilo" id="section3">
        <p class="titolo-info">Sicurezza</p>
            <div class="dettagli-info">
                <div class="col1">
                    <p>Email : <?php echo"$email"?> </p>
                </div>
                <div class="col2">
                    <p>Password : ******** </p>
                </div>
            </div>
        </section>

        <section class="section-profilo" id="section4">
        <p class="titolo-info">Log out</p>
            <div class="dettagli-info">
                <p><button class="bottone-logOut" type="button" onclick="logout()">Log out</button></p>
            </div>
        </section>
    </div>


    <script>
        function logout(){
            window.location.href = "logout.php";
        }
    </script>
    <script src="js/indiceDinamico.js"></script>
    <script src="js/barraProgressiva.js"></script>
<<<<<<< HEAD

=======
    <script src="js/modificaDatiProfilo.js"></script>
    
>>>>>>> 1a00ebc (FUNZIONA LA MODIFICA DEI DATI)
    <?php include 'footer.html'; ?>
</body>
</html>