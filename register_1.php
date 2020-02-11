<!DOCTYPE html>
<html>
    <head>
        <title>hello</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="Formatierung.css">
    </head>
    <body>
        <div class="formular">
            <h1>Registrieren</h1>
            <?php
                session_start();
                $datum = $_SESSION["datum"];
                $_SESSION["datum"] = $datum;
            ?>
            <form action="register.php" method="POST" target="">
                <input type="text" name="username_reg" placeholder="Username"> <br>
                <input type="password" name="password_reg" placeholder="Passwort"> <br>
                <input type="password" name="password_reg2" placeholder="Passwort bestätigen"> <br>
                <input type="submit" value="Ehre" class="login">
            </form>
        </div>
    </body>
</html>