<?php
echo $_SERVER['DOCUMENT_ROOT'];
 if (file_exists(__DIR__.'/../imagenes/01231'))
         echo 'existe';
 else{
     echo 'no existe';
     mkdir(__DIR__.'/../imagenes/01231',0777);
 }