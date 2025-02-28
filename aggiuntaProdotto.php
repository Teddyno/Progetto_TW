<?php
    require_once "db.php";

    $db = pg_connect($connection_string) or die('Impossibile connettersi al database! ' .pg_last_error());

    $nome = $_POST['nome'];
    $prezzo = $_POST['prezzo'];
    $categoria = $_POST['categoria'];

    if($_FILES["foto"]){
        $target_dir = "images/shop/";
        if(basename($_FILES["foto"]["name"]) == '')
        {
            $fotopath = $target_dir . $_POST['fotopath'];
        } else{
            $fotopath = $target_dir . basename($_FILES["foto"]["name"]);
        }
    }
    
    if($fotopath == "images/shop/"){
        $fotopath = "images/shop/foto_prodotto_default.jpeg";
    }

    insert_prodotto($nome,$prezzo,$categoria,$fotopath,$db);

    ?>
    <script>
        window.location.href = "shop.php";
    </script>
    <?php

    function insert_prodotto($nome,$prezzo,$categoria,$fotopath,$db) {

        $sql = "INSERT INTO prodotti(nome, prezzo, categoria, fotopath) VALUES($1, $2, $3, $4)";
        $prep = pg_prepare($db, "insertProdotto", $sql);
        $ret = pg_execute($db, "insertProdotto", array($nome, $prezzo, $categoria, $fotopath));
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

