<!DOCTYPE html> 
<html lang="it"> 
<head>
  <meta charset="UTF-8"> 
  <title>UniSa Gym - Shop</title> 
  <link rel="stylesheet" href="styleSheet/style.css">
  <style>


    /* Stile di base per il body */
    body {
      font-family: Arial, sans-serif;        
      background-color: #f4f4f4;           /* Sfondo grigio chiaro */
      text-align: center;                    /* Centra il testo globalmente */
    }

    /* Header della pagina */
    header {
      margin-top: 30px;
      padding: 20px 0;
    }
    header h1 {
      font-size: 32px;
      font-weight: bold;
      color: #283b96;
      margin-bottom: 5px;
    }
    header p {
      font-size: 18px;
      opacity: 0.7;
      margin-top: 10px;
      text-align: center;
    }

    /* Layout principale dello shop: due colonne (barra dei filtri e area dei prodotti) */
    .contenitore-shop {
      width: 80%;
      margin: 20px auto;
      background: white;
      padding: 20px;
      border-radius: 10px;
      display: flex; /* Allinea e distribuisce elementi di un contenitore */
      gap: 20px;
      text-align: left;
    }

    /* Barra laterale dei filtri */
    .barra-filtri {
      width: 250px;
      padding: 10px;
      border-right: 1px solid #ddd;
    }
    .barra-filtri h3 {
      margin-bottom: 15px;
    }
    .lista-filtri {
      list-style: none;
      padding: 0;
    }
    .lista-filtri li {
      padding: 8px;
      margin-bottom: 5px;
      border: 1px solid #283b96;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    .lista-filtri li a {
      text-decoration: none;
      color: inherit;
      display: block;
    }
    .lista-filtri li:hover {
      background-color: #5063BF;
      color: white;
    }

    /* Area dei prodotti */
    .area-prodotti {
      flex: 1;
      padding-left: 20px;
    }
    /* Layout a griglia: più prodotti per riga */
    .griglia-prodotti {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));  /* Ogni prodotto occuperà almeno 250px, con più colonne se lo spazio lo consente */
      gap: 20px;
    }
    .scheda-prodotto {
      background: white;
      padding: 10px;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
      text-align: center;
    }
    .scheda-prodotto img {
      width: 100%;
      border-radius: 5px;
    }
    .scheda-prodotto h3 {
      font-size: 20px;
      margin: 10px;
    }
    .prezzo {
      font-size: 16px;
      font-weight: bold;
      color: #283b96;
    }
  </style>
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
