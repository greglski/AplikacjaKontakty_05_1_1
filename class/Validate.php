<?php

class Validate{
    //wlasciwosc error sluzaca do przechowywania bledow
    private $error;
    
    public $liczError;
    
    function __construct() {
        $this->error='';
        $this->liczError=0;
    }
    
    function puste($ciag,$pole){
        
        if(empty(trim($ciag))){
            $this->AddError("Pole $pole nie może być puste.");
            $this->liczError++;
        }
        
    }
    
    function znakiPL($ciag,$pole){
        //preg_match sluzy do testowania czy danyznak nie wystapil w podanym wzorcu
        if(preg_match('/[ąęółśćźżń]/i', $ciag)){
            $this->AddError("Pole $pole nie może zawierać znaków PL.");
            $this->liczError++;
            
        }
        
    }
    
    function znakiSpecjalne($ciag,$pole){
        if(preg_match('/[?@$#!%^&*{}\[\]]/',$ciag )){
            
            
            $this->AddError("Pole  $pole nie może zawierać znaków specjalnych: ?@$#!%^&*{}[]");
            $this->liczError++;
        }
        
    }
    
    function znakiOK($ciag,$pole){
        //sprawdzic
        if(!preg_match('/[a-z_.]/i', $ciag)){
            $this->AddError("Pole $pole nie może zawierać cyfr i znaków specjalnych");
            $this->liczError++;
            
        }
        
    }
    
    function minIloscZnakow($ciag, $pole, $min){
        if(strlen(trim($ciag)) < $min){
            $this->AddError("Pole $pole nie może być za krótkie, minimalna iość znaków to : $min");
            $this->liczError++;
        }
    }
    
    function porownaj($ciag1, $pole1,$ciag2, $pole2){
        if($ciag1!=$ciag2){
            $this->AddError("Błędnie powtórzyłeś $pole1, spróbuj ponownie.");
            $this->liczError++;
            
        }
    }
    
    function weryfikacjaMaila($ciag,$pole){
        if(!filter_var($ciag,FILTER_VALIDATE_EMAIL)){
            
            $this->AddError("Pole $pole nie zawiera poprawnego maila");
            $this->liczError++;
        }
    }
    
    function czyJestLiczba($ciag, $pole){
        
        if(!filter_var($ciag, FILTER_VALIDATE_INT)){
            
            $this->AddError("Wprowadź cyfry w pole $pole");
            $this->liczError++;
        }
    }
    
    function weryfikacjaHasla($ciag, $pole){
        
        if(!preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(?=.*[!@#$%^&*()_+|-]).{8,30}$/",$ciag)){
            
            $this->AddError("Pole $pole nie spełnia wymagań złożoności. Musi zawierać od 8 do 30 znaków  ");
            $this->liczError++;
        }
    }
    
    function isChecked($pole){
        $this->AddError("Pole $pole musi być zaznaczone");
            $this->liczError++;
    }
            
            
    
            
    function AddError($text){
        
        $this->error.=$text.'<br>';
            
    }
    
    function __destruct() {
        if(!empty($this->error)){
            echo '<div class="error">'.$this->error.'</div>';
    }
    
    }
    
}

