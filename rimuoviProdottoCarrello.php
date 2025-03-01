<?php

session_start();
if (isset($_POST['id']) && isset($_COOKIE['cart'])) {
    $id = $_POST['id'];
    $cart = json_decode($_COOKIE['cart'], true); // true per ottenere un array associativo

    
    // Cerca il prodotto nel carrello e rimuovilo
    foreach ($cart as $key => $value) {
        if ($value['idprodotto'] == $id) {
            unset($cart[$key]);
            break;
        }
    }

    // aggiorna il carrello nei cookie
    $cart = array_values($cart);
    setcookie('cart', json_encode($cart), time() + 3600, "/");

    // Restituisci lo stato del carrello
    echo json_encode(['cartEmpty' => empty($cart)]);
}
?>
