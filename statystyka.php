<?php 
    session_start();
    include("nagl.php");
    include("baza.php");
?>
<H1> Prosta statystyka</H1>
<br>
<a href="p5.php">powrót do p5.php</a><br>
<?php 
    /*echo "<br> Hello there! <br>";
    echo "<H1>Pomiary dla usera o ID = " . $_SESSION['id_pacjenta'] . "</H1>";
    $sql = "SELECT p.id_pom_bio, p.data_badania, st.imie, st.email, s.nazwa, p.wynik, j.jednostka ";
    $sql .= " FROM _pomiary_bio p, slownik_badan s, _stud_ib st, jednostka j ";
    $sql .= " WHERE p.id = st.id AND p.id_slownik_badan = s.id_slownik ";
    $sql .= "AND s.id_jednostka = j.id_jednostka AND st.id = " . $_SESSION['id_pacjenta'];
    $wynik = WykonajZapytanie1($sql);
    if($wynik){
        wyswietl_02($wynik);*/
    echo "<br> Analiza temperatury: <br>";
    echo "Maksymalna: ";
    $ID = $_SESSION['id_pacjenta'];
    $sqlMax = "SELECT MAX(wynik) FROM `_pomiary_bio` WHERE id_slownik_badan = 1 AND id = $ID";
    //echo $sqlMax . "<br>";
    $Max = zwrocSkalar($sqlMax);
    if($Max)
        echo $Max . "<br>";
    /*else
        echo "<H1>BŁĄD </H1>";
    }*/

    echo "Minimalna: ";
    $sqlMin = "SELECT MIN(wynik) FROM `_pomiary_bio` WHERE id_slownik_badan = 1 AND id = $ID";
    //echo $sqlMin . "<br>";
    $Min = zwrocSkalar($sqlMin);
    if($Min)
        echo $Min . "<br>";
    else
        echo "<H1>BŁĄD </H1>";

    $sqlPowyzej = "SELECT p.data_badania, p.wynik, j.jednostka ";
    $sqlPowyzej .= "FROM _pomiary_bio p, jednostka j, normy_biom n, slownik_badan s ";
    $sqlPowyzej .= "WHERE p.id_slownik_badan = 1 AND p.id = " . $ID . " AND j.id_jednostka = s.id_jednostka ";
    $sqlPowyzej .= "AND s.id_slownik = 1  AND n.id_badania = 1 AND p.wynik >= n.max";
    //echo $sqlPowyzej . "<br>";
    echo "<br> Temperatura powyżej normy została zarejestrowana: <br>";
    $wynikPowyzej = WykonajZapytanie1($sqlPowyzej);
    if($wynikPowyzej){
        wyswietl_02($wynikPowyzej);
    }

    $sqlPonizej = "SELECT p.data_badania, p.wynik, j.jednostka ";
    $sqlPonizej .= "FROM _pomiary_bio p, jednostka j, normy_biom n, slownik_badan s ";
    $sqlPonizej .= "WHERE p.id_slownik_badan = 1 AND p.id = " . $ID . " AND j.id_jednostka = s.id_jednostka ";
    $sqlPonizej .= "AND s.id_slownik = 1  AND n.id_badania = 1 AND p.wynik < n.min";
    //echo $sqlPonizej . "<br>";
    echo "<br> Temperatura poniżej normy została zarejestrowana: <br>";
    $wynikPonizej = WykonajZapytanie1($sqlPonizej);
    if($wynikPonizej){
        wyswietl_02($wynikPonizej);
    }


    
//    }else echo "Brak wyników<br>";


?>
<pre>
<?php/*
//INFORMACYJNIE
    echo "POST: ";
    var_dump($GET);
    echo "SESSION: ";
    var_dump($_SESSION);*/
?>
</pre>
<?php
    include("stopka.php");
?>