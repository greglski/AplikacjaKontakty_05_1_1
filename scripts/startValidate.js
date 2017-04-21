$(function(){
   $('#zalogujS1').click(function(e){
       e.preventDefault();
      
       
       var loguj = $('#loguj').val();
       var password = $('#password').val();
       
//       alert(login + haslo);
       
       $.ajax({
           
          type: "POST",
          url: "sprawdzanie.php",
          data:{
              
              login: loguj,
              haslo: password
          },
          
          success: function(odpowiedz){
              
              
              if(odpowiedz !== ''){
              
//              alert(odpowiedz);
              
//                $('#start').fadeIn(2000).delay(3000).fadeOut(1000);
                
                $('#komunikatS1').html(odpowiedz).hide().fadeIn(2000);
              
              } else {
              
              $('#formStart1').submit();
          }
      }
           
       });
       
       
       
   }); 
    
});
