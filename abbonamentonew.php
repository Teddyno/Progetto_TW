<?php
// abbonamenti.php

// Includi l'header del sito (rimane invariato)
include 'header.php';
?>
<!DOCTYPE html>
<html lang="it">
<head>
  <!-- Imposta la codifica dei caratteri -->
  <meta charset="UTF-8">
  <!-- Configura il viewport per dispositivi mobili -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Imposta il titolo della pagina -->
  <title>UniSa Gym - Abbonamenti & Personal</title>
  <!-- Collega il foglio di stile globale (se presente) -->
  <link rel="stylesheet" href="styleSheet/style.css">
  <style>
    /* ======================================================
       CSS per la pagina Abbonamenti & Personal
       ====================================================== */

    /* Stile di base per il body */
    body {
      font-family: Arial, sans-serif;   /* Imposta il font di base */
      margin: 0;                        /* Rimuove margini di default */
      padding: 0;                       /* Rimuove padding di default */
      background-color: #f4f4f4;          /* Sfondo grigio chiaro */
      text-align: center;               /* Centra il testo globalmente */
      color: #333;                      /* Colore del testo */
    }

    /* Stile per il titolo della pagina (non il file header.php) */
    .page-header {
      background: none;                 /* Rimuove eventuale fondo blu */
      padding: 20px 0;                  /* Padding verticale */
      margin-bottom: 20px;              /* Spazio inferiore */
    }
    .page-header h1 {
      font-size: 36px;                  /* Dimensione del titolo */
      margin: 0;                        /* Nessun margine */
      color: #283b96;                   /* Colore del titolo */
    }
    .page-header p {
      font-size: 18px;                  /* Dimensione del sottotitolo */
      margin-top: 10px;                 /* Margine superiore */
      color: #333;                      /* Colore del testo */
    }

    /* Contenitore principale che ospita le sezioni */
    .container {
      width: 90%;                       /* Larghezza 90% della finestra */
      max-width: 1200px;                /* Larghezza massima */
      margin: 40px auto;                /* Centra il contenitore verticalmente */
      background: #fff;                 /* Sfondo bianco */
      padding: 40px;                    /* Padding interno */
      border-radius: 10px;              /* Arrotonda gli angoli */
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); /* Ombreggiatura */
      text-align: center;               /* Centra il testo all'interno */
    }

    /* ======================================================
       Sezione Abbonamenti
       ====================================================== */
    #abbonamenti {
      margin-bottom: 60px;              /* Spazio inferiore tra le sezioni */
    }
    #abbonamenti h2 {
      font-size: 28px;                  /* Dimensione del titolo della sezione */
      margin-bottom: 10px;              /* Spazio sotto il titolo */
      color: #283b96;                   /* Colore del titolo */
    }
    #abbonamenti p {
      font-size: 18px;                  /* Dimensione del testo descrittivo */
      margin-bottom: 30px;              /* Spazio inferiore */
      color: #555;                      /* Colore del testo */
    }
    /* Griglia degli abbonamenti */
    .grid-abbonamenti {
      display: flex;                    /* Utilizza Flexbox */
      flex-wrap: wrap;                  /* Permette il wrapping su più righe */
      justify-content: center;          /* Centra le schede */
      gap: 20px;                        /* Spazio tra le schede */
    }
    /* Scheda singola di abbonamento */
    .abbonamento {
      background: #eaeaea;              /* Sfondo della scheda */
      flex: 1 1 250px;                  /* Dimensione flessibile minima */
      max-width: 300px;                 /* Larghezza massima */
      padding: 20px;                    /* Padding interno */
      border-radius: 10px;              /* Arrotonda gli angoli */
      transition: transform 0.3s, box-shadow 0.3s; /* Effetti di transizione */
    }
    .abbonamento:hover {
      transform: translateY(-5px);      /* Solleva la scheda al passaggio del mouse */
      box-shadow: 0 6px 15px rgba(0,0,0,0.2); /* Aggiunge ombra */
    }
    .abbonamento .durata {
      display: block;                   /* Mostra il numero su una nuova riga */
      font-size: 48px;                  /* Dimensione del numero */
      font-weight: bold;                /* Testo in grassetto */
      color: #283b96;                   /* Colore del numero */
      margin-bottom: 10px;              /* Spazio inferiore */
    }
    .abbonamento .testo-mesi {
      font-size: 20px;                  /* Dimensione del testo "Mesi" */
      margin-bottom: 20px;              /* Spazio inferiore */
      color: #283b96;                   /* Colore del testo */
    }
    .abbonamento .prezzo {
      font-size: 32px;                  /* Dimensione del prezzo */
      font-weight: bold;                /* Testo in grassetto */
      color: #FFD700;                   /* Colore oro */
      margin-bottom: 20px;              /* Spazio inferiore */
    }
    .abbonamento button {
      background: #283b96;              /* Colore di sfondo del pulsante */
      color: #fff;                      /* Testo bianco */
      border: none;                     /* Nessun bordo */
      padding: 10px 20px;               /* Padding interno */
      font-size: 18px;                  /* Dimensione del testo */
      border-radius: 5px;               /* Arrotondamento */
      cursor: pointer;                  /* Cursore a puntatore */
      transition: background 0.3s;      /* Transizione per il colore */
    }
    .abbonamento button:hover {
      background: #5063BF;              /* Colore al passaggio del mouse */
    }

    /* ======================================================
       Sezione Personal Trainer (rinominata "Personal")
       ====================================================== */
    #personal {
      margin-top: 60px;                 /* Spazio sopra la sezione */
    }
    #personal h2 {
      font-size: 28px;                  /* Dimensione del titolo della sezione */
      margin-bottom: 10px;              /* Spazio sotto il titolo */
      color: #283b96;                   /* Colore del titolo */
    }
    #personal p {
      font-size: 18px;                  /* Dimensione del testo descrittivo */
      margin-bottom: 30px;              /* Spazio inferiore */
      color: #555;                      /* Colore del testo */
    }
    /* Griglia dei Personal Trainer */
    .trainer-grid {
      display: flex;                    /* Utilizza Flexbox */
      flex-wrap: wrap;                  /* Permette il wrapping */
      justify-content: center;          /* Centra le schede */
      gap: 30px;                        /* Spazio tra le schede */
    }
    /* Scheda singola per un Personal Trainer */
    .trainer {
      background: #5063BF;              /* Sfondo blu della scheda */
      width: 250px;                     /* Larghezza fissa */
      padding: 20px;                    /* Padding interno */
      border-radius: 8px;               /* Arrotondamento degli angoli */
      text-align: center;               /* Centra il contenuto */
      color: white;                     /* Testo bianco */
      transition: transform 0.3s, box-shadow 0.3s; /* Effetti di transizione */
    }
    .trainer:hover {
      transform: translateY(-5px);      /* Solleva la scheda al passaggio del mouse */
      box-shadow: 0 6px 15px rgba(0,0,0,0.2); /* Aggiunge ombra */
    }
    .trainer img {
      width: 120px;                     /* Larghezza fissa dell'immagine */
      height: 120px;                    /* Altezza fissa */
      border-radius: 50%;               /* Forma circolare */
      object-fit: cover;                /* Riempi il contenitore mantenendo le proporzioni */
      border: 3px solid #FFD700;        /* Bordo oro */
      margin-bottom: 10px;              /* Spazio sotto l'immagine */
    }
    .trainer .nome-trainer {
      font-size: 18px;                  /* Dimensione del nome */
      font-weight: bold;                /* Testo in grassetto */
      margin-bottom: 5px;               /* Spazio inferiore */
    }
    .trainer .orari {
      margin-top: 10px;                 /* Spazio sopra la tabella degli orari */
      font-size: 14px;                  /* Dimensione del testo */
      background: #3E4E9C;              /* Sfondo scuro per la tabella */
      padding: 8px;                    /* Padding interno */
      border-radius: 5px;              /* Arrotondamento */
    }
    .trainer .orari table {
      width: 100%;                    /* Larghezza della tabella */
      border-collapse: collapse;     /* Collassa i bordi */
      color: white;                   /* Testo bianco */
    }
    .trainer .orari th, .trainer .orari td {
      border: 1px solid #FFF;         /* Bordo bianco per le celle */
      padding: 5px;                   /* Padding nelle celle */
    }
    .trainer .orari th {
      background: #FFD700;            /* Sfondo oro per l'intestazione */
      color: #283b96;                 /* Testo blu scuro per l'intestazione */
    }
  </style>
