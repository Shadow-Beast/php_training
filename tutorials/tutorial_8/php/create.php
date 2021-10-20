<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Order</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php
    // Include config file
    require_once "config.php";
    
    // Define variables and initialize with empty values
    $order_date = $region = $rep = $item = $units = $unit_cost = "";
    $order_date_err = $region_err = $rep_err = $item_err = $units_err = $unit_cost_err = "";
    
    // Processing form data when form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Validate order date
        $input_order_date = trim($_POST["order_date"]);
        if (empty($input_order_date)) {
            $order_date_err = "Please enter order date.";
        } else {
            $order_date = $input_order_date;
        }
        
        // Validate region
        $input_region = trim($_POST["region"]);
        if (empty($input_region)) {
            $region_err = "Please enter a region.";
        } else {
            $region = $input_region;
        }
        
        // Validate rep
        $input_rep = trim($_POST["rep"]);
        if (empty($input_rep)) {
            $rep_err = "Please enter sales rep.";
        } else {
            $rep = $input_rep;
        }

        // Validate item
        $input_item = trim($_POST["item"]);
        if (empty($input_item)) {
            $item_err = "Please enter item.";
        } else {
            $item = $input_item;
        }

        // Validate units
        $input_units = trim($_POST["units"]);
        if (empty($input_units)) {
            $units_err = "Please enter units.";
        } else {
            $units = $input_units;
        }

        // Validate unit cost
        $input_unit_cost = trim($_POST["unit_cost"]);
        if (empty($input_unit_cost)) {
            $unit_cost_err = "Please enter unit cost.";
        } else {
            $unit_cost = $input_unit_cost;
        }
        
        // Check input errors before inserting in database
        if (empty($order_date_err) && empty($region_err) && empty($rep_err) && empty($item_err) && empty($units_err) && empty($unit_cost_err)) {
            // Prepare an insert statement
            $sql = "INSERT INTO sale_orders (order_date, region, rep, item, units, unit_cost) VALUES (?, ?, ?, ?, ?, ?)";
            
            if ($stmt = mysqli_prepare($link, $sql)) {
                // Bind variables to the prepared statement as parameters
                mysqli_stmt_bind_param($stmt, "ssssss", $param_order_date, $param_region, $param_rep, $param_item, $param_units, $param_unit_cost);
                
                // Set parameters
                $param_order_date = $order_date;
                $param_region = $region;
                $param_rep = $rep;
                $param_item = $item;
                $param_units = $units;
                $param_unit_cost = $unit_cost;
                
                // Attempt to execute the prepared statement
                if (mysqli_stmt_execute($stmt)) {
                    // Records created successfully. Redirect to landing page
                    header("location: ../index.php");
                    exit();
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }
            }
            // Close statement
            mysqli_stmt_close($stmt);
        }
        // Close connection
        mysqli_close($link);
    }
    ?>

    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Create Order Record</h2>
                    <p>Please fill this form and submit to add sale order record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Order Date</label>
                            <input type="date" name="order_date" class="form-control <?php echo (!empty($order_date_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $order_date; ?>">
                            <span class="invalid-feedback"><?php echo $order_date_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Region</label>
                            <input type="text" name="region" class="form-control <?php echo (!empty($region_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $region; ?>">
                            <span class="invalid-feedback"><?php echo $region_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Sales Rep</label>
                            <input type="text" name="rep" class="form-control <?php echo (!empty($rep_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $rep; ?>">
                            <span class="invalid-feedback"><?php echo $rep_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Item</label>
                            <input type="text" name="item" class="form-control <?php echo (!empty($item_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $item; ?>">
                            <span class="invalid-feedback"><?php echo $item_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Units</label>
                            <input type="number" step=1 min="0" name="units" class="form-control <?php echo (!empty($units_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $units; ?>">
                            <span class="invalid-feedback"><?php echo $units_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Unit Cost</label>
                            <input type="number" step=0.01 min="0" name="unit_cost" class="form-control <?php echo (!empty($unit_cost_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $unit_cost; ?>">
                            <span class="invalid-feedback"><?php echo $unit_cost_err;?></span>
                        </div>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="../index.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>