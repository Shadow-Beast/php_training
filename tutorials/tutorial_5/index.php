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
                $file_extension = strtolower(pathinfo($file_dir, PATHINFO_EXTENSION));
                
                if ($file_extension == "txt") {
                    readNormalTextFile($file_dir);
                } elseif ($file_extension == "csv") {
                    readCSVFile($file_dir);
                } elseif ($file_extension == "xlsx") {
                    readXLSXFile($file_dir);
                } elseif ($file_extension == "doc") {
                    readDOCFile($file_dir);
                } else {
                    echo "Error File Format !";
                }

                echo "</p></div>";
            }

            /**
             * Read file with txt extension
             */
            function readNormalTextFile($file_dir)
            {
                $file_read = file_get_contents($file_dir);
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
                    foreach ($xlsx->rows() as $data_in_row) {
                        echo "<tr>";
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
                } else {
                    echo SimpleXLSX::parseError();
                }
            }
            
            /**
             * Read file with doc extension
             */
            function readDOCFile($file_dir)
            {
                if (file_exists($file_dir)) {
                    if (($fh = fopen($file_dir, 'r')) !== false) {
                        $headers = fread($fh, 0xA00);

                        // 1 = (ord(n)*1) ; Document has from 0 to 255 characters
                        $n1 = (ord($headers[0x21C]) - 1);

                        // 1 = ((ord(n)-8)*256) ; Document has from 256 to 63743 characters
                        $n2 = ((ord($headers[0x21D]) - 8) * 256);

                        // 1 = ((ord(n)*256)*256) ; Document has from 63744 to 16775423 characters
                        $n3 = ((ord($headers[0x21E]) * 256) * 256);

                        // 1 = (((ord(n)*256)*256)*256) ; Document has from 16775424 to 4294965504 characters
                        $n4 = (((ord($headers[0x21F]) * 256) * 256) * 256);

                        // Total length of text in the document
                        $textLength = ($n1 + $n2 + $n3 + $n4);

                        $extracted_plaintext = fread($fh, $textLength);

                        echo nl2br($extracted_plaintext);
                    }
                }
            }
        ?>
    </div>    
</body>
</html>