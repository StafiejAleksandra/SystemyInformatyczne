<?php
    function polaczZbaza()
    {
        include('zmiennedb.php');
        $dbSerwer = "mysql.agh.edu.pl";
        $dbLogin = "stafiej";
        $dbHaslo = $dbHaslo_z_Pliku_zmiennedb;
        $dbBaza = "stafiej";
        //echo "Polaczenie <br>";
        return @new mysqli($dbSerwer, $dbLogin, $dbHaslo, $dbBaza);
    }

    function WykonajZapytanie($polaczenie, $_MySQL)
    {
        mysqli_set_charset($polaczenie, 'utf8');
        $wynik = @$polaczenie->query($_MySQL);
        return $wynik;
    }

    function wyswietl_02($wynik){
        //echo "<br>wyswietl_02<br><br>";
        while($wiersz = $wynik -> fetch_array(MYSQLI_NUM)){
            foreach ($wiersz as $pole)
                echo $pole . "; ";
            echo "<br>";
        }
    }

    function zwrocSkalar($_MySQL){
        if ($polaczenie = polaczZbaza()){
            mysqli_set_charset($polaczenie, 'utf8');
            if($dataSet = WykonajZapytanie($polaczenie, $_MySQL)){
                $wiersz = $dataSet ->fetch_array(MYSQLI_NUM);
                if($wiersz)
                    return $wiersz[0];
                else return NULL;
            }else return NULL;
        }else return NULL;
    }

    function WykonajZapytanie1($_MySQL)
    {
        //echo "1. $_MySQL <br>";
        if ($polaczenie = polaczZbaza()){
            mysqli_set_charset($polaczenie, 'utf8');
            $wynik = @$polaczenie->query($_MySQL);
            return $wynik;
        }else echo "Brak <br>";
    }

    function WykonajZapytanie2($_MySQL)
    {
        //echo "2. $_MySQL <br>";
        if ($polaczenie = polaczZbaza()){
            mysqli_set_charset($polaczenie, 'utf8');
            $wynik = @$polaczenie->query($_MySQL);
            return $wynik;
        }else return NULL;
    }

    function opcjeBadania(){
        $retVal = "";
        $sql = "SELECT `id_slownik`, `nazwa` FROM `slownik_badan`";
        $wynik = WykonajZapytanie1($sql);
        if($wynik){
            while($wiersz = $wynik -> fetch_assoc())
                $retVal .= '<option value="' . $wiersz["id_slownik"] . '">' . $wiersz["nazwa"] . '</option>';
            return $retVal;
        }
        else return NULL;
    }

?>






