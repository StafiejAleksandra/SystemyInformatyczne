<?php
    include("nagl.php");
    include("baza.php");
    session_start();
    if($_SESSION['zalogowany'] !=1)
        echo "Dostep do skryptu zabroniony";
    else{
?>
    <H1>p3.php</H1>
    <H3>Tajny tekst</H3>
    <p>
        To jest <br> specjalny tekst <br> tylko dla <br> w t a j e m n i c z o n y c h 
    </p>
<?php
include("stopka.php");
}
?>
<br>
<a href="p1.php">powrot do p1.php</a>
