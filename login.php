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
    <?php include 'header.php'; ?>

    <div class="contenitore-login">
        <h2 class="titolo-login">Accedi alla tua area riservata</h2>
        <form class="form-login" action="login-manager.php" method="POST">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Inserisci la tua email" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="password" placeholder="Inserisci la tua password" required>

            <button type="submit" class="pulsante-login">Accedi</button>

            <p class="link-extra">
                <a href="#">Password dimenticata?</a> | <a href="registrati.php">Registrati</a>
            </p>
        </form>
    </div>
    
    <?php include 'footer.html'; ?>
</body>
</html>