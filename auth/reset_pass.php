<?php
    require '../config/db.php';
    require 'send_email.php';

    if(!isset($_GET['email'])){
        header("location: forgot.php");
    }

    $status = "";

    if(isset($_POST['submit'])){
        $pass1 = strval($_POST['pass1']);
        $pass2 = strval($_POST['pass2']);
        if($pass1 != $pass2){
            $status = "Both passwords do not match!";
        } else {
            try{
                $db = DB::Connect();
                $sql = "UPDATE user SET pass='".password_hash($pass1, PASSWORD_BCRYPT)."' WHERE email='".strtolower($_GET['email'])."'";
                $stmt = $db->prepare($sql);
                $stmt->execute();
    
                $email = new Email();
                $email->sendEmail($_GET['email'], "Your LMS password has been changed", "Hello,<br><br>Your Library Management System password has been successfully changed on ".date("d/m/Y H:i:s"));
                header("location: login.php");
            }catch(PDOException $ex){
                $status = $ex->getMessage();
            } catch(Exception $e){
                $status = $e;
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Library Management System</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="wrapper flex">
        <div class="left-side">
            <img src="../media/angel-bookstore.jpg" alt="">
        </div>
        <div class="right-side">
            <form action="#" method="post">
                <h1>Reset Password</h1><br>
                <?php 
                    if($status != ""){
                        echo "<div class='error-box'>$status</div><br>";
                    }
                ?>
                <p>Create a new password</p><br>
                <label for="pass1">Password</label><br>
                <input type="password" name="pass1" id="pass1" required><br>
                <br><label for="pass2">Confirm Password</label><br>
                <input type="password" name="pass2" id="pass2" required><br><br>
                <input type="submit" value="Change Password" id="submit" name="submit"><br><br>
                <input type="button" value="Back" id="back" class="back" onclick="location.href='forgot.php'"><br>
            </form>
        </div>
    </div>
</body>
</html>