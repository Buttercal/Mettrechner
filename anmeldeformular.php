<!DOCTYPE html>
<html>
    <head>
        <title>hello</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="Formatierung.css">
    </head>
    <body>
        <?php
            session_start();
            if(ISSET($_REQUEST["date"])) {
                $date = $_REQUEST["date"];
                $_SESSION["datum"] = $date;
                $erstwahl = true;
            } else {
                $date = $_SESSION["datum"];
                $_SESSION["datum"] = $date;
            }
            $link = mysqli_connect("127.0.0.1", "root", "", "db");
            if(!$link) {
                exit();
            } elseif($date != "") {
                $date_proof = "SELECT day
                           FROM day
                           WHERE day = '".$date."';";
                $result = mysqli_query($link, $date_proof);
                $affectedrows = mysqli_num_rows($result);
                if ($affectedrows == 0 or ($affectedrows >= 1 AND !ISSET($erstwahl))) {
                    if(ISSET($erstwahl)) {
                        $query = "INSERT INTO day (day)
                        VALUES ('".$date."');";
                        mysqli_query($link, $query);
                    }
                    $select_date_id = "SELECT Day_ID
                                FROM day
                                WHERE day = '".$date."';";
                    $catch_date_id = mysqli_query($link, $select_date_id);
                    while ($rows = mysqli_fetch_assoc($catch_date_id)) {
                        $date_id = $rows['Day_ID'];
                    }
                    $erstwahl = 0;
                    $_SESSION['date_id'] = $date_id;
                    mysqli_free_result($catch_date_id);
                    mysqli_close($link);
                    ?>
                    <div class="formular">
                        <h1>Login</h1>
                        <form action="name.php" method="POST" target="">
                            <input type="text" name="username" placeholder="Username"> <br>
                            <input type="password" name="password" placeholder="Passwort"> <br>
                            <input type="submit" value="Ehre" class="login"> <br> <br>
                        </form>
                    <a href="register_1.php"><button class="login">Registrieren</button></a>      
                    </div>
                    <?php
                } else {
                    echo "<div class='formular'>Für dieses Datum existiert bereits ein Eintrag<br><br>";
                    mysqli_close($link);
                    echo "<a href='start.html'><button class='login'>Zurück zur Auswahl</button></a></div>";
                }
            } else {
                echo "<div class='formular'>Datum wurde nicht richtig erfasst<br><br>";
                mysqli_close($link);
                echo "<a href='start.html'><button class='login'>Zurück zur Auswahl</button></a></div>";
            }
        ?>
    </body>
</html>