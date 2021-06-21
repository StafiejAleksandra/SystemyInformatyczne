<?php
/*
Skrypt o nazwie p1.php
*/
    session_start();
    include("nagl.php");
    include("baza.php");
    //$czasPoczatkowy = time();

    if(!isset($_SESSION['startLogin']) || $_SESSION['startLogin'] = 1){
        session_regenerate_id();         //Odnowienie id sesji
        $_SESSION = array();             //usuniecie zmiennych sesyjnych
        $_SESSION['startLogin'] = 1;     //znacznik startu logowania
        $_SESSION['komunikat'] = "A jednak";
        $_SESSION['czas'] = date("Y-m-d H:i:s");
        //$_SESSION['time'] = $czasPoczatkowy;
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>p1.php</title>
</head>
<body>
    <H1>p1.php</H1>
    <form action="./p2.php" method="POST">
    Login: <input type="email" name="login" placeholder = "podaj email" recquired><br>
    Hasło: <input type="password" name="tajneHaslo" placeholder = "wprowadź hasło" recquired><br>
    <input type="submit" value="Zaloguj"><br>
    <input type="reset" value="Wyczyść"><br><br>
</form><br>

<a href="noweKonto.php">Załóż nowe konto</a><br><br>
<!--<a href="ZmianaHasla.php">Zmiana Hasła</a><br><br>-->
<a href="ResetHasla.php">Pomocy! Zapomniałem(am) hasła!</a><br><br>

<pre>
<?php 
    include("stopka.php"); //Wyswietlanie zawartosci tablicy sesyjnej
?>
</pre>
</body>
</html>
