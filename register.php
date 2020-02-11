<!DOCtype html>
<html>
    <head>
        <title>Hello</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="Formatierung.css">
    </head>
    <body>
        <?php
            session_start();
            $datum = $_SESSION["datum"];
            $_SESSION["datum"] = $datum;
            $username = $_REQUEST["username_reg"];
            $password = $_REQUEST["password_reg"];
            $password2 = $_REQUEST["password_reg2"];
            if($username == "" or $password == "" or $password2 == "") {
                echo "<div class='formular'>Bitte Daten vollsändig angeben!<br><br>";
                echo "<a href='anmeldeformular.php'><button class='login'>Zurück zum Login</button></a></div>"; 
            } elseif ($password != $password2) {
                echo "<div class='formular'>Passwort wurde nicht richtig bestätigt!<br><br>";
                echo "<a href='anmeldeformular.php'><button class='login'>Zurück zum Login</button></a></div>"; 
            } else {
                $link = mysqli_connect("127.0.0.1", "root", "", "db");
                if (!$link) {
                    echo "<div>Verbindung zu Datenbank fehlgeschlagen</div>";
                    exit();
                } else {
                    $result = mysqli_query($link, "SELECT username, password FROM persons WHERE username = '".$username."'");
                    $affectedrows = mysqli_num_rows($result);
                    if ($affectedrows > 0) {
                        while ($rows = mysqli_fetch_assoc($result)) {
                            $username_db = $rows["username"];
                        }
                        if ($username == $username_db) {
                            echo "<div class='formular'>Account existiert bereits<br><br>";
                            echo "<a href='anmeldeformular.php'><button class='login'>Zurück zum Login</button></a</div>"; 
                            mysqli_free_result($result);
                        } else {
                            echo "Fehler";
                            mysqli_free_result($result);
                            exit();
                        }
                    } else {
                        mysqli_free_result($result);
                        $insert = "INSERT INTO persons (username, PASSWORD)
                                    VALUES ('".$username."', '".$password."');";
                        mysqli_query($link, $insert);
                        echo $username;
                        $alter_table = "ALTER TABLE day ADD (".$username."_bread INT, ".$username."_mett INT);";
                        mysqli_query($link, $alter_table);
                        echo "<div class='formular'><b>Registriert, klingt unnormal belohnend!</b><br><br>";
                        echo "<a href='anmeldeformular.php'><button class='login'>Zurück zum Login</button></a></div>"; 
                    }
                }
                mysqli_close($link);
            }  
        ?>
    </body>
</html>