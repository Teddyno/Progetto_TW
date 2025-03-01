<?php
    require_once "db.php";

    $db = pg_connect($connection_string) or die('Impossibile connettersi al database! ' .pg_last_error());

    if (isset($_POST['idcorso']) &&
        isset($_POST['idpersonal'])) {

        $idcorso = intval($_POST['idcorso']);
        $idpersonal = intval($_POST['idpersonal']);

        $sql = "DELETE FROM daticorsi WHERE id=$1";
        $prep = pg_prepare($db, "removeOrario", $sql);
        $ret = pg_execute($db, "removeOrario", array($idcorso));

        $sqlCont = "SELECT * FROM daticorsi WHERE idpersonal=$1";
        $prepCont = pg_prepare($db, "contOrario", $sqlCont);
        $retCont = pg_execute($db, "contOrario", array($idpersonal));

        $cont = pg_num_rows($retCont);

        if ($ret) {
            echo $cont;
        } else {
            echo "Error: " . pg_last_error($db);
        }
    } else {
        echo "Error: " . pg_last_error($db);
    }

    pg_close($db);
?>