<?php
    include("nagl.php");
    include("baza.php");
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>ZmianaHasla.php</title>
</head>
<body>
    <H1>Zmiana Hasła</H1>
    <form action="./ZmianaHasla.php" method="POST">
    Login: <input type="email" name="login" placeholder = "podaj email" recquired><br>
    Stare hasło: <input type="password" name="StareTajneHaslo" placeholder = "wprowadź stare hasło" recquired><br>
    Nowe hasło: <input type="password" name="NoweTajneHaslo" placeholder = "wprowadź nowe hasło" recquired><br>
    Powtórz hasło: <input type="password" name="PowtorzNoweTajneHaslo" placeholder = "powtórz nowe hasło" recquired><br>
    <input type="submit" value="Zmien"><br>
</form><br>

<?php
    if(!empty($_POST["login"])){
        //echo "hello there!";

        $login = $_POST['login'];
        $haslo = md5($_POST['StareTajneHaslo']);
        $noweHaslo = md5($_POST['NoweTajneHaslo']);
        
        //sprawdz czy mamy 1 login w tabeli
        $sql = "SELECT COUNT(*) AS ileRazy FROM `_stud_ib` WHERE `email` = '$login'";
        $ileLoginow = zwrocSkalar($sql);
        
        if($ileLoginow == 1){
            //echo "!Loginow w tabeli: $ileLoginow !!!<br>";

            $sql = "SELECT id FROM `_stud_ib` WHERE `email` = '$login' AND tajne = '$haslo'";
            $czyJestPoprawnaPara = zwrocSkalar($sql);
            //echo "??id  $czyJestPoprawnaPara ??";
            
            if ($czyJestPoprawnaPara){
                $id = $czyJestPoprawnaPara;
                //$_SESSION['id_pacjenta'] = $czyJestPoprawnaPara;
                //echo "Haslo jest poprawne <br><br>";
                if($_POST["NoweTajneHaslo"] == $_POST["PowtorzNoweTajneHaslo"]){
                    //echo "MOŻNA ZMIENIC HASŁO! <br>";
                    $sql = sprintf("UPDATE `_stud_ib` SET `tajne` = '%s' WHERE id = %d", $noweHaslo, $id);
                    //echo "<br>" . $sql;

                    if($wynik = WykonajZapytanie2($sql))
                        echo "<H4>Hasło zostało pomyślnie zmienione</H4>";
                    else
                        echo "<H1>BŁĄD dodawania reokrdu</H1>";
                }else 
                    echo "Wpisane hasła różnią się od siebie!";
            }else{
                echo "Podales zle dane<br><br>";
            }
            
        }elseif($ileLoginow == 0){                   //nie ma takiego loginu 
            echo "!Podałeś błedne dane !!! <br>";
        }
    }
?>

<br><a href="p1.php">Powrót do strony logowania</a><br>

<pre>
<?php 
    include("stopka.php"); 
    //var_dump($_POST);
?>
</pre>
</body>
</html>
