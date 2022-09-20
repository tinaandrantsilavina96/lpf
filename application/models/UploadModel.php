<?php
  if ( ! defined('BASEPATH')) exit ('No direct script acces allowed');

  class UploadModel extends CI_Model{
      function uploadImage($nom_post,$dossier,$newsnom,$width){

          /* Get original image x y*/
          list($w, $h) = getimagesize($_FILES[$nom_post]['tmp_name']);
          $new_height=$h*$width/$w;
          /* calculate new image size with ratio */
          $ratio = max($width/$w, $new_height/$h);
          $h = ceil($new_height / $ratio);
          $x = ($w - $width / $ratio) / 2;
          $w = ceil($width / $ratio);
          /* new file name */
          //$path = 'uploads/'.$width.'x'.$new_height.'_'.basename($_FILES['fileToUpload']['name']);
//$//        $path = 'imageUpload/'.basename($_FILES[$nom_post]['name']);
          $path = $dossier.'/'.basename($newsnom.".jpg");
          /* read binary data from image file */
          $imgString = file_get_contents($_FILES[$nom_post]['tmp_name']);
          /* create image from string */
          $image = imagecreatefromstring($imgString);
          $tmp = imagecreatetruecolor($width, $new_height);
          imagecopyresampled($tmp, $image,
              0, 0,
              $x, 0,
              $width, $new_height,
              $w, $h);
          $uploadOk = 1;
          $imageFileType = strtolower(pathinfo($path,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
          if(isset($_POST["submit"])) {
              $check = getimagesize($_FILES[$nom_post]["tmp_name"]);
              if($check !== false) {
                  //echo "File is an image - " . $check["mime"] . ".";
                  $uploadOk = 1;
              } else {
                  //echo "File is not an image.";
                  $uploadOk = 0;
              }
          }
// Check if file already exists
          if (file_exists($path)) {
//            echo "Sorry, file already exists.";
//            $uploadOk = 0;
          }
// Check file size
          if ($_FILES[$nom_post]["size"] > 500000000000) {
//            echo "Sorry, your file is too large.";
//            $uploadOk = 0;
          }
// Allow certain file formats
          if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
              && $imageFileType != "gif" ) {
//            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
//            $uploadOk = 0;
          }
          if ($uploadOk == 0) {
              echo "Sorry, your file was not uploaded.";
              // if everything is ok, try to upload file
          } else {
              /* Save image */
              switch ($_FILES[$nom_post]['type']) {
                  case 'image/jpeg':
                      imagejpeg($tmp, $path, 50);
                      break;
                  case 'image/png':
                      imagepng($tmp, $path, 0);
                      break;
                  case 'image/gif':
                      imagegif($tmp, $path);
                      break;
                  default:
                      exit;
                      break;
              }
//            echo "The file " . basename($_FILES["photo"]["name"]) . " has been uploaded.";
              /* cleanup memory */
              imagedestroy($image);
              imagedestroy($tmp);
          }
      }




      function uploadImagePng($nom_post,$dossier,$newsnom,$width){
          /* Get original image x y*/
          list($w, $h) = getimagesize($_FILES[$nom_post]['tmp_name']);
          $new_height=$h*$width/$w;
          /* calculate new image size with ratio */
          $ratio = max($width/$w, $new_height/$h);
          $h = ceil($new_height / $ratio);
          $x = ($w - $width / $ratio) / 2;
          $w = ceil($width / $ratio);
          /* new file name */
          //$path = 'uploads/'.$width.'x'.$new_height.'_'.basename($_FILES['fileToUpload']['name']);
//$//        $path = 'imageUpload/'.basename($_FILES[$nom_post]['name']);
          $path = $dossier.'/'.basename($newsnom.".png");
          /* read binary data from image file */
          $imgString = file_get_contents($_FILES[$nom_post]['tmp_name']);
          /* create image from string */
          $image = imagecreatefromstring($imgString);
          $tmp = imagecreatetruecolor($width, $new_height);
          imagecopyresampled($tmp, $image,
              0, 0,
              $x, 0,
              $width, $new_height,
              $w, $h);
          $uploadOk = 1;
          $imageFileType = strtolower(pathinfo($path,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
          if(isset($_POST["submit"])) {
              $check = getimagesize($_FILES["photo"]["tmp_name"]);
              if($check !== false) {
                  //echo "File is an image - " . $check["mime"] . ".";
                  $uploadOk = 1;
              } else {
                  //echo "File is not an image.";
                  $uploadOk = 0;
              }
          }
// Check if file already exists
          if (file_exists($path)) {
//            echo "Sorry, file already exists.";
//            $uploadOk = 0;
          }
// Check file size
          if ($_FILES["photo"]["size"] > 500000000000) {
//            echo "Sorry, your file is too large.";
//            $uploadOk = 0;
          }
// Allow certain file formats
          if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
              && $imageFileType != "gif" ) {
//            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
//            $uploadOk = 0;
          }
          if ($uploadOk == 0) {
              echo "Sorry, your file was not uploaded.";
              // if everything is ok, try to upload file
          } else {
              /* Save image */
              switch ($_FILES[$nom_post]['type']) {
                  case 'image/jpeg':
                      imagejpeg($tmp, $path, 50);
                      break;
                  case 'image/png':
                      imagepng($tmp, $path, 0);
                      break;
                  case 'image/gif':
                      imagegif($tmp, $path);
                      break;
                  default:
                      exit;
                      break;
              }
//            echo "The file " . basename($_FILES["photo"]["name"]) . " has been uploaded.";
              /* cleanup memory */
              imagedestroy($image);
              imagedestroy($tmp);
          }
      }
  }

?>
