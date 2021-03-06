<?php
/* imghardchache
 * imghardchache creates thumbs of images as file
*  using https://github.com/Nimrod007/PHP_image_resize/
*/

// Settings
$originalname = "" ;
$requestedpath = "" ; // path for cache

// purge cache
if(isset( $_GET['purge'] )) {
    $glob = glob( $requestedpath  . '*' );
    foreach($glob as $filename) { // just if orignal and cache dir is the same
        if(preg_match('/.*__[0-9]*\..*/', $filename)) {
            unlink( $filename );
            echo 'removed: '. $filename . '<br />';
        }
    }
    die('all cache cleared');
}

// Start caching
require_once('PHP_image_resize/smart_resize_image.function.php');

$requestedname = basename($_SERVER['REQUEST_URI']);  
if ( $requestedname == basename($_SERVER['SCRIPT_NAME']) ) die("get a image");  

$pattern = '/(.*)__([0-9]+)\.(.*)/i';
$replacementoriginal = '${1}.$3';
$replacementsize = '$2';
$originalname .= preg_replace($pattern, $replacementoriginal, $requestedname);
$width = preg_replace($pattern, $replacementsize, $requestedname);


$requestedpath .= $requestedname ;

//call the function (when passing path to pic)
$resized = smart_resize_image( 
    $originalname , 
    null,
    $width ,
    '0' , //height will be ignored, due proportional true
    true , //  proportional
    $requestedpath , 
    false ,
    false ,
    100 
);

// after creating image. redirect to new image
if ( $resized == "1" ){
    header("HTTP/1.1 301 Moved Permanently"); 
    header("location: " . $requestedpath );
    exit ; 
    } else {
    echo "there is no " . $originalname ;
    exit ; 
}
?>
