<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutorial 10</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.min.css'>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <form class="box" method="post" action="php/login.php">
            <h1>Sale Order Login</h1>
            <?php if(isset($_GET["loginFail"])) : ?>
                <p class="text-danger">Email or password is incorrect !</p>
            <?php else : ?>
                <p class="text-muted">Please enter your email and password</p>
            <?php endif; ?>            
            <input type="email" name="entered_email" placeholder="Email Address">
            <input type="password" name="entered_password" placeholder="Password">
            <a class="forgot text-muted" href="php/forgot_pwd.php">Forgot password?</a>
            <input type="submit" value="Login">                        
        </form>      
    </div>  
</body>
</html>