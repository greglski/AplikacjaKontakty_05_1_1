
<?php
require_once 'config/Config.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Potwierdzenie rejestracji</title>
        <link rel="stylesheet" href="<?php echo WITRYNA; ?>css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo WITRYNA; ?>css/main.css">
        <script src="<?php echo WITRYNA; ?>scripts/jquery-3.1.1.min.js"></script>
        <script src="<?php echo WITRYNA; ?>scripts/script.js"></script>
        <script src="<?php echo WITRYNA; ?>scripts/startValidate.js"></script>
    </head>
    <body>
        <?php
        
        $mail = htmlentities($_GET['mail']);
        $sec = htmlentities($_GET['sec']);
        $zapytanie="select id_user from users where mail='$mail' and security='$sec' and aktywne=0";
        $account = new Account();
        $account->potAccount($zapytanie, $mail);
        $zalozone = $account->zalozone;
        ?>
        
        <div class="start">
        <form>
            <div class="cont">
            <h2>Potwierdzenie założenia<br>konta</h2>
                <div id="komunikat">
                    <?php if($zalozone){echo $zalozone;} ?>
                </div>
                <div id="info">
         
                    <a href="index.php" class="btn btn-warning">Powrót do logowania</a>
                </div>
            </div>
    
    
        </form>
        </div>
        
        
        
    </body>
</html>
