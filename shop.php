<?php 
    session_start(); 

    $admin = FALSE;
    if(isset($_SESSION['admin'])){
        $admin = $_SESSION['admin'];
    }
?>

<?php
// Recupera la categoria tramite GET; altrimenti usa la categoria "tutti"
$categoriaFiltro = $_GET['categoria'] ?? 'tutti';
?>
<!DOCTYPE html> 
<html lang="it"> 
<head>
  <meta charset="UTF-8"> 
  <title>UniSa Gym - Shop</title> 
  <link rel="stylesheet" href="styleSheet/style.css">
  <link rel="stylesheet" href="styleSheet/styleShop.css">
  <link rel="stylesheet" type="text/css" href="stylesheet/formAggiuntaProdotto.css">
  
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
        <li><a href="shop.php?categoria=tutti">Tutti</a></li>
        <li><a href="shop.php?categoria=attrezzatura">Attrezzatura</a></li>
        <li><a href="shop.php?categoria=integratori">Integratori</a></li>
        <li><a href="shop.php?categoria=abbigliamento">Abbigliamento</a></li>
      </ul>
    </div>
    <!-- Area dei prodotti -->
    <div class="area-prodotti">
      <div class="griglia-prodotti">
        <!-- Prodotto 1: Manubri 10kg -->
        <?php if ($categoriaFiltro == 'tutti' || $categoriaFiltro == 'attrezzatura'): ?>
          <div class="scheda-prodotto">
            <img src="images/shop/manubri10kg.jpg" alt="Manubri 10kg">
            <h3>Manubri 10kg</h3>
            <p class="prezzo">€29.99</p>
          </div>
        <?php endif; ?>

        <!-- Prodotto 2: Tapis Roulant -->
        <?php if ($categoriaFiltro == 'tutti' || $categoriaFiltro == 'attrezzatura'): ?>
          <div class="scheda-prodotto">
            <img src="images/shop/tapisroulant.jpg" alt="Tapis Roulant">
            <h3>Tapis Roulant</h3>
            <p class="prezzo">€299.99</p>
          </div>
        <?php endif; ?>

        <!-- Prodotto 3: Cyclette -->
        <?php if ($categoriaFiltro == 'tutti' || $categoriaFiltro == 'attrezzatura'): ?>
          <div class="scheda-prodotto">
            <img src="images/shop/cycletta.jpg" alt="Cyclette">
            <h3>Cyclette</h3>
            <p class="prezzo">€199.99</p>
          </div>
        <?php endif; ?>

        <!-- Prodotto 4: Proteine Whey -->
        <?php if ($categoriaFiltro == 'tutti' || $categoriaFiltro == 'integratori'): ?>
          <div class="scheda-prodotto">
            <img src="images/shop/proteine.jpg" alt="Proteine Whey">
            <h3>Proteine Whey</h3>
            <p class="prezzo">€49.99</p>
          </div>
        <?php endif; ?>

        <!-- Prodotto 5: Creatina Monoidrato -->
        <?php if ($categoriaFiltro == 'tutti' || $categoriaFiltro == 'integratori'): ?>
          <div class="scheda-prodotto">
            <img src="images/shop/creatina.jpg" alt="Creatina Monoidrato">
            <h3>Creatina Monoidrato</h3>
            <p class="prezzo">€19.99</p>
          </div>
        <?php endif; ?>

        <!-- Prodotto 6: Barrette Proteiche -->
        <?php if ($categoriaFiltro == 'tutti' || $categoriaFiltro == 'integratori'): ?>
          <div class="scheda-prodotto">
            <img src="images/shop/barrette.jpg" alt="Barrette Proteiche">
            <h3>Barrette Proteiche</h3>
            <p class="prezzo">€14.99</p>
          </div>
        <?php endif; ?>

        <!-- Prodotto 7: Maglietta Sportiva -->
        <?php if ($categoriaFiltro == 'tutti' || $categoriaFiltro == 'abbigliamento'): ?>
          <div class="scheda-prodotto">
            <img src="images/shop/maglietta.jpg" alt="Maglietta Sportiva">
            <h3>Maglietta Sportiva</h3>
            <p class="prezzo">€19.99</p>
          </div>
        <?php endif; ?>

        <!-- Prodotto 8: Pantaloncini Fitness -->
        <?php if ($categoriaFiltro == 'tutti' || $categoriaFiltro == 'abbigliamento'): ?>
          <div class="scheda-prodotto">
            <img src="images/shop/panataloncini.jpg" alt="Pantaloncini Fitness">
            <h3>Pantaloncini Fitness</h3>
            <p class="prezzo">€24.99</p>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>

  <?php 
    if($admin) {
  ?>
    <div class="container-aggiunta-prodotto">
      <h1>Aggiungi Prodotto</h1>
      <form class="form-aggiungi" action="aggiuntaProdotto.php" method="POST" enctype="multipart/form-data">
        <label for="nome">Nome Prodotto</label>
        <input type="text" id="nome" name="nome" placeholder="Inserisci nome" required>
        <label for="prezzo">Prezzo</label>
        <input type="text" id="prezzo" name="prezzo" placeholder="Inserisci prezzo" required>

        <label for="foto">Foto</label>
        <div id="foto-area">
        <h2>Trascina la foto qui</h2>
        <p>Oppure clicca qui per selezionare un file</p>
        <input type="file" id="foto" name="foto">
        </div>

        <button type="submit" class="pulsante-aggiungi" id="bottone-aggiungi">Aggiungi</button>
      </form>
    </div>
    <?php
      }
    ?>
  <?php include 'footer.html'; ?>
</body>
</html>
