<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutorial 9</title>    
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php
        // Include config file
        require_once "php/config.php";

        $sqlQuery = "SELECT item,SUM(units) as total_sold_units FROM sale_orders GROUP BY item";
        $result = mysqli_query($link, $sqlQuery);
        $data = array();
        foreach ($result as $row) {
            $data[] = $row;
        }

        mysqli_close($link);
        echo $msg;
        echo '<script> data =' . json_encode($data) . '</script>';
    ?>
    <div class="wrapper">
        <canvas id="graphCanvas"></canvas>
    </div>
    <script src="js/library/jquery.min.js"></script>
    <script src="js/library/Chart.min.js"></script>
    <script src="js/script.js"></script>
</body>
</html>