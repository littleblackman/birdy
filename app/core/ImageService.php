<?php

namespace Etsik\Core;


class ImageService
{
    protected $folder;
    protected $imageName;
    protected $imagePath;
    protected $extension;

    protected $extensions = ['jpg','jpeg','png','gif'];
    protected $mimes = ['image/jpeg','image/gif','image/png'];

    public function upload($fileData) {
        if (($fileData['name']!="")){
            $horodate = date('dhis');
            $target_dir = ROOT."assets/upload/img/";
            $file = $fileData['name'];
            $path = pathinfo($file);
            $filename = $path['filename'].'_'.$horodate;
            $ext = $path['extension'];
            $temp_name = $fileData['tmp_name'];

            $path_filename_ext = $target_dir.$filename.".".$ext;
            
           // Check if file already exists
           if (file_exists($path_filename_ext)) {
               $message = "file saved";
            }else{
                move_uploaded_file($temp_name,$path_filename_ext);
                $message = "file saved";
            }
       } else {
           $message = "Error - can't saved";
       }

       if($message == "file saved") {
           $this->setImageName($filename.".".$ext);
           $this->setFolder("upload/img/");
           $this->setImagePath($this->getFolder().$this->getImageName());
       }

       return $this->getImagePath();
    }

    /**
     * Resize Img
     *
     * source: https://www.frederic-gerard.com/scripts/script-php-pour-redimentionner-une-image-en-conservant-les-proportions.html
     * 
     * @param [string] $img
     * @param [string] $image_dest
     * @param string $type
     * @return void
     */
    public function resize($max_size = 300, $type = "auto", $quality = 100, $img = null, $dest = null) {

        if(!$img) $img = ROOT.'assets/'.$this->getImagePath();

        if(!file_exists($img)) return $img." is not found";

        if($dest == "") $dest = ROOT.'assets/'.$this->getFolder().'resized';

        $tab_ext = explode('.', $img);
        $extension  = strtolower($tab_ext[count($tab_ext)-1]);

        if (!in_array($extension,$this->extensions)) return 'this_not_img';

        $data = getimagesize($img);

        $width  = $data[0];
        $height = $data[1];

        // check if it's portrait or landscape img
        /**** calcul new dimension *****/

        if($width >= $height && $type != "height") {

            // Calcul new dim from width
            if($max_size >= $width) return 'no_need_to_resize';
    
            $new_width = $max_size;
            $reduction = ( ($new_width * 100) / $width );
            $new_height = round(( ($height * $reduction )/100 ),0);
    
        } else {
    
            // Calcul new dim from height
            if($max_size >= $height) return 'no_need_to_resize';
        
            $new_height = $max_size;
            $reduction = ( ($new_height * 100) / $height );
            $new_width = round(( ($width * $reduction )/100 ),0);

        };

        // Create new IMG
        $img_dest = imagecreatetruecolor($new_width, $new_height);
        
        switch($extension){
            case 'jpg':
            case 'jpeg':
            $src = imagecreatefromjpeg($img);
            break;
    
            case 'png':
            $src = imagecreatefrompng($img);
            break;
    
            case 'gif':
            $src = imagecreatefromgif($img);
            break;
        }

        if(!imagecopyresampled($img_dest, $src, 0, 0, 0, 0, $new_width, $new_height, $width, $height)) return "resize error";

        $new_name = 'resized_'.$this->getImageName();

        // Place img in folder
        switch($extension){
            case 'jpg':
            case 'jpeg':
            imagejpeg($img_dest , $dest.'/'.$new_name, $quality);
            break;

            case 'png':
            $black = imagecolorallocate($img_dest, 0, 0, 0);
            imagecolortransparent($img_dest, $black);

            $compression = round((100 - $quality) / 10,0);
            imagepng($img_dest , $dest.'/'.$new_name, $compression);
            break;

            case 'gif':
            imagegif($img_dest , $dest.'/'.$new_name);
            break;
        }

        return $dest.'/'.$new_name;
    }


    public function crop($img = null) {
        if(!$img) $img = ROOT.'assets/'.$this->getImagePath();

        $tab_ext = explode('.', $img);
        $extension  = strtolower($tab_ext[count($tab_ext)-1]);

        switch($extension){
            case 'jpg':
            case 'jpeg':
            $src = imagecreatefromjpeg($img);
            break;
    
            case 'png':
            $src = imagecreatefrompng($img);
            break;
    
            case 'gif':
            $src = imagecreatefromgif($img);
            break;
        }

        $data = getimagesize($img);

        $width  = $data[0];
        $height = $data[1];

        $x = 0; $y = 0;

        if($width >= $height) {
            $limit = $height;
            $x = ($width - $limit) / 2;
        } else {
            $limit = $width;
            $y = ($height - $limit) / 2;
        }


        $img_dest = imagecreatetruecolor(100, 100);

       
        if(!imagecopyresampled($img_dest, $src, 0, 0, $x, $y, 100, 100, $limit, $limit)) return "resize error";

        $new_name = 'cropped_'.$this->getImageName();
        $dest = ROOT.'assets/'.$this->getFolder().'cropped'; 

        // Place img in folder
        switch($extension){
            case 'jpg':
            case 'jpeg':
            imagejpeg($img_dest , $dest.'/'.$new_name, 100);
            break;

            case 'png':
            $black = imagecolorallocate($img_dest, 0, 0, 0);
            imagecolortransparent($img_dest, $black);

            $compression = round((100 - 100) / 10,0);
            imagepng($img_dest , $dest.'/'.$new_name, $compression);
            break;

            case 'gif':
            imagegif($img_dest , $dest.'/'.$new_name);
            break;
        }
        
        return "cropped";

    }




    /**
     * Get the value of folder
     */ 
    public function getFolder()
    {
        return $this->folder;
    }

    /**
     * Set the value of folder
     *
     * @return  self
     */ 
    public function setFolder($folder)
    {
        $this->folder = $folder;

        return $this;
    }

    /**
     * Get the value of image_name
     */ 
    public function getImageName()
    {
        return $this->imageName;
    }

    /**
     * Set the value of image_name
     *
     * @return  self
     */ 
    public function setImageName($imageName)
    {
        $this->imageName = $imageName;

        return $this;
    }

    /**
     * Get the value of imagePath
     */ 
    public function getImagePath()
    {
        return $this->imagePath;
    }

    /**
     * Set the value of imagePath
     *
     * @return  self
     */ 
    public function setImagePath($imagePath)
    {
        $this->imagePath = $imagePath;

        return $this;
    }
}