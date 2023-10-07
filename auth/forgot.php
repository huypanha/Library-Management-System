<?php
    require '../config/db.php';

    $status = "";

    if(isset($_POST['submit'])){
        try{
            $db = DB::Connect();
            $verSql = "SELECT COUNT(*) FROM user WHERE email='".strtolower($_POST['email'])."' AND ver_code=".$_POST['code'];
            $stmt = $db->prepare($verSql);
            $stmt->execute();
            $count = $stmt->fectColumn();
            echo $count;
            $status = $count;
        }catch(PDOException $ex){
            $status = $ex->getMessage();
            echo $status;
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $(".loading-animation").hide();
            $("#sendCode").click(function(){
                $("#sendCode").hide();
                $(".loading-animation").show();
                $.ajax({
                    method: 'POST',
                    url: 'send_code_to_email.php',
                    data: {
                        email: $("#email").val(),
                    }
                }).done(function (data){
                    if(data == "Code sent!"){
                        $("#status").html("<span style='color: green;'>"+data+"</span>");
                    } else if(data == "Not found!"){
                        $("#status").html("This email was not found, Please register first!");
                    } else {
                        $("#status").html("Sonething went wrong!");
                    }
                    $(".loading-animation").hide();
                    $("#sendCode").show();
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
            <form action="#" method="post">
                <h1>Forgot Password</h1><br>
                <p>Enter your email to reset password</p><br>
                <label for="email">Email</label><br>
                <input type="email" name="email" id="email" value="panhahuy70@gmail.com" required><br>
                <div class="row content-right" id="status"></div>
                <br><label for="code">Verification Code</label><br>
                <input type="number" name="code" id="code"><br><br>
                <div class="row space-between">
                    <a id="sendCode" href="#">Send Code</a>
                    <a class="loading-animation"></a>
                </div><br>
                <input type="submit" value="Submit" id="submit" class="submit"><br><br>
                <input type="button" value="Login" onclick="location.href='login.php'"><br>
            </form>
        </div>
    </div>
</body>
</html>