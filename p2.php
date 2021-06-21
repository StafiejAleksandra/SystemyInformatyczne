<?php
    session_start(); //Inicjalizacja dostępu do $_SESSION
    include("nagl.php");
    include("baza.php");
    /*$czas = time() - $_SESSION['time'];
    echo "Czas: " . $czas . " s<br>";
    echo "IP uzytkownika: " . $_SERVER['REMOTE_ADDR'] . "<br>";
    echo "Data czas: " . $_SESSION['czas'];


    $sql = sprintf("INSERT INTO `rejestr_prob_logowania` (`id`, `proba_logowania`, `data_proby`, `IP`) VALUES (NULL, %d, '%s', '%s')",
        $_SESSION["startLogin"], $_SESSION["czas"],  $_SERVER['REMOTE_ADDR']);
    echo "<br>$sql<br>";

    if($wynik = WykonajZapytanie2($sql))
        echo "<H1>Dodano rekord</H1>";
    else
        echo "<H1>BŁĄD dodawania reokrdu</H1>";
*/
    echo "<h1>p2.php</h1>";
    if($_SESSION['startLogin'] != 1)
        echo "Dostep do skryptu zabroniony";  //Blokada dostepu
        
    else{
        $_SESSION['startLogin'] = -1; //Koniec startu logowania
        
        $login = $_POST['login'];
        $haslo = md5($_POST['tajneHaslo']);
        
        //sprawdz czy mamy 1 login w tabeli

        $sql = "SELECT COUNT(*) AS ileRazy FROM `_stud_ib` WHERE `email` = '$login'";
        $ileLoginow = zwrocSkalar($sql);
        
        if($ileLoginow == 1){
            //echo "!Loginow w tabeli: $ileLoginow !!!<br>";

            $sql = "SELECT id FROM `_stud_ib` WHERE `email` = '$login' AND tajne = '$haslo'";
            $czyJestPoprawnaPara = zwrocSkalar($sql);
            //echo "?? $czyJestPoprawnaPara ??";
            
            if ($czyJestPoprawnaPara){
                $_SESSION['zalogowany'] = 1;
                $_SESSION['id_pacjenta'] = $czyJestPoprawnaPara;
                echo "Jesteś zalogowany jako: $czyJestPoprawnaPara <br><br>";
                echo '<a href="p5.php">Do aplikacji p5.php</a><br>';
                echo '<a href="ZmianaHasla.php">Zmiana Hasła</a><br>';
                echo '<a href="Dokumentacja.pdf">Dokumentacja </a><br>';
            }else{
                $_SESSION['zalogowany'] = -1; //Nie udalo sie zalogowac
                $_SESSION['id_pacjenta'] = -1;
                echo "Podales zle dane<br><br>";
                echo '<a href="p4.php">Ide do p4.php</a>';
            }
            
        }elseif($ileLoginow == 0){                   //nie ma takiego loginu 
            echo "!Podałeś błedne dane !!! <br>";
            $_SESSION['zalogowany'] = -1;
        }else
            echo "!Masz niespojna baze!!! <br>";
        
        $sql = sprintf("INSERT INTO `rejestr_prob_logowania` (`id`, `proba_logowania`, `data_proby`, `IP`) VALUES (NULL, %d, '%s', '%s')",
            $_SESSION["zalogowany"], $_SESSION["czas"],  $_SERVER['REMOTE_ADDR']);
        //echo "<br>$sql<br>";
    
        if($wynik = WykonajZapytanie2($sql))
            echo "<H1>Dodano rekord</H1>";
        else
            echo "<H1>BŁĄD dodawania reokrdu</H1>";
    }

?>
<pre>
    <?php/*
    echo "POST: ";
    var_dump($_POST);
    echo "SESSION: ";
    var_dump($_SESSION);*/
    ?>
</pre>
<?php
    include("stopka.php");
?>

