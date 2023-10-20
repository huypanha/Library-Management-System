<?php
    require '../config/db.php';
    // start session to use session
    session_start();
    // check logged in or not
    if(isset($_POST['login'])){
        $email = $_POST['email'];
        $pass = $_POST['pass'];
        
        try {
            $db = DB::Connect();
            $sql = "SELECT * FROM user WHERE email='". strtolower($email)."' LIMIT 1";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            if($stmt->rowCount() > 0){
                $re = $stmt->fetch();
                if(password_verify($pass, $re['pass'])){
                    $getRoleSql = "SELECT * FROM role WHERE role_id=".$re['role_id']." LIMIT 1";
                    $roleStmt = $db->prepare($getRoleSql);
                    $roleStmt->execute();
                    $userRole = $roleStmt->fetch();

                    $role = array(
                        'roleId'=>$userRole['role_id'],
                        'title'=>$userRole['title'],
                        'status'=>$userRole['status'],
                    );

                    $user = array(
                        'userId'=>$re['user_id'],
                        'userName'=>$re['username'],
                        'email'=>$re['email'],
                        'phone'=>$re['phone'],
                        'address'=>$re['address'],
                        'profileImg'=>$re['profile_img'],
                        'gender'=>$re['gender'],
                    );

                    $_SESSION['user'] = json_encode($user);
                    $_SESSION['role'] = json_encode($role);
                    $_SESSION['loggedIn'] = true;
                    header("location: ../index.php");
                } else {
                    $error = "Incorrect Password";
                }
            } else {
                $error = "User not found!";
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
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
                <input type="email" name="email" id="email" value="panhahuy70@gmail.com" required><br><br><br>
                <label for="pass">Password</label><br>
                <input type="password" name="pass" id="pass" value="1111" required><br><br>
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
        if(isset($error)){
            echo "<div class='resultBoxError'>$error
            <a href='login.php'>x</a></div>";
        }
    ?>
</body>
</html>