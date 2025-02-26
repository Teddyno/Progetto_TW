<?php

    require_once "db.php";

    //CONNESSIONE AL DB
    $db = pg_connect($connection_string) or die('Impossibile connettersi al database: ' . pg_last_error());

    $id = $_GET["id"];

    $sql= "DELETE FROM personaltrainer where id = $1;";
    $prep = pg_prepare($db, "sqlDeletePT", $sql);
    $ret = pg_execute($db, "sqlDeletePT", array($id));

    if(!$ret) {
        echo "ERRORE QUERY: " . pg_last_error($db);
    }
    else{
        echo "Personal Trainer eliminato con successo ";
    }
?>
<script>
    window.location.href = "abbonamento.php";
</script>