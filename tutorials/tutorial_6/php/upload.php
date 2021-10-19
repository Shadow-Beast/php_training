<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
</head>
<body>
<?php
    $target_dir = "../img_storage/" . $_POST["folderName"];
    //Create File if not exists
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }
    $target_file = $target_dir . "/" . basename($_FILES["imgToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $message = "";

    // Check if image file is a actual image or fake image
    if (isset($_POST["upload"])) {
        $check = getimagesize($_FILES["imgToUpload"]["tmp_name"]);
        if ($check !== false) {
            $message .= "File is an image - " . $check["mime"] . ".<br>";
            $uploadOk = 1;
        } else {
            $message .= "File is not an image.<br>";
            $uploadOk = 0;
        }
    }

    // Allow img file formats only
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $message .= "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        $message .= "Sorry, file already exists.<br>";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $message .= "Sorry, your file was not uploaded.";
    // if everything is ok, try to Upload file
    } else {
        if (move_uploaded_file($_FILES["imgToUpload"]["tmp_name"], $target_file)) {
            $message .= "The file ". htmlspecialchars(basename($_FILES["imgToUpload"]["name"])). " has been uploaded.";
        } else {
            $message .= "Sorry, there was an error uploading your file.";
        }
    }
    // Send back to index.php
    header("location: ../index.php?uploadOk=". $uploadOk . "&msg=" . $message);
?>
</body>
</html>