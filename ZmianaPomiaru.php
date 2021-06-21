<?php 
    session_start();
    include("nagl.php");
    include("baza.php");
?>
<H1> Modyfikacja pomiaru</H1>
<br>
<a href="p5.php">powrót do p5.php</a><br>
<?php
    $ID = $_SESSION['IDPomiaru'];
    if(!empty($_GET['wartPomZmien'])){
        
        $sql = sprintf("UPDATE `_pomiary_bio` SET `wynik` = %d WHERE `id_pom_bio`= %d", $_GET['wartPomZmien'], $ID);
        //echo $sql . "<br>";
        if($wynik = WykonajZapytanie2($sql))
            echo "<H4>Pomiar został pomyślnie zmieniony</H4>";
        else
            echo "<H1>BŁĄD dodawania reokrdu</H1>";

    }elseif(!empty($_GET['dataPomZmien'])){
        $dataCzas = $_GET['dataPomZmien'] . " " . $_GET['czasPomZmien'];
        $sql = sprintf("UPDATE `_pomiary_bio` SET `data_badania` = '%s' WHERE `id_pom_bio`= %d", $dataCzas, $ID);
        //echo $sql . "<br>";
        if($wynik = WykonajZapytanie2($sql))
            echo "<H4>Pomiar został pomyślnie zmieniony</H4>";
        else
            echo "<H1>BŁĄD dodawania reokrdu</H1>";

    }

    ?>
    <pre>
    <?php
    //INFORMACYJNIE
        echo "POST: ";
        var_dump($GET);
        echo "SESSION: ";
        var_dump($_SESSION);
    ?>
    </pre>
    <?php
        include("stopka.php");
    ?>