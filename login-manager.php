<?php
	require_once "db.php";

	//CONNESSIONE AL DB
	$db = pg_connect($connection_string) or die('Impossibile connettersi al database: ' . pg_last_error());
	
?>

<html>
<head>
	<title>Gestione Login</title>
</head>
<body>
	<?php
		if($_POST['email'] || $_POST['password']){
			$email =  $_POST['email'];
			$pass =  $_POST['password'];
			//chiama la funzione get_pwd che controlla
			//se username esiste nel DB. Se esiste, restituisce la password (hash), altrimenti restituisce false.
			$hash = get_pwd($email,$db);
			if(!$hash){
				echo "<p style=\"margin-top:100px;\"> L'utente con $email non esiste. <a href=\"login.html\">Riprova</a></p>";
			}
			else{
				if(password_verify($pass, $hash)){
					echo "<p>Login Eseguito con successo</p>";
					//Se il login è corretto, inizializziamo la sessione
					session_start();
					$_SESSION['username']=$email;
					echo "<p style=\"margin-top:100px;\"><a href=\"profilo.php\">Accedi</a> al contenuto riservato solo agli utenti registrati<p>";
				}
				else{
					echo '<p style=\"margin-top:100px;\">Username o password errati. <a href="login.html">Riprova</a></p>';
				}
			}
		}
		else{
			echo "<p style=\"margin-top:100px;\">ERRORE: username o password non inseriti <a href=\"login.html\">Riprova</a></p>";
			exit();
		}
	?>
</body>
</html>

<?php
function get_pwd($email, $db){
		require 'db.php';
		$sql = "SELECT password FROM iscritti WHERE email=$1;";
		$prep = pg_prepare($db, "sqlPassword", $sql);
		$ret = pg_execute($db, "sqlPassword", array($email));
		if(!$ret) {
			echo "ERRORE QUERY: " . pg_last_error($db);
			return false;
		}
		else{
			if ($row = pg_fetch_assoc($ret)){
				$pass = $row['password'];
				return $pass;
			}
			else{
				return false;
			}
   	}
		pg_close($db);
}
?>
