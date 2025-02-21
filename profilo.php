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
        $nickname = $_SESSION['nickname'];

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
        $datanascitaAnni = pg_fetch_result($ret, 0, 'datanascita');
        $date = str_replace('-', '/', $datanascitaAnni);
        $datanascitaGiorni = date('d-m-Y', strtotime($date));
        $sesso = pg_fetch_result($ret, 0, 'sesso');
        $telefono = pg_fetch_result($ret, 0, 'telefono');
    }

    ?>
    <header class="indice">
        <a href="#section1">Dati Personali</a>
        <a href="#section2">Abbonamento</a>
        <a href="#section3">Sicurezza</a>
    </header>

    <div class="contenitore-profilo">
        <section class="section-profilo" id="section1">
        <p class="titolo-info">Dati Personali</p>
            <div class="dettagli-info-dati">
                <div id="visualizza-dati">
                    <div class="col1">
                        <p><strong>Nome: </strong><?php echo"$nome" ?></p>
                        <p><strong>Cognome: </strong><?php echo"$cognome" ?></p>
                        <p><strong>Data di Nascita: </strong><?php echo"$datanascitaGiorni" ?></p>
                    </div>
                    <div class="col2">
                        <p><strong>Sesso: </strong><?php echo"$sesso" ?></p>
                        <p><strong>Numero di Telefono: </strong><?php echo"$telefono" ?></p>
                    </div>
                </div>
                <button id="btn-modifica" class="bottone-modifica">Modifica</button>

                <form id="form-modifica" style="display: none;" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <div class="col1">
                        <p><strong>Nome: </strong><input class="input-modifica" type="text" name="nome" value="<?php echo htmlspecialchars("$nome")?>" required /><span class="bordo-input"></span></p>
                        <p><strong>Cognome: </strong><input class="input-modifica" type="text" name="cognome" value="<?php echo htmlspecialchars("$cognome")?>" required /><span class="bordo-input"></p>
                        <p><strong>Data di Nascita: </strong><input class="input-modifica" type="date" name="datanascita" value="<?php echo $datanascitaAnni;?>" required /><span class="bordo-input"></p>
                    </div>
                    <div class="col2">
                        <p><strong>Sesso: </strong>
                            <select name="sesso" class="input-modifica" required>
                                <span class="bordo-input">
                                <option value="M" <?php if ($sesso == 'M') echo 'selected'; ?>>Maschio</option>
                                <option value="F" <?php if ($sesso == 'F') echo 'selected'; ?>>Femmina</option>
                            </select>
                        </p>
                        <p><strong>Numero di Telefono: </strong><input class="input-modifica" type="text" name="telefono" value="<?php echo $telefono; ?>" required /><span class="bordo-input"></p>
                    </div>
                    <button type="submit" id="bottone-salva">Salva</button>
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
                        <p id="testo-barra" class="testo-barra-profilo"></p>
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
                    <p><strong>Email: </strong><?php echo"$email"?> </p>
                </div>
                <div class="col2">
                    <p><strong>Nickname: </strong><?php echo $_SESSION['nickname']; ?></p>
                    <p><strong>Password:</strong> ******** </p>
                    <button id="btn-modifica" class="bottone-modifica">Modifica</button>
                </div>
            </div>
        </section>

        <button class="bottone-logOut" onclick="logout()"> <img src="images/logout">
            <span class="testo-logout">Logout</span>
        </button>


    <script>
        function logout(){
            window.location.href = "logout.php";
        }
    </script>
    <script src="js/indiceDinamico.js"></script>
    <script src="js/barraProgressiva.js"></script>
    <script src="js/modificaDatiProfilo.js"></script>
    
    <?php include 'footer.html'; ?>
</body>
</html>