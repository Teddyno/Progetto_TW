<?php
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
        $email = $_SESSION['email'];

		$sql = "SELECT id, nome, cognome, datanascita FROM iscritti WHERE email = $1;";
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
        }
    ?>

    <header class="indice">
        <a href="#section1">Dati Personali</a>
        <a href="#section2">abbonamento</a>
        <a href="#section3">Sicurezza</a>
        <a href="#section4">Log out</a>
    </header>

    <div class="contenitore-profilo">
        <section class="section-profilo" id="section1">
            <div class="dettagli-info">
                <p class="titolo-info">Dati Personali</p>
                <p>Nome : <?php echo"$nome" ?></p>
                <p>Cognome : <?php echo"$cognome" ?></p>
                <p>Data di nascita : <?php echo"$datanascita" ?></p>
            </div>
        </section>

        <section class="section-profilo" id="section2">
            <div class="dettagli-info">
                <p class="titolo-info">abbonamento</p>
                <?php 
                    include 'datiAbbonamento.php'; 
                    if($_SESSION['abbonato']){
                ?> <!-- sezione se utente è abbonato -->
                    <div class="container-barra">
                        <div class="barra-progressiva" id="barra-progressiva"></div>
                        <script>
                            let tipoAbbonamento = <?php echo json_encode($tipoAbbonamento); ?>;
                            let dataScadenza = <?php echo json_encode($dataScadenza); ?>;    
                        </script>
                    </div>
                    <p id="testo-barra"></p>
                    <p>tipo abbonamento : <?php echo $tipoAbbonamento; ?></p>
                    <p>data sottoscrizione : <?php echo $dataIscrizione; ?></p>
                    <p>Scadenza abbonamento: <?php echo $dataScadenza; ?></p>
                <?php /*  sezione utente non abbonato */
                    } else {
                        echo "<p>Non hai ancora un abbonamento, inserisci il tuo abbonamento</p>";
                    }
                ?>
            </div>
        </section>

        <section class="section-profilo" id="section3">
            <div class="dettagli-info">
                <p class="titolo-info">Sicurezza</p>
                <p>Email : <?php echo"$email"?> </p>
                <p>Password : ******** </p>
            </div>
        </section>

        <section class="section-profilo" id="section4">
            <div class="dettagli-info">
                <p class="titolo-info">Log out</p>
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

    <?php include 'footer.html'; ?>
</body>
</html>