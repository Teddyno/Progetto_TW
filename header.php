<?php
    error_reporting(E_ALL ^ E_NOTICE); 
    session_start();

    $accesso = FALSE;
    $admin = FALSE;
    if(isset($_SESSION['autenticato'])){
        $accesso = $_SESSION['autenticato'];
        if(isset($_SESSION['admin'])){
            $admin = $_SESSION['admin'];  
        }
    }

    require_once 'carrello.php';
?>

<!DOCTYPE html>
    <header id="header1">
        <div class="header">
            <div><a href="index.php"><img src="images/UnisaGym_logo1.png" style="height: 50px"></a></div>
            <div class="topnav">
                <a href="servizi.php" style="color:white">Servizi</a>
                <a href="shop.php" style="color:white">Shop</a>
                <a href="ChiSiamo.php" style="color:white">Chi Siamo</a>
                <a onclick='openCart()'><img src='images/carrello.png' class="bottone-carrello" ></a>
                <?php if($admin){ ?>
                    <button class="bottone-log-out" onclick="logout()"> <img src="images/logout">
                    </button>
                <?php
                    }else{
                        if($accesso){
                            echo "<a href=\"profilo.php\">";
                        } else {
                            echo "<a href=\"login.php\">";
                        }
                ?>
                        <img src="images/icona_profilo.png" height="20px"></a>
                <?php } ?>
            </div>
        </div>
        
        <script>
            function logout(){
                window.location.href = "logout.php";
            }
        </script>
        <script src="js/header.js"></script>

    </header>
</html>
