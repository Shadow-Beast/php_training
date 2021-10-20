<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutorial 6</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <form class="upload-img-form" method="post" action="php/upload.php" enctype="multipart/form-data">
        <fieldset>
            <legend>Upload Image</legend>            
            <input class="foldername-input" name="folderName" type="text" placeholder="Folder Name">
            <input class="img-input" name="imgToUpload" type="file">            
            <input class="upload-btn" type="submit" value="Upload" name="upload">

            <?php
                if(isset($_GET["msg"]) || isset($_GET["uploadOk"])) {
                    $uploadOk = $_GET["uploadOk"];
                    $msg = $_GET["msg"];
                    if($uploadOk == 1) {
                        echo "<p class='upload-success'>";
                    }
                    else {
                        echo "<p class='upload-fail'>";
                    }
                    echo $msg . "</p>";
                }
            ?>
        </fieldset>
    </form>  
</body>
</html>