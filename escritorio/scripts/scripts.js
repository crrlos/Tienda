function recargarMunicipios(val){
 
   //esperando la carga...
   $('#muncipio').html('<option value="">Cargando...aguarde</option>');
   //realizo la call via jquery ajax
   $.ajax({
		url: '/paginas/actualizarMunicipios.php',
		data: 'id='+val,
		success: function(resp){
                  
		 $('#municipio').html(resp)
		 }
	});
}
$(document).ready(function() {
	$('#showlogin').click(function() {
	  $('#loginpanel').slideToggle('fast', function() {
		  $("#triangle_down").toggle(); 
		  $("#triangle_up").toggle();
	  });
	});
 });