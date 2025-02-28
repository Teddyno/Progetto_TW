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

        $sql = "INSERT INTO daticorsi (idpersonal, giornocorso, orainizio, orafine) VALUES ($1, $2, $3, $4)";
        $prep = pg_prepare($db, "addOrario", $sql);
        $ret = pg_execute($db, "addOrario", array($id, $giorno, $orarioinizio, $orariofine));

        if ($ret) {
            echo "Nuovo Orario inserito con Successo";
        } else {
            echo "Error: " . pg_last_error($db);
        }
    } else {
        echo "Error: " . pg_last_error($db);
    }

    pg_close($db);
?>