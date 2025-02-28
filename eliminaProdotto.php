<?php
    require_once "db.php";

    $db = pg_connect($connection_string) or die('Impossibile connettersi al server: '. pg_last_error());

    $id = $_GET["id"];
    $fotopath = $_GET["fotopath"];

    $sql = "DELETE FROM prodotti where idprodotto = $1";
    $prep = pg_prepare($db, "sqlDeletePR", $sql);
    $ret = pg_execute($db, "sqlDeletePR", array($id));

    if(!$ret) {
        echo "Errore nella query: " . pg_last_error($db);
    } else {
        echo "Prodotto eliminato con successo ";
    }

    if (file_exists($fotopath) && ($fotopath !="images/shop/foto_prodotto_default.png" && $fotopath !="images\shop\\foto_prodotto_default.png")) { // Controlla se il file esiste
        if (unlink($fotopath)) {  
            echo "\nImmagine eliminata con successo!";
        } else {
            echo "\nErrore nell'eliminazione dell'immagine.";
        }
    }
?>

<script>
    window.location.href = "shop.php";
</script>