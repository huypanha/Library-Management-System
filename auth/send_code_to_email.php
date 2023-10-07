<?php
    require '../config/db.php';
    if(isset($_POST['email'])){
        $code = rand(100000, 999999);
        try {
            // connect to database
            $db = DB::Connect();

            // create result for return
            $re = array();

            // check this email is registered or not
            $checkEmailSql = "SELECT * FROM user WHERE email='".strtolower($_POST['email'])."'";
            $checkStmt = $db->prepare($checkEmailSql);
            $checkStmt->execute();
            if($checkStmt->rowCount() > 0){
                // update verification code
                $sql = "UPDATE user SET ver_code=".$code." WHERE email='".strtolower($_POST['email'])."'";
                $stmt = $db->prepare($sql);
                $stmt->execute();
                $re = array("status"=>1, "data"=>"Code sent! ".$checkStmt->rowCount());
            } else {
                $re = array("status"=>0, "data"=>"This email was not found, Please register first!");
            }
            echo json_encode($re);
        } catch(PDOException $ex){
            $re = array("status"=>0, "data"=>$ex->getMessage());
            echo json_encode($re);
        }
    }
?>