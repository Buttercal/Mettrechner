<!DOCtype html>
<html>
    <head>
        <title>Hello</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="Formatierung.css">
    </head>
    <body>
        <div class="formular_table">
            <?php
                $mett_price = 11;
                $bread_price = 0.3;
                settype($mett_price, "double");
                settype($bread_price, "double");
                session_start();
                $broetchen = $_SESSION["broetchen_gesamt"]/2;
                $mett = $_SESSION["mett_gesamt"]/1000;
                $mett_costs = $mett * $mett_price;
                $bread_costs = $broetchen * $bread_price;
                $day = $_SESSION["datum"];
                session_unset();
                session_destroy();
                $link = mysqli_connect("127.0.0.1", "root", "", "db");
            ?>
            <h1>I've calcualted the following values!</h1>
            I've calculated this with a price of 0,3€ per bread.<br>
            I've calculated this with a price of 11€ per one kg mett.<br>
            For changes pls contact Jermey Pascal because the and  only wont help you! :)<br><br>
            <table>
                <tr>
                    <th>User</th>
                    <th>Mett in g</th>
                    <th>Brötchen in Hälften</th>
                    <th>Kosten in €</th>
                </tr>
                <?php 
                    if (!$link) {
                        echo "Verbindung zur DB fehlgeschlagen";
                        exit();
                    } else {
                        $SELECT_USER = "SELECT username
                                        FROM persons";
                        $select = mysqli_query($link, $SELECT_USER);
                        while ($rows_user = mysqli_fetch_assoc($select)) {
                            $user = $rows_user["username"];
                            $query = "SELECT *
                                      FROM day
                                      WHERE day = '".$day."';";
                            $results = mysqli_query($link, $query);
                            while ($rows = mysqli_fetch_assoc($results)) {
                                $data1 = $rows[$user."_mett"];
                                $data2 = $rows[$user."_bread"];
                                settype($data1, "double");
                                settype($data2, "double");
                                $costperson = $data1 * $mett_price / 1000 + $data2 * $bread_price /2;
                                        if ($data1 == null OR $data2 == null) {
                                            //placeholder, wenn User null Wert enthält, auch schelchte, aber billige Lösung :)    
                                        } else {
                                            echo "<tr>
                                                    <td>".$user."</td>
                                                    <td>".$data1."</td>
                                                    <td>".$data2."</td>
                                                    <td>".$costperson."</td>
                                                </tr>";
                                        }
                                }
                            }    
                        }
                ?>
            </table>          
            <?php
                mysqli_close($link);
            ?>
        </div>
    </body>
</html>