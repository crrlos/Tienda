
<?php
$mail = "Prueba de mensaje";
//Titulo
$titulo = "Reestablecimiento de contraseña";
//cabecera
$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
//dirección del remitente 
$headers .= "From: Tienda";
//Enviamos el mensaje a tu_dirección_email 
$bool = mail("crrlos1810@gmail.com",$titulo,$mail,$headers);
if($bool){
    echo "Mensaje enviado";
}else{
    echo "Mensaje no enviado";
}
?>