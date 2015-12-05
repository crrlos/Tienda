<html>
    <head>
       <script src="http://code.jquery.com/jquery-2.1.4.min.js" type="text/javascript"></script>
        
        <script type="text/javascript">
            $(document).ready(function () {
                $('#usuario').blur(function () {

                    $('#Info').html('<img src="loader.gif" alt="" />').fadeOut(1000);

                    var username = $(this).val();
                    var dataString = 'usuario=' + username;

                    $.ajax({
                        type: "POST",
                        url: "http://www.impuso2015.tk/paginas/comprobar.php",
                        data: dataString,
                        success: function (data) {
                           if(data == 1)
                           {
                               $('#Info').fadeIn(1000).html(data);
                           }
                            
                        }
                    });
                });
            });
        </script>
    </head>
    <body>
        <form action="pagina.php" method="get" name="form1">
             <input type="hidden" id="pasa" name="pasa">
             <input type="text" name="usuario" id="usuario" value="jeje"><div id="Info"></div>
            <br> <input type="text" name="clave" id="clave">
        <input type="submit">
        </form>
    </body>
</html>