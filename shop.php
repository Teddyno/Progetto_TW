<!DOCTYPE html> 
<html lang="it"> 
<head>
  <meta charset="UTF-8"> 
  <title>UniSa Gym - Shop</title> 
  <link rel="stylesheet" href="styleSheet/style.css">
  <link rel="stylesheet" href="styleSheet/styleShop.css">
  
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
        <li><a href="shop.php">Tutti</a></li>
        <li><a href="shop.php">Attrezzatura</a></li>
        <li><a href="shop.php">Integratori</a></li>
        <li><a href="shop.php">Abbigliamento</a></li>
      </ul>
    </div>
    <!-- Area dei prodotti -->
    <div class="area-prodotti">
      <div class="griglia-prodotti">
        <!-- Prodotto 1: Manubri 10kg -->
          <div class="scheda-prodotto">
            <img src="images/shop/manubri10kg.jpg" alt="Manubri 10kg">
            <h3>Manubri 10kg</h3>
            <p class="prezzo">€29.99</p>
          </div>

        <!-- Prodotto 2: Tapis Roulant -->
          <div class="scheda-prodotto">
            <img src="images/shop/tapisroulant.jpg" alt="Tapis Roulant">
            <h3>Tapis Roulant</h3>
            <p class="prezzo">€299.99</p>
          </div>

        <!-- Prodotto 3: Cyclette -->
          <div class="scheda-prodotto">
            <img src="images/shop/cycletta.jpg" alt="Cyclette">
            <h3>Cyclette</h3>
            <p class="prezzo">€199.99</p>
          </div>

        <!-- Prodotto 4: Proteine Whey -->
          <div class="scheda-prodotto">
            <img src="images/shop/proteine.jpg" alt="Proteine Whey">
            <h3>Proteine Whey</h3>
            <p class="prezzo">€49.99</p>
          </div>

        <!-- Prodotto 5: Creatina Monoidrato -->
          <div class="scheda-prodotto">
            <img src="images/shop/creatina.jpg" alt="Creatina Monoidrato">
            <h3>Creatina Monoidrato</h3>
            <p class="prezzo">€19.99</p>
          </div>

        <!-- Prodotto 6: Barrette Proteiche -->
          <div class="scheda-prodotto">
            <img src="images/shop/barrette.jpg" alt="Barrette Proteiche">
            <h3>Barrette Proteiche</h3>
            <p class="prezzo">€14.99</p>
          </div>

        <!-- Prodotto 7: Maglietta Sportiva -->
          <div class="scheda-prodotto">
            <img src="images/shop/maglietta.jpg" alt="Maglietta Sportiva">
            <h3>Maglietta Sportiva</h3>
            <p class="prezzo">€19.99</p>
          </div>

        <!-- Prodotto 8: Pantaloncini Fitness -->
          <div class="scheda-prodotto">
            <img src="images/shop/panataloncini.jpg" alt="Pantaloncini Fitness">
            <h3>Pantaloncini Fitness</h3>
            <p class="prezzo">€24.99</p>
          </div>
      </div>
    </div>
  </div>

  <?php include 'footer.html'; ?>
</body>
</html>
