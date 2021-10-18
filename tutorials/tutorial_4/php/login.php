<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php
        $username = "admin";
        $password = "admin123";
        $entered_username = $_POST["username"];
        $entered_password = $_POST["password"];
        if($entered_username == $username && $entered_password == $password) {
            session_start();
            $_SESSION["user"] = ["username" => $entered_username, "password" => $entered_password];
            echo "<div class='welcome-block'><h1>Hi ",$_SESSION["user"]["username"]," !</h1></div>";
            echo "<div class='logout-block'><a class='logout-link' href='logout.php'>Log out</a></div>";
        }
        else {
            /**
             * Go to Index when Login failed
             */
            header("location: ../index.php?loginFail=1");
        }
    ?>    
</body>
</html>