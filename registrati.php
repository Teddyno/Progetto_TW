<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styleSheet/style.css">
    <link rel="stylesheet" type="text/css" href="styleSheet/styleLoginRegister.css">
    <title>Login</title>
</head>
<body>
    <?php include 'header.html'; ?>

    <div class="contenitore-login">
        <h2 class="titolo-login">Crea il tuo account</h2>
        <form class="form-login" action="#" method="POST">
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" placeholder="Inserisci il tuo nome" required>

            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Inserisci la tua email" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Crea una password" required>

            <label for="conferma-password">Conferma Password</label>
            <input type="password" id="conferma-password" name="conferma-password" placeholder="Ripeti la password" required>

            <button type="submit" class="pulsante-login">Registrati</button>

            <p class="link-extra">
                Hai già un account? <a href="login.php">Accedi</a>
            </p>
        </form>
    </div>
    
    <?php include 'footer.html'; ?>
</body>
</html>