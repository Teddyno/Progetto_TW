<?php
/**
 * Questo script viene utilizzato per eliminare un elemento dal carrello specificato da una richiesta di tipo POST.
 * FUNZIONAMENTO:
 * Viene aperta una sessione.
 * Vi realizza una decodifica del cookie 'cart' e lo si associa all'array cart.
 * Per ogli elemento dell'array cart se si verifica se l'id è lo stesso della richiesta. In caso positivo lo si rimuove dal carrello.
 * Si aggiorna il carrello con il carrello modificato e codificato in json.
 */
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

    //header("Location: " . $_SERVER['HTTP_REFERER']); // Puoi scommentare questa linea se vuoi ridirezionare l'utente
}
?>
