<!DOCTYPE html>

<?php
include_once "header.php";
?>
<?php
$alertText = "<div class=\"alert alert-info bannerWidth\" role=\"alert\">Accepted Types: JPEG, JPG, GIF, PNG</div>";
$i = 0;
$targetDirectory = 'images';

if (isset($_FILES["files"])) {

    $fileName = $_FILES['files']['name'];
    $fileTemp = $_FILES["files"]['tmp_name'];
    $fileType = $_FILES['files']['type'];

    //check each file is a supported image type and then move to directory
    foreach ($fileName as $files) {

        $fileExtension = pathinfo($files, PATHINFO_EXTENSION);

        $extentions = array("jpeg", "gif", "jpg", "png");

        if (in_array($fileExtension, $extentions) == false) {
            $alertText = "<div class=\"alert alert-danger bannerWidth\" role=\"alert\">
  <span class=\"glyphicon glyphicon-exclamation-sign\" aria-hidden=\"true\"></span>
  <span class=\"sr-only\">Error: </span>
  Invalid Input, please only use JPEG, JPG, GIF or PNG.
</div>";

        } else {

            move_uploaded_file($fileTemp[$i], $targetDirectory . "/" . $files);
            $i++;
        }
    }
}
?>


<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css"
          integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ=="
          crossorigin="anonymous">
    <link rel="stylesheet" href="GalleryStyles.css">
</head>
<body>

<?php
include "navbar.php";
?>
<div class="container">
    <div class="row">
        <div class="column-md-12">
            <form class="form-horizontal" method="post" action="PictureGallery.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="imageUpload" class="col-sm-2 control-label">Image: </label>

                    <div class="col-sm-10">
                        <input type="file" class="inputStyling" name="files[]" multiple>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-10">
                        <?php
                        echo $alertText;
                        ?>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </div>
                </div>
            </form>
            <?php

            $col = 0;
            $x = 0;
            $totalPictures = scandir($targetDirectory);
            $totalPictures = array_diff($totalPictures, array('.', '..'));

            echo "<table name='imageThumbnails'><tr>";

            foreach ($totalPictures as $images) {

                //ensure no more than 6 columns in table
                if ($col <= 5) {

                    $targetImage = "images/" . $images;
                    $targetThumb = "thumbs/" . $images;
                    $targetResample = "resample/" . $images;

                    //get base image size
                    list($baseWidth, $baseHeight) = getimagesize($targetImage);


                    $imageThumb = imagecreatetruecolor(180,120);
                    $imageResample = imagecreatetruecolor(800,525);

                    $fileExt = pathinfo($images, PATHINFO_EXTENSION);

                    //check each file type, create thumb and resample based on image type
                    if ($fileExt == "jpg" || $fileExt == "jpeg"){

                        $baseImage = imagecreatefromjpeg($targetImage);

                        imagecopyresampled($imageThumb, $baseImage, 0, 0 , 0 , 0, 180, 120, $baseWidth, $baseHeight);

                        imagecopyresampled($imageResample, $baseImage, 0, 0 , 0 , 0, 800, 525, $baseWidth, $baseHeight);
                        imagejpeg($imageResample, $targetResample);
                        imagejpeg($imageThumb, $targetThumb);

                    }
                    elseif($fileExt == "gif"){

                        $baseImage = imagecreatefromgif($targetImage);

                        imagecopyresampled($imageThumb, $baseImage, 0, 0 , 0 , 0, 180, 120, $baseWidth, $baseHeight);

                        imagegif($imageResample, $targetResample);
                        imagegif($imageThumb, $targetThumb);
                    }
                    elseif($fileExt == "png"){

                        $baseImage = imagecreatefrompng($targetImage);

                        imagecopyresampled($imageThumb, $baseImage, 0, 0 , 0 , 0, 180, 120, $baseWidth, $baseHeight);

                        imagepng($imageResample, $targetResample);
                        imagepng($imageThumb, $targetThumb);
                    }

                    //Insert image into table with JS to make image open in new window.

                    echo "<td><img src=\"$targetThumb\" id=\"$x\"></td>

            <script type=\"text/javascript\">

                var currentId = document.getElementById($x);

                currentId.onclick = function newWindow(){
                    window.open(\"$targetResample\", \"popUpWindow\", \"height=530, width=805\");
                }


            </script>";


                    $col++;
                    $x++;
                }
                else{
                    echo "</tr><tr>";
                    $col = 0;
                }
            }

            echo "</table>";
            ?>
        </div>
    </div>
</div>
</body>
</html>
