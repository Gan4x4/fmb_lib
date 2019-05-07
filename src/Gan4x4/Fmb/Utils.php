<?php

namespace Gan4x4\Fmb;

class Utils{
    
    const ERROR_ALREADY_EXISTS = 50;
    const ERROR_NO_IMAGES = 1;
    
    
     public static function getAjaxResponse($errorCode = 0, $message = "OK"){
        return [
            'error' => $errorCode,
            'message' => $message
            ];
    }
    
    // Save Image from URL to local temp dir
    public static function saveImage($url){
        
        if (strpos($url, "http:") === false){
            $imgUrl = "http:".$url;
        }else{
            $imgUrl = $url;    
        }
        
        $ext = pathinfo($imgUrl, PATHINFO_EXTENSION);
        $tempImage = tempnam(sys_get_temp_dir(),"ext_img").".".$ext;
        copy($imgUrl, $tempImage);
        return $tempImage;
    }
    
}