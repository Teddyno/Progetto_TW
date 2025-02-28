<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styleSheet/style.css">
    <link rel="stylesheet" type="text/css" href="styleSheet/styleLoginRegister.css">
    <link rel="ICON" href="images/icon.ico" type="image/X-ixon">
    <title>UniSa Gym - Registrati</title>
</head>
<body>
    <?php include 'header.php'; ?>
    <?php
        if(isset($_POST['nome']))
            $nome = $_POST['nome'];
        else
            $nome = "";
        if(isset($_POST['cognome']))
            $cognome = $_POST['cognome'];
        else
            $cognome = "";
        if(isset($_POST['nickname']))
            $nickname = $_POST['nickname'];
        else
            $nickname = "";
        if(isset($_POST['email']))
            $email = $_POST['email'];
        else
            $email = "";
        if(isset($_POST['password']))
            $pass = $_POST['password'];
        else
            $pass = "";
        if(isset($_POST['conferma-password']))
            $repassword = $_POST['conferma-password'];
        else
            $repassword = "";

    ?>

    <div class="contenitore-login">
        <h2 class="titolo-login">Crea il tuo account</h2>
        <form class="form-login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" placeholder="Inserisci il tuo nome" value="<?php echo $nome ?>" required>

            <label for="nome">Cognome</label>
            <input type="text" id="cognome" name="cognome" placeholder="Inserisci il tuo cognome" value="<?php echo $cognome ?>" required>

            <label for="nome">Nickname</label>
            <input type="text" id="nickname" name="nickname" placeholder="Inserisci il tuo nickname" value="<?php echo $nickname ?>" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Inserisci la tua email" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Crea una password" required>

            <label for="conferma-password">Conferma Password</label>
            <input type="password" id="conferma-password" name="conferma-password" placeholder="Ripeti la password" required>

            <button type="submit" class="pulsante-login">Registrati</button>

            <p class="link-extra">
                Hai già un account? <a href="login.php">Accedi</a>
            </p>
        </form>
    </div>

    <?php

        
        // Se il campo password è vuoto non effettuiamo nessun altro controllo
        if (!empty($pass)){
            // Se le due password sono diverse mostriamo un messaggio di errore
            if($pass!=$repassword){
                echo "<p style=\"margin-top:30px;\"> Hai sbagliato a digitare la password. Riprova</p>";
                // a $pass e $repass assegniamo una stringa vuota in modo tale che nel modulo sticky non capariranno più le password errate
                $pass = "";
                $repassword = "";
            }
            else{
                // Se la password è stata inserita e la password di conferma coincide, proseguiamo
                //ANDREBBERO INSERITI ANCHE I CONTROLLI DEGLI ALTRI VALORI OBBLIGATORI
                //....

                require_once "db.php";

                //CONNESSIONE AL DB
                $db = pg_connect($connection_string) or die('Impossibile connettersi al database: ' . pg_last_error());
	
                //CONTROLLO SE L'UTENTE GIA' ESISTE
                if(email_exist($email,$db)){
                    echo "<p style=\"margin-top:30px;\"> Email $email già esistente. Riprova</p>";
                    exit;
                }
                if(nickname_exist($nickname,$db)){
                    echo "<p style=\"margin-top:30px;\"> Nickname $nickname già esistente. Riprova</p>";
                }else{
                    //ORA posso inserire il nuovo utente nel db
                    if(insert_utente($nome, $cognome, $nickname, $email, $pass,$db)){
                        echo "<p style=\"margin-top:30px;\"> Utente registrato con successo. Effettua il <a href=\"login.php\" style=\"text-decoration:none;\">login</a></p>";
                    }
                    else{
                        echo "<p style=\"margin-top:30px;\"> Errore durante la registrazione. Riprova</p>";
                    }
                }
            }
        }

    ?>
    
    <?php include 'footer.html'; ?>
</body>
</html>

<?php
function email_exist($email,$db){

	$sql = "SELECT email FROM iscritti WHERE email=$1";
	$prep = pg_prepare($db, "sqlEmail", $sql);
	// $prep sarà uguale a false in caso di fallimento nella creazione del prepared statement

	$ret = pg_execute($db, "sqlEmail", array($email));
	// $ret sarà uguale a false in caso di fallimento nell'esecuzione del prepared statement

	if(!$ret) {
		echo "ERRORE QUERY: " . pg_last_error($db);
		return false;
	}
	else{
		// $row sarà uguale a false se non sono state restituite righe della tabella
		// a seguito dell'esecizone del prepared statement.
		// Nelle specifico, è false se la tabella non contiene un record con nickname uguale a $user
		if ($row = pg_fetch_assoc($ret)){
			return true;
		}
		else{
			return false;
		}
	}
	pg_close($db);
}

function nickname_exist($nickname,$db){

	$sql = "SELECT nickname FROM iscritti WHERE nickname=$1";
	$prep = pg_prepare($db, "sqlnickname", $sql);
	$ret = pg_execute($db, "sqlnickname", array($nickname));

	if(!$ret) {
		echo "ERRORE QUERY: " . pg_last_error($db);
		return false;
	}
	else{
		if ($row = pg_fetch_assoc($ret)){
			return true;
		}
		else{
			return false;
		}
	}
	pg_close($db);
}

function insert_utente($nome,$cognome, $nickname, $email, $pass,$db){

	$hash = password_hash($pass, PASSWORD_DEFAULT);
	$sql = "INSERT INTO iscritti(nome, cognome, nickname, email, password) VALUES($1, $2, $3, $4, $5)";
	$prep = pg_prepare($db, "insertUser", $sql);
	$ret = pg_execute($db, "insertUser", array($nome, $cognome, $nickname, $email, $hash));
	if(!$ret) {
		echo "ERRORE QUERY: " . pg_last_error($db);
		return false;
	}
	else{
		return true;
	}
	pg_close($db);
}
?>