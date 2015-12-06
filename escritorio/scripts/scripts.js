expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
function validar(){
    if($('#ok_usuario').val() == 0)
    {
       $("body").cftoaster({content: "El nombre de usuario no está disponible",	bottomMargin: 150,showTime: 4000});
        $('#nombreusuario').focus();
        return false;
    }else if (!expr.test($('#email').val())){
       $("body").cftoaster({content: "El e-mail no es correcto",bottomMargin: 150,showTime: 4000});
        $('#email').focus();
        return false;
    }else if($('#ok_email').val()==0){
         $("body").cftoaster({content: "El e-mail ya está en uso",bottomMargin: 150,showTime: 4000});
        $('#email').focus();
        return false;
    }
   return true;
}
function validar_cambio(){
   
    if($('#clave').val() != $('#clave2').val()){
        $("body").cftoaster({content: "Las contraseñas no coinciden",bottomMargin: 150,showTime: 4000});
        return false;
    }
}


//comprobar usuario
$(document).ready(function () {
    $('#nombreusuario').blur(function () {
        if (document.getElementById("nombreusuario").value.length > 0)
            $('#estado_usuario').html('<img src="http://www.impuso2015.tk/imagenes/ajax-loader.gif" alt="" />');
        var username = $(this).val();
        var dataString = {'usuario': username, 'opusuario': 7};

        $.ajax({
            type: "POST",
            url: "http://www.impuso2015.tk/controladores/controladorUsuarios.php",
            data: dataString,
            success: function (data) {
                if (data == 1 && document.getElementById("nombreusuario").value.length > 0) {
                    document.getElementById("nombreusuario").style.background = "#FCB7B7";
                    $('#estado_usuario').html("<font color = 'red'>no disponible</font>");
                   $('#ok_usuario').val(0);
                    
                    
                }else if (data == 0 && document.getElementById("nombreusuario").value.length > 0) {
                    document.getElementById("nombreusuario").style.background = "#C8F7C8";
                    $('#estado_usuario').html("<font color = 'green'>disponible</font>");
                    $('#ok_usuario').val(1);
                    
                }


            }
        });
    });
});
//comprobar email
$(document).ready(function () {
    $('#email').blur(function () {
         if (document.getElementById("email").value.length > 0)
        if(expr.test($('#email').val())){
        $('#estado_email').html('<img src="http://www.impuso2015.tk/imagenes/ajax-loader.gif" alt="" />');
        var username = $(this).val();
        var dataString = {'email': username, 'opusuario': 8};

        $.ajax({
            type: "POST",
            url: "http://www.impuso2015.tk/controladores/controladorUsuarios.php",
            data: dataString,
            success: function (data) {
                if (data == 1 && document.getElementById("email").value.length > 0) {
                    document.getElementById("email").style.background = "#FCB7B7";
                    $('#estado_email').html("<font color = 'red'>no disponible</font>");
                    $('#ok_email').val(0);
                }
                else if (data == 0 && document.getElementById("email").value.length > 0) {
                    document.getElementById("email").style.background = "#C8F7C8";
                    $('#estado_email').html("<font color = 'green'>disponible</font>");
                    $('#ok_email').val(1);
                }


            }
        });}else
            $('#estado_email').html("<font color = 'red'>email no válido</font>");v
    });
});
//iniciar elevatezoom
$(document).ready(function () {
    $("#zoom_01").elevateZoom();
});

$(document).ready(function () {
    $('#showlogin').click(function () {
        $('#loginpanel').slideToggle('fast', function () {
            $("#triangle_down").toggle();
            $("#triangle_up").toggle();
        });
    });
});

//script de facebook
(function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id))
        return;
    js = d.createElement(s);
    js.id = id;
    js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
//script de twitter
!function (d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
    if (!d.getElementById(id)) {
        js = d.createElement(s);
        js.id = id;
        js.src = p + '://platform.twitter.com/widgets.js';
        fjs.parentNode.insertBefore(js, fjs);
    }
}(document, 'script', 'twitter-wjs');
//script de g+
window.___gcfg = {lang: 'es'};

(function () {
    var po = document.createElement('script');
    po.type = 'text/javascript';
    po.async = true;
    po.src = 'https://apis.google.com/js/platform.js';
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(po, s);
})();
