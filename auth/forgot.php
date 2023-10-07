<?php
    $status = array();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Library Management System</title>
    <link rel="stylesheet" href="../css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#sendCode").click(function(){
                $.ajax({
                    method: 'POST',
                    url: 'send_code_to_email.php',
                    data: {
                        email: $("#email").val(),
                    }
                }).done(function (jdata){
                    const data = jQuery.parseJSON(jdata);
                    alert(jdata + " " + data.status+" " + data.status == 0);
                    if(data.status == 0){
                        $("#status").html = data.data;
                    }
                });
            });
        });
    </script>
</head>
<body>
    <div class="wrapper flex">
        <div class="left-side">
            <img src="../media/angel-bookstore.jpg" alt="">
        </div>
        <div class="right-side">
            <form action="" method="post">
                <h1>Forgot Password</h1><br>
                <p>Enter your email to reset password</p><br>
                <label for="email">Email</label><br>
                <input type="email" name="email" id="email" required><br>
                <div id="status"></div>
                <br><label for="code">Verification Code</label><br>
                <input type="number" name="code" id="code"><br><br>
                <div class="row space-between">
                    <a id="sendCode" href="#">Send Code</a>
                    <a href="#">Forgot Password?</a>
                </div><br>
                <input type="submit" value="Submit"><br><br>
                <input type="button" value="Login" onclick="location.href='login.php'"><br>
            </form>
        </div>
    </div>
</body>
</html>