</head>
<body>
  <?php include 'header.php'; ?>  <!-- Includi l'header invariato -->

  <!-- Header principale della pagina (localmente definito) -->
  <div class="page-header">
    <h1>UniSa Gym</h1>
    <p>Benvenuto nel nostro mondo di benessere e forma fisica!</p>
  </div>

  <!-- Contenitore principale per le sezioni -->
  <div class="container">
    <!-- Sezione Abbonamenti -->
    <section id="abbonamenti">
      <!-- Titolo della sezione Abbonamenti -->
      <h2>Abbonamenti</h2>
      <!-- Sottotitolo della sezione Abbonamenti -->
      <p>Scegli il piano che fa per te e inizia il tuo percorso verso il benessere!</p>
      <!-- Griglia degli abbonamenti -->
      <div class="grid-abbonamenti">
        <!-- Abbonamento 12 Mesi -->
        <div class="abbonamento">
          <span class="durata">12</span>
          <span class="testo-mesi">Mesi</span>
          <span class="prezzo">€99,99</span>
          <button>Iscriviti Ora</button>
        </div>
        <!-- Abbonamento 6 Mesi -->
        <div class="abbonamento">
          <span class="durata">6</span>
          <span class="testo-mesi">Mesi</span>
          <span class="prezzo">€59,99</span>
          <button>Iscriviti Ora</button>
        </div>
        <!-- Abbonamento 2 Mesi -->
        <div class="abbonamento">
          <span class="durata">2</span>
          <span class="testo-mesi">Mesi</span>
          <span class="prezzo">€19,99</span>
          <button>Iscriviti Ora</button>
        </div>
      </div>
    </section>

    <!-- Sezione Personal Trainer (rinominata "Personal") -->
    <section id="personal">
      <!-- Titolo della sezione Personal -->
      <h2>Personal</h2>
      <!-- Sottotitolo della sezione Personal -->
      <p>I nostri esperti sono qui per aiutarti a raggiungere i tuoi obiettivi!</p>
      <!-- Griglia dei Personal Trainer -->
      <div class="trainer-grid">
        <!-- Trainer 1 -->
        <div class="trainer">
          <img src="images/pt_1.jpg" alt="Foto Marco Bianchi">
          <div class="nome-trainer">Marco Bianchi</div>
          <!-- Tabella degli orari -->
          <div class="orari">
            <table>
              <tr>
                <th>Giorno</th>
                <th>Orario</th>
              </tr>
              <tr>
                <td>Lunedì</td>
                <td>10:00 - 12:00</td>
              </tr>
              <tr>
                <td>Mercoledì</td>
                <td>14:00 - 16:00</td>
              </tr>
              <tr>
                <td>Venerdì</td>
                <td>18:00 - 20:00</td>
              </tr>
            </table>
          </div>
        </div>
        <!-- Trainer 2 -->
        <div class="trainer">
          <img src="images/pt_2.jpg" alt="Foto Luca Rossi">
          <div class="nome-trainer">Luca Rossi</div>
          <!-- Tabella degli orari -->
          <div class="orari">
            <table>
              <tr>
                <th>Giorno</th>
                <th>Orario</th>
              </tr>
              <tr>
                <td>Martedì</td>
                <td>09:00 - 11:00</td>
              </tr>
              <tr>
                <td>Giovedì</td>
                <td>15:00 - 17:00</td>
              </tr>
              <tr>
                <td>Sabato</td>
                <td>10:00 - 12:00</td>
              </tr>
            </table>
          </div>
        </div>
        <!-- Trainer 3 -->
        <div class="trainer">
          <img src="images/pt_3.jpg" alt="Foto Andrea Verdi">
          <div class="nome-trainer">Andrea Verdi</div>
          <!-- Tabella degli orari -->
          <div class="orari">
            <table>
              <tr>
                <th>Giorno</th>
                <th>Orario</th>
              </tr>
              <tr>
                <td>Lunedì</td>
                <td>16:00 - 18:00</td>
              </tr>
              <tr>
                <td>Mercoledì</td>
                <td>09:00 - 11:00</td>
              </tr>
              <tr>
                <td>Venerdì</td>
                <td>17:00 - 19:00</td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </section>
  </div>

  <?php include 'footer.html'; ?>  <!-- Includi il footer invariato -->
</body>
</html>
