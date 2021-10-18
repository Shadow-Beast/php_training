<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutorial 4</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <form class="login-form" method="post" action="php/login.php">
        <fieldset>
            <legend>Login Form</legend>
            <?php
                /**
                 * Check and display When Login Failed
                 */
                if(!empty($_GET["loginFail"])) {
                    echo "<p>Username or password is incorrect !</p>";
                }
            ?>
            <input class="login-input" name="username" type="text" placeholder="Username">
            <input class="login-input" name="password" type="password" placeholder="Password">
            <input class="login-btn" type="submit" value="Login">
        </fieldset>
    </form>    
</body>
</html>