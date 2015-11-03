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
