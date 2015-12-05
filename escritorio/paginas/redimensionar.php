<?php

header('Content-type: image/jpeg');

$imagen = new Imagick('image.jpg');
$image->adaptiveResizeImage(1024,768);

echo $imagen;