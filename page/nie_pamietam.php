
<?php

$noMail = '';

if(isset($_POST['przypomnij'])){
    $mail = htmlentities($_POST['mail']);
    $zapytanie = "select `id_user` from `users` where `mail`='$mail'";
    $baza = new DbConnect();
    $wynik = $baza->db->query($zapytanie);
    if($wynik->num_rows == 1){
        
        $sec = sha1(uniqid());
        $zapytanie = "update `users` set `security`='$sec' where `mail`='$mail'";
        $modyfikuj = $baza->db->query($zapytanie);
        
        if($modyfikuj){
        $message = "Link do zmiany hasła znajduje się <a href=\"".WITRYNA."zmiana.php?mail=$mail&sec=$sec\">tutaj</a>";
        $e_mail = new SendMail(E_MAIL_ADMIN);
        $e_mail->send($mail, 'Zmiana hasła w aplikacji Kontakty', $message);
        $noMail = $e_mail->wyslana;
        
        }
    
        
    } else {
        
        $noMail = 'Nie odnaleziono podanego maila';
    }
}
?>

<div class="start">

<form method="post">
    <div class="cont">
        
        <h2>Przypomnij hasło</h2>
        
        <div class="komunikat">
            <?php echo $noMail;  ?>
        </div>
        
<div id="log">
        <div class="form-group">                        
           <label for="mail3">Podaj e-mail</label>
    <input name="mail" id="mail3">
        </div>
    <input type="submit" name="przypomnij" value="Przypomnij" class="btn btn-primary">
</div>
</form>
<a href="index.php" class="btn btn-warning">Powrót do logowania</a>
    </div>

</div>

