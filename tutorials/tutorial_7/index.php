<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutorial 7</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <form class="qr-form" action="php/displayqr.php" method="post">
        <fieldset>            
            <legend>QRCode Generator</legend>
            <?php
                //When Clicked without no data
                if(isset($_GET["nodata"])) {
                    echo "<p class='warning-txt'>Please Enter data you want to generate !</p>";
                }
            ?>
            <textarea name="data" id="data-txt" placeholder="Enter your data here ..."></textarea>
            <input class="generate-btn" type="submit" value="Generate">
        </fieldset>
    </form>
</body>
</html>