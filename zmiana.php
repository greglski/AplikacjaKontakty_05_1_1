
<?php
require_once 'config/Config.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Zmiana hasła</title>
        <link rel="stylesheet" href="<?php echo WITRYNA; ?>css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo WITRYNA; ?>css/main.css">
        <script src="<?php echo WITRYNA; ?>scripts/jquery-3.1.1.min.js"></script>
        <script src="<?php echo WITRYNA; ?>scripts/script.js"></script>
        <script src="<?php echo WITRYNA; ?>scripts/startValidate.js"></script>
    </head>
    <body>
        <?php
        if(isset($_GET['mail'])){
            $mail = htmlentities($_GET['mail']);
            $sec = htmlentities($_GET['sec']);
            
            $zapytanie1 = "select security from users where mail='$mail'";
            $baza = new DbConnect();
            $wyslij = $baza->db->query($zapytanie1);
            $pobrane = $wyslij->fetch_object();
            
            
            if($sec != $pobrane->security){
                
                echo 'Coś kombinujesz....';
                exit();
            }
        }
        if(isset($_POST['zapisz'])){
            $pass1 = htmlentities($_POST['pass1']);
            $zapytanie2 = "UPDATE users set password='$pass1', security='' where mail='$mail'" ;
            $baza2 = new DbConnect();
            $baza2->db->query($zapytanie2);            
            
        }
        ?>
        <div class="start">        
        
            <form method="post">
            
                <div class="cont">
            
                    <h2>Przypomnij hasło</h2>
                    <div class="komunikat"></div>
        
                    <div id="log">
                        <div class="form-group">                        
                            <label for="passz1">Podaj nowe hasło</label>        
                            <input type="password" id="passz1" name="pass1">
                    </div>
        
                        <div class="form-group">                        
                            <label for="passz2">Powtórz nowe hasło</label>
                            <input type="password" name="pass2" id="passz2">
                        </div>
        
                        <input type="submit" name="zapisz" value="Zapisz" class="btn btn-primary">
            
                    </div>
            
                </div>
            
            
            
            </form>
        </div>
       
        
    </body>
</html>


