<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Library Management System</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="wrapper">
        <div class="left-side">
            <img src="../media/angel-bookstore.jpg" alt="">
        </div>
        <div class="right-side">
            <form action="" method="post">
                <h1>Welcome Back</h1><br><br>
                <label for="email">Email</label><br>
                <input type="email" name="email" id="email" required><br><br><br>
                <label for="email">Password</label><br>
                <input type="password" name="pass" id="pass" required><br><br>
                <div class="align-right">
                    <a href="#">Forgot Password?</a>
                </div><br>
                <input type="submit" value="Login" onclick="location.href='../index.php'"><br>
                <!-- <div class="center size-15">
                    Don't have account yet?<br>
                    <a href="#">CREATE ACCOUNT</a>
                </div> -->
            </form>
        </div>
    </div>
</body>
</html>