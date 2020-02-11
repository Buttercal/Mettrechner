<!DOCtype html>
<html>
    <head>
        <title>Hello</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="Formatierung.css">
    </head>
    <body>
        <div class="formular">
            <?php
                session_start();
                $username = $_REQUEST["username"];
                $password = $_REQUEST["password"];
                $datum = $_SESSION["datum"];
                $_SESSION["datum"] = $datum;
                if ($username == "" or $password == "") {
                    echo "Bitte Daten angeben, du Dulli, Entschuldigung, Sie Dulli<br><br>";
                    echo "<a href='anmeldeformular.php'><button class='login'>Zurück zum Login</button></a>";
                } else {
                    $link = mysqli_connect("127.0.0.1", "root", "", "db");
                    if (!$link) {
                        echo "Verbindung zur DB fehlgeschlagen";
                        exit();
                    } else {
                        $result = mysqli_query($link, "SELECT username, password, ID FROM persons WHERE username = '".$username."'");
                        $affectedrows = mysqli_num_rows($result);
                            if($affectedrows > 0) {
                                while ($rows = mysqli_fetch_assoc($result)) {
                                    $username_db = $rows["username"];
                                    $password_db = $rows["password"];
                                    $user_id = $rows["ID"];
                                }
                                if($password == $password_db) {
                                    $_SESSION['username'] = $username_db;
                                    $date_id = $_SESSION['date_id'];
                                    $insert = "INSERT INTO person_day (ID, Day_ID)
                                               VALUES ('".$user_id."','".$date_id."')";
                                    mysqli_query($link, $insert);
                                    echo "<b>Hello my dear friend ".$username_db."!</b><br><br>";
                                    ?>
                                        <form method="POST" action="auswahl.php">
                                            <b>Please give me the amount of bread buns you like to eat :)</b> <br><br>
                                            <input type="text" name="broetchenmenge" placeholder="1 = eine Brötchenhälfte" value=""> <br>
                                            <b>Please select now the amount of "Mett" even that I prefer "Sucuk" :)</b> <br><br>
                                            <div class="selection">
                                                <select name="mettmenge" class="select-css">
                                                    <option value="50">wenig (50g)</option>
                                                    <option value="60">mittel (60g)</option>
                                                    <option value="70">viel (70g)</option>
                                                </select>
                                            </div>
                                            <br>
                                            <input type="submit" value="Ab in die Einkaufsliste" class="summit">
                                        </form>
                                    <?php
                                } else {
                                    echo "Passwort falsch :/<br><br>";
                                    echo "<a href='anmeldeformular.php'><button class='login'>Zurück zum Login</button></a>"; 
                                }
                            } else {
                                echo "Dieser Mettkonsument existiert hier nicht :O<br><br>";
                                echo "<a href='anmeldeformular.php'><button class='login'>Zurück zum Login</button></a>"; 
                            }
                        mysqli_free_result($result);
                    }
                    mysqli_close($link);
                }
            ?>
        </div>
    </body>
</html>