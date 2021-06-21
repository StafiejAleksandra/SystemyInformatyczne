<?php 
    include("nagl.php");
    include("baza.php");
?>
<H1> Dodawanie jednostki</H1>
<br>
<a href="p5.php">powrót do p5.php</a>
<?php
    $jednostka = $_POST['DodawanaJednostka'];
    //echo $jednostka . " : Jednostka<br>";
    $sqlJednostkaSpr = "SELECT COUNT(*) AS ileRazy FROM `jednostka` WHERE `jednostka` = '$jednostka'";
    //echo $sqlJednostkaSpr . "<br>";
    $CzyJednostka = zwrocSkalar($sqlJednostkaSpr);
    
    if($CzyJednostka == 1){
        echo "<H1>Taka jednostka już istnieje! </H1>";
    }else{
        $sql = sprintf("INSERT INTO jednostka (`id_jednostka`, `jednostka`) VALUES (NULL, '%s')", $_POST["DodawanaJednostka"]);
        echo "<br>$sql<br>";

        if($wynik = WykonajZapytanie2($sql))
            echo "<H1>Dodano jednostkę</H1>";
        else
            echo "<H1>BŁĄD wpisywania</H1>";
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