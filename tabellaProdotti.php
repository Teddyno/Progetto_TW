
<?php
$categoria =$_GET['categoria'];
$admin = $_GET['admin'];
require_once "./db.php";
$db = pg_connect($connection_string) or die('Impossibile connettersi al database: ' . pg_last_error());

if($categoria == "tutti"){
    $sql = "SELECT * FROM prodotti";
    $ret = pg_query($db, $sql);
} else{
    $sql = "SELECT * FROM prodotti WHERE categoria= $1;";
    $prep = pg_prepare($db, "sqlProdotti", $sql);
    $ret = pg_execute($db, "sqlProdotti", array($categoria));
}

while($row = pg_fetch_array($ret)) {
    if($admin == 'true'){
        echo    "<div class='scheda-prodotto'>
                <div class='tasti-prodotto'>
                    <a href='eliminaProdotto.php?id=".$row['idprodotto']."&fotopath=".$row['fotopath']."' onclick='return confirm(\"Sei sicuro di voler eliminare questo prodotto?\");'>
                        <img src='images/cestino.png'></a>
                </div>
                <img src=".$row['fotopath']." alt=".$row['nome'].">
                <h3>".$row['nome']."</h3>
                <p class='prezzo'>".$row['prezzo']."$</p>
                <button type='submit' class='pulsante-aggiunta-carrello'
                                        id='pulsante-aggiunta-carrello'
                                        onclick='ajaxAggiuntaCarrello(".$row['idprodotto'].",\"".$row['nome']."\",".$row['prezzo'].",\"".$row['fotopath']."\")'>Acquista</button>
            </div>";
    }else{
        echo    "<div class='scheda-prodotto'>
                    <img src=".$row['fotopath']." alt=".$row['nome'].">
                    <h3>".$row['nome']."</h3>
                    <p class='prezzo'>".$row['prezzo']."$</p>
                    <button type='submit' class='pulsante-aggiunta-carrello'
                                            id='pulsante-aggiunta-carrello'
                                            onclick='ajaxAggiuntaCarrello(".$row['idprodotto'].",\"".$row['nome']."\",".$row['prezzo'].",\"".$row['fotopath']."\")'>Acquista</button>
                </div>";
    }
    
}
pg_close($db);
?>
</body>
</html>
