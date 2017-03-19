<?php
/* imghardchache
 * imghardchache creates thumbs of images as file
*  using https://github.com/Nimrod007/PHP_image_resize/
*/

// Settings
$originalname = "" ;
$requestedname = "" ;

// Start caching
require_once('PHP_image_resize/smart_resize_image.function.php');

$requestedname = basename($_SERVER['REQUEST_URI']);  
if ( $requestedname == basename($_SERVER['SCRIPT_NAME']) ) die("get a image");  


$pattern = '/(.*)__(.*)\.(.*)/i';
$replacementoriginal = '${1}.$3';
$replacementsize = '$2';
$originalname .= preg_replace($pattern, $replacementoriginal, $requestedname);
$width = preg_replace($pattern, $replacementsize, $requestedname);

//call the function (when passing path to pic)
$resized = smart_resize_image( 
    $originalname , 
    null,
    $width ,
    '0' , //height will be ignored, due proportional true
    true , //  proportional
    $requestedname , 
    false ,
    false ,
    100 
);

// after creating image. send it, only the first time, 
if ( $resized == "1" ){
    header('Content-type: image');
    readfile( $requestedname );
    } else {
    echo "there is no " . $originalname ;
}
?>
