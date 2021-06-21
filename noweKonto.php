<?php
    //session_start(); 
    include("nagl.php");
    include("baza.php");
?>
<H1> Rejestracja</H1>
<br>
<a href="p1.php">Powrót do strony logowania</a>
<br>
    <form action="./noweKonto.php" method="POST">
    Twój login: <input type="email" name="NewLogin" placeholder = "podaj email" recquired><br>
    Twój numer albumu: <input type="text" name="NewNrAlbum" placeholder = "podaj numer albumu" recquired><br>
    Twoje imię: <input type="text" name="NewImie" placeholder = "podaj imie" recquired><br>
    Twój drugie imie: <input type="text" name="NewImieD" placeholder = "podaj drugie imie"><br>
    Twoja grupa: <input type="text" name="NewGrupa" placeholder = "podaj grupe"><br>
    Twoje hasło: <input type="password" name="NewTajneHaslo" placeholder = "wprowadź hasło" recquired><br>
    Powtórz hasło: <input type="password" name="NewTajneHasloPowt" placeholder = "wprowadź hasło" recquired><br>
    <input type="submit" value="Zarejestruj"><br>
    <input type="reset" value="Wyczyść"><br><br>
    </form>
<?php
    if(!empty($_POST["NewLogin"])){
        //echo "hello there!";
        $login = $_POST["NewLogin"];
        $sqlIle = "SELECT COUNT(*) AS ileRazy FROM `_stud_ib` WHERE `email` = '$login'";
        $ileLoginow = zwrocSkalar($sqlIle);
        //echo $sqlIle;
        //echo "<br> IleLoginow: " . $ileLoginow;
        
        if($ileLoginow == 1){
            echo "Taki login już istnieje!";
        }else{
            if($_POST["NewTajneHaslo"] != $_POST["NewTajneHasloPowt"]){
                echo "Wpisane hasła różnią się od siebie!";
            }else{
                $sql = sprintf("INSERT INTO `_stud_ib` (`id`, `nr_albumu`, `imie`, `imie2`, `email`, `grupa`, `tajne`) VALUES (NULL, %d, '%s', '%s', '%s', '%s', '%s')",
                    $_POST["NewNrAlbum"], $_POST["NewImie"], $_POST["NewImieD"], $_POST["NewLogin"] , $_POST["NewGrupa"], md5($_POST["NewTajneHaslo"]));
                //echo "<br>" . $sql;

                if($wynik = WykonajZapytanie2($sql))
                    echo "<H1>Dodano konto</H1>";
                else
                    echo "<H1>BŁĄD dodawania konta</H1>";
                }
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