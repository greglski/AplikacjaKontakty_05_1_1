<?php


        $value = '';
        $checked = '';
        
        if(isset($_COOKIE['login'])){
            
            $checked = 'checked="checked"';
            $wartosc = $_COOKIE['login'];
            $value = "value=\"$wartosc\"";
        }
        
        if(isset($_POST['login']) && isset($_POST['haslo'])){
            
            $login = htmlentities($_POST['login']);
            $haslo = htmlentities($_POST['haslo']);
            $hasloSha1 = sha1(htmlentities($_POST['haslo']));
            
//            $walidacja = new Validate();
//            $walidacja->puste($login, 'Login');
//            $walidacja->puste($haslo, 'Hasło');
            
            
//            if($walidacja->liczError == 0){
            $sess = new mySession();
            $sess->sessStart($login, $hasloSha1);
            
            
//            unset($walidacja);
        }
              

?>
<div class="start">

    <form method="post" id="formStart1">
    
    <div class="cont">
        
        <h1>Kontakty</h1>
        
        <div class="komunikat" id="komunikatS1"></div>
        
        <div id="log">
        <div class="form-group">                        
           <label for="loguj">Podaj login</label>
               <input name="login" id="loguj" <?php echo $value;?> >
        </div>
        <div class="form-group">    
           <label for="password">Podaj hasło</label>
           <input type="password" id="password" name="haslo">
        </div>
        <div class="checkbox">    
            <input type="checkbox" name="zapamietaj" value="tak" <?php echo $checked;?> > Zapamiętaj login<br>
        </div>
            <input type="submit" name="zaloguj" id="zalogujS1" class="btn btn-primary" value="zaloguj">            
        </div>
            
    
        <div id="nowy">
            <a href="index.php?page=zaloz_konto" class="btn btn-success">Załóż nowe konto</a>
            <a href="index.php?page=nie_pamietam" class="btn btn-warning">Zapomniane hasło</a>
        </div>    
        
    </div>
    </form>
</div>  
        
        
        
      