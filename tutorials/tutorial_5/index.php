<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutorial 5</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="wrapper">
        <div class="directory-block">
            <h1>Directory</h1>
            <ul>
            <?php
                $dir = "resources/";
                $files = array_values(array_diff(scandir($dir), array('.','..')));
                foreach ($files as $file) {
                    echo "<li><a href='index.php?filename=",$file,"'>",$file,"</a></li>";
                }
            ?>
            </ul>
        </div>

        <?php
            /**
             * Check and display file
             */
            if (!empty($_GET["filename"])) {
                echo "<div class='file-block'>";
                echo "<h2>",$_GET["filename"],"</h2><p>";
                $filedir = $dir . $_GET["filename"];
                $fileread= file_get_contents($filedir);
                echo nl2br($fileread);
                echo "</p></div>";
            }
        ?>
    </div>    
</body>
</html>