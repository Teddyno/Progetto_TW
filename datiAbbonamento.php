<?php
    error_reporting(E_ALL ^ E_NOTICE);  
    session_start();

    $id = $_SESSION['idIscritto'];

    require "db.php";

    $db = pg_connect($connection_string) or die('Impossibile connettersi al database: ' . pg_last_error());

    $sql = "SELECT dataiscrizione, tipoabbonamento, datascadenza FROM datiabbonamento WHERE idiscritto = '$id';";
    $ret = pg_query($db, $sql); 
    if(!$ret) {
        echo "ERRORE QUERY: " . pg_last_error($db);
        exit; 
    }
    
    if(pg_num_rows($ret) != 0){
        $dataIscrizione = pg_fetch_result($ret, 0, 'dataIscrizione');
        $tipoAbbonamento = pg_fetch_result($ret, 0, 'tipoAbbonamento');
        $dataScadenza = pg_fetch_result($ret, 0, 'dataScadenza');
    }else{
        echo "Non hai ancora un abbonamento, inserisci il tuo abbonamento";
    }

    pg_close($db);
?>