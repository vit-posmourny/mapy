<?php

namespace App\Http\Controllers;

use Core\View;

class CroppieController
{
    private $msgs = [];

    private $color = 'white';

    public function showCroppieDialog()
    {
        return view('croppie', [
            'messages' => $this->msgs,
            'color' => $this->color,
        ]);
    }

    public function uploadAccountImg()
    {
        $target_dir = "images/user/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image
        if(isset($_POST["submit"])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {

                $uploadOk = 1;
            } else {
                // msg #0
                $this->msgs[0] = "File is not an image.";
                $this->color = 'red';
                $uploadOk = 0;
            }
        }
        
        // Check if file already exists
        if (file_exists($target_file)) {
            // msg #1
            $this->msgs[1] = "Sorry, file already exists. <br>";
            $uploadOk = 0;
        }
        
        // Check file size
        if ($_FILES["fileToUpload"]["size"] > 500000) {
            // msg #2
            $this->msgs[2] = "Sorry, your file is too large. <br>";
            $uploadOk = 0;
        }
  
        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            // msg #3
            $this->msgs[3] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }
        
        if ($uploadOk == 0) {
            // msg #4
            $this->msgs[4] = "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } 
        else {
            
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                // msg #5
                $this->msgs[5] = "Image uploaded successfull.";
                $this->color = "green";
            }
            else {
                // msg #6
                $this->msgs[6] = "Sorry, there was an error uploading your file.";
            }
        }
        $this->showCroppieDialog();
    }
}
