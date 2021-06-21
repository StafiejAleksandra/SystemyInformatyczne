<?php
//Wylogowanie i ustawienie startLogin
    include("nagl.php");
    include("baza.php");
    session_start();              //Inicjalizacja id i/lub dostep do $_SESSION
    session_regenerate_id();      //odnowienie id sesji
    $_SESSION = array();          //usuniecie zmiennych sesyjnych
    $_SESSION['startLogin'] = 1;  //znacznik startu logowania
?>
<H1>p4.php</H1>
<H2>Wylogowanie</H2>
<br>
<a href="p1.php">powrot do p1.php</a>
<?php
    include("stopka.php");
?>
