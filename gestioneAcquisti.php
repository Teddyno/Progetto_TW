<?php
    session_start();

    $id = $_SESSION['idIscritto'];

    $pagamentoEffettuato = $_GET['pagamentoEffettuato'];

    if($pagamentoEffettuato){
        $carrello = json_decode($_COOKIE['cart'], true);
        foreach ($carrello as $key => $value) {
            $nome = $value['nome'];
            if(str_contains($nome, 'Abbonamento') || str_contains($nome, 'abbonamento')){
                $array_stringa = explode(' ',$nome);
                $tipo_abbonamento =strtolower($array_stringa[1]); 

                $data_attuale = date('Y-m-d',time());

                switch($tipo_abbonamento) {
                    case 'annuale':
                    case 'Annuale':
                        $giorniTotali = 365;
                        break;
                    case 'semestrale':
                    case 'Semestrale':
                        $giorniTotali = 180;
                        break;
                    case 'trimestrale':
                    case 'Trimestrale':
                        $giorniTotali = 90;
                        break;
                    case 'mensile':
                    case 'Mensile':
                        $giorniTotali = 30;
                        break;
                    default:
                        $giorniTotali = 0;
                    }
                $data_scadenza = date('Y-m-d',time()+(60*60*24*$giorniTotali));

                inserimentoAbbonamento($id,$data_attuale,$tipo_abbonamento,$data_scadenza);
                break;
            } 
        }
    }

    setcookie('cart', "", time() + 3600, "/");
    ?>
    <script>
        window.location.href = 'index.php?pagamentoEffettuato=true';
    </script>
    <?php


    function inserimentoAbbonamento($id,$data_attuale,$tipo_abbonamento,$data_scadenza) {

        require_once "db.php";

        $db = pg_connect($connection_string) or die('Impossibile connettersi al database! ' .pg_last_error());

        $sql = "INSERT INTO datiabbonamento( idiscritto, dataiscrizione, tipoabbonamento, datascadenza) VALUES($1, $2, $3, $4)";
        $prep = pg_prepare($db, "insertAbbonamento", $sql);
        $ret = pg_execute($db, "insertAbbonamento", array($id,$data_attuale,$tipo_abbonamento,$data_scadenza));
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