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

    require_once "db.php";

    //RECUPERO DATI UTENTE
    $email = $_SESSION['email'];

    $sql = "SELECT id, nome, cognome, datanascita, sesso, telefono, nickname FROM iscritti WHERE email = $1;";
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
        $nickname = pg_fetch_result($ret, 0, 'nickname');
    }

    //CONNESSIONE AL DB
    $db = pg_connect($connection_string) or die('Impossibile connettersi al database: ' . pg_last_error());
    
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nome'])){
        $email = $_SESSION['email'];
        $nome = $_POST['nome'];
        $cognome = $_POST['cognome'];
        $datanascita = $_POST['datanascita'];
        $sesso = $_POST['sesso'];
        $telefono = $_POST['telefono'];

        $sql_update_dati = <<<_QUERY
            UPDATE iscritti 
            SET nome = $1, 
            cognome = $2, 
            datanascita = $3, 
            sesso = $4, 
            telefono = $5 
            WHERE email = $6;
        _QUERY;

        $prep_dati = pg_prepare($db, "updateProfiloDati", $sql_update_dati);

        $ret_dati = pg_execute($db, "updateProfiloDati", array($nome, $cognome, $datanascita, $sesso, $telefono, $email));
    }

    //MODIFICA PASSWORD E NICKNAME
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nickname'])){
        $email = $_SESSION['email'];
        $nickname = $_POST['nickname'];
        $password = $_POST['password'];

        $check_nickname_sql = "SELECT COUNT(*) FROM iscritti WHERE nickname = $1 AND email != $2";
        $check_nickname_prep = pg_prepare($db, "checkNickname", $check_nickname_sql);
        $check_nickname_ret = pg_execute($db, "checkNickname", array($nickname, $email));
        $nickname_exists = pg_fetch_result($check_nickname_ret, 0, 0);

        if ($nickname_exists > 0) {
            echo "Errore: Il nickname è già in uso.";
        } else {
            if(!empty($password)){
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            } else{
                $hashed_password = null;
            }
            if($hashed_password != null){
                $sql_update_sicurezza = <<<_QUERY
                    UPDATE iscritti 
                    SET nickname = $1, 
                    password = $2
                    WHERE email = $3;
                _QUERY;
                
                $prep_sicurezza = pg_prepare($db, "updateProfiloSicurezza", $sql_update_sicurezza);
                $ret_sicurezza = pg_execute($db, "updateProfiloSicurezza", array($nickname, $hashed_password, $email));
            } else {
                $sql_update_sicurezza = <<<_QUERY
                    UPDATE iscritti 
                    SET nickname = $1
                    WHERE email = $2;
                _QUERY;

                $prep_sicurezza = pg_prepare($db, "updateProfiloSicurezza", $sql_update_sicurezza);
                $ret_sicurezza = pg_execute($db, "updateProfiloSicurezza", array($nickname, $email));
            }
        }
    }

    // ELIMINA ACCOUNT
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['email']) && isset($_POST['conferma_password'])) {
        $email = $_SESSION['email'];
        $conferma_password = $_POST['conferma_password'];

        $sql_check_password = "SELECT password FROM iscritti WHERE email = $1;";
        $ret_check_password = pg_query_params($db, $sql_check_password, array($email));

        if ($ret_check_password && pg_num_rows($ret_check_password) > 0) {
            $hash = pg_fetch_result($ret_check_password, 0, 'password');

            if (password_verify($conferma_password, $hash)) {
                $sql_delete_user = "DELETE FROM iscritti WHERE id = $1;";
                $prep_delete_user = pg_prepare($db, "deleteUser", $sql_delete_user);
                $ret_delete_user = pg_execute($db, "deleteUser", array($id));

                if ($ret_delete_user) {
                    session_destroy(); 
                    header("Location: index.php"); 
                    exit();
                }
            } else {
                echo "<script>alert('Password errata. L\'account non può essere eliminato.');</script>";
            }
        } else {
            echo "<script>alert('Utente non trovato.');</script>";
        }
    }

    ?>
    <header class="indice">
        <div class="container-indice"><a href="#section1">Dati Personali</a></div>
        <div class="container-indice"><a href="#section2">Abbonamento</a></div>
        <div class="container-indice"><a href="#section3">Sicurezza</a></div>
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

        <!-- SEZIONE SICUREZZA -->
        <section class="section-profilo" id="section3">
        <p class="titolo-info">Sicurezza</p>
            <div class="dettagli-info-sicurezza">
                <div id="visualizza-sicurezza">
                    <div class="col1">
                        <p><strong>Email: </strong><?php echo"$email"?> </p>
                    </div>
                    <div class="col2">
                        <p><strong>Nickname: </strong><?php echo "$nickname";?></p>
                        <p><strong>Password:</strong> ******** </p>
                    </div>
                </div>
            </div>

            <button id="btn-modifica-sicurezza" class="bottone-modifica">Modifica</button>

            <!-- FORM MODIIFICA SICUREZZA -->
            <form id="form-modifica-sicurezza" style="display: none;" method="POST" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                <div class="col1">
                    <p><strong>Email: </strong><?php echo"$email"?> </p>
                </div>
                <div class="col2">
                    <p><strong>Nickname: </strong><input class="input-modifica" type="text" name="nickname" value="<?php echo htmlspecialchars("$nickname"); ?>"/><span class="bordo-input"></p>
                    <p><strong>Password: </strong><input class="input-modifica" type="password" name="password"/><span class="bordo-input"></p>
                </div>
                <button type="submit" id="bottone-salva">Salva</button>
                <button type="button" id="btn-annulla-sicurezza" class="bottone-annulla">Annulla</button>
            </form>
        </section>
        <?php
            if(isset($nickname_exists) && $nickname_exists > 0) {
                echo "Errore: Il nickname è già in uso.";
            } 
        ?>

        <div class="container-bottoni-finali">
            <button class="bottone-logOut" onclick="logout()"> <img src="images/logout">
                <span class="testo-logout">Logout</span>
            </button>
            <button id="bottone-elimina" class="bottone-elimina"><img src="images/remove">
                <span class="testo-elimina">Elimina</span>
            </button>
        </div>

        <div id="conferma-password-popup" class="popup">
            <div class="contenuto-popup">
                <h4>Conferma Eliminazione Account</h4>
                <p>Inserisci la tua password per procedere:</p>
                <form id="conferma-password-form" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                    <input type="password" id="conferma_password" name="conferma_password" placeholder="Password" required />
                    <button type="submit" name="delete_account" class="bottone-conferma">Conferma</button>
                    <button type="button" id="annulla-conferma" class="bottone-annulla">Annulla</button>
                </form>
            </div>
        </div>

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