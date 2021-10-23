<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Sale Order</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php
    // Check existence of id parameter before processing further
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        // Include config file
        require_once "config.php";
        
        // Prepare a select statement
        $sql = "SELECT * FROM sale_orders WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = trim($_GET["id"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);
        
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $order_date = $row["order_date"];
                    $region = $row["region"];
                    $rep = $row["rep"];
                    $item = $row["item"];
                    $units = $row["units"];
                    $unit_cost = $row["unit_cost"];
                    $total = $row["total"];
                } else {
                    // URL doesn't contain valid id parameter. Redirect to error page
                    header("location: error.php");
                    exit();
                }                
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($link);
    } else {
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    } 
    ?>

    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">View Record</h1>
                    <div class="form-group">
                        <label>Order Date</label>
                        <p><b><?php echo $row["order_date"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Region</label>
                        <p><b><?php echo $row["region"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Rep</label>
                        <p><b><?php echo $row["rep"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Item</label>
                        <p><b><?php echo $row["item"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Units</label>
                        <p><b><?php echo $row["units"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Unit Cost</label>
                        <p><b><?php echo $row["unit_cost"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Total</label>
                        <p><b><?php echo $row["total"]; ?></b></p>
                    </div>
                    <p><a href="../index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>