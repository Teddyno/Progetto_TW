<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styleSheet/style.css">
    <title>Shop</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
</head>
<body>

    <?php include 'header.php'; ?>

    <style>
            button {
            font-family: Arial, sans-serif; /* Stesso font della pagina */
            font-size: 16px; /* Dimensione del testo */
            font-weight: bold; /* Testo in grassetto */
            color: white; /* Testo bianco */
            background-color: #283b96; /* Blu scuro (colore principale della pagina) */
            border: none; /* Nessun bordo */
            padding: 10px 20px; /* Spaziatura interna */
            margin: 10px; /* Margine per separare i pulsanti */
            border-radius: 8px; /* Angoli arrotondati */
            cursor: pointer; /* Cambia il cursore al passaggio del mouse */
            transition: all 0.3s ease-in-out; /* Effetto di transizione morbida */
        }
        /* Effetto hover (quando il mouse passa sopra) */
        button:hover {
            background-color: #5063BF; /* Blu più chiaro */
            transform: scale(1.05); /* Leggero ingrandimento */
        }

        /* Effetto quando il pulsante viene premuto */
        button:active {
            background-color: #1F2F7A; /* Blu più scuro */
            transform: scale(0.95); /* Leggera riduzione */
        }

        /* Stile specifico per il pulsante "Scarica QR Code" */
        #scaricaQR {
            background-color: #28A745; /* Verde */
        }

        #scaricaQR:hover {
            background-color: #218838; /* Verde più scuro */
        }
        
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            text-align: center;
        }

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
        }

        .shop-container {
            width: 80%;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .filtro-container {
            margin-bottom: 20px;
        }

        select {
            padding: 8px;
            border: 1px solid #283b96;
            border-radius: 5px;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        select:hover {
            background-color: #5063BF;
            color: white;
        }

        .prodotti-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 15px;
        }

        .prodotto {
            background: white;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s;
        }

        .prodotto:hover {
            transform: scale(1.05);
        }

        .prodotto img {
            width: 100%;
            border-radius: 5px;
        }

        .prezzo {
            font-size: 16px;
            font-weight: bold;
            color: #283b96;
        }

        .prodotto button {
            background-color: #5063BF;
            color: white;
            border: none;
            padding: 8px;
            cursor: pointer;
            margin-top: 10px;
            border-radius: 5px;
        }

        .container-sezioni {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 20px auto;
            width: 80%;
        }

        .carrello-container, .legenda-container {
            background: white;
            padding: 15px;
            width: 40%;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .qr-container {
            margin-top: 20px;
            display: none;
        }

        .recap-container {
            text-align: center;
            padding: 10px;
            margin-top: 10px;
            border-top: 1px solid #ddd;
        }

        .legenda-container {
            font-size: 14px;
            line-height: 1.5;
        }
    </style>

    <header>
        <h1>Shop</h1>
        <p>Trova tutto ciò che ti serve per il tuo allenamento</p>
    </header>

    <!-- Contenitore principale del negozio -->
    <div class="shop-container">
        <!-- Filtro per categoria -->
        <div class="filtro-container">
            <label for="categoria">Filtra per categoria:</label> <!-- Testo del filtro -->
            <select id="categoria" onchange="filtraProdotti()"> <!-- Menu a tendina per la selezione -->
                <option value="tutti">Tutti</option> <!-- Mostra tutti i prodotti -->
                <option value="attrezzatura">Attrezzatura</option> <!-- Categoria attrezzatura -->
                <option value="integratori">Integratori</option> <!-- Categoria integratori -->
                <option value="abbigliamento">Abbigliamento</option> <!-- Categoria abbigliamento -->
            </select>
        </div>
        <!-- Contenitore della griglia dei prodotti -->
        <div class="prodotti-grid" id="prodotti-grid"></div> <!-- Contenitore che verrà riempito con i prodotti -->
    </div>
    <div class="container-sezioni">
        <div class="carrello-container">
            <h2>🛒 Carrello</h2>
            <ul id="carrello-lista"></ul>
            <p id="totale">Totale: €0.00</p>
           
            <button onclick="generaQR()">Genera QR Code</button>
            <button onclick="svuotaCarrello()">Svuota Carrello</button>
           

            <div class="recap-container">
                <h3>Prodotti nel carrello:</h3>
                <p id="recap">Nessun prodotto aggiunto</p>
            </div>

            <div class="qr-container">
                <canvas id="qrcode"></canvas>
            </div>

            <button onclick="scaricaQRCode()" id="scaricaQR">Scarica QR Code</button>

        </div>

        <div class="legenda-container">
            <h2>📌 Come funziona?</h2>
            <p>✅ Aggiungi i prodotti che vuoi acquistare.</p>
            <p>✅ Clicca su "Genera QR Code".</p>
            <p>✅ Mostra il QR Code alla reception.</p>
            <p>✅ Il personale scannerizzerà il codice.</p>
            <p>📍 Comodo, veloce e senza bisogno di stampare nulla!</p>
        </div>
    </div>

    <script>

        /**
         * Funzione per filtrare i prodotti in base alla categoria selezionata
         * Cambia la visibilità dei prodotti in base alla categoria scelta dal menu a tendina
         */
        function filtraProdotti() {
            let categoria = document.getElementById("categoria").value; // Ottiene il valore della categoria selezionata
            document.querySelectorAll(".prodotto").forEach(prodotto => { // Seleziona tutti i prodotti
                if (categoria === "tutti" || prodotto.dataset.categoria === categoria) {
                    prodotto.style.display = "block"; // Mostra i prodotti della categoria selezionata
                } else {
                    prodotto.style.display = "none"; // Nasconde gli altri prodotti
                }
            });
        }

        let prodotti = [
            { nome: "Manubri 10kg", categoria: "attrezzatura", prezzo: 29.99, immagine: "images/pt_1.jpg" },
            { nome: "Tapis Roulant", categoria: "attrezzatura", prezzo: 299.99, immagine: "images/pt_1.jpg" },
            { nome: "Cyclette", categoria: "attrezzatura", prezzo: 199.99, immagine: "images/pt_1.jpg" },
            { nome: "Proteine Whey", categoria: "integratori", prezzo: 49.99, immagine: "images/pt_1.jpg" },
            { nome: "Creatina Monoidrato", categoria: "integratori", prezzo: 19.99, immagine: "images/pt_1.jpg" },
            { nome: "Barrette Proteiche", categoria: "integratori", prezzo: 14.99, immagine: "images/pt_1.jpg" },
            { nome: "Maglietta Sportiva", categoria: "abbigliamento", prezzo: 19.99, immagine: "images/pt_1.jpg" },
            { nome: "Pantaloncini Fitness", categoria: "abbigliamento", prezzo: 24.99, immagine: "images/pt_1.jpg" }
];


        let container = document.getElementById("prodotti-grid");
        let carrello = [];      

        // Crea dinamicamente i prodotti e li aggiunge alla griglia
        prodotti.forEach(prod => {
            let prodottoDiv = document.createElement("div"); // Crea un div per il prodotto
            prodottoDiv.className = "prodotto"; // Aggiunge la classe CSS
            prodottoDiv.setAttribute("data-categoria", prod.categoria); // Assegna la categoria come attributo

            prodottoDiv.innerHTML = `
                <img src="${prod.immagine}" alt="${prod.nome}"> <!-- Mostra l'immagine del prodotto -->
                <h3>${prod.nome}</h3> <!-- Nome del prodotto -->
                <span class="prezzo">€${prod.prezzo.toFixed(2)}</span> <!-- Prezzo del prodotto -->
                <button onclick="aggiungiAlCarrello('${prod.nome}', ${prod.prezzo})">Aggiungi al carrello</button> <!-- Pulsante per aggiungere al carrello -->
            `;

            container.appendChild(prodottoDiv); // Aggiunge il prodotto al contenitore della griglia
        });
        
        /**
        * Aggiunge un prodotto al carrello e aggiorna il totale
        */
        function aggiungiAlCarrello(nome, prezzo) {
            carrello.push({ nome, prezzo });
            aggiornaCarrello();
        }

        /**
         * Aggiorna il carrello, mostrando i prodotti selezionati e il totale
         */
        function aggiornaCarrello() {
            let recap = document.getElementById("recap");
            let lista = document.getElementById("carrello-lista"); // Seleziona la lista del carrello
            lista.innerHTML = ""; // Svuota la lista per aggiornarla
            let totale = 0; // Inizializza il totale
            carrello.forEach(item => {
                let li = document.createElement("li"); // Crea un elemento lista
                li.textContent = `${item.nome} - €${item.prezzo.toFixed(2)}`; // Aggiunge il nome e il prezzo del prodotto
                lista.appendChild(li); // Aggiunge il prodotto alla lista
                totale += item.prezzo; // Aggiunge il prezzo al totale
            });

            recap.innerText = carrello.length > 0 ? carrello.map(p => p.nome).join(", ") : "Nessun prodotto aggiunto";
            document.getElementById("totale").innerText = `Totale: €${totale.toFixed(2)}`;  // Aggiorna il totale
        }

        function svuotaCarrello() {
            carrello = [];
            aggiornaCarrello();
            document.querySelector(".qr-container").style.display = "none";
        }

        function scaricaQRCode() {
            let canvas = document.getElementById("qrcode"); // Prende il QR Code generato
            let link = document.createElement("a"); // Crea un link per il download
            link.href = canvas.toDataURL("image/png"); // Converte il QR in immagine PNG
            link.download = "QR_Code.png"; // Nome del file da scaricare
            link.click(); // Simula il click per avviare il download
        }

        function generaQR() {
           /* document.querySelector(".qr-container").style.display = "block";
            new QRious({
                element: document.getElementById("qrcode"),
                value: carrello.map(p => p.nome).join(", "),
                size: 200
            });
            */ 
            let qr = new QRious({
                element: document.getElementById("qrcode"), // Seleziona il canvas
                value: carrello.map(p => p.nome).join(", "), // Contenuto del QR Code
                size: 200 // Dimensione del QR
            });

            document.querySelector(".qr-container").style.display = "block"; // Mostra il QR Code
            document.getElementById("scaricaQR").style.display = "block"; // Mostra il pulsante di download        
        }
    </script>

    <?php include 'footer.html'; ?>
</body>
</html>
