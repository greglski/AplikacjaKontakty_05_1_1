<?php
require_once 'Config/Config.php';
$sess = new mySession();
$sess->sessVer();

//echo 'Jesteś zalogowany jako:'. $_SESSION['login'].'<br>';
//echo $_SESSION['identyfikator_sesji'];
//echo '<br>Twój ID z bazy danych to :'.$_SESSION['id_user'].'<br>';
//echo '<br>Twoje IP to:'.$_SESSION['ip'];
//echo '<br>Twoja przeglądarka to:'.$_SESSION['klient'].'<br>';
  
if(isset($_GET['logout'])){
$sess->sessEnd();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Aplikacja kotakty</title>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/main.css">
        <script src="scripts/jquery-3.1.1.min.js"></script>
        <script src="scripts/indexlog.js"></script>
        <!--<script src="scripts/script.js"></script>-->
    </head>
    <?php
        $id_user = $_SESSION['id_user'];
        $db = new DbConnect();
    
    //usuwanie z tabeli kontakty
    
        if(isset($_GET['action']) && $_GET['action']=='del' && !empty($_GET['id'])){
    
            $idRecord = (int)$_GET['id'];
            $usuwanie = "delete from kontakty where id_kontakt=$idRecord and id_user=$id_user";
            $db->db->query($usuwanie);
            header('Location:indexlog.php');
            exit();                
        }            
            //dodajemy nowy wiersz w tabeli kontakty lub zapisujemy modyfikację zapisu
        if(isset($_POST['zapisz'])){
                
            $nazwisko = htmlentities(trim($_POST['nazwisko']));
            $imie = htmlentities(trim($_POST['imie']));
            $miejscowosc = htmlentities(trim($_POST['miejscowosc']));
            $ulica = htmlentities(trim($_POST['ulica']));
            $nr_domu = htmlentities(trim($_POST['nr_domu']));
            $nr_mieszkania = htmlentities(trim($_POST['nr_mieszkania']));
            $kod_pocztowy = htmlentities(trim($_POST['kod_pocztowy']));
            $poczta = htmlentities(trim($_POST['poczta']));
            $mail = htmlentities(trim($_POST['mail']));
            $data = date('Y-m-d');
                
            //tworzymy zapytanie dodające wiersz do tabeli kontakty
            if(!isset($_POST['idKontakt'])){                
                $dodaj = "insert into kontakty (id_kontakt , id_user, nazwisko, imie, miejscowosc, ulica, nr_domu, nr_mieszkania, kod_pocztowy, poczta,mail, data) values (NULL,$id_user,'$nazwisko','$imie','$miejscowosc','$ulica','$nr_domu', '$nr_mieszkania','$kod_pocztowy','$poczta','$mail','$data')";
            } else {
                
                //tworzymy zapytanie modyfikujące wierssz w tabeli kontakty    
                $idKontakt = $_POST['idKontakt'];                
                
                $dodaj = "update kontakty set nazwisko='$nazwisko' , imie='$imie', miejscowosc='$miejscowosc', ulica='$ulica', nr_domu='$nr_domu', nr_mieszkania='$nr_mieszkania', kod_pocztowy='$kod_pocztowy', poczta='$poczta' ,mail='$mail', data='$data' where id_kontakt=$idKontakt";   
            }                
                
            $db->db->query($dodaj);
            header('Location:indexlog.php');
            exit();                               
        }
            
            //reakcja na modyfikuj
            $style = '';
            $valueNazwisko = '';
            $valueImie = '';
            $valueMiejscowosc = '';
            $valueUlica = '';
            $valueNrDomu = '';
            $valueNrMieszkania = '';
            $valueKodPocztowy = '';
            $valuePoczta = '';
            $valueMail = '';
            $inputHidden = '';
            
            if(isset($_GET['action']) && $_GET['action']=='mod' && !empty(trim($_GET['id']))){
                $id_mod = (int)$_GET['id'];
                $inputHidden = '<input type="hidden" name="idKontakt" value="'.$id_mod.'">';
                echo '<script>';
                ?>
                $(function(){
                $('#modal').css('display','block').hide().fadeIn(500);
                $('#dod').css('display','block').hide().slideDown(1000);
                });
                
                <?php
                echo '</script>';
                
                //zaczytujemy do formularza przy modyfikacji kontakty
                $zapytanie_mod = "select * from kontakty where id_kontakt=$id_mod";
                $wynik_mod = $db->db->query($zapytanie_mod);
                $row_mod = $wynik_mod->fetch_object();
                
                $valueNazwisko = $row_mod->nazwisko;
                $valueImie = $row_mod->imie;
                $valueMiejscowosc = $row_mod->miejscowosc;
                $valueUlica = $row_mod->ulica;
                $valueNrDomu = $row_mod->nr_domu;
                $valueNrMieszkania = $row_mod->nr_mieszkania;
                $valueKodPocztowy = $row_mod->kod_pocztowy;
                $valuePoczta = $row_mod->poczta;
                $valueMail = $row_mod->mail;                
            }          
            ?>
     <body>
        <div id="modal" style="<?php echo $style; ?>">
            
            <form method="post">
                
                <div id="dod" style="<?php echo $style; ?>">
                    
                    <div class="form-group">                        
                        <label for="nazwisko">Nazwisko</label>
                        <input name="nazwisko" id="nazwisko" class="form-control" value="<?php echo $valueNazwisko; ?>">
                    </div>
                        
                    <div class="form-group">                        
                        <label for="imie">Imie</label>
                        <input name="imie" id="imie" class="form-control" value="<?php echo $valueImie; ?>">
                    </div>
                        
                    <div class="form-group">                        
                        <label for="miejscowosc">Miejscowosc</label>
                        <input name="miejscowosc" id="miejscowosc" class="form-control" value="<?php echo $valueMiejscowosc; ?>">
                    </div>
                        
                    <div class="form-group">                        
                        <label for="ulica">Ulica</label>
                        <input name="ulica" id="ulica" class="form-control" value="<?php echo $valueUlica; ?>">
                    </div>
                        
                    <div class="form-group">                        
                        <label for="nr_domu">Numer domu</label>
                        <input name="nr_domu" id="nr_domu" class="form-control" value="<?php echo $valueNrDomu; ?>">
                    </div>
                        
                    <div class="form-group">                        
                        <label for="numer_mieszkania">Numer mieszkania</label>
                        <input name="nr_mieszkania" id="nr_mieszkania" class="form-control" value="<?php echo $valueNrMieszkania; ?>">
                    </div>
                        
                    <div class="form-group">                        
                        <label for="kod_pocztowy">Kod pocztowy</label>
                        <input name="kod_pocztowy" id="kod_pocztowy" class="form-control" value="<?php echo $valueKodPocztowy; ?>">
                    </div>
                        
                    <div class="form-group">                        
                        <label for="poczta">Poczta</label>
                        <input name="poczta" id="poczta" class="form-control" value="<?php echo $valuePoczta; ?>">
                    </div>
                        
                    <div class="form-group">                        
                        <label for="mail">Mail</label>
                        <input name="mail" id="mail" class="form-control" value="<?php echo $valueMail; ?>">
                    </div>
                    
                    <?php echo $inputHidden; ?>
                    
                    <input type="submit" name="zapisz" id="zapisz" class="btn btn-primary" value="Zapisz">
                    <input type="submit" name="anuluj" id="anuluj" class="btn btn-danger" value="Anuluj">
                
                </div> 
            </form>
            
            
        </div>
     
       
        
        <form method="get">
            
            <a href="#" id="dodaj" class="btn btn-primary">Dodaj</a>            
            <a href="?logout=yes" class="btn btn-danger" style="float:right" onclick="return confirm('Czy chcesz się wylogować ?')">Wyloguj</a>
            <input type="submit" name="szukaj" value="Szukaj" class="btn btn-default" style="margin-right: 20px;float: right">
            <input name="pattern" id="pattern" class="form-control" style="width: 200px;float: right;margin-right:20px ">
            <a href="indexlog.php" id="wyczysc" class="btn btn-primary" style="margin-right: 20px;float: right">Wyczyść filtr</a>
            
        </form>        
        <br>        
        <table class="table table-striped">
    
            <thead>
                <tr>
                    <th>L.p.</th>
                    <th>nazwisko</th>
                    <th>imię</th>
                    <th>miejscowość</th>
                    <th>ulica</th>
                    <th>nr domu</th>
                    <th>nr mieszkania</th>
                    <th>kod pocztowy</th>
                    <th>poczta</th>
                    <th>mail</th>
                    <th>data</th>
                    <th>Akcja</th>            
                </tr>
            </thead>
            <tbody>
        
            <?php
        
        // Wypisujemy rekordy z tabeli Kontakty
         
            $zapytanie = "select * from kontakty where id_user=$id_user";
            
            if(isset($_GET['pattern']) && !empty(trim($_GET['pattern']))){          
                $pattern = htmlentities($_GET['pattern']);
                $zapytanie .= " and (nazwisko like \"%$pattern%\" || imie like \"%$pattern%\")";               
                
            }            
            $wyslij = $db->db->query($zapytanie);
            $lp = 0;            
            while($row = $wyslij->fetch_object()){
                $lp++;
                echo "                
                 <tr>            
            <td>$lp</td>
            <td>$row->nazwisko</td>
            <td>$row->imie</td>
            <td>$row->miejscowosc</td>
            <td>$row->ulica</td>
            <td>$row->nr_domu</td>
            <td>$row->nr_mieszkania</td>
            <td>$row->kod_pocztowy</td>
            <td>$row->poczta</td>
            <td>$row->mail</td>
            <td>$row->data</td>
            <td><a href=\"?action=mod&id=$row->id_kontakt\" class=\"btn btn-sm btn-warning\">modyfikuj</a> <a href=\"?action=del&id=$row->id_kontakt\" onclick=\"return confirm('Czy naprawdę chcesz usunąć kontakt ?')\" class=\"btn btn-sm btn-danger\">usuń</a></td>                
                </tr>                
                ";                        
            }       
            ?>
            </tbody>
        </table>
        <?php
        if($lp==0){
        echo 'Brak rekordów';
        }
        ?>
       
        
    </body>
</html>


