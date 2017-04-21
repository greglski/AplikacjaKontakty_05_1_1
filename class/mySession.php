<?php

class mySession{
    
    function __construct() {
        session_start();
    }
            
    
    function sessStart($login, $haslo){
        
          $polacz = new DbConnect();
          $zapytanie = "select id_user, login from users where login='$login' and password='$haslo'";
          $wynik = $polacz->db->query($zapytanie);
          $wynik2 = $wynik->fetch_object();
          if($wynik->num_rows == 1){
               
            if(isset($_POST['zapamietaj']) && $_POST['zapamietaj']=='tak'){
                //tworzenie ciasteczek
                //setcookie(nazwa,wartość,data);
                
            setcookie('login',$login, time()+(60*60*24*7));
                
            } else {
                
                setcookie('login',$login, time()-120);
            }
         
               
               
               $_SESSION['identyfikator_sesji'] = session_id();
               $_SESSION['id_user'] = $wynik2->id_user;
               $_SESSION['login'] = $wynik2->login;
               $_SESSION['klient'] = $_SERVER['HTTP_USER_AGENT'];
               $_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
               header('Location:indexlog.php');
               exit();
           } else {
               header('Location:index.php?logowanie=no');
               exit();
           }
        
    }
    
    
    function sessVer(){
        
        if(!isset($_SESSION['id_user']) || $_SESSION['identyfikator_sesji'] != session_id()  || $_SESSION['ip'] != $_SERVER['REMOTE_ADDR'] 
        || $_SESSION['klient'] != $_SERVER['HTTP_USER_AGENT']){
    header('Location:index.php');
    exit();
    }
                
    }
    
    
    function sessEnd(){
       
      //    unset($_SESSION['identyfikator_sesji']);
//    unset($_SESSION['id_user']);
    
    //przypisuję pustą tablicę w efekcie wszystkie zmienne $_SESSION zostają usunięte
    $_SESSION = array();
    session_regenerate_id();
    session_destroy();
    header('Location:index.php');
    exit();
        
    }
    
    
    
    
    
    
}