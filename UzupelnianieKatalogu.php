<?php 
    session_start(); 
    include("nagl.php");
    include("baza.php");
?>
<H1> Uzupełnianie katalogu</H1>
<br>
<a href="p5.php">powrót do p5.php</a>
<?php
    $IDSession = $_SESSION['id_pacjenta'];
    //echo $IDSession . " : ID pacjenta<br>";
    $sqlIloscID = "SELECT COUNT(*) AS ileRazy FROM `slownik_badan` WHERE `id_uzytkownika` = '$IDSession'";
    //echo $sqlIloscID . "<br>";
    $IloscID= zwrocSkalar($sqlIloscID);
    //echo "<br> Ile: " . $sqlIloscID;

    if($IloscID >= 5){
        echo "<H1>Nie możesz dodać więcej pomiarów!</H1>";
    }else{
        $jednostka = $_POST['DodawanyElementJednostka'];
        //echo $jednostka . " : Jednostka<br>";
        $sqlJednostkaSpr = "SELECT COUNT(*) AS ileRazy FROM `jednostka` WHERE `jednostka` = '$jednostka'";
        //echo $sqlJednostkaSpr . "<br>";
        $CzyJednostka= zwrocSkalar($sqlJednostkaSpr);

        $sqlIDJednostka = "SELECT id_jednostka FROM `jednostka` WHERE `jednostka` = '$jednostka'";
        $IDJednostka = zwrocSkalar($sqlIDJednostka);
        //echo "?? $IDJednostka ??";

        $nazwa = $_POST['DodawanyElementPomiar'];
        $sqlPomiarSpr = "SELECT COUNT(*) AS ileRazy FROM `slownik_badan` WHERE `nazwa` = '$nazwa' AND `id_jednostka` = '$IDJednostka'";
        $CzyPomiar = zwrocSkalar($sqlPomiarSpr);

        if(($CzyJednostka == 1) and ($CzyPomiar == 1)){
            echo "<H1>Taki pomiar już istnieje!<H1>";
        }elseif($CzyJednostka == 1){
            $sql = sprintf("INSERT INTO `slownik_badan` (`id_slownik`, `id_jednostka`, `nazwa`, `id_uzytkownika`) VALUES (NULL, %d, '%s', %d)",
            $IDJednostka, $_POST["DodawanyElementPomiar"], $_SESSION['id_pacjenta']);
            //echo "<br>" . $sql;
            if($wynik = WykonajZapytanie2($sql))
                echo "<H1>Dodano pomiar</H1>";
            else
                echo "<H1>BŁĄD dodawania</H1>";
        }else{
            $sql = sprintf("INSERT INTO `jednostka` (`id_jednostka`, `jednostka`) VALUES (NULL, '%s')", $_POST["DodawanyElementJednostka"]);
            //echo "<br>" . $sql;
            if($wynik = WykonajZapytanie2($sql))
                echo "<H1>Dodano jednostkę</H1>";
            else
                echo "<H1>BŁĄD dodawania</H1>";

            $sqlID= sprintf("SELECT id_jednostka FROM `jednostka` WHERE `jednostka` = '%s'", $_POST["DodawanyElementJednostka"]);
            $ID = zwrocSkalar($sqlID);
            //echo "ID: " . $ID ."<br>";

            $sql = sprintf("INSERT INTO `slownik_badan` (`id_slownik`, `id_jednostka`, `nazwa`, `id_uzytkownika`) VALUES (NULL, %d, '%s', %d)",
                        $ID, $_POST['DodawanyElementPomiar'], $_SESSION['id_pacjenta']);
            //echo "<br>" . $sql;
            if($wynik = WykonajZapytanie2($sql))
                echo "<H1>Dodano pomiar</H1>";
            else
                echo "<H1>BŁĄD dodawania</H1>";
        }
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