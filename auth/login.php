<?php
    require 'db.php';
    // start session to use session
    session_start();
    // check logged in or not
    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        
        try {
            $db = DB::Connect();
            $sql = "SELECT pass FROM user WHERE email='". strtolower($email)."'";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            if($stmt->rowCount() > 0){
                if($re = $stmt->fetchObject()){
                    echo $pass;
                    echo $re.pass;
                    // if(password_verify($pass, $re.pass)){
                    //     echo "Success";
                    // } else {
                    //     echo "Failed";
                    // }
                }
            } else {
                $error = "User not found!";
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        } catch(Exception $ex){
            echo $ex->getMessage();
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Library Management System</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="wrapper flex">
        <div class="left-side">
            <img src="../media/angel-bookstore.jpg" alt="">
        </div>
        <div class="right-side">
            <form action="#" method="post">
                <h1>Welcome Back</h1><br>
                <p>Provide your information</p><br>
                <label for="email">Email</label><br>
                <input type="text" name="email" id="email"><br><br><br>
                <label for="pass">Password</label><br>
                <input type="password" name="pass" id="pass"><br><br>
                <div class="align-right">
                    <a href="forgot.php">Forgot Password?</a>
                </div><br>
                <input type="submit" value="Login" name="login"><br>
                <!-- <div class="center size-15">
                    Don't have account yet?<br>
                    <a href="#">CREATE ACCOUNT</a>
                </div> -->
            </form>
        </div>
    </div>
    <?php
        if(ISSET($error)){
            echo "<div class='resultBoxError'>$error<a href='#'>x</a></div>";
        }
    ?>
</body>
</html>