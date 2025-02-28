<?php
/*
 * il carrello è un array di informazioni,
 * informaazioni che sono a loro volta array
 * in fine il carrello è salvato in stringa con encoder json nei cookie
 */
session_start();

// Connessione al database
require_once "db.php";
$db = pg_connect($connection_string) or die('Impossibile connettersi al database! ' .pg_last_error());

$id = $_POST['id'];
$query = "SELECT * FROM prodotti WHERE idprodotto=$1";

$return = pg_query_params($db, $query, array($id)) or die('Errore: ' . pg_last_error($db));
$prodotto = pg_fetch_assoc($return);
pg_close($db);

// Se il carrello non esiste nei cookie lo crea vuoto altrimenti decoder
if (isset($_COOKIE['cart'])) {
    $cart = json_decode($_COOKIE['cart'], true);
} else {
    $cart = [];
}

$info = array(
    "nome" => $prodotto['nome'],
    "prezzo" => $prodotto['prezzo'],
    "idprodotto" => $prodotto['idprodotto'],
    "fotopath" => $prodotto['fotopath'],
    "quantita" => 1
);
    $quantita=1;
    $multipli = false;
    foreach ($cart as &$sottoarray) {
        if ($sottoarray['idprodotto'] == $prodotto['idprodotto']) {
            $multipli = true;
            $sottoarray['quantita']++;
            $quantita=$sottoarray['quantita'];
            break;
        }
    }

    if (!$multipli) {
        $cart[] = $info;
    }

    setcookie('cart', json_encode($cart), time() + 3600, "/");

    echo $quantita;
    //header("Location: " . $_SERVER['HTTP_REFERER']);
    
?>