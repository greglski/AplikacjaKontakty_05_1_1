




<?php
$wyslana = '';
if(isset($_POST['zapisz'])){
    
$login = htmlentities($_POST['login']);
$haslo = htmlentities($_POST['haslo']);
$haslo2 = htmlentities($_POST['haslo2']);
$mail = htmlentities($_POST['mail']);
$hasloSha1 = sha1($_POST['haslo']);
//    echo $sec;
//    die();

//$regulamin = htmlentities($_POST['regulamin']);


$walidacja = new Validate();
$walidacja->puste($login, 'Login');
$walidacja->minIloscZnakow($login, 'Login', 2);
$walidacja->weryfikacjaHasla($haslo, 'Hasło');
$walidacja->porownaj($haslo, 'Hasło', $haslo2, 'Hasło2');
$walidacja->weryfikacjaMaila($mail, 'Mail');

if(!isset($_POST['regulamin'])){
    
    $walidacja->isChecked('Regulamin');
}

if($walidacja->liczError == 0){
    $sec = sha1(uniqid());
    $now = date('Y-m-d');
    
    
    $zapytanie = "INSERT INTO `users`(`id_user`, `login`, `password`, `mail`, `is_admin`, `aktywne`, `security`, `data_dodania`) VALUES (NULL,'$login', '$hasloSha1','$mail',0,0,'$sec','$now')";
    
    $zapytanie_weryfikacja = "select id_user from users where login='$login'";
    
//    $zapytanie_weryfikacja_mail = "select id_user from users where mail='$mail'";
    
//    echo $zapytanie;
//    exit();
    
    $account = new Account();
//    $account->addAccount($zapytanie,$zapytanie_weryfikacja,$zapytanie_weryfikacja_mail);
    $account->addAccount($zapytanie,$zapytanie_weryfikacja);
    if($account->istnieje ==0){
    $e_mail= new sendMail(E_MAIL_ADMIN);
    $message = "<a href=\"".WITRYNA."potwierdzenie.php?mail=$mail&sec=$sec\">kliknij aby potwierdzić</a>";
    $e_mail->send($mail, 'Aktywacja konta w aplikacji Kontakty', $message); 
    $wyslana = $e_mail->wyslana;
    
    }
}
    
    
}

?>
    
  
<div class="start">
    <div class="cont">
        <h2>Załóż konto</h2>
        <div id="komunikat">
            <?php unset($walidacja);
            if($wyslana){echo 'Na Twój adres e-mail: '.$mail.'<br>przesłaliśmy prośbę o aktywację konta.<br>Prosimy teraz o aktywację konta';}
             ?>
        </div>
        <div id="info">
    <form method="post" class="form-horizontal">
            
        <div class="form-group">
            <label for="login" class="col-sm-3 col-sm-offset-1 control-label" style="text-align: right; margin-right: 0; padding-right: 0;">Podaj login</label>
            <div class="col-sm-5" style="padding: 0; margin: 0;">
             <input name="login" id="login" value="<?php if(isset($_POST['login'])){echo $_POST['login'];} ?>"> <span id="loginSpan"></span>
        </div>   
        </div>   
    
        <div class="form-group">
         <label for="password1" class="col-sm-3 col-sm-offset-1 control-label" style="text-align: right; margin-right: 0; padding-right: 0;">Podaj hasło</label>
         <div class="col-sm-5" style="padding: 0; margin: 0;">
             <input type="password" name="haslo" id="password1">
        </div>
        </div>   
            
        <div class="form-group">
         <label for="password2" class="col-sm-3 col-sm-offset-1 control-label" style="text-align: right; margin-right: 0; padding-right: 0;">Powtórz hasło</label>
         <div class="col-sm-5" style="padding: 0; margin: 0;">
         <input type="password" name="haslo2" id="password2">
        </div>
        </div>
            
        <div class="form-group">
         <label for="mail1" class="col-sm-3 col-sm-offset-1 control-label" style="text-align: right; margin-right: 0; padding-right: 0;">Podaj e-mail</label>
         <div class="col-sm-5" style="padding: 0; margin: 0;">
         <input name="mail" id="mail1" value="<?php if(isset($_POST['mail'])){echo $_POST['mail'];} ?>"><span id="mailSpan"></span>
        </div>
        </div>
            
        <div class="checkbox">
            <label>
         <input type="checkbox" name="regulamin" value="zgoda"> Zaakceptuj regulamin<br>
            </label>
         </div>
            
         <input type="submit" name="zapisz" value="Zapisz" class="btn btn-primary">
         <a href="index.php" class="btn btn-warning">Porót do logowania</a>
        </form>
        </div>
    </div>
    
    
</div>