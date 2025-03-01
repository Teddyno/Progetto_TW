<?php
    require_once "db.php";

    $db = pg_connect($connection_string) or die('Impossibile connettersi al database! ' .pg_last_error());

    if (isset($_POST['idpersonal'])) {

        $idpersonal = intval($_POST['idpersonal']);

        $sql = "SELECT * FROM daticorsi WHERE idpersonal=$1";
        $prep = pg_prepare($db, "contOrario", $sql);
        $ret = pg_execute($db, "contOrario", array($idpersonal));

        $cont = pg_num_rows($ret)==0;

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