<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styleSheet/style.css">
    <title>Profilo</title>
</head>
<body>
    <?php include 'header.php'; ?>

    <header class="indice">
        <a href="#section1">Dati Personali</a>
        <a href="#section2">abbonamento</a>
        <a href="#section3">Sicurezza</a>
        <a href="#section4">Log out</a>
    </header>
    <div class="contenitore-profilo">
        <section class="section-profilo" id="section1">
            <div class="dettagli-info">
                <p class="titolo-info">Dati Personali</p>
                <p>Nome : Giorgo </p>
                <p>Cognome : Cappello</p>
                <p>Data di nascita : 12/03/2004</p>
            </div>
        </section>
        <section class="section-profilo" id="section2">
            <div class="dettagli-info">
                <p class="titolo-info">abbonamento</p>
                <p>Contenuto della sezione 3.</p>
            </div>
        </section>
        <section class="section-profilo" id="section3">
            <div class="dettagli-info">
                <p class="titolo-info">Sicurezza</p>
                <p>Email : Giorgo.cappello@gmail.com </p>
                <p>Password : ******** </p>
            </div>
        </section>
        <section class="section-profilo" id="section4">
            <div class="dettagli-info">
                <p class="titolo-info">Log out</p>
                <p><button class="bottone-logOut" type="button" onclick="logout()">Log out</button></p>
            </div>
        </section>
    </div>
    <script>
        function logout(){
            window.location.href = "logout.php";
        }
    </script>
    <script src="js/indiceDinamico.js"></script>
    
    <?php include 'footer.html'; ?>
    <script src="js/header.js"></script>
</body>
</html>