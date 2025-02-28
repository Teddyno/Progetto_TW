<?php 
    session_start(); 

    $admin = FALSE;
    if(isset($_SESSION['admin'])){
        $admin = $_SESSION['admin'];
    }
?>

<script>
function showProdotti(str) {
  if (str == "") {
    str = "tutti";
  }
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("griglia-prodotti").innerHTML = this.responseText;
      }
  };
  xmlhttp.open("GET","tabellaProdotti.php?categoria="+str,true);
  xmlhttp.send();
}
</script>
<!DOCTYPE html> 
<html lang="it"> 
<head>
  <meta charset="UTF-8"> 
  <title>UniSa Gym - Shop</title> 
  <link rel="stylesheet" href="styleSheet/style.css">
  <link rel="stylesheet" href="styleSheet/styleShop.css">
  <link rel="stylesheet" type="text/css" href="stylesheet/formAggiuntaProdotto.css?ts=<?=time()?>&quot">
</head>
<body>
  <?php include 'header.php'; ?>

  <!-- Header della pagina Shop -->
  <header>
    <h1>Shop</h1>
    <p>Benvenuto nel nostro negozio: trova l'attrezzatura, gli integratori e l'abbigliamento perfetto per il tuo allenamento!</p>
  </header>

  <!-- Contenitore principale dello shop -->
  <div class="contenitore-shop">
    <!-- Barra laterale per il filtro -->
    <div class="barra-filtri">
      <h3>Filtra per categoria</h3>
      <ul class="lista-filtri">
        <li><a onclick="showProdotti('')">Tutti</a></li>
        <li><a onclick="showProdotti('attrezzatura')">Attrezzatura</a></li>
        <li><a onclick="showProdotti('abbonamenti')">abbonamenti</a></li>
        <li><a onclick="showProdotti('abbigliamento')">Abbigliamento</a></li>
        <li><a onclick="showProdotti('alimentari')">alimentari</a></li>
      </ul>
    </div>
    <!-- Area dei prodotti -->
    <script>
      showProdotti('');
    </script>
    <div class="area-prodotti">
      <div id="griglia-prodotti">

      </div>
    </div>
  </div>


  <br><br><br>

  <?php 
    if($admin) {
  ?>
    <div class="container-aggiungi-prodotto">
      <h1>Aggiungi Prodotto</h1>
      <form class="form-aggiungi" action="aggiuntaProdotto.php" method="POST" enctype="multipart/form-data">
        <label for="nome">Nome Prodotto</label>
        <input type="text" id="nome" name="nome" placeholder="Inserisci nome" required>
        <label for="prezzo">Prezzo</label>
        <input type="text" id="prezzo" name="prezzo" placeholder="Inserisci prezzo" required>
        <label for="categoria">Scegli una categoria</label>
        <select id="categoria" name="categoria"> 
            <option value="abbigliamento">Abbigliamento</option>
            <option value="abbigliamento">Attrezzatura</option>
            <option value="abbigliamento">Abbonamenti</option>
            <option value="abbigliamento">Alimentari</option>
        </select>
        <label for="foto">Foto</label>
        <div id="foto-area">
            <h2>Foto Prodotto</h2>
            <p id="file-list">Seleziona un file oppure trascinalo qui</p>
            <input type="file" id="foto" name="foto">
        </div>

        <input type="text" id="fotopath" name="fotopath" value='' style="display:none;">

        <button type="submit" class="pulsante-aggiungi" id="bottone-aggiungi">Aggiungi</button>
      </form>
    </div>
    <?php
      }
    ?>
  <?php include 'footer.html'; ?>

  <script src="js/drag_and_drop_shop.js"></script>
  <script src="js/carrello.js"></script>
</body>
</html>
