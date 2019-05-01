<?php

namespace Gan4x4\Fmb;

use Intervention\Image\ImageManager;
use Intervention\Image\ImageManagerStatic;

trait ImageTrait {
    
    public function url(){
        return asset('storage'.DIRECTORY_SEPARATOR.config('constants.image_path').DIRECTORY_SEPARATOR.$this->filename);
    }
    
    public function getThumbUrl(){
        $thumb_path = $this->getThumbPath();
        if (! file_exists(storage_path('app/'.$thumb_path))) {
            $this->createThumb();
        }
        
        return "/storage/".substr($thumb_path,7);
    }
    
    private function getThumbPath(){
        return 'public'.DIRECTORY_SEPARATOR.config('constants.image_path').DIRECTORY_SEPARATOR.$this->thumb_dir.DIRECTORY_SEPARATOR.$this->filename;
    }
    
    private function getFullThumbPath(){
        return storage_path('app/'.$this->getThumbPath());
    }
    
    private function createThumb(){
        try{
            $img = ImageManagerStatic::make($this->path());
        }catch(\Exception $e){
            print("Image not found ".$this->id);
            return;
        }
        
        $img->resize($this->thumb_width, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        //$path = storage_path('app/'.$this->getThumbPath());
        $img->save($this->getFullThumbPath());
    }
    
    public function path(){
        return storage_path('app/public'.DIRECTORY_SEPARATOR.config('constants.image_path').DIRECTORY_SEPARATOR.$this->filename);
    }
    
    public static function hashFunction($path){
        return md5_file($path);
    }
    
    // Override
    public function save(array $options = array()){
        $size = getimagesize($this->path());
        $this->width = $size[0];
        $this->height = $size[1];
        $this->hash = self::hashFunction($this->path());
        parent::save($options);
    }
    
    
}





