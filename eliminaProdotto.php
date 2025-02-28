<?php
    require_once "db.php";

    $db = pg_connect($connection_string) or die('Impossibile connettersi al server: '. pg_last_error());

    $id = $_GET["id"];
    $fotopath = $_GET["fotopath"];

    $sql = "DELETE FROM personaltrainer where id = $1";
    $prep = pg_prepare($db, "sqlDeletePR", $sql);
    $ret = pg_execute($db, "sqlDeletePR", array($id));

    if(!$ret) {
        echo "Errore nella query: " . pg_last_error($db);
    } else {
        echo "Prodotto eliminato con successo ";
    }
?>

<script>
    window.location.href = "shop.php";
</script>