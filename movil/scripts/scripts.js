




$(window).resize(function () {
    
    if ($(this).width() < 480)
    {
         llamadaAjax('smartphone');
     window.location.reload();
    
      
      
  }else if($(this).width()<768){
        llamadaAjax('tablet');
      window.location.reload();
      
     
  }else 
  {
       llamadaAjax('escritorio');
      window.location.reload();
      
  }
});


function llamadaAjax(device){
    $.ajax({
        type: "POST",
        url: "http://192.168.0.100/Tienda/scripts/setDevice.php",
        
        data: {
            dev: device
        }});
}




