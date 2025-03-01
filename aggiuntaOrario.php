<?php
    require_once "db.php";

    $db = pg_connect($connection_string) or die('Impossibile connettersi al database! ' .pg_last_error());

    if (isset($_POST['id']) && 
        isset($_POST['giorno']) && 
        isset($_POST['orarioInizio']) && 
        isset($_POST['orarioFine'])) {

        $id = intval($_POST['id']);
        $giorno = $_POST['giorno'];
        $orarioinizio = $_POST['orarioInizio'];
        $orariofine = $_POST['orarioFine'];

        // inseriamo il nuovo corso
        $sql = "INSERT INTO daticorsi (idpersonal, giornocorso, orainizio, orafine) VALUES ($1, $2, $3, $4)";
        $prepAdd = pg_prepare($db, "addOrario", $sql);
        $retAdd = pg_execute($db, "addOrario", array($id, $giorno, $orarioinizio, $orariofine));

        //andiamo a recuperare l'id del corso appena aggiunto
        $sqlCont = "SELECT * FROM daticorsi WHERE idpersonal=$1;";
        $prepCont = pg_prepare($db, "idCorso", $sqlCont);
        $retCont = pg_execute($db, "idCorso", array($id));

        //col while riscriviamo idcorso fino all'ultima riga, ovvero l'ultimo id inserito
        while($row = pg_fetch_assoc($retCont)){
            $idcorso=$row['id'];
        }

        if ($retCont) {
            echo $idcorso;
        } else {
            echo "Error: " . pg_last_error($db);
        }
    } else {
        echo "Error: " . pg_last_error($db);
    }

    pg_close($db);
?>