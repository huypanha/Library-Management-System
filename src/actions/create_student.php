<?php
    // if have data
    if(isset($_POST['fn'])){
        // import db
        require '../../config/db.php';

        // start sesstion to get current user info
        session_start();

        $user = json_decode($_SESSION['user']);

        $fn = $_POST['fn']; // firstName
        $ln = $_POST['ln']; // lastName
        $c = $_POST['c'];   // contact
        $addr = $_POST['addr']; // address
        $g = $_POST['g']; // gender
        $dob = $_POST['dob'];

        // set content type to json to send data back as JSON
        header('Content-Type: application/json');

        try {
            // connect to db
            $db = DB::Connect();

            // create query
            $sql = "INSERT INTO student(first_name, last_name, gender, contact, dob, address, created_by) 
                    VALUES('$fn', '$ln', $g, '$c', '$dob', '$addr', ".$user->userId.")";
            $stmt = $db->prepare($sql);
            $stmt->execute();

            // get last inserted id
            $newId = $db->lastInsertId();

            // get role
            $role = json_decode($_SESSION['role']);

            // return result
            echo json_encode(array(
                "status"=>1,
                "data"=> $newId,
                "roleTitle"=>$role->title,
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