<?php 
    session_start();
    include("nagl.php");
    include("baza.php");
?>
<H1> Modyfikacja pomiaru</H1>
<br>
<a href="p5.php">powrót do p5.php</a>
<?php
    $ID = $_POST['IDPomiaru'];
    $_SESSION['IDPomiaru'] = $ID;
    $sqlUzytkownik = "SELECT id FROM `_pomiary_bio` WHERE `id_pom_bio`=$ID";
    //echo $sqlUzytkownik . "<br>";
    $IdUzytkownikFromSQL = zwrocSkalar($sqlUzytkownik);
    //echo $IdUzytkownikFromSQL . "<br>" . $_SESSION['id_pacjenta'];
    if($IdUzytkownikFromSQL == $_SESSION['id_pacjenta']){
        if($_POST['modyfikacja'] == 'usuwanie'){
            echo "<br> usuwanie <br>";
            $sqlUsuwanie = "DELETE FROM `_pomiary_bio` WHERE `id_pom_bio`=$ID";
            echo $sqlUsuwanie;
            if($wynik = WykonajZapytanie2($sqlUsuwanie))
                echo "<H4>Pomiar został pomyślnie usunięty</H4>";
            else
                echo "<H1>BŁĄD dodawania reokrdu</H1>";

        }else if($_POST['modyfikacja'] == 'zmiana'){
            echo "<br> zmiana <br>";
?>
            <br>Jaki pomiar:
                <form action="ZmianaPomiaru.php" method = "get">
                    Podaj zmienioną wartość parametru biomedycznego: <input type = "text", name="wartPomZmien" ><br>
                    Zmieniana data dokonania pomiaru: <input type="date" name = "dataPomZmien" ><br>
                    Zmieniany czas dokonania pomiaru: <input type="time" name = "czasPomZmien" ><br>
                    <input type="submit" value="Zmien"><br>
                </form>
<?php
        }else
            echo "<H1>BŁĄD! Nie podano rodzaju modyfikacji!</H1>";
    }else{
        echo "<H2>To nie jest twój pomiar!</H2>";
    }

    
?>
<pre>
<?php/*
//INFORMACYJNIE
    echo "POST: ";
    var_dump($_POST);
    echo "SESSION: ";
    var_dump($_SESSION);*/
?>
</pre>
<?php
    include("stopka.php");
?>