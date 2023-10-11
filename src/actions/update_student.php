<?php
    // if have data
    if(isset($_POST['fn'])){
        // import db
        require '../../config/db.php';

        // start sesstion to get current user info
        session_start();

        $user = json_decode($_SESSION['user']);

        $stuId = $_POST['stuId']; // student id
        $fn = $_POST['fn']; // firstName
        $ln = $_POST['ln']; // lastName
        $c = $_POST['c'];   // contact
        $addr = $_POST['addr']; // address
        $g = $_POST['g']; // gender
        $dob = $_POST['dob'];
        $isBL = $_POST['isBlackList'];

        try {
            // connect to db
            $db = DB::Connect();

            // create query
            $sql = "UPDATE student SET first_name='$fn', last_name='$ln', gender=$g, contact='$c', dob='$dob', address='$addr', is_black_list=$isBL, updated_by=".$user->userId.", updated_date=NOW() WHERE stu_id=$stuId";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            // set content type to json to send data back as JSON
            header('Content-Type: application/json');

            // return result
            echo json_encode(array(
                "status"=>1,
                "data"=> "Updated student #$stuId successfully!",
            ));
        } catch(PDOException $ex){
            // return error
            echo json_encode(array(
                "status"=>0,
                "data"=> $ex->getMessage(),
            ));
        }
    }
?>