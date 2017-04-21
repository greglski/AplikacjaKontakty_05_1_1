$(function(){
    
    
    $('#login').blur(function(){
//       alert('dddddddddddd');
       
       //obsługa zapytan ajax przez jQuery
       
       
       if($(this).val().length > 1){
        
        
        $.ajax({
           url:'sprawdz.php?login='+$(this).val(),
           
           success:function(s){
               
               if(s==='TAK'){
                   
                   $('#loginSpan').html('Taki login jest zajęty!').css('color','red').hide().fadeIn('slow');
                   
               } else {
                   
                   $('#loginSpan').html('Taki login jest wolny !').css('color','green');
                   
               }
           },
           error: function(e){
               alert('Błąd połączenia');
           }
           
           
           
       });
   
        } else {
            $('#loginSpan'.empty());
        }
        
        
        
    });
    
        
});
