function validar(){
    if(document.getElementById("ok_usuario").value == 0)
    {
        var toast = $(window).AndroidToast({
			message : "El usuario no está disponible",
                        stayTime:"3000"
                        
		});
        toast.AndroidToast('show');
        return false;
    }
    
  expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if ( !expr.test(document.getElementById('email').value)){
        var toast = $(window).AndroidToast({
			message : "El email ingresado no es válido",
                        stayTime:"3000"
                        
		});
        toast.AndroidToast('show');
        
        
        document.getElementById("email").focus();
        return false;
    }
   return true;
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
                    document.getElementById("ok_usuario").value = 0;
                    
                }
                else if (data == 0 && document.getElementById("nombreusuario").value.length > 0) {
                    document.getElementById("nombreusuario").style.background = "#C8F7C8";
                    $('#estado_usuario').html("<font color = 'green'>disponible</font>");
                    document.getElementById("ok_usuario").value = 1;
                    alert(document.getElementById("ok_usuario").value);
                }


            }
        });
    });
});
//comprobar email
$(document).ready(function () {
    $('#email').blur(function () {
         if (document.getElementById("email").value.length > 0)
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
                }
                else if (data == 0 && document.getElementById("email").value.length > 0) {
                    document.getElementById("email").style.background = "#C8F7C8";
                    $('#estado_email').html("<font color = 'green'>disponible</font>");
                }


            }
        });
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
