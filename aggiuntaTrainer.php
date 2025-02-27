<?php

    require_once "db.php";

    //CONNESSIONE AL DB
    $db = pg_connect($connection_string) or die('Impossibile connettersi al database: ' . pg_last_error());

    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    if($_FILES["foto"]){
        $target_dir = "images/personaltrainer/";
        if(basename($_FILES["foto"]["name"]) == '')
        {
            $fotopath = $target_dir . $_POST['fotopath'];
        } else{
            $fotopath = $target_dir . basename($_FILES["foto"]["name"]);
        }
    }
    if($fotopath == "images/personaltrainer/"){
        $fotopath = "images/personaltrainer/foto_personal_default.png";
    }

    insert_trainer($nome,$cognome,$fotopath,$db);
    
    ?>
    <script>
        window.location.href = "abbonamento.php";
    </script>
    <?php

    function insert_trainer($nome,$cognome,$fotopath,$db){

        $sql = "INSERT INTO personaltrainer(nome, cognome, fotopath) VALUES($1, $2, $3)";
        $prep = pg_prepare($db, "insertTrainer", $sql);
        $ret = pg_execute($db, "insertTrainer", array($nome, $cognome, $fotopath));
        if(!$ret) {
            echo "ERRORE QUERY: " . pg_last_error($db);
            return false;
        }
        else{
            return true;
        }
        pg_close($db);
    }
?>