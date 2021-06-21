<?php
    session_start(); 
    include("nagl.php");
    include("baza.php");
?>
<H1> Zapis nowego pomiaru</H1>
<br>
<a href="p5.php">powrót do p5.php</a>
<?php
    $user = $_SESSION["id_pacjenta"];
    $sql = sprintf("INSERT INTO `_pomiary_bio` (`id_pom_bio`, `id`, `id_slownik_badan`, `wynik`, `data_badania`) VALUES (NULL, %d, %d, %f, '%s')",
        $_SESSION["id_pacjenta"], $_POST["id_badanie"], $_POST["wartPom"], $_POST["dataPom"]  . " " . $_POST["czasPom"]);
    //echo "<br>$sql<br>";

    if($wynik = WykonajZapytanie2($sql))
        echo "<H1>Dodano wynik</H1>";
    else
        echo "<H1>BŁĄD dodawania reokrdu</H1>";

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