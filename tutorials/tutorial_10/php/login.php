<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <?php session_start(); ?>
</head>
<body>
    <?php
        //Default email
        $email = "zawwintin21@gmail.com";
        
        //Default password
        $password = "root";

        //Overwrite password if changed
        if(isset($_SESSION["user"]["password"])) {
            $password = $_SESSION["user"]["password"];
        }
        
        $entered_email = $_POST["entered_email"];
        $entered_password = $_POST["entered_password"];
        if($entered_email == $email && $entered_password == $password) {
            $_SESSION["user"] = ["email" => $entered_email, "password" => $entered_password];

            //Send to Tutorial 8 Sale Orders Database
            header("location: ../tutorial_8_modify/index.php");
        }
        else {            
            //Go to Login Index when Login failed            
            header("location: ../index.php?loginFail=1");
        }
    ?>    
</body>
</html>