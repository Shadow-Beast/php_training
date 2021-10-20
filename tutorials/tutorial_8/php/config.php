<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Config</title>
</head>
<body>
    <?php
        define('DB_SERVER', 'localhost');
        define('DB_USERNAME', 'root');
        define('DB_PASSWORD', 'root');
        define('DB_NAME', 'tutorial8db');
        
        //Print $msg if want to check error
        $msg = '';

        /* Attempt to connect to MySQL*/
        $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD);
        if($link == false) {
            $msg .= "Cound not connect";
        } else {
            $msg .= "Connect Successful!";
        }

        $createdb_query = "CREATE DATABASE " . DB_NAME;
        if(mysqli_query($link, $createdb_query)){
            $msg .= "<br>Database created successfully.";
        } else {
            $msg .= "<br>ERROR: " . mysqli_error($link);
        }        

        $usedb_query = "USE " . DB_NAME;
        mysqli_query($link, $usedb_query);

        $createtable_sql = "CREATE TABLE sale_orders(
                                id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                                order_date DATE NOT NULL,
                                region VARCHAR(30) NOT NULL,
                                rep VARCHAR(30) NOT NULL,
                                item VARCHAR(30) NOT NULL,
                                units INT(5) NOT NULL,
                                unit_cost DECIMAL(5,2) NOT NULL,
                                total DECIMAL(10,2) AS (units * unit_cost)
                            )";

        if(mysqli_query($link, $createtable_sql)){
            $msg .= "<br>Table created successfully.";
        } else {
            $msg .= "<br>ERROR: " . mysqli_error($link);
        }
    ?>
</body>
</html>