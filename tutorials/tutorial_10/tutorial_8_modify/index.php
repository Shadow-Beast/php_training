<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutorial 8</title>    
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="float-left">Sale Orders</h2>
                        <a href="../php/logout.php" class="btn btn-info float-right ml-3">
                            <i class="fa fa-sign-out"></i> Log Out
                        </a>
                        <a href="php/create.php" class="btn btn-success float-right">
                            <i class="fa fa-plus"></i> Add New Order
                        </a>                        
                    </div>
                    <?php
                    // Include config file
                    require_once "php/config.php";
                    
                    // Attempt select query execution
                    $sql = "SELECT * FROM sale_orders";
                    if ($result = mysqli_query($link, $sql)) {
                        if (mysqli_num_rows($result) > 0) {
                            echo '<table class="table table-bordered table-striped">';
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>#</th>";
                            echo "<th>Order Date</th>";
                            echo "<th>Region</th>";
                            echo "<th>Rep</th>";
                            echo "<th>Item</th>";
                            echo "<th>Units</th>";
                            echo "<th>Unit Cost</th>";
                            echo "<th>Total</th>";
                            echo "<th>Action</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . date('m-d-Y', strtotime($row['order_date'])) . "</td>";
                                echo "<td>" . $row['region'] . "</td>";
                                echo "<td>" . $row['rep'] . "</td>";
                                echo "<td>" . $row['item'] . "</td>";
                                echo "<td>" . $row['units'] . "</td>";
                                echo "<td>" . $row['unit_cost'] . "</td>";
                                echo "<td>" . $row['total'] . "</td>";
                                echo "<td>";
                                echo '<a href="php/read.php?id='. $row['id'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                echo '<a href="php/update.php?id='. $row['id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                echo '<a href="php/delete.php?id='. $row['id'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                echo "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else {
                            echo '<div class="alert alert-danger"><em>No records were found.<br>' . $msg .'</em></div>';
                        }
                    } else {
                        echo "Oops! Something went wrong. Please try again later.";
                    }
 
                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>