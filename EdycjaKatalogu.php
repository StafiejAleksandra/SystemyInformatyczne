<?php 
    include("nagl.php");
    include("baza.php");
?>
<H1> Edycja Katalogu</H1>
<br>

<?php
    $jednostka = $_POST['ZmienianyElementJednostka'];
    //echo $jednostka . " : Jednostka<br>";
    $sqlJednostkaSpr = "SELECT COUNT(*) AS ileRazy FROM `jednostka` WHERE `jednostka` = '$jednostka'";
    //echo $sqlJednostkaSpr . "<br>";
    $CzyJednostka= zwrocSkalar($sqlJednostkaSpr);
    
    $sqlIDJednostka = "SELECT id_jednostka FROM `jednostka` WHERE `jednostka` = '$jednostka'";
    $IDJednostka = zwrocSkalar($sqlIDJednostka);
    //echo "?? $IDJednostka ??";

    $nazwa = $_POST['ZmienianyElementPomiar'];
    $sqlPomiarSpr = "SELECT COUNT(*) AS ileRazy FROM `slownik_badan` WHERE `nazwa` = '$nazwa' AND `id_jednostka` = '$IDJednostka'";
    $CzyPomiar = zwrocSkalar($sqlPomiarSpr);

        
    if(($CzyJednostka == 1) and ($CzyPomiar == 1)){
        $sql = sprintf("UPDATE `jednostka` SET `jednostka` = '%s' WHERE `jednostka` = '%s'", $_POST['ElementJednostkaPoZmianie'], $_POST['ZmienianyElementJednostka']);
        //echo "<br>$sql<br>";
        if($wynik = WykonajZapytanie2($sql))
            echo "<H1>Zedytowano jednostkę</H1>";
        else
            echo "<H1>BŁĄD zmiany</H1>";
        $sql = sprintf("UPDATE `slownik_badan` SET `nazwa` = '%s' WHERE `nazwa` = '%s'", $_POST['ElementPomiarPoZmianie'], $_POST['ZmienianyElementPomiar']);
        //echo "<br>$sql<br>";
        if($wynik = WykonajZapytanie2($sql))
            echo "<H1>Zedytowano pomiar</H1>";
        else
            echo "<H1>BŁĄD zmiany</H1>";     
        
    }else
        echo "Taki pomiar nie istnieje!";

?>
<br><a href="p5.php">powrót do p5.php</a><br>
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