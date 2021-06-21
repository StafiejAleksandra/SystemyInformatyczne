<?php 
    include("nagl.php");
    include("baza.php");
?>
<H1> Zmiana jednostki</H1>
<br>
<a href="p5.php">powrót do p5.php</a>
<?php
    $jednostka = $_POST['ZmienianaJednostka'];
    //echo $jednostka . " : Jednostka<br>";
    $sqlJednostkaSpr = "SELECT COUNT(*) AS ileRazy FROM `jednostka` WHERE `jednostka` = '$jednostka'";
    //echo $sqlJednostkaSpr . "<br>";
    $CzyJednostka = zwrocSkalar($sqlJednostkaSpr);
    
    if($CzyJednostka == 1){
        $sql = sprintf("UPDATE `jednostka` SET `jednostka` = '%s' WHERE `jednostka` = '%s'", $_POST['JednostkaPoZmianie'], $_POST['ZmienianaJednostka']);
        //echo "<br>$sql<br>";

        if($wynik = WykonajZapytanie2($sql))
            echo "<H1>Zmieniono jednostkę</H1>";
        else
            echo "<H1>BŁĄD zmiany</H1>";
    }else
        echo "<H1>Zmieniana jednostka nie istnieje! </H1>";
    

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