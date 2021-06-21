<?php
    include("nagl.php");
    include("baza.php");
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>ResetHasla.php</title>
</head>
<body>
    <H1>Reset Hasła</H1>
    <form action="./ResetHasla.php" method="POST">
    Podaj swoje dane: <br>
    Twój login: <input type="email" name="NewLogin" placeholder = "podaj email" recquired><br>
    Twój numer albumu: <input type="text" name="NewNrAlbum" placeholder = "podaj numer albumu" recquired><br>
    Twoje imię: <input type="text" name="NewImie" placeholder = "podaj imie" recquired><br>
    Twój drugie imie: <input type="text" name="NewImieD" placeholder = "podaj drugie imie"><br>
    Twoja grupa: <input type="text" name="NewGrupa" placeholder = "podaj grupe"><br>
    <br>Podaj nowe hasło: <br>
    Nowe hasło: <input type="password" name="NoweTajneHaslo" placeholder = "wprowadź nowe hasło" recquired><br>
    Powtórz hasło: <input type="password" name="PowtorzNoweTajneHaslo" placeholder = "powtórz nowe hasło" recquired><br>
    <input type="submit" value="Zmien"><br>
</form><br>


<?php
    if(!empty($_POST["NewLogin"])){
        //echo "hello there!";
        $login = $_POST['NewLogin'];
        $noweHaslo = md5($_POST['NoweTajneHaslo']);
        $POSTNrAlbumu = $_POST['NewNrAlbum'];
        $POSTImie = $_POST['NewImie'];
        $POSTImieD = $_POST['NewImieD'];
        $POSTGrupa = $_POST['NewGrupa'];

        //sprawdz czy mamy 1 login w tabeli
        $sql = "SELECT COUNT(*) AS ileRazy FROM `_stud_ib` WHERE `email` = '$login'";
        $ileLoginow = zwrocSkalar($sql);
        
        
        if($ileLoginow == 1){
            if($_POST["NoweTajneHaslo"] != $_POST["PowtorzNoweTajneHaslo"])
                echo "Wpisane hasła różnią się od siebie!";
            else{
                //echo "!Loginow w tabeli: $ileLoginow !!!<br>";
                $sqlNrAlbumu = "SELECT nr_albumu FROM `_stud_ib` WHERE `email` = '$login'";
                $NrAlbumuFromSQL = zwrocSkalar($sqlNrAlbumu);
                $sqlImie = "SELECT imie FROM `_stud_ib` WHERE `email` = '$login'";
                $ImieFromSQL = zwrocSkalar($sqlImie);
                $sqlImieD = "SELECT imie2 FROM `_stud_ib` WHERE `email` = '$login'";
                $ImieDFromSQL = zwrocSkalar($sqlImieD);
                $sqlGrupa = "SELECT grupa FROM `_stud_ib` WHERE `email` = '$login'";
                $GrupaFromSQL = zwrocSkalar($sqlGrupa);

                //echo "Nr Albumu: " . $NrAlbumuFromSQL . ", Imie: " . $ImieFromSQL . ", Drugie imie: " . $ImieDFromSQL . ", Grupa: " . $GrupaFromSQL . "<br>";
                if(($POSTNrAlbumu == $NrAlbumuFromSQL) and ($POSTImie == $ImieFromSQL) and ($POSTImieD == $ImieDFromSQL) and ($POSTGrupa == $GrupaFromSQL)){
                    //echo "Te same dane! Można zmieniać hasło";
                    $sqlHaslo = sprintf("UPDATE `_stud_ib` SET `tajne` = '%s' WHERE email = %d", $noweHaslo, $login);
                    //echo "<br>" . $sql;

                    if($wynik = WykonajZapytanie2($sqlHaslo))
                        echo "<H4>Hasło zostało pomyślnie zmienione</H4>";
                    else
                        echo "<H1>BŁĄD dodawania rekordu</H1>";
                }

            }
            
        }elseif($ileLoginow == 0){                   //nie ma takiego loginu 
            echo "!Podałeś błedne dane !!! <br>";
        }
    }
?>

<a href="p1.php">Powrót do strony logowania</a>

<pre>
<?php 
    var_dump($_POST);
    include("stopka.php"); 
    
?>
</pre>
</body>
</html>
