function cargar_subcategorias(){
        var categoria = $('#categorias').val();
        var dataString = {'categoria': categoria,'opcategoria':1};
         
        $.ajax({
            type: "POST",
            url: "http://www.impuso2015.tk/controladores/controladorCategorias.php",
            data: dataString,
            success: function (data) {
             $('#subcategorias').html(data);
                

            }
        });
}