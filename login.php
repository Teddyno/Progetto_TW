<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styleSheet/style.css">
    <link rel="stylesheet" type="text/css" href="styleSheet/styleLoginRegister.css">
    <link rel="ICON" href="images/icon.ico" type="image/X-ixon">
    <title>UniSa Gym - Login</title>

    <?php
		function get_pwd($nickname_email,$db){
				require 'db.php';

                if(is_email($nickname_email)){
                    $sql = "SELECT password FROM iscritti WHERE email=$1;";
                } else {
                    $sql = "SELECT password FROM iscritti WHERE nickname=$1;";
                }

				$prep = pg_prepare($db, "sqlPassword", $sql);
				$ret = pg_execute($db, "sqlPassword", array($nickname_email));
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

		function get_dati($nickname_email,$db){
			require 'db.php';

            if(is_email($nickname_email)){
                $sql = "SELECT id, nome, nickname, email FROM iscritti WHERE email=$1;";
            } else {
                $sql = "SELECT id, nome, nickname, email FROM iscritti WHERE nickname=$1;";
            }
			$prep = pg_prepare($db, "sqlNome", $sql);
			$ret = pg_execute($db, "sqlNome", array($nickname_email));
			if(!$ret) {
				echo "ERRORE QUERY: " . pg_last_error($db);
				return false;
			}
			else{
				if ($row = pg_fetch_assoc($ret)){
                    $_SESSION['email']= $row['email'];
                    $_SESSION['nickname']= $row['nickname'];
					$_SESSION['idIscritto']= $row['id'];
					$_SESSION['nome']= $row['nome'];
                    $_SESSION['admin'] = false;
                    if($_SESSION['idIscritto'] == 0){
                        $_SESSION['admin'] = true;
                    }
					return true;
				}
				else{
					return false;
				}
			}
			pg_close($db);
		}

        function is_email($nickname_email){
            if (filter_var($nickname_email, FILTER_VALIDATE_EMAIL)) {
                return true;
            } else {
                return false;
            }
        }
	?>
</head>
<body>
    <?php include 'header.php'; ?>

    <?php
        if(isset($_POST['nicknameEmail']))
            $nickname_email = $_POST['nicknameEmail'];
        else
            $nickname_email = "";
        if(isset($_POST['password']))
            $pass = $_POST['password'];
        else
            $pass = "";
    ?>

    <div class="contenitore-login">
        <h2 class="titolo-login">Accedi alla tua area riservata</h2>
        <form class="form-login" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <label for="nicknameEmail">nickname/Email</label>
            <input type="text" id="nicknameEmail" name="nicknameEmail" placeholder="Inserisci nickname o Email" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Inserisci la tua password" required>

            <button type="submit" class="pulsante-login">Accedi</button>

            <p class="link-extra">
                Non sei ancora registrato? <a href="registrati.php">Registrati</a>
            </p>
        </form>
    </div>

    <?php
        require_once "db.php";

        //CONNESSIONE AL DB
        $db = pg_connect($connection_string) or die('Impossibile connettersi al database: ' . pg_last_error());


        if(!empty($nickname_email) && !empty($pass)){
 
            //chiama la funzione get_pwd che controlla
            //se username esiste nel DB. Se esiste, restituisce la password (hash), altrimenti restituisce false.
            $hash = get_pwd($nickname_email,$db);
            if(!$hash){
                echo "<p style=\"margin-top:100px;\"> L'utente con $nickname_email non esiste. <a href=\"login.php\">Riprova</a></p>";
            }
            else{
                if(password_verify($pass, $hash)){
                    //Se il login è corretto, inizializziamo la sessione
                    session_start();
                    $_SESSION['autenticato']=true;
                    get_dati($nickname_email,$db);
    ?>
                <script>
                    window.location.href = "profilo.php";
                </script>
    <?php   
                }else{
                    echo '<p style=\"margin-top:100px;\">Username/Email o password errati. <a href="login.php">Riprova</a></p>';
                }
            }
        }
    ?>
    
    <?php include 'footer.html'; ?>
</body>
</html>
