<?php
    require_once "db.php";

    $db = pg_connect($connection_string) or die('Impossibile connettersi al database! ' .pg_last_error());

    $nome = $_POST['nome'];
    $prezzo = $_POST['prezzo'];
    $categoria = $_POST['categoria'];
    $cfotopath = $_POST['fotopath'];
    if($_FILES["foto"]) {
        $target_dir = "images/shop/";
        $fotopath = $target_dir .basename($_FILES["foto"]["name"]);
    } else {
        $fotopath = "images/shop/foto_profilo_default.png";
    }

    insert_prodotto($nome,$prezzo,$fotopath,$db);

    ?>
    <script>
        window.location.href = "shop.php";
    </script>
    <?php

    function insert_prodotto($nome,$prezzo,$fotopath,$db) {

        $sql = "INSERT_INTO prodotto(nome, prezzo, fotopath) VALUES($1, $2, $3)";
        $prep = pg_prepare($db, "insertProdotto", $sql);
        $ret = pg_execute($db, "insertProdotto", array($nome, $prezzo, $fotopath));
        if(!$ret) {
            echo "ERRORE QUERY: " . pg_last_error($db);
            return false;
        }
        else {
            return true;
        }
        pg_close($db);
    }
?>

