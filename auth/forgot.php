<?php
    require '../config/db.php';

    $status = "";

    if(isset($_POST['submit'])){
        try{
            $db = DB::Connect();
            $verSql = "SELECT COUNT(*) FROM user WHERE email='".strtolower($_POST['email'])."' AND ver_code='".$_POST['code']."'";
            $stmt = $db->prepare($verSql);
            $stmt->execute();
            if($stmt->fetchColumn() > 0){
                header("location: reset_pass.php?email=".strtolower($_POST['email']));
            } else {
                $status =  "Incorrect verification code!";
            }
        }catch(PDOException $ex){
            $status = $ex->getMessage();
        } catch(Exception $e){
            $status = $e;
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Library Management System</title>
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
                        $("#status").html("<span style='color: green; font-size: 13px;'>"+data+"</span>");
                    } else if(data == "Not found!"){
                        $("#status").html("<span style='color: red; font-size: 13px;'>This email was not found, Please register first!</span>");
                    } else {
                        $("#status").html("<span style='color: red; font-size: 13px;'>Sonething went wrong!</span>");
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
                <?php 
                    if($status != ""){
                        echo "<div class='error-box'>$status</div><br>";
                    }
                ?>
                <p>Enter your email to reset password</p><br>
                <label for="email">Email</label><br>
                <input type="email" name="email" id="email" value="<?php echo $_POST['email']; ?>" required><br>
                <div class="row content-right" id="status"></div>
                <br><label for="code">Verification Code</label><br>
                <input type="number" name="code" id="code" required><br><br>
                <div class="row space-between">
                    <a id="sendCode" href="#">Send Code</a>
                    <a class="loading-animation"></a>
                </div><br>
                <input type="submit" value="Submit" id="submit" name="submit"><br><br>
                <input type="button" value="Login" id="login" class="login" onclick="location.href='login.php'"><br>
            </form>
        </div>
    </div>
</body>
</html>