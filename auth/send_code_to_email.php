<?php
    require '../config/db.php';
    require '../vendor/autoload.php';
    include 'send_email.php';

    if(isset($_POST['email'])){
        $code = rand(100000, 999999);
        try {
            // connect to database
            $db = DB::Connect();

            // create result for return
            $re = "";

            // check this email is registered or not
            $checkEmailSql = "SELECT * FROM user WHERE email='".strtolower($_POST['email'])."'";
            $checkStmt = $db->prepare($checkEmailSql);
            $checkStmt->execute();
            if($checkStmt->rowCount() > 0){
                // update verification code
                $sql = "UPDATE user SET ver_code=".$code." WHERE email='".strtolower($_POST['email'])."'";
                $stmt = $db->prepare($sql);
                $stmt->execute();

                $email = new Email();
                $email->sendEmail($_POST['email'], "Verification Code for Library Management System", 
                "Your verification code is : <b><h1 style='color: #1479ff;'>".$code."</h1></b>");
                $re = "Code sent!";
            } else {
                $re = "Not found!";
            }
            echo $re;
        } catch(PDOException $ex){
            $re = $ex->getMessage();
            echo $re;
        }
    }
?>