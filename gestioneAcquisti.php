<?php

    $pagamentoEffettuato = $_POST['pagamentoEffettuato'];

    if($pagamentoEffettuato){
        $carrello = $_COOKIE['cart'];

        

        setcookie('cart', "", time() + 3600, "/");
    }

?>