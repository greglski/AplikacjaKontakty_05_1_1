$(function(){
//        alert('eee');
$('#dodaj').click(function(event){
    //blokada domyslnej akcji
    
    event.preventDefault();
    
    $('#modal').css('display','block').hide().fadeIn(500);
    $('#dod').css('display','block').hide().slideDown(1000);    
    
});

$('#anuluj').click(function(event){
    
    event.preventDefault();
    $('#modal').fadeOut(1000);
    $('#dod').slideUp(100);
    var ciag = window.location.search;
//    if (ciag.lastIndexOf("action=mod") != -1) alert("Ciąg zawiera frazę 'action=mod'");
    if (ciag.lastIndexOf("action=mod") != -1){
        setTimeout("location.replace('indexlog.php'),2500");
    }
    
    
});

$(document).keyup(function(e){
    //klawisz escape = 27
    if(e.keyCode === 27){   
        
    $('#modal').fadeOut(1000);
    $('#dod').slideUp(100);
    
    var ciag = window.location.search;
//    if (ciag.lastIndexOf("action=mod") != -1) alert("Ciąg zawiera frazę 'action=mod'");
    if (ciag.lastIndexOf("action=mod") != -1){
        setTimeout("location.replace('indexlog.php'),2500");
    
      
    }
}
    
});


                
});