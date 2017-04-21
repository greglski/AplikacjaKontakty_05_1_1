<?php

class Account extends DbConnect{
    
    
//    function addAccount($zapytanie,$zapytanie_weryfikacja,$zapytanie_weryfikacja_mail){
    function addAccount($zapytanie,$zapytanie_weryfikacja){
        
        $spr = $this->db->query($zapytanie_weryfikacja);
//        $spr_mail = $this->db->query($zapytanie_weryfikacja_mail);
        
        $this->istnieje = 0;
        
        
        if($spr->num_rows != 0){
            $this->istnieje++;
            echo 'Taki login już istnieje';
                
                
        }
        
//        if($spr_mail->num_rows != 0){
//            $this->istnieje++;
//            
//            echo 'Taki mail już istnieje.';
//        }
        
        if($this->istnieje == 0){
            $this->db->query($zapytanie);
            
        }
    }
        
        //zapomnialem
    
    function rememberPass($zapytanie_mail){            
        
        $wynik = $this->db->query($zapytanie_mail);        
        
        $wynik2 = $wynik->fetch_object();
        
        $this->istnieje = 0;
        
        if($wynik->num_rows != 0){
            $this->istnieje++;
            
        }
    }
                
     
    function potAccount($zapytanie,$mail){
        
        $this->zalozone = '';
        
        $wynik = $this->db->query($zapytanie);
        if($wynik->num_rows==1){
            $zapytanie_update = "update users set aktywne=1 where mail='$mail'";
//            echo $zapytanie_update;
//            exit();
            $potwierdzenie1 = $this->db->query($zapytanie_update);
            if($potwierdzenie1){
                $this->zalozone = 'Proces potwierdzenia został zakończony poprawnie.<br>Zaloguj się i rozpocznij korzystanie z serwisu.';
                
//                echo 'Proces potwierdzenia został zakończony poprawnie.<br>Zaloguj się i rozpocznij korzystanie z serwisu.';
            }else{
                $this->zalozone = 'Podczas potwierdzania wystąpił błąd.<br>Skontaktuj się z nami';
//                echo 'Podczas potwierdzania wystąpił błąd.<br>Skontaktuj się z nami';
            }
            
        } else {
            $this->zalozone = 'Dane potwierdzenia niepoprawne<br>lub<br>konto zostało już aktywowane';
//            echo 'Dane potwierdzenia niepoprawne<br>lub<br>konto zostało już aktywowane';
        }
        
    }
    
    
    
    
            
    function modAccount(){
        
        
    }
    
    function delAccount(){
        
        
        
    }
    
    
    
}


