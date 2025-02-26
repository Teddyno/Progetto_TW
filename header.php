<?php
    error_reporting(E_ALL ^ E_NOTICE); 
    session_start();

    $accesso = FALSE;
    if(isset($_SESSION['autenticato'])){
        $accesso = $_SESSION['autenticato'];
    }

    require_once 'carrello.php';
?>

<!DOCTYPE html>
    <header id="header1">
        <div class="header">
            <div><a href="index.php"><img src="images/UnisaGym_logo1.png" style="height: 50px"></a></div>
            <div class="topnav">
                <a href="abbonamento.php" style="color:white">Abbonamento</a>
                <a href="shop.php" style="color:white">Shop</a>
                <a href="ChiSiamo.php" style="color:white">Chi Siamo</a>
                <a onclick='openCart()'><img src='images/carrello.png' class="bottone-carrello" ></a>
                <!-- <button class='btn' id='cartbtn' >". 
                    class='fa-solid fa-cart-shopping fa-beat'-->
                
                <!-- </button> -->
                <?php
                    if($accesso){
                        echo "<a href=\"profilo.php\">";
                    } else {
                        echo "<a href=\"login.php\">";
                    }
                ?>
                <img src="images/icona_profilo.png" height="20px"></a>
                
            </div>
        </div>

        <script src="js/header.js"></script>

    </header>
</html>
