<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require_once "../vendor/autoload.php";
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validation Code</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.min.css'>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="container">
        <form class="box" method="post" action="pwd_reset_token.php">
            <h1>Confirm<br>Verfication Code</h1> 
            <?php
                //Default email
                $email = "zawwintin21@gmail.com";
                if(isset($_POST["entered_email"]) && isset($_POST["password-reset-token"])) {
                    if($email == $_POST["entered_email"]) {                        
                        $token = md5($email).rand(10,9999);
                        $mail = new PHPMailer();
                        $expFormat = mktime(date("H")+1, date("i"), date("s"), date("m"), date("d"), date("Y"));
                        $expDate = date("Y-m-d H:i:s",$expFormat);
                        $_SESSION["one_time_code"] = ["token" => $token, "expDate" => $expDate];
                        
                        $mail = new PHPMailer();

                        /* enable SMTP authentication. */
                        $mail->IsSMTP();
                        /* specify main and backup SMTP */
                        $mail->Host = "smtp.gmail.com";
                        $mail->SMTPAuth = true;
                        $mail->CharSet =  "utf-8";
                        $mail->SMTPSecure = 'tls';
                        $mail->Port = 587;

                        /* Log in with Sender email and password */
                        $mail->Username = "sender@gmail.com";;
                        $mail->Password = 'senderpasswordhere';

                        /* Set the mail sender. */
                        $mail->setFrom("sender@gmail.com", "Sender");

                        /* Add a recipient. */
                        $mail->addAddress($email, "Zaw Win Tin");
                        $mail->addReplyTo($email);

                        $mail->IsHTML(true);
                        $mail->Subject  = "Reset Password";
                        $mail->Body = "<big>Here is verfication code to reset password: </big><b>" . $token . "</b>";
                        if($mail->send()) {
                            echo '<p class="text-muted">Verfication code is sent to your email.</p>';
                            echo '<input type="text" name="entered-verfication-code" placeholder="Verfication Code">';
                            echo '<input type="submit" name="code-submit" value="Submit">';  
                        } else {
                            /* PHPMailer exception. */
                            echo '<p class="text-danger">' . $mail->ErrorInfo . '</p>';
                        }                           
                    } else {
                        header("location: forgot_pwd.php?emailFail=1");
                    } 
                } else {
                    if(isset($_POST["entered-verfication-code"]) && isset($_POST["code-submit"])) {
                        $one_time_code = $_SESSION["one_time_code"]["token"];
                        $one_time_expDate = $_SESSION["one_time_code"]["expDate"];
                        $current_time = date("Y-m-d H:i:s");
                        if($one_time_code == $_POST["entered-verfication-code"]) {
                            if($current_time <= $one_time_expDate) {
                                header("location: reset_pwd.php");
                            } else {
                                echo '<p class="text-warning">Code is expired !</p>';
                                echo '<a class="try-again-link" href="forgot_pwd.php">Try again</a>';
                            }
                        } else {
                            echo '<p class="text-warning">Verfication code is incorrect !</p>';
                            echo '<a class="try-again-link" href="forgot_pwd.php">Try again</a>';
                        }
                        //Reset one_time_code
                        unset($_SESSION["one_time_code"]);
                    }
                }  
            ?>                 
        </form>      
    </div> 
</body>
</html>
