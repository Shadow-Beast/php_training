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
                $file_dir = $dir . $_GET["filename"];
                $file_extension = explode(".", $_GET["filename"])[1];
                
                if ($file_extension == "doc" || $file_extension == "txt") {
                    readNormalTextFile($file_dir);
                } elseif ($file_extension == "csv") {
                    readCSVFile($file_dir);
                } elseif ($file_extension == "xlsx") {
                    readXLSXFile($file_dir);
                } else {
                    echo "Error File Format !";
                }

                echo "</p></div>";
            }

            /**
             * Read file with doc, txt extension
             */
            function readNormalTextFile($file_dir)
            {
                $file_read= file_get_contents($file_dir);
                echo nl2br($file_read);
            }

            /**
             * Read file with csv extension
             */
            function readCSVFile($file_dir)
            {
                $csv_file = fopen($file_dir, "r");
                echo "<table class='excel-table'>";
                $row = 0;
                while (!feof($csv_file)) {
                    echo "<tr>";
                    $data_in_row = fgetcsv($csv_file);
                    //Check Array null or not
                    if (is_array($data_in_row) || is_object($data_in_row)) {
                        foreach ($data_in_row as $data) {
                            if ($row == 0) {
                                echo "<th>",$data,"</th>";
                            } else {
                                echo "<td>",$data,"</td>";
                            }
                        }
                    }
                    echo "</tr>";
                    $row++;
                }
                echo "</table>";
                fclose($csv_file);
            }
            
            /**
             * Read file with xlsx extension
             */
            function readXLSXFile($file_dir)
            {
                include "library/SimpleXLSX.php";
                if ($xlsx = SimpleXLSX::parse($file_dir)) {
                    echo "<table class='excel-table'>";
                    $row = 0;
                
                    foreach ($xlsx->rows() as $elt) {
                        if ($row == 0) {
                            echo "<tr><th>" . $elt[0] . "</th><th>" . $elt[1] . "</th></tr>";
                        } else {
                            echo "<tr><td>" . $elt[0] . "</td><td>" . $elt[1] . "</td></tr>";
                        }
                        $row++;
                    }
                    echo "</table>";
                } else {
                    echo SimpleXLSX::parseError();
                }
            }
        ?>
    </div>    
</body>
</html>