<?php
    session_start(); //Inicjalizacja dostępu do $_SESSION
    include("nagl.php");
    include("baza.php");
    if($_SESSION['zalogowany'] != 1)
        echo "Dostep do skryptu zabroniony";  //Blokada dostepu
    else{
?>
    <H1>Namiastka aplikacji </H1>
    <H3>Tajne akcje</H3>

<form action = "p5.php" method = "post">
        <button name = "opcja" value = "1">Katalog pomiarów</button><br>
        <button name = "opcja" value = "50">Edycja katalogu</button>
        <button name = "opcja" value = "60">Uzupełnianie katalogu</button><br><br>
        <button name = "opcja" value = "2">Jednostki</button><br>
        <button name = "opcja" value = "30">Edycja jednostek</button>
        <button name = "opcja" value = "40">Dopisanie jednostki</button><br>
        <button name = "opcja" value = "3">Pomiary</button><br>
        <button name = "opcja" value = "20">Nowy pomiar</button><br>
</form>

<?php //Akcje
    if(isset($_POST['opcja']))
        switch ($_POST['opcja']) {
            case '1':
                echo "Katalog pomiarów<br>";
                $sql = "SELECT s.id_slownik, s.nazwa, j.jednostka ";
                $sql .= "FROM slownik_badan s, jednostka j ";
                $sql .= "WHERE s.id_jednostka = j.id_jednostka";
                if($wynik = WykonajZapytanie1($sql))
                    wyswietl_02($wynik);
                else echo "Brak wyników<br>";
                
                break;
            case '2':
                echo "Jednostki";
                $sql = "SELECT * FROM `jednostka`";
                if($wynik = WykonajZapytanie1($sql))
                    wyswietl_02($wynik);
                else echo "Brak wyników<br>";
                break;
            case '3':
                echo "<H1>Pomiary dla usera o ID = " . $_SESSION['id_pacjenta'] . "</H1>";
                $sql = "SELECT p.id_pom_bio, p.data_badania, st.imie, st.email, s.nazwa, p.wynik, j.jednostka ";
                $sql .= " FROM _pomiary_bio p, slownik_badan s, _stud_ib st, jednostka j ";
                $sql .= " WHERE p.id = st.id AND p.id_slownik_badan = s.id_slownik ";
                $sql .= "AND s.id_jednostka = j.id_jednostka AND st.id = " . $_SESSION['id_pacjenta'];
                $wynik = WykonajZapytanie1($sql);
                if($wynik)
                    wyswietl_02($wynik);
                else echo "Brak wyników<br>";
?>
                <br>
                <form action = "statystyka.php" method = "post">
                <input type="submit" value="Statystyka Temperatury"><br><br>
                </form>
                <form action="ModyfikacjaPomiaru.php" method = "post">
                <p>Modyfikacja:<p>
                    <input type="radio" id="zmiana" name="modyfikacja" value="zmiana">
                    <label for="zmiana">Zmiana wartosci</label><br>
                    <input type="radio" id="usuwanie" name="modyfikacja" value="usuwanie">
                    <label for="usuwanie">Usuwanie pomiaru</label><br>
                    Podaj id zmienianego pomiaru: <input type = "text", name="IDPomiaru" required><br>
                    <input type="submit" value="Przejdz"><br>
                </form>

<?php
                break;
            case '20':
                echo "<br>Dodaj pomiar<br>";
?>
                <br>Jaki pomiar:
                <form action="p6.php" method = "post">
                    <select name="id_badanie">
                <?php
                        echo opcjeBadania();
                ?>
                    </select><br>
                    Podaj wartość parametru biomedycznego: <input type = "text", name="wartPom" required><br>
                    Data dokonania pomiaru: <input type="date" name = "dataPom" required><br>
                    Czas dokonania pomiaru: <input type="time" name = "czasPom" required><br>
                    <input type="submit" value="Zapisz"><br>
                </form>
<?php
                break;
            case '30':
                echo "<br>Edycja jednostki<br>";
?>
                <form action="ZmianaJednostki.php" method = "post">
                    Podaj zmienianą jednostkę: <input type = "text", name="ZmienianaJednostka" required><br>
                    Podaj jednostkę na którą należy zmienić: <input type="text" name = "JednostkaPoZmianie" required><br>
                    <input type="submit" value="Zmien"><br>
                </form>

<?php
                break;
            case '40':
                echo "<br>Dopisanie jednostki<br>";
?>
                <form action="DodajJednostke.php" method = "post">
                    Podaj dodawaną jednostkę: <input type = "text", name="DodawanaJednostka" required><br>
                    <input type="submit" value="Dodaj"><br>
                </form>

<?php
                break;
                case '50':
                    echo "<br>Edycja katalogu<br>";
    ?>
                    <form action="EdycjaKatalogu.php" method = "post">
                        Podaj zmieniany pomiar: <input type = "text", name="ZmienianyElementPomiar" required><br>
                        Podaj zmienianą jednostkę: <input type = "text", name="ZmienianyElementJednostka" required><br>
                        Podaj pomiar, na który należy zmienić: <input type="text" name = "ElementPomiarPoZmianie" required><br>
                        Podaj jednostkę, na którą należy zmienić: <input type="text" name = "ElementJednostkaPoZmianie" required><br>
                        <input type="submit" value="Zmien"><br>
                    </form>
    
    <?php
                    break;
                case '60':
                    echo "<br>Uzupełnianie katalogu<br>";
    ?>
                    <form action="UzupelnianieKatalogu.php" method = "post">
                        Podaj dodawany pomiar: <input type = "text", name="DodawanyElementPomiar" required><br>
                        Podaj dodawaną jednostkę: <input type = "text", name="DodawanyElementJednostka" required><br>
                        <input type="submit" value="Dodaj"><br>
                    </form>
    
    <?php
                    break;
        }
?>

<?php
}
?>

<br><br>
<a href="p1.php">powrot do p1.php</a>

<pre>
<?php/*
    echo "POST: ";
    var_dump($_POST);
    echo "SESSION: ";
    var_dump($_SESSION);*/
?>
</pre>
<?php
    include("stopka.php");
?>
