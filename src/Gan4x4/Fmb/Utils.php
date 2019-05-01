<?php

namespace Gan4x4\Fmb;

class Utils{
    
     public function getAjaxResponse($errorCode = 0, $message = "OK"){
        return [
            'error' => $errorCode,
            'message' => $message
            ];
    }
    
}