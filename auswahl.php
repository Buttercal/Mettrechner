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
                $link = mysqli_connect("127.0.0.1", "root", "", "db");
                if(!$link) {
                    echo "Verbindung zur DB fehlgeschlagen";
                    exit();
                } else {
                    session_start();
                    $broetchen_ermittelt = $_REQUEST["broetchenmenge"];
                    $mett_ermittelt = $_REQUEST["mettmenge"];
                    $mett_insgesamt_user = $mett_ermittelt * $broetchen_ermittelt;
                    $loggeduser = $_SESSION["username"];
                    $update = "UPDATE day
                               SET ".$loggeduser."_bread = ".$broetchen_ermittelt.", ".$loggeduser."_mett = ".$mett_insgesamt_user.";";
                    mysqli_query($link, $update);

                    if (isset($_SESSION["broetchen_gesamt"])) {
                        $broetchen = $_SESSION["broetchen_gesamt"];
                        $mett = $_SESSION["mett_gesamt"];
                    } else {
                        if(isset($broetchen)) {       
                        } else {
                            //echo "nicht gesetzt";
                            $broetchen = 0;
                            $mett = 0;
                        }
                    }
                    $broetchen = $broetchen + $broetchen_ermittelt;
                    $mett = $mett + $mett_ermittelt;
                    $_SESSION["broetchen_gesamt"] = $broetchen;
                    $_SESSION["mett_gesamt"] = $mett;
                    $datum = $_SESSION["datum"];
                    $_SESSION["datum"] = $datum;
                }
            mysqli_close($link);
            ?>
            <a href="anmeldeformular.php"><button class="login">Nächster</button></a> <br><br>
            <a href="calc.php"><button class="login">Frühstück berechnen</button></a> 
        </div>
    </body>
</html>