<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php
        if (!empty($_POST["data"])) {
            include "../library/phpqrcode/qrlib.php";
            $txt_data = $_POST["data"];

            //file image naming
            $qrcode_id = 0;
            $qrcode_folder_location = "../qr_img/";
            //file path
            $qrcode_img_location = $qrcode_folder_location . sprintf("%03d", $qrcode_id) . ".png";
            while (file_exists($qrcode_img_location)) {
                $qrcode_id++;
                $qrcode_img_location = $qrcode_folder_location . sprintf("%03d", $qrcode_id) . ".png";
            }

            //other parameters
            $ecc = 'H';
            $pixel_size = 12;
            $frame_size = 5;
            QRcode::png($txt_data, $qrcode_img_location, $ecc, $pixel_size, $frame_size);

            echo "<div class= 'qrcode-block'><h1>QR Code Generated Successfully!</h1>";
            echo "<img src='" . $qrcode_img_location . "'>";
            echo "<a class='goback-btn' href='../index.php'>Generate New Code</a></div>";
        } else {
            header("location: ../index.php?nodata=1");
        }
    ?>
</body>
</html>