<?php

    session_start();

    require_once "db.php";

    //CONNESSIONE AL DB
    $db = pg_connect($connection_string) or die('Impossibile connettersi al database: ' . pg_last_error());

    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];

    if(isset($_POST['foto'])){
        $foto = $_POST['foto'];
    }
    else{
        $foto = "images\icona_profilo_default.png";
    }

    insert_trainer($nome,$cognome,$foto,$db);
    ?>
    <script>
        window.location.href = "abbonamento.php";
    </script>
    <?php

    function insert_trainer($nome,$cognome,$foto,$db){

        $sql = "INSERT INTO personaltrainer(nome, cognome, foto) VALUES($1, $2, $3)";
        $prep = pg_prepare($db, "insertTrainer", $sql);
        $ret = pg_execute($db, "insertTrainer", array($nome, $cognome, $foto));
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