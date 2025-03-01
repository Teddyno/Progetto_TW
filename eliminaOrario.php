<?php
    require_once "db.php";

    $db = pg_connect($connection_string) or die('Impossibile connettersi al database! ' .pg_last_error());

    if (isset($_POST['idcorso'])) {

        $idcorso = intval($_POST['idcorso']);

        $sql = "DELETE FROM daticorsi WHERE id=$1";
        $prep = pg_prepare($db, "removeOrario", $sql);
        $ret = pg_execute($db, "removeOrario", array($idcorso));

        if ($ret) {
            echo "Orario Rimosso con Successo";
        } else {
            echo "Error: " . pg_last_error($db);
        }
    } else {
        echo "Error: " . pg_last_error($db);
    }

    pg_close($db);
?>