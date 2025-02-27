<?php

    $pagamentoEffettuato = $_POST['pagamentoEffettuato'];

    if($pagamentoEffettuato){
        setcookie('cart', "", time() + 3600, "/");
    }

?>