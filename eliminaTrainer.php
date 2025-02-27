<?php

    require_once "db.php";

    //CONNESSIONE AL DB
    $db = pg_connect($connection_string) or die('Impossibile connettersi al database: ' . pg_last_error());

    $id = $_GET["id"];
    $fotopath = $_GET["fotopath"];

    $sql= "DELETE FROM personaltrainer where id = $1;";
    $prep = pg_prepare($db, "sqlDeletePT", $sql);
    $ret = pg_execute($db, "sqlDeletePT", array($id));

    if(!$ret) {
        echo "ERRORE QUERY: " . pg_last_error($db);
    }
    else{
        echo "Personal Trainer eliminato con successo ";
    }

    if (file_exists($fotopath) && ($fotopath !="images/personaltrainer/foto_personal_default.png" && $fotopath !="images\personaltrainer\foto_personal_default.png")) { // Controlla se il file esiste
        if (unlink($fotopath)) {  // Elimina il file
            echo "\nImmagine eliminata con successo!";
        } else {
            echo "\nErrore nell'eliminazione dell'immagine.";
        }
    }
?>
<script>
    window.location.href = "abbonamento.php";
</script